<!DOCTYPE html>
<?php 
session_start();
$_SESSION['previous_uri'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php"); 
// $_GET['p']="";


?>

<!-- saved from url=(0054)https://v4-alpha.getbootstrap.com/examples/dashboard/# -->
<html lang="en" class="gr__v4-alpha_getbootstrap_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Web App | Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
    <script src="js/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
    .tt-menu { width:300px; }
    ul.dropdown-textbox{margin:0px;padding:10px 0px;}
    ul.dropdown-textbox.dropdown-menu li a {padding: 10px !important;  border-bottom:#CCC 1px solid;color:#FFF;}
    ul.dropdown-textbox.dropdown-menu li:last-child a { border-bottom:0px !important; }
    .demo-label {font-size:1.5em;color: #686868;font-weight: 500;color:#FFF;}
    .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
        text-decoration: none;
        background-color: #1f3f41;
        outline: 0;
    }
</style>    
  <body data-gr-c-s-loaded="true">
    <?php include("menus/top-nav.php"); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include("menus/left-nav.php");?>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <?php //include("content/top-section.php") ?>
          <?php include(returnContent($_GET['p'])); ?>

        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>