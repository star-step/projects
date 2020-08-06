<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
// Fetching the existing Admin Data Start
$AdminId = $_SESSION["UserId"];
global $ConnectingDB;
$sql  = "SELECT * FROM user WHERE id='$AdminId'";
$stmt =$ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $ExistingName = $DataRows['aname'];
  $ExistingEmail = $DataRows['email'];
  $ExistingPassword = $DataRows['password'];
}
// Fetching the existing Admin Data End

    // Query to Update Admin Data in DB When everything is fine
if(isset($_POST["Submit"])){
  $Email  = $_DATAROWS["email"];
  $PassWord  = $_POST["password"];
if (strlen($PassWord)<4) {
    $_SESSION["ErrorMessage"] = "PassWord should be greater than 4 digits";
    Redirect_to("edit.php");
  }else{
    // Query to Update Admin Data in DB When everything is fine
    global $ConnectingDB;
      $sql = "UPDATE user
              SET password='$PassWord'
              WHERE id='$AdminId'";
    
    $Execute= $ConnectingDB->query($sql);
    if($Execute){
      $_SESSION["SuccessMessage"]="Details Updated Successfully";
      Redirect_to("edit.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("edit.php");
    }
  }
} //Ending of Submit Button If-Condition
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>My Profile</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
      <a href="#" class="navbar-brand"> IQ Test</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i> Logout</a></li>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->

     <!-- Main Area -->
<section class="container py-2 mb-4">
    <!-- Righ Area -->
    <div class="col-md-6" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="edit.php" method="post" enctype="multipart/form-data">
        <div class="card bg-dark text-light">
          <div class="card-header bg-secondary text-light">
            <h4>Edit Password</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
               <label for="email"><span class=""> Email: <?php echo $ExistingEmail; ?></span></label>
            </div>
            <div class="form-group">
               <label for="password"><span class="FieldInfo">New Password</span></label>
               <input class="form-control" type="password" name="password">
            </div>

            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Save Changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>



    <!-- End Main Area -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
