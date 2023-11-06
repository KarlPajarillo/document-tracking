  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>Admin</b></h3>
        <?php elseif($_SESSION['login_type'] == 2): ?>
        <h4 class="text-center p-0 m-0"><b>Department Head</b></h4>
        <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>Member</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_department">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Department
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_department" class="nav-link nav-new_department tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=department_list" class="nav-link nav-department_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['login_type'] != 3): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_transaction">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] == 1): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_document" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>New Document</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=document_list" class="nav-link nav-document_list nav-sall tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List all documents</p>
                </a>
              </li>
            <?php endif; ?>
            <?php //if($_SESSION['login_type'] == 2): ?>
              <li class="nav-item">
                <a href="./index.php?page=send_document" class="nav-link nav-send_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Send Document</p>
                </a>
              </li>
            <?php //endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=document_transactions" class="nav-link nav-document_transactions nav-sall tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List all process</p>
                </a>
              </li>
              <?php 
              $status_arr = array("Files Sent","Files Received","Files Denied");
              foreach($status_arr as $k =>$v):
              ?>
              <li class="nav-item">
                  <a href="./index.php?page=document_transactions&s=<?php echo $k ?>" class="nav-link nav-document_transactions_<?php echo $k ?> tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p><?php echo $v ?></p>
                  </a>
                </li>
              <?php endforeach; ?>
              <?php //if($_SESSION['login_type'] == 2): ?>
                <li class="nav-item">
                  <a href="./index.php?page=created_transactions" class="nav-link nav-created_transactions tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Created Transactions</p>
                  </a>
                </li>
              <?php //endif; ?>
            </ul>
          </li>
           <li class="nav-item dropdown">
            <a href="./index.php?page=track" class="nav-link nav-track">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Track Document 
              </p>
            </a>
          </li>  
           <li class="nav-item dropdown">
            <a href="./index.php?page=reports" class="nav-link nav-reports">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>  
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
      
  	})
  </script>