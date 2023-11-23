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
      <div class="row">
            <?php 
              $qry = $conn->query("SELECT * FROM documents");
              foreach($qry as $key => $value):
            ?>
              <div class="col-4 col-sm-6 col-md-6" style="font-size:18px">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item" style="border: solid 2px lightgrey">
                    <a href="#" class="nav-link nav-edit_user">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        <?php echo $value['doc_name'] ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <?php
                        $qry = $conn->query("SELECT * FROM parcels p inner join users u on p.created_by = u.id inner join branches b on u.branch_id = b.id WHERE u.branch_id = ".$_SESSION['login_branch_id']." and u.id != ".$_SESSION['login_id']);
                        foreach($qry as $key => $value):
                      ?>
                        <li class="nav-item">
                          <a href="./" class="nav-link nav-new_user tree-item">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Created</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="./" class="nav-link nav-user_list tree-item">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Approved</p>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                </ul>
              </div>
          <?php endforeach; ?>
      </div>
    </div><!-- /.container-fluid -->
</div>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Your faculty's transactions</h1>
          </div><!-- /.col -->
      </div><!-- /.row -->
      <hr class="border-primary">
      <div class="row">
            <?php 
              $qry = $conn->query("SELECT *, concat(firstname, ' ', lastname) as name FROM users WHERE branch_id = ".$_SESSION['login_branch_id']." and id != ".$_SESSION['login_id']);
              foreach($qry as $key => $value):
            ?>
              <div class="col-4 col-sm-6 col-md-3" style="font-size:18px">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item" style="border: solid 2px lightgrey">
                    <a href="#" class="nav-link nav-edit_user">
                      <!-- <i class="nav-icon fas fa-users"></i> -->
                      <p>
                        <?php echo $value['name'] ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./" class="nav-link nav-new_user tree-item">
                          <i class="fas fa-angle-right nav-icon"></i>
                          <p>Created</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./" class="nav-link nav-user_list tree-item">
                          <i class="fas fa-angle-right nav-icon"></i>
                          <p>Approved</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
          <?php endforeach; ?>
      </div>
    </div><!-- /.container-fluid -->
</div>
<?php endif; ?>
