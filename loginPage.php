<?php
    session_start();
    ob_start();
    require('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Bootstrap Login Form</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="css/styles.css" rel="stylesheet">
</head>

<!-- original form
    <form class="form col-md-12 center-block" method="post">
        Username:<input type="text" name="username" value="username"><br>
        Password:<input type="password" name="password" value="password"><br>
        <input type="submit" value="Login" name="submit">
    </form>
-->

<!-- New modified for for login info-->
<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post">
            <div class="form-group">
              <input type="text" class="form-control input-lg" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Sign In</button>
              <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</body>
</html>

<!-- Php to process the user name and Password-->
<?php
if (isset($_POST['submit'])){
    try {
        $dbh = new PDO("mysql:host=$hostname;
                        dbname=amaninde_grcc", $username, $password);
                echo "Connected to database.";
        } catch (PDOException $e) {
                echo $e->getMessage();
        }
     
    // Check if the user name exist.     
    $sql = "select COUNT(*) from bas_login where username = :username and password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue("username", $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue("password", $_POST['password'], PDO::PARAM_STR);
    $stmt->execute();
    
    $count = $stmt->fetchColumn();
    
    // This is wherever you want to redirect the user to
    if ($count == 1) {
        $_SESSION['loggedIn'] = "true";
        header("Location: loginLanding.php"); 
    } else {
        $_SESSION['loggedIn'] = "false";
        header("Location: loginPage.php"); // Wherever you want the user to go when they fail the login
    }
}
?>