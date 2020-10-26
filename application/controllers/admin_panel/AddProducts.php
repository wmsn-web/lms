<?php
/**
 * 
 */
class AddProducts extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("AdminUsers"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/Login?refer=$actual_link");
		}
		
	}

	public function index($id='')
	{
			$admin = $this->session->userdata("AdminUsers");
			if($admin == "admin")
			{
				
			if(!empty($id))
			{
				$getAllCat = $this->AdminModel->getAllCat();
				$getAllProducts = $this->AdminModel->getAllProducts();
				$getProById = $this->AdminModel->getProById($id);
				$this->load->view("admin/EditProducts",["data"=>$getAllProducts,"cats"=>$getAllCat,"proData"=>$getProById]);
			}
			else
			{
				$getAllCat = $this->AdminModel->getAllCat();
				$getAllProducts = $this->AdminModel->getAllProducts();
				$this->load->view("admin/AddProducts",["data"=>$getAllProducts,"cats"=>$getAllCat]);
			}
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function addPro()
	{
		$cat_id = $this->input->post("catId");
		$proName = $this->input->post("proName");
		$price = $this->input->post("price");

		$this->db->where(["cat_id"=>$cat_id,"pro_name"=>$proName]);
		$chk = $this->db->get("products")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("Feed","Product Already Exist!");
			return redirect("admin_panel/AddProducts");
		}
		else
		{
			$config['upload_path'] = './uploads/products';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_width'] = 0;
	        $config['max_height'] = 0;
	        $config['max_size'] = 0;
	        $config['remove_spaces'] = TRUE;
	        $config['encrypt_name'] = FALSE;
	        $fileName = mt_rand(0000000, 9999999);
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload("pro_mg")) {
			    $error = array('error' => $this->upload->display_errors());
			    $err = $error['error'];
			    $this->session->set_flashdata("Feed",$err);
				return redirect("admin_panel/AddProducts");
			} else {
			    $arr_image = array('upload_data' => $this->upload->data());
			    //print_r($arr_image);
			    $pro_img = $arr_image['upload_data']['file_name'];
			    $this->db->insert("products",["cat_id"=>$cat_id,"pro_name"=>$proName,"pro_img"=>$pro_img,"price"=>$price]);
			    $this->session->set_flashdata("Feed","Product Saved Successfully");
				return redirect("admin_panel/AddProducts");
			}
		}
	}

	public function edPro()
	{
		$cat_id = $this->input->post("catId");
		$pro_id = $this->input->post("id");
		$proName = $this->input->post("proName");
		$price = $this->input->post("price");
		if($_FILES['pro_mg']['name']=="")
		{
				$this->db->where("id",$pro_id);
				$this->db->update("products",["cat_id"=>$cat_id,"pro_name"=>$proName,"price"=>$price]);
			    $this->session->set_flashdata("Feed","Product Updated Successfully");
				return redirect("admin_panel/AddProducts/index/".$pro_id);
		}
		else
		{
			$config['upload_path'] = './uploads/products';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_width'] = 0;
	        $config['max_height'] = 0;
	        $config['max_size'] = 0;
	        $config['remove_spaces'] = TRUE;
	        $config['encrypt_name'] = FALSE;
	        $fileName = mt_rand(0000000, 9999999);
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload("pro_mg")) {
			    $error = array('error' => $this->upload->display_errors());
			    $err = $error['error'];
			    $this->session->set_flashdata("Feed",$err);
				return redirect("admin_panel/AddProducts");
			} else {
			    $arr_image = array('upload_data' => $this->upload->data());
			    //print_r($arr_image);
			    $pro_img = $arr_image['upload_data']['file_name'];
			    $this->db->where("id",$pro_id);
			    $this->db->update("products",["cat_id"=>$cat_id,"pro_name"=>$proName,"pro_img"=>$pro_img,"price"=>$price]);
			    $this->session->set_flashdata("Feed","Product Saved Successfully");
				return redirect("admin_panel/AddProducts/index/".$pro_id);
			}
		}
	}
}