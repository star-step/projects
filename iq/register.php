<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
$EmailError="";

if (isset($_POST["Register"])) {
$aname = $_POST["aname"];
$Name = $_POST["uname"];
$Email = $_POST["email"];
$Password = $_POST["Password"];
  if (empty($aname)||empty($Email)||empty($Password)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("register.php");

  }else {
    $ConnectingDB;
    $sql = "INSERT INTO user(aname,uname,email,password)";
    $sql .= "VALUES(:aName,:uName,:eMail,:passWord)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':aName',$aname);
    $stmt->bindValue(':uName',$Name);
    $stmt->bindValue(':eMail',$Email);
    $stmt->bindValue(':passWord',$Password);
    $Execute=$stmt->execute();
   if($Execute){
      $_SESSION["SuccessMessage"]="Success";
      Redirect_to("Dashboard.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("register.php");
    }
  }
}

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
  <title>Register</title>
</head>
<body>
  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
     <h1> <a class="navbar-brand text-white">TEST YOUR IQ</a></h1>
    </div>
  </nav>
    <!-- NAVBAR END -->

    <!-- Main Area Start -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <br><br><br>
 
          <div class="card bg-success text-dark">
            <div class="card-header">
              <h4 class="text-white">Welcome !</h4>
              </div>
               <?php
                       echo ErrorMessage();
                       echo SuccessMessage();
                      ?>
              <div class="card-body bg-light">
              <form class="" action="register.php" method="post">
                      
                <div class="form-group">
                  <label for="aname"><span class="FieldInfo">Name</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-dark"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="aname" id="aname" value="">
                  </div>


                  <label for="uname"><span class="FieldInfo">UserName</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-dark"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="uname" id="uname" value="">
                  </div>
                </div>
                 <label for="email"><span class="FieldInfo">Email:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <?php  echo $EmailError?>
                      <span class="input-group-text text-white bg-dark"> <i class="fas fa-envelope"></i> </span>
                      
                    </div>
                    <input type="text" class="form-control" name="email" id="email" value="">
                  </div>
               

                     <div class="form-group">
                  <label for="password"><span class="FieldInfo">Set Password</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-dark"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="Password" id="password" value="">
                  </div>
                
                  </div>

                </div>
               
                <input type="submit" name="Register" class="btn btn-dark btn-block" value="Register">
              </div>
            </div>
              </form>

            </div>

          </div>

        </div>

      </div>

    </section>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
<!--                <input class="form-control" type="text" name="uname" id="uname" value="">
               <small class="text-muted">*Optional</small>
            </div>
            <div class="form-group">
              <label for="Password"> <span class="FieldInfo"> Password: </span></label>
               <input class="form-control" type="password" name="Password" id="Password" value="">
            </div>
 <div class="form-group">
              <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password:</span></label>
               <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword"  value="">
             </div>
               <div style="text-align: center;">
             <input type="submit" name="Register" class="btn btn-info btn-block" value="Register">
            <h6>Already have an account? <a href="login.php" >Login here</a></h6>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body> -->