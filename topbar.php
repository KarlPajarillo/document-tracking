<!-- Navbar -->
  <nav class=" main-header docu-header navbar navbar-expand navbar-primary navbar-dark " style="background: #0d2ddc;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['login_id'])): ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    <?php endif; ?>
      <li>
        <a class="nav-link header-title"  style="color: #e1d467;font-size: 25px; margin-top: -7px" href="./" role="button"> <large><b><?php echo $_SESSION['system']['name'] ?></b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     <li class="nav-item dropdown">
        <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="notifications.php">
          <span class="fa fa-bell" style="font-size: 20px;"></span>
          <?php if (5 > 0) : ?>
              <span class="badge badge-danger" style="font-size: 10px; vertical-align: top; margin-left: -10px"><?php echo 5 ?></span>
          <?php endif; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
          <a class="dropdown-item" href="" id=""> notif1</a>
          <a class="dropdown-item" href="" id=""> notif2</a>
          <a class="dropdown-item" href="" id=""> notif3</a>
          <a class="dropdown-item" href="" id=""> notif4</a>
          <a class="dropdown-item" href="" id=""> notif5</a>
        </div>
      </li>
     <li class="nav-item dropdown" style="margin-left: -15px">
        <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
          <span>
            <div class="d-felx badge-pill">
              <span class="fa fa-user mr-2" style="font-size: 18px;"></span>
              <span style="font-size: 18px;"><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
              <span class="fa fa-angle-down ml-2"></span>
            </div>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
          <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage Account</a>
          <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script>
     $('#manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
      })
  </script>
