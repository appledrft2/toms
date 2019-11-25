
<?php
  session_start();
    if(empty(isset($_SESSION['dbu']))){
        header("location:login.php");
    }
    
?>
<?php 

  if(isset($_POST['btnLogout'])){
    session_unset();
    header('location:login.php');
  }


 ?>
<?php include('includes/autoload.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Travel Order Monitoring System  <?php if(isset($title)){echo '| '.$title;} ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>plugins/pace/pace.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/select2/dist/css/select2.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TO</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Travel Order</b>MS</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">


   
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $baseurl ?>dist/img/user1-128x128.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo $baseurl ?>dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['dbfname'] ?> - <?php echo $_SESSION['dbrole'] ?>
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  
                  <div class="">
                    <form method="POST" action="#">
                      <button name="btnLogout" class="btn btn-block btn-default btn-flat">Sign out</button>
                    </form>
                    
                  </div>
                </li>
              </ul>
            </li>
            
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo $baseurl ?>dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo ucfirst($_SESSION['dbfname']).' '.ucfirst($_SESSION['dblname']) ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="index.php">
              <i class="fa fa-tachometer"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview active">
            <a href="#">
              <i class="fa fa-graduation-cap"></i> <span>Manage Teacher</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu ">
              <li><a href="add_teacher.php"><i class="fa fa-plus-circle"></i> New Teacher</a></li>
              <li><a href="teacher_list.php"><i class="fa fa-list"></i> Teacher List</a></li>
            </ul>
          </li>
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-users"></i> <span>Manage Student</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="add_student.php"><i class="fa fa-plus-circle"></i> New Student</a></li>
              <li><a href="student_list.php"><i class="fa fa-list"></i> Student List</a></li>
            </ul>
          </li>

          

          
          
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Manage Travel Orders</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="treeview active">
                <a href="#"><i class="fa fa-graduation-cap"></i> Teacher
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="t_to_add.php"><i class="fa fa-plus-circle"></i> Issue Travel Order</a></li>
                  <li><a href="t_to_list.php"><i class="fa fa-list"></i> TO List</a></li>
                  
                </ul>
              </li>
              <li class="treeview active">
                <a href="#"><i class="fa fa-users"></i> Student
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="s_to_add.php"><i class="fa fa-plus-circle"></i> Issue Travel Order</a></li>
                  <li><a href="s_to_list.php"><i class="fa fa-list"></i> TO List</a></li>
                  
                </ul>
              </li>
             
            </ul>
          </li>
           <li class="treeview active">
                       <a href="#">
                         <i class="fa fa-list"></i> <span>Report</span>
                         <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                         </span>
                       </a>
                       <ul class="treeview-menu">
                         <li><a href="report.php"><i class="fa fa-list"></i> View Report</a></li>
                       </ul>
                     </li>
          <!-- <li class="header">SETTINGS</li>
          <li><a href="#"><i class="fa fa-cog"></i> <span>Manage Account</span></a></li> -->
          

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
 
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
          <h1 class="col-md-6 text-left">
            <span class="text-left">Overview</span>

          </h1>
          <h2 class="col-md-6 text-right">
            <span class="text-right"><i class="fa fa-calendar"></i> <?php echo date('D, M. d Y') ?></span>
          </h2>
        </div>
      </section>