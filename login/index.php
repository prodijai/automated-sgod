<!DOCTYPE html>
<!-- saved from url=(0053)https://v4-alpha.getbootstrap.com/examples/jumbotron/ -->
<html lang="en" class="gr__v4-alpha_getbootstrap_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Welcome to SGOD Report Automation</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>

  <body data-gr-c-s-loaded="true">

    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">&nbsp</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">SGOD Report Automation <span class="sr-only">(current)</span></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        <form class="form-inline my-2 my-lg-0" action="../system/functions.php" method="post">
          <input class="form-control mr-sm-2" type="text" placeholder="Username" name="username">
          <input class="form-control mr-sm-2" type="password" placeholder="Password" name="password">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="login_submit">Login</button>
        </form>
      </div>
    </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php

    if (isset($_GET['msg'])) {
      echo '    <div class="alert alert-danger text-right" style="margin-top: 20px; margin-bottom: -5px;">
      '.$_GET['msg'].'
    </div>';
    }
    ?>
    <div class="jumbotron">

      <div class="container">
        <h1 class="display-3">Hello, Mabuhay!</h1>
        <p>Welcome to SGOD Report Automation system, originally created for the Division of City of San Fernando. Start by logging in your credentials in the fields above. For questions, you can email the administrator at admin@dgcas-sgod.net</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Welcome to SGOD Report Automation System</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Forms</h2>
          <p>Forms are used to gather data from a specific entity like students, teachers or school heads. A form is group of fields, created to easily input the data in to the database. Fields can be linked to forms once they have been created.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-md-4">
          <h2>Reports</h2>
          <p>After gathering data by using forms, the input can be converted in to reports. The reports can be configured as to who can view them and what data can be shown in them. You can also choose which form fields will show up on each report. </p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
       </div>
        <div class="col-md-4">
          <h2>Records</h2>
          <p>Information about entities need to be inputted only once. After inputting an entity, multiple forms can be linked to it which means data inputting job can be minimized. Aggregated records can then be generated as reports.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>© Deparment of Education | Division of City of San Fernando</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>