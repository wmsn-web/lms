<?php

class Products extends CI_controller
{
	
	function index()
	{
		$allpro = $this->AdminModel->getAllProducts();
		$getAllCat = $this->AdminModel->getAllCat();
		$this->load->view("fronts/Products",["data"=>$allpro,"cats"=>$getAllCat]);
	}

	function getByCat()
	{
		$id = $this->input->post("id");
		$getProByCat = $this->SiteModel->getProByCat($id);
		$data = $getProByCat; ?>

				<div class="row align-items-center">
                        <?php foreach($data as $pro){ ?>
                            <div class="col-md-2">
                                <div  class="product-div moving-vertical">
                                    <span class="badges">Best Offer 
                                    </span><span class="bxblank"></span><br>
                                    <div class="pro_img">
                                        <img src="<?= base_url('uploads/products/'.$pro['img']); ?>"><br>
                                        <span class="pro-price">&#8377; <?= $pro['price']; ?></span><br>
                                        <ul class="rating">
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star-o orange"></i></li>
                                    </ul><br>
                                    <span class="pro-title"><?= $pro['pro_name']; ?></span>
                                    <p class="pro-des">This Product will available only Samridhi's Store</p>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php } ?>
                    </div>
<?php	}
}