<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Statistics</title>
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
    <!---->
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
            <li class="active"> <a href="<?php echo base_url()?>index.php/administrator/statistics"><i class="icon-line-chart"></i>Statistic</a></li>
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
              <h2 class="no-margin-bottom">Statistics</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <div class="dashboard-counts">
            <div class="container">

              <br>
              <div class="row">

                 <div class="col-md-6"> 
                  <!-- Pie Chart -->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Number of Users </h3>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChartExample"></canvas>
                    </div>
                  </div>
                </div>

                <div class="col-md-6"> 
                  <!-- Pie Chart -->
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Number of Papers </h3>
                    </div>
                    <div class="card-body">
                      <canvas id="papersChart"></canvas>
                    </div>
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
    <script src="<?php echo base_url()?>static/js/charts-custom.js"></script>
    <script src="<?php echo base_url()?>static/js/front.js"></script>

    <script type="text/javascript">

    // ------------------------------------------------------- //
    // Chart for 'Number of Users' | Pie Chart 
    // ------------------------------------------------------ //
    <?php
      $sponsor = $this->db->query('SELECT * FROM account WHERE type = 2');
      $participant_with_paper = $this->db->query('SELECT * FROM account WHERE type = 0');
      $participant_without_paper = $this->db->query('SELECT * FROM account WHERE type = 1');
    ?>
    var PIECHARTEXMPLE    = $('#pieChartExample');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        data: {
            labels: [
                "Sponsor",
                "Participant with paper",
                "Participant without paper"
            ],
            datasets: [
                {
                    data: [<?php echo $sponsor->num_rows() ?>, <?php echo $participant_with_paper->num_rows() ?>, <?php echo $participant_without_paper->num_rows() ?>],
                    borderWidth: 0,
                    backgroundColor: [
                        '#97EEFF',
                        '#49B0E8',
                        "#698AE8",
                        "#3D48E8",
                    ]
                     
                }]
            }
    });

    var pieChartExample = {
        responsive: true
    };

    // ------------------------------------------------------- //
    // Chart for 'Number of Papers' | Pie Chart 
    // ------------------------------------------------------ //

    <?php
      $present_speaking = $this->db->query('SELECT * FROM paper WHERE presentation_type = 0');
      $present_poster = $this->db->query('SELECT * FROM paper WHERE presentation_type = 1');
      $reviews = $this->db->query('SELECT * FROM paper WHERE paper_status != 0 AND paper_status != 3');
      $without_reviews = $this->db->query('SELECT * FROM paper WHERE paper_status = 0');
      $accepted = $this->db->query('SELECT * FROM paper WHERE paper_status = 3');
    ?>

    var PAPERCHART    = $('#papersChart');
    var papersChart = new Chart(PAPERCHART, {
        type: 'pie',
        data: {
            labels: [
                "Presentantion: Speaking",
                "Presentantion: Poster",
                "Reviews",
                "Without Reviews",
                "Accepted paper"
            ],
            datasets: [
                {
                    data: [<?php echo $present_speaking->num_rows() ?>, <?php echo $present_poster->num_rows() ?>, <?php echo $reviews->num_rows() ?>, <?php echo $without_reviews->num_rows() ?>, <?php echo $accepted->num_rows() ?>  ],
                    borderWidth: 0,
                    backgroundColor: [
                        '#97EEFF',
                        '#49B0E8',
                        "#698AE8",
                        "#3D48E8",
                        "#5DA7FF"
                    ]
                  
                }]
            }
    });

    var papersChart = {
        responsive: true
    };


    </script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
  </body>
</html>