
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="images/deped-logo-white.png" height="40px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="navbar-brand" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#">Dashboard</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#">Help</a>
          </li>
        </ul>
         <ul class="navbar-nav float-right">
          <li class="nav-item active">
            <a class="nav-link" href="https://v4-alpha.getbootstrap.com/examples/dashboard/#"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </form>
      </div>
    </nav>