<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM branches")->num_rows; ?></h3>

                <p>Department's</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users where type != 1")->num_rows; ?></h3>

                <p>User's</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <hr>
          <?php 
              // $status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","Unsuccessfull Delivery Attempt");
              $status_arr = array("Sent","Approved", "Denied");
               foreach($status_arr as $k =>$v):
          ?>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels where status = {$k} ")->num_rows; ?></h3>

                <p><?php echo $v ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
          </div>
            <?php endforeach; ?>
        </div>

<?php else: ?>
  <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <a href="./index.php?page=document_transactions" class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels WHERE sender_name = ".$_SESSION['login_id']." or recipient_name = ".$_SESSION['login_id']." or created_by = ".$_SESSION['login_id']."")->num_rows; ?></h3>

                <p>All Transactions</p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </a>
          </div>
          <?php if($_SESSION['login_type'] == 5): ?>
           <div class="col-12 col-sm-6 col-md-4">
            <a href="./index.php?page=created_transactions" class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels where created_by = ".$_SESSION['login_id']."")->num_rows; ?></h3>
                <p>Created Transactions</p>
              </div>
              <div class="icon">
                <i class="fa fa-box"></i>
              </div>
            </a>
          </div>
          <?php endif; ?>
          <hr>
          <?php 
              $status_arr = array("Sent","Approved", "Denied");
               foreach($status_arr as $k =>$v):
          ?>
          <div class="col-12 col-sm-6 col-md-4">
            <a href="./index.php?page=document_transactions&s=<?php echo $k ?>" class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels where (sender_name = ".$_SESSION['login_id']." or recipient_name = ".$_SESSION['login_id']." or created_by = ".$_SESSION['login_id'].") and status = {$k} ")->num_rows; ?></h3>

                <p><?php echo $v.' Transactions' ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-box"></i>
              </div>
            </a>
          </div>
            <?php endforeach; ?>
        </div>
          
<?php endif; ?>
<?php if($_SESSION['login_type'] == 4): ?>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions per Docs</h1>
          </div><!-- /.col -->
      </div><!-- /.row -->
      <hr class="border-primary">
          <?php 
            $docs = $conn->query("SELECT * FROM documents");
            foreach($docs as $key => $value):
          ?>
            <div class="row" id="main-menu">
              <div>
                <nav id="menu-area">
                  <ul>
                    <li id="menu-1">
                      <a href="#" >
                        <i class="nav-icon fas fa-folder"></i>
                        <span>
                          <?php echo $value['doc_name'] ?>
                          <i class="right fas fa-angle-left"></i>
                        </span>
                      </a>
                      <ul class="submenu-1">
                        <?php
                          // $qry = $conn->query("SELECT * FROM parcels p inner join users u on p.created_by = u.id inner join branches b on u.branch_id = b.id WHERE u.branch_id = ".$_SESSION['login_branch_id']." and u.id != ".$_SESSION['login_id']);
                          // foreach($qry as $key => $value):
                        ?>
                        <?php 
                          // for created docs per user
                          // $qry = $conn->query("SELECT *, concat(firstname, ' ', lastname) as name FROM users WHERE branch_id = ".$_SESSION['login_branch_id']." and id != ".$_SESSION['login_id']);
                          // foreach($qry as $key => $value):
                        ?>
                          <li class="">
                            <a href="#">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <span>Created</span>
                            </a>
                            <ul class="submenu-2">
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                            </ul>
                          </li>
                          <li class="">
                            <a href="#" class="">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <span>Approved</span>
                            </a>
                            <ul class="submenu-2">
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                              <li><a href="#"><i class="fa fa-user mr-2"></i>test</a></li>
                            </ul>
                          </li>
                        <?php //endforeach; ?>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
          </div>
        <?php endforeach; ?>
    </div><!-- /.container-fluid -->
</div>
<?php endif; ?>
<style>
  #main-menu{
    float: left;
    height: 60px;
    line-height: 20px;
    width: 100%;
  }
  #main-menu>div{
    width: 100%;
    /* min-width: 20%;
    max-width: 50%; */
  }
  nav#menu-area{
    margin: 0 auto;
    padding: 0 15px;
    position: relative;
    background: #212529;
    width: 100%;
  }
  nav#menu-area ul li{
    background: #f8f9fa;
    border: 1px solid #343a40;
    float: left;
    position: relative;
    font-size: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
    text-align: center;
    text-transform: uppercase;
    width: 100%;
  }
  nav#menu-area ul li a{
    color: #343a40;
    text-decoration: none;
    display: inline-block;
    line-height: 60px;
  }
  nav#menu-area ul li:hover>a, nav#menu-area ul li:hover{
    color: #fff;
    background: #555555;
    width: 50%;
    transition: width 0.1s 0.1s ease-out;
  }
  nav#menu-area ul li:hover>a>span>i{
    transform: rotate(-90deg);
  }
  nav#menu-area ul li ul.submenu-1{
    z-index: 1;
    float: left;
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    right: -182px;
    top: -1px;
    background: #212529;
    width: 30%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-out, visibility 0.1s 0.1 linear;
  }
  nav#menu-area ul li ul.submenu-1 li{
    border: 1px solid #343a40;
    clear: both;
    margin-top: -15px;
    padding: 0;
    width: 100%;
    transition: opacity 0.15s 0.15s ease-out, margin 0.3s 0.1s ease-out;
  }
  nav#menu-area ul li:hover ul.submenu-1{
    opacity: 1;
    visibility: visible;
  }
  nav#menu-area ul li:hover ul.submenu-1 li{
    margin-top: 0;
    opacity: 1;
  }
  nav#menu-area ul li ul.submenu-1 li ul.submenu-2{
    float: left;
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    left: 80%;
    top: -1px;
    background: #212529;
    width: 200%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.2s 0.01s ease-in-out, left 0.2s 0.1s ease-out, visibility 0.1s 0.1s linear;
  }
  ul.submenu-1 li ul.submenu-2{
    border: none;
    border-bottom: 1px solid #ccc;
    clear: both;
    margin: 0;
    padding: 0;
    width: 100%;
    opacity: 1;
  }
  nav#menu-area ul li ul.submenu-1 li:hover ul.submenu-2{
    opacity: 1;
    left: 100%;
    visibility: visible;
    max-height:400px;
    overflow: hidden;
    overflow-y: scroll;
  }
</style>
<script>
  $(document).ready(function(){
    $('.nav-link.dropper').click(function(){
        $('.nav-link.dropper').addClass('menu-is-opening')
        $('.nav-drop').addClass('nav-dropped')
    })
  })

</script>
