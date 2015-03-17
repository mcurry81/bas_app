<?php
    session_start();
    ob_start();
    require('db.php');
    if ($_SESSION['loggedIn'] != "true") {
        header("Location: main_login.php");
    }
?>
<!--Form data on education page. -->
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<div class="panel panel-success" id="main-body">
<div class="panel-body">
    <div class="container">
        <h2>Add User</h2>
        <form action="#" method="post" class="form-horizontal">
            <fieldset>
            New User Name:&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='newusername'><br>
            New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='newpassword'><br>
            Confirm New Password:<input type='text' name='confirm'><br>
            <input type='submit' value='Add User' name='submit' class="btn btn-success">
                </fieldset>
        </form>
    </div>
</div>
</body>
</html>
<?php
    
    $name = $_POST['newusername'];
    $word = $_POST['newpassword'];

    if (isset($_POST['submit'])){
        try {
            $dbh = new PDO("mysql:host=$hostname;
                            dbname=amaninde_grcc", $username, $password);
                    //echo "Connected to database.";
                    
            } catch (PDOException $e) {
                    echo $e->getMessage();
            }
    $sql = "INSERT INTO amaninde_grcc.bas_login (username, password) VALUES (:name,:word)";
    $stmt = $dbh->prepare($sql);
    
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":word", $word);
    $stmt->execute();
    }
    if(!empty($_POST['newusername'])){
        header("Location: loginLanding.php");
    }
?>