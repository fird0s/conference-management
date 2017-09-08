  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register - <?php echo $this->config->item('title') ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url()?>static/css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url()?>static/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url()?>static/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url()?>static/img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>REGISTER</h1>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <?php if($this->session->flashdata('success_msg')):?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('success_msg');?>
                      </div>
                    <?php endif?>

                    <?php if($this->session->flashdata('err_msg')):?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error! </strong> <?php echo $this->session->flashdata('err_msg');?>
                      </div>
                    <?php endif?>

                  <?php echo form_open('account/register', array('id'=>'register-form')); ?>

                    <div class="form-group">
                      <label for="type">Type of Member:</label>
                      <select class="form-control" id="type" name="type">
                        <option value="0">Participant with paper</option>
                        <option value="1">Participant without paper</option>
                        <option value="2">Sponsor</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <input id="register-title" type="text" name="title" class="input-material" aria-required="true">
                      <label for="register-title" class="label-material">Academic Title</label>
                    </div>

                    <div class="form-group">
                      <input id="register-username" type="text" name="name" required="" class="input-material" aria-required="true">
                      <label for="register-username" class="label-material">Name</label>
                    </div>

                    <div class="form-group">
                      <input id="register-surname" type="text" name="surname" required="" class="input-material" aria-required="true">
                      <label for="register-surname" class="label-material">Surname</label>
                    </div>

                     <div class="form-group">
                      <input id="register-email" type="email" name="email" required="" class="input-material" aria-required="true" >
                      <label for="register-email" class="label-material">Email</label>
                    </div>

                    <div class="form-group">
                      <input id="register-work" type="text" name="work" required="" class="input-material" aria-required="true">
                      <label for="register-work" class="label-material">Place of Work</label>
                    </div>

                    <div class="form-group">
                      <input id="register-address" type="text" name="address" required="" class="input-material" aria-required="true">
                      <label for="register-address" class="label-material">Correspondence Address</label>
                    </div>

                     <div class="form-group">
                      <input id="register-phone" type="number" name="phone" required="" class="input-material" aria-required="true">
                      <label for="register-phone" class="label-material">Phone</label>
                    </div>

                    <div class="form-group">
                      <label for="register-bill" class="label-material">Data for Bill</label>
                      <textarea class="form-control" rows="3" id="register-bill" name="bill"></textarea>
                    </div>

                    <div class="form-group">
                      <input id="register-tax" type="text" name="tax" class="input-material">
                      <label for="register-tax" class="label-material">Tax Number</label>
                    </div>

                    <input id="register" type="submit" name="submit" value="Register" class="btn btn-primary">
                  </form><small>Already have an account? </small><a href="<?php echo base_url()?>index.php/account/login" class="signup">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo base_url()?>static/js/tether.min.js"></script>
    <script src="<?php echo base_url()?>static/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>static/js/jquery.cookie.js"> </script>
    <script src="<?php echo base_url()?>static/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url()?>static/js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
   
  </body>
</html>