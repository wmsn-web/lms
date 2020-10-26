<div id="modal1" tabindex="-1"  class="modal fade" role="dialog">
  <div class="modal-dialog  modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"> 
      <h3>Login</h3>       
        <span type="button" class="close" data-dismiss="modal">&times;</span>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <form action="<?= base_url('UserLogin/Login'); ?>" method="post">
                        <div class="sign-form">
                            <div class="form-group">
                                <label>Mobile No. Or Email Id</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <input type="hidden" name="redirectUrl" value="<?= $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                            <button class="bnt bnt-primary" type="submit">Login</button><br>
                            <a href="<?= base_url('ForgotPass'); ?>">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>