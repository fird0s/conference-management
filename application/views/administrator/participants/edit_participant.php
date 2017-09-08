<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Participant</title>
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
                <!-- Navbar Brand --><a href="<?php echo base_url()?>index.php/administrator/statistics" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Administrator</strong></div>
                  <div class="brand-text brand-small"><strong>Admin</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo base_url()?>index.php/administrator/logout" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <br>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/administrator/statistics"><i class="icon-line-chart"></i>Statistic</a></li>
            <li> <a href="<?php echo base_url()?>index.php/administrator/payments"><i class="icon-check"></i>Payments</a></li>
            <li> <a href="<?php echo base_url()?>index.php/administrator/mail"><i class="icon-mail"></i>Mail</a></li>
          </ul>
          <span class="heading">Participant</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/administrator/participants"><i class="icon-user"></i>Participants</a></li>
            <li> <a href="<?php echo base_url()?>index.php/administrator/add_participant"><i class="icon-bars"></i>Add Participants</a></li>
          </ul>
          <span class="heading">Paper</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/administrator/paper"><i class="icon-presentation"></i>Paper</a></li>
            <li> <a href="<?php echo base_url()?>index.php/administrator/add_paper"><i class="icon-bars"></i>Add Paper</a></li>
          </ul>
          <span class="heading">Expense</span>
          <ul class="list-unstyled">
            <li> <a href="<?php echo base_url()?>index.php/administrator/expense"><i class="icon-bill"></i>Expense</a></li>
            <li> <a href="<?php echo base_url()?>index.php/administrator/add_expense"><i class="icon-bars"></i>Add Expense</a></li>
          </ul>
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard</h2>
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
                      <?php echo form_open('administrator/edit_participant/'.$user->id); ?>
                        
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Academic Title</label>
                          <div class="col-sm-9">
                            <p><?php echo $user->academic_title ?></p>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Name</label>
                          <div class="col-sm-9">
                            <p><?php echo $user->name ?></p>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Surname</label>
                          <div class="col-sm-9">
                            <p><?php echo $user->surname ?></p>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Place of Works</label>
                          <div class="col-sm-9">
                           <p><?php echo $user->work?></p>
                          </div>
                        </div>

                        <div class="line"></div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Correspondence Address</label>
                          <div class="col-sm-9">
                            <p><?php echo $user->address ?><p>
                          </div>
                        </div>

                        <div class="line"></div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Phone</label>
                          <div class="col-sm-9">
                            <?php echo $user->phone ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Email</label>
                          <div class="col-sm-9">
                            <a href="mailto:<?php echo $user->email ?>"><?php echo $user->email ?></a>
                          </div>
                        </div>

                         <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Role</label>
                          <div class="col-sm-9">
                              <?php if ($user->type === '0'): ?>
                                Participant with paper
                              <?php elseif ($user->type === '1'): ?>
                                Participant without paper
                              <?php elseif ($user->type === '2'): ?> 
                                Sponsor
                              <?php else: ?>
                              <?php endif; ?>
                          </div>
                        </div>

                        <?php if ($user->type === '0'): ?>
                         <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Numbers Paper Reported</label>
                          <div class="col-sm-9">
                            <?php 
                              $num_paper = $this->db->query("SELECT * FROM paper WHERE author = ? ", array($user->id));
                              if ($num_paper->num_rows() >= 1) {
                                echo $num_paper->num_rows();
                              } else {
                                echo "0";
                              }
                            ?>
                          </div>
                        </div>
                        <?php else: ?>
                        <?php endif; ?>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Payment Status</label>
                          <div class="col-sm-9">
                            <?php 
                              $payment = $this->db->query('SELECT * from payment WHERE author = ? LIMIT 1', array($user->id));
                              $payment = $payment->row();
                             ?>
                            <p><?php if ($payment->status === '0'): ?>Unconfirmed<?php elseif ($payment->status === '1'): ?>Confirmed<?php endif; ?></p>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Payment Participant Confirmation</label>
                          <div class="col-sm-9">
                            <a href="<?php echo base_url('index.php/administrator/confirm_participant_payment/')?><?php echo $user->id ?>?status=1" onclick="return confirm('are you sure you want confirm payment?');" data-effect="mfp-move-from-top" data-toggle="tooltip" title="Confirm"  class="btn btn-success btn-mini"> YES</a>
                            <a href="<?php echo base_url('index.php/administrator/confirm_participant_payment/')?><?php echo $user->id ?>?status=0" onclick="return confirm('are you sure you want unconfirm payment?');" data-effect="mfp-move-from-top" data-toggle="tooltip" title="Hapus"  class="btn btn-danger btn-mini fa fa-trash-o"> NO</a>
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Amount</label>
                          <div class="col-sm-9">
                              <div class="row" style="padding: 0px 0px; margin-left: -15px;">
                                  <div class="col-md-6">
                                      <input type="number" name="amount" value="<?php echo $payment->amount ?>" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" placeholder="Amount" class="form-control">
                                  </div>
                                  <div class="col-md-6">
                                    <select class="form-control" id="sel1" name="currency">
                                         <?php if ($payment->currency === '0'): ?>
                                            <option value="0">EUR</option>
                                            <option value="1">USD</option>
                                        <?php elseif ($payment->currency === '1'): ?>
                                            <option value="1">USD</option>
                                            <option value="0">EUR</option>
                                        <?php else: ?>
                                            <option value="0">EUR</option>
                                            <option value="1">USD</option>
                                        <?php endif; ?>
                                    </select>
                                  </div>
                              </div>                            

                          </div>

                        </div>

                         <div class="line"></div>
                         <hr style="margin-top: -15px;">
                          <div class="form-group" style="margin-left: 25px;">
                            <button type="submit" name="submit" class="btn btn-primary">Edit Participant</button>
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
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
  </body>
</html>