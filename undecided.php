<?php
    session_start();
    //initializes some session variables
    $_SESSION['prereq1'] = ""; $_SESSION['prereq2'] = ""; $_SESSION['prereq3'] = ""; $_SESSION['prereq4'] = "";
    $_SESSION['req1'] = ""; $_SESSION['req2'] = ""; $_SESSION['req3'] = ""; $_SESSION['req4'] = "";

    //sets posted values into sessions
    //$_SESSION['student'] = $_POST['studentYesNo'];
    //$_SESSION['sid'] = $_POST['SID'];
    //$_SESSION['notes'] = $_POST['notes'];
    
    
?>
<head>
    <title>BAS Application</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
          <style>.error{color: #ff0000;}</style>
</head>
<main>
    <div class="panel panel-success" id="main-body">
        <div class="panel-body">
            <div id="main-div">
                <p>Thank you for your interest in Green River College's BAS programs! An email will be sent you an with some information you should look at. On the next page you can see how you can get ahead while you wait to be contacted by a program manager.</p>
            </div>
            <form action="steps.php" method='post'>
                                    <input type="checkbox" id="class" name="req1" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req2" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req3" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req4" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="prereq1" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="prereq2" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="prereq3" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="prereq4" value="" class="hideThis">
                <button type="submit" class="btn btn-success">Next Steps</button>
            </form>
        </div>
    </div>
</main>