<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Change Password</title>
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
    
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Font Icons CSS-->
    <!-- <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Account </span></div>
                  <div class="brand-text brand-small"><strong>Account</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo base_url()?>index.php/account/logout" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            
            <div class="title">
              <h1 class="h4">Hi, <?php echo $user->name ?> <?php echo $user->surname ?></h1>
              <p> </p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
         <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/account/profile"><i class="icon-home"></i>Profile</a></li>
            <li class="active"> <a href="<?php echo base_url()?>index.php/account/change_pwd"><i class="icon-grid"></i>Security</a></li>
          </ul>
         
          <?php if ($user->type === '0'): ?>
          <span class="heading">Paper</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/account/papers"><i class="icon-presentation"></i>My Paper</a></li>
            <li> <a href="<?php echo base_url()?>index.php/account/add_paper"><i class="icon-check"></i>Add Paper</a></li>
          </ul>
          <?php endif; ?>


          <span class="heading">Payment</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/account/payments"><i class="icon-bill"></i>Payment</a></li>
            <!-- <li> <a href="<?php echo base_url()?>index.php/account/make_payment"><i class="icon-line-chart"></i>Make Payment</a></li> -->
          </ul>

          <span class="heading">Information</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/account/information"><i class="icon-bill"></i>Conference Informations</a></li>
          </ul>

        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Security</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">


              <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">

                      <?php if($this->session->flashdata('success_msg')):?>
                      <div class="alert alert-success">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $this->session->flashdata('success_msg');?>
                        </div>
                      <?php endif?>

                      <?php if($this->session->flashdata('err_msg')):?>
                      <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $this->session->flashdata('err_msg');?>
                        </div>
                      <?php endif?>

                      <?php echo form_open('account/change_pwd', array('class'=>'form-horizontal')); ?>  
                        <div class="line"></div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Current Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="current_pwd" name="current_pwd" required></input>
                          </div>
                        </div>

                        <div class="line"></div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">New Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="new_pwd" name="new_pwd" required></input>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Re Type New Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="re_new_pwd" name="re_new_pwd" required></input>
                          </div>
                        </div>
                        
                        <div class="alert alert-danger password_matching">
                            Please re-type new matching password.
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Change Password</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>


            </div>
          
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Your company &copy; 2017-2019</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo base_url()?>static/js/tether.min.js"></script>
    <script src="<?php echo base_url()?>static/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>static/js/jquery.cookie.js"> </script>
    <script src="<?php echo base_url()?>static/js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="<?php echo base_url()?>static/js/charts-home.js"></script>
    <script src="<?php echo base_url()?>static/js/front.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('.password_matching').hide();
          $('#re_new_pwd').keyup(function(){
              var pass = $('#new_pwd').val();
              var pass2 = $('#re_new_pwd').val();
              if(pass != pass2){
                  $('.password_matching').show('slow');
                  $("#submit").attr("disabled", true);
              } else if (pass == pass2)  {
                  $('.password_matching').hide('slow');
                  $("#submit").attr("disabled", false);
              }
          });
      });
    </script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
  </body>
</html>