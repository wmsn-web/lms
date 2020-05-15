<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div style="margin-top: 55px">
		<?php if(!$this->session->userdata("UserAdmin")){ ?>
			<div align="center">
				<?php if($feed=$this->session->flashdata("Feed")){ ?>
					<span style="color:#f00"><?= $feed; ?></span>
				<?php } ?>
				<form action="<?= base_url('admin_panel/HomeAdmin/loginProcess'); ?>" method="post">
					<label>Username:</label>
					<input type="text" name="username" required="required" /><br><br>
					<label>Password:</label>
					<input type="password" name="password" required="required"><br><br>
					<input type="submit" name="sumbit" value="Login">
				</form>
			</div>
	    <?php }else{ ?>
	    	<div class="container">
	    		<h4>Join User</h4>
	    		<?php if($feed = $this->session->flashdata("Feed")){ ?>
	    			<span class="text-danger"><?= $feed; ?></span>
	    	    <?php } ?>
	    		<div class="row">
	    			<div class="col-md-4">
	    				<div class="card">
	    					<div class="card-body">
			    				<form action="<?= base_url('admin_panel/Join/userJoin'); ?>" method='get'>
			    					<div class="form-group">
			    						<label>Full Name</label>
			    						<input type="text" name="name" class="form-control">
			    					</div>
			    					<div class="form-group">
			    						<label>Email</label>
			    						<input type="text" name="email" class="form-control">
			    					</div>
			    					<div class="form-group">
			    						<label>Mobile</label>
			    						<input type="text" name="phone" class="form-control">
			    					</div>
			    					<div class="form-group">
			    						<label>Address</label>
			    						<input type="text" name="addr" class="form-control">
			    					</div>
			    					<div class="form-group">
			    						<label>Under</label>
			    						<input type="text" name="under" class="form-control">
			    					</div>
			    					<div class="form-group">
			    						<label>Position</label><br>
			    						<input type="radio" value="left" name="side"> 1st
			    						<input type="radio" value="right" name="side"> 2nd
			    						<input type="radio" value="three" name="side"> 3rd
			    						<input type="radio" value="fourth" name="side"> 4th
			    						<input type="radio" value="fifth" name="side"> 5th
			    						<input type="radio" value="sixth" name="side"> 6th
			    						<input type="radio" value="seventh" name="side"> 7th
			    						<input type="radio" value="eighth" name="side"> 8th
			    						<input type="radio" value="ninth" name="side"> 9th
			    						<input type="radio" value="tenth" name="side"> 10th
			    					</div>
			    					<div class="form-group">
			    						<button name="join_user" class="btn btn-primary">Save</button>
			    					</div>
			    				</form>
			    			</div>
			    		</div>
	    			</div>
	    			<div class="col-md-8">
	    				<div class="table-responsive">
	    					<table class="table table-bordered table-stripe">
	    						<tr>
	    							<th>SL</th>
	    							<th>Name</th>
	    							<th>Email</th>
	    							<th>Mobile</th>
	    							<th>User ID</th>
	    							<th>Position</th>
	    							<th>Total Join</th>
	    						</tr>
	    						<?php
	    						$i = 1;
	    						foreach ($getDtls as $key => $value) { $s = $i++;?>
	    							
	    						
	    						<tr>
	    							<td><?= $s; ?></td>
	    							<td><?= $value['name']; ?></td>
	    							<td><?= $value['email']; ?></td>
	    							<td><?= $value['mobile']; ?></td>
	    							<td><?= $value['userid']; ?></td>
	    							<td><?= $value['position']."<br>(Under ".$value['under'].")"; ?></td>
	    							<td><?= $value['total']; ?></td>
	    						</tr>
	    					<?php } ?>
	    					</table>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    <?php } ?>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>