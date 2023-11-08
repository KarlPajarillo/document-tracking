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
              $status_arr = array("Sent","Received", "Denied");
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
          <hr>
          <?php 
              $status_arr = array("Sent","Received", "Denied");
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
<?php if($_SESSION['login_type'] != 5): ?>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Your member's transactions</h1>
          </div><!-- /.col -->
      </div><!-- /.row -->
            <hr class="border-primary">
    </div><!-- /.container-fluid -->
</div>
<?php endif; ?>
