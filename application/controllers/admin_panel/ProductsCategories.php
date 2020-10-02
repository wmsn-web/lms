<?php
/**
 * 
 */
class ProductsCategories extends CI_controller
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
		if(!empty($id))
		{
			$getAllCat = $this->AdminModel->getAllCat();
			$getCatById = $this->AdminModel->getCatById($id);
			$this->load->view("admin/EditCat",["data"=>$getAllCat,"cat"=>$getCatById]);
		}
		else
		{
			$getAllCat = $this->AdminModel->getAllCat();
			$this->load->view("admin/ProductsCategories",["data"=>$getAllCat]);
		}
		
	}

	public function addCat()
	{
		$catName = $this->input->post("catName");
		$this->db->where("cat_name",$catName);
		$chk = $this->db->get("categories")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("Feed","Category Already Exist!");
			return redirect("admin_panel/ProductsCategories");
		}
		else
		{
			$config['upload_path'] = './uploads/cat_img';
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
			if ( ! $this->upload->do_upload("cat_mg")) {
			    $error = array('error' => $this->upload->display_errors());
			    $err = $error['error'];
			    $this->session->set_flashdata("Feed",$err);
				return redirect("admin_panel/ProductsCategories");
			} else {
			    $arr_image = array('upload_data' => $this->upload->data());
			    //print_r($arr_image);
			    $cat_img = $arr_image['upload_data']['file_name'];
			    $this->db->insert("categories",["cat_name"=>$catName,"cat_img"=>$cat_img]);
			    $this->session->set_flashdata("Feed","Category Saved Successfully");
				return redirect("admin_panel/ProductsCategories");
			}
		}
	}

	public function EditCat()
	{
		$catName = $this->input->post("catName");
		$id = $this->input->post("id");
		if($_FILES['cat_mg']['name']=="")
		{
				$this->db->where("id",$id);
				$this->db->update("categories",["cat_name"=>$catName]);
			    $this->session->set_flashdata("Feed","Category Updated Successfully");
				return redirect("admin_panel/ProductsCategories");
		}
		else
		{
				$config['upload_path'] = './uploads/cat_img';
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
				if ( ! $this->upload->do_upload("cat_mg")) {
				    $error = array('error' => $this->upload->display_errors());
				    $err = $error['error'];
				    $this->session->set_flashdata("Feed",$err);
					return redirect("admin_panel/ProductsCategories");
				} else {
				    $arr_image = array('upload_data' => $this->upload->data());
				    //print_r($arr_image);
				    $cat_img = $arr_image['upload_data']['file_name'];
				    $this->db->where("id",$id);
					$this->db->update("categories",["cat_name"=>$catName,"cat_img"=>$cat_img]);
				    $this->session->set_flashdata("Feed","Category Updated Successfully");
					return redirect("admin_panel/ProductsCategories");
				}
		}
	}
}