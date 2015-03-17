<?php
    session_start();
    ob_start();
    require('db.php');

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>BAS APP Admin Login </title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="css/styles.css" rel="stylesheet">
</head>
<html>
<!-- Old login form 	
<table width = "300" border = "0" align = "center" cellpadding = "0" cellspacing = "1" bgcolor = "#CCCCCC">
	<tr>
	<form name = "form1" method = "post" action="#">
		<td>
		<table width = "100%" border = "0" cellpadding = "3" cellspacing = "1" bgcolor = "#FFFFFF">

			<tr>
				<td colspan = "3"> <strong>Admin Login</strong></td>
			</tr>

			<tr>
				<td width = "78">Username</td>
				<td width = "6">:</td>
				<td width = "294"><input name = "username" type = "text" id = "username">
				</td>
			</tr>

			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input name = "password" type = "password" id = "password"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type = "submit" name = "submit" value = "Login"></td>
			</tr>
		</table>
		</td>
	</form>
	</tr>
</table> old login form finishes here. -->
<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Admin Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="#">
            <div class="form-group">
              <input type="text" class="form-control input-lg" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Sign In</button>
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
<?php
$_SESSION['username'] = $_POST['username'];
if (isset($_POST['submit'])){
    try {
        $dbh = new PDO("mysql:host=$hostname;
                        dbname=amaninde_grcc", $username, $password);
                echo "Connected to database.";
        } catch (PDOException $e) {
                echo $e->getMessage();
        }
        
    $sql = "select COUNT(*) from bas_login where username = :username and password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue("username", $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue("password", $_POST['password'], PDO::PARAM_STR);
    $stmt->execute();
    
    $count = $stmt->fetchColumn();
    
    if ($count == 1) {
        $_SESSION['loggedIn'] = "true";
        header("Location: loginLanding.php"); // This is wherever you want to redirect the user to
    } else {
        $_SESSION['loggedIn'] = "false";
        header("Location: main_login.php"); // Wherever you want the user to go when they fail the login
    }
}
?>