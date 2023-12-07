<!DOCTYPE html>
<html lang="en" style="height: none">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>

<?php 
if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
?>
<?php include 'header.php' ?>

<body class="hold-transition login-page">
<div class="background"></div>
<div class="big-card">
  <div class="left-column">
      <div class="top-part">
          <div class="rect-logo">
            <img src="assets/images/logo.jpg" alt="school logo" style="width: 94.291px; height: 94.291px; flex-shrink: 0; border-radius: 116.429px; ">
          </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="2" height="76" viewBox="0 0 2 76" fill="none" class="line">
             <path d="M1 1V75" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
          <h2 class="school-name">Pangasinan State University</h2>
      </div>
      <div class="bottom-part">
          <h3 class="DT">Docu Track</h3>
          <h1 class="PSU">PSU Cross Platform</h1>
          <h2 class="DMS">Document Monitoring System</h2>
      </div>
  </div>

    <div class="right-column">
  <h1 class="form-heading">Sign in</h1>
  <form action="" id="login-form">
  <div class="input-group mb-3">
      <div class="input-group-prepend">
          <div class="input-group-text" style="background-color: #5064DF; border: none;">
              <span class="fas fa-envelope" style="color: #fff;"></span>
          </div>
      </div>
      <input type="email" class="form-control form-control-lg" id="email" name="email" required placeholder="Email">
  </div>

  <div class="input-group mb-3">
      <div class="input-group-prepend">
          <div class="input-group-text" style="background-color: #5064DF; border: none;">
              <span class="fas fa-lock" style="color: #fff; padding-left: 1px;"></span>
          </div>
      </div>
      <input type="password" class="form-control form-control-lg" name="password" required placeholder="Password">
  </div>


      <div class="row">
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #5064DF">Sign In</button>
          </div>
      </div>

      <div class="row mt-3">
          <div class="col-12 text-center">
              <a href="#" class="forgot">Forgot Password</a>
          </div>
      </div>
  </form>


    </div>
</div>


<div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
<style>
  body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh; 
  }
  .background {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: url("assets/images/login_bg.jpg"), lightgray 50% / cover no-repeat;
   box-shadow: 0px 4px 172.3px 227px rgba(11, 41, 217, 0.20) inset;
   filter: blur(9.050000190734863px);
   z-index: -1;
}

  .rect-logo{
   width: 115px;
   height: 112.975px;
   flex-shrink: 0;
   border-radius: 35px;
   background: linear-gradient(131deg, rgba(244, 244, 244, 0.60) 0%, rgba(255, 255, 255, 0.00) 100%);
   display: flex; /* Add this line */
   justify-content: center; /* Add this line */
   align-items: center; /* Add this line */
   margin-left: 60px;
   margin-top: 40px;
  }

  .line{
    margin-left: 20px;
    margin-top: 38px;
  }

  .school-name{
    color: #FFF;
  
    font-size: 24px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -0.48px;
  }

  .school-name{
    margin-top: 50px;
    margin-left: 20px;
  }

  .input-group {
      border-radius: 10px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.65);
      -webkit-backdrop-filter: blur(9px);
      backdrop-filter: blur(9px);
      
      border-radius: 14px;
  }

  .input-group-prepend{
    margin-right: 0px;
  }

  .input-group-text {
      background-color: #5064DF;
      border: none;
      border-radius: 14px;
      padding-right: 14px;
  }

  .form-control {
      border-radius: 0 10px 10px 0;
  }

  
  .big-card {
      display: flex;
      width: 70%;
      height: 80vh;
      min-width: 300px; /* Add a minimum width to prevent the card from becoming too narrow */

      box-sizing: border-box;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 50px;
      
      position: relative;
      z-index: 1;
  
      border-radius: 60px;
      background: linear-gradient(234deg, rgba(221, 193, 45, 0.37) 28.22%, rgba(11, 41, 217, 0.37) 63.58%);
      box-shadow: 0px 4px 49.3px 272px rgba(0, 0, 0, 0.34);
      backdrop-filter: blur(48.29999923706055px);
  }
  .left-column {
      flex: 60%;
      padding: 20px;
      display: flex;
      flex-direction: column;
  }

  .top-part,
  .bottom-part {
      width: 100%;
      text-align: center;
  }

  .top-part {
      flex: 20%;
      display: flex;
      align-items: center; /* Center content vertically */
  }

  .bottom-part {
      flex: 80%;
      display: flex;
      flex-direction: column;
      align-items: center; /* Center content horizontally */
      justify-content: center; /* Center content vertically */
  }

  .left-column img {
      max-width: 100%; /* Add margin to the right of the logo for spacing */
  }

  .left-column h1 {
    font-size: 4.4rem;
  }

  .left-column p {
      font-size: 1.5rem;
  }



  .right-column {
      flex: 40%;
      padding-left: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

      border-radius: 0px 60px 60px 0px;
background: linear-gradient(60deg, rgba(176, 182, 215, 0.56) 1.3%, rgba(255, 255, 255, 0.43) 99.3%, rgba(255, 255, 255, 0.11) 99.3%);
backdrop-filter: blur(29.850000381469727px);
  }

  .form-control-lg{
    color: #4B4B4B;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -0.32px;

  }
  #login-form {
    width: 100%;
    max-width: 80%;
  }

  .input-group {
      margin-bottom: 15px;
  }

  .btn-group {
      text-align: center;
  }

  .form-heading{
    color: #1E1E1E;
    font-size: 48px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    letter-spacing: -0.96px;
    align-self: flex-start;
    margin-bottom: 20px;
    padding-left: 59px;
  }
 
  .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show > .btn-primary.dropdown-toggle {
    color: #fff;
    border-color: #FFFFFF;
}

.btn-primary.focus, .btn-primary:focus {
    color: #fff;
}

  .btn-primary:hover{
    border: 1px solid #FFFFFF;
  }


.btn-primary {
  
   border-radius: 14px; 
   border: 1px solid #A7A7A7;
   background: #4F64DE;
}


.DT {
 align-self: flex-start; /* Align the DT to the left */
 color: #FFE047;
 font-size: 45px;
 font-style: normal;
 font-weight: 500;
 letter-spacing: -1.28px;
 margin-left: 60px;
 margin-bottom: 0;
}

.PSU {
 align-self: center; /* Align the PSU to the center */
 color: #FFF;
 font-style: normal;
 font-weight: 700;
 letter-spacing: -1.28px;
 margin-bottom: 0px;
 margin-right: 5px;
}

.DMS {
 align-self: flex-end; /* Align the DMS to the right */
 color: #FFF;
 font-size: 27px;
 font-style: normal;
 font-weight: 500;
 letter-spacing: -0.56px;
 margin-right: 64px;
 margin-bottom: 100px;
}

.forgot{
  color: #1E1E1E;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  letter-spacing: -0.32px;
}


</style>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('.forgot').click(function(){
        start_load()
        $("#alert-message").remove();
        $.ajax({
          url:'send.php?email='+$('#email').val(),
          method:'POST',
          // data:$(this).serialize(),
          error:err=>{
            console.log(err)
            end_load();

          },
          success:function(resp){
            end_load();
            if(resp == 'Message has been sent'){
              alert_toast(resp,'success')
              uni_modal("Please check your email for verification code!!!","reset_password.php?email="+$('#email').val(),"large")
            }else{
              $('#login-form').prepend('<div id="alert-message" class="alert alert-danger">'+resp+'</div>')
            }
          }
        })
      })

      $('#login-form').submit(function(e){
        $("#alert-message").remove();
      e.preventDefault()
      start_load()
      if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
      $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
          console.log(err)
          end_load();

        },
        success:function(resp){
          if(resp == 1){
            location.href ='index.php?page=home';
          }else{
            $('#login-form').prepend('<div id="alert-message" class="alert alert-danger">Username or password is incorrect.</div>')
            end_load();
          }
        }
      })
    })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
