<?php
 include_once  $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/functions.php";

loginCheckAndRedirect("template/login.php");

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | داشبورد اول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://localhost/admin-brick/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="http://localhost/admin-brick/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="http://localhost/admin-brick/dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="http://localhost/admin-brick/dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
          <i class="fa fa-user img-circle elevation-2"></i>
          </div>
          <div class="info">
            <a href="#" class="d-block"> ادمین</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick" class="nav-link ">
                <i class="nav-icon fa fa-"></i>
                <p>
                  پنل ادمین
                </p>
              </a>
            
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/Brick" class="nav-link ">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  بازدید سایت
                </p>
              </a>
            
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  مدیریت کاربران
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/create-user.php" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>اضافه کردن کاربر</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/list-users.php" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>لیست کاربران</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-tree"></i>
                <p>
                  دسته بندی ها
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/list-categories.php" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست دسته بندی ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/create-categoreis.php" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن دسته بندی</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  محصولات
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/list-products.php" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست محصولات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/create-products.php" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن محصول</p>
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  سفارشات
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/list-order.php" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست سفارشات</p>
                  </a>
                </li>
               
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
