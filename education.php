<?php
 //this starts the session
    session_start();
    ob_start();

    //Turn on error reporting
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);
    
    // Loading everything to the sesssions. 
    $_SESSION['prereq1'] = ""; $_SESSION['prereq2'] = ""; $_SESSION['prereq3'] = ""; $_SESSION['prereq4'] = "";
    $_SESSION['req1'] = ""; $_SESSION['req2'] = ""; $_SESSION['req3'] = ""; $_SESSION['req4'] = "";
    
    if(!empty($_POST['prereq1'])){
        $_SESSION['prereq1']=$_POST['prereq1'];
    }
    if(!empty($_POST['prereq2'])){
        $_SESSION['prereq2']=$_POST['prereq2'];
    }
    if(!empty($_POST['prereq3'])){
        $_SESSION['prereq3']=$_POST['prereq3'];
    }
    if(!empty($_POST['prereq4'])){
    $_SESSION['prereq4']=$_POST['prereq4'];
    }
    
    if(!empty($_POST['req1'])){
        $_SESSION['req1']=$_POST['req1'];
    }
    if(!empty($_POST['req2'])){
        $_SESSION['req2']=$_POST['req2'];
    }
    if(!empty($_POST['req3'])){
        $_SESSION['req3']=$_POST['req3'];
    }
    if(!empty($_POST['req4'])){
        $_SESSION['req4']=$_POST['req4'];
    }
    
    $_SESSION['notes'] = $_POST['notes'];
    //$_SESSION[''] = "";
    //print_r($_POST);
    //print_r($_SESSION);
?>
<!--Form data on education page. -->
<!DOCTYPE html>
<html>
<head>
    <title>Education</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link href="modalPopLite/modalPopLite.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="modalPopLite/modalPopLite.min.js"></script>
    <!-- Pop up's CSS-->
    <style type="text/css">
		/* CSS Reset */
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { 
			
			padding:0;
			font-family: Verdana, Arial, "Lucida Grande", sans-serif;
		}        
		#clicker
		{
			font-size:20px;
			cursor:pointer;
		}
		#popup-wrapper
		{
			width:500px;
			height:300px;
			background-color:#ccc;
			padding:10px;
		
		}
		body
		{
		    padding:10px;
		}
	</style>
</head>
<body>
    <?php
        //Connect to the database
        require 'db.php';
    ?>
    <div class="panel panel-success" id="main-body">
        <div class="panel-body">
            <div class="container">
            <h1>Education</h1>
            
                Select highest degree achieved:
                <!-- Reserve for future POST method -->
                <form name="degree" action="steps.php" method="POST" enctype="multipart/form-data">
                    <select name="degrees">
                    <option value="HS">Highschool Diploma or GED</option>
                    <option value="AS">Associates degree (AA, AS, AAS, AAS-T)</option>
                    <option value="BA">Bachelors degree</option>
                    <option value="MA">Masters degree</option>
                    <option value="PhD">Ph.D.</option>
                    </select><br>
                How many college credits have you earned?: 
                <input class="form-group" type="number" name="credits" value=" ">
                <p>Upload unofficial transcripts from any college other than Green River.</p>
                <input id="upload" name="upload" type="file">
                <br>
                <input type="checkbox" id="myCheck" required>
                I verify that the information submitted here is accurate and complete. <br>
                <div><br>
                    <a href="javascript:history.back()"><input type="button" id="back" value="Previous" class="btn btn-success"></a>
                    <input type="submit" id="submit" name="submit" value="Finish" class="btn btn-success">
                </div>
                <script>document.getElementById("submit").disabled = true;</script>
                </form>
                </div>
        </div>
    </div>
    
    <!-- Java Script for pop up-->
    <script type="text/javascript">
        $(function () {
            $('#popup-wrapper').modalPopLite({ openButton: '#myCheck', closeButton: '#close-btn' });
        });
        
        function enable() {
    document.getElementById("submit").disabled = false;
    $('#myCheck').attr('checked', true);
    }
    </script>
    
    <!-- Pop up data -->
    <div id="popup-wrapper" style="background-color: #ccc;">
        <span style='color: red'><strong>This is a summary of the information you entered. Please review it for accuracy.</strong></span><br><br>
        <?php
        echo "Name: " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "<br>";
        echo "Contact: " . $_SESSION['email'] . "  " . $_SESSION['phone'] . "<br>";
        if(!empty($_SESSION['sid'])){
            echo $_SESSION['sid'] . "<br>";
        }
        if($_SESSION['degreebtn']=='sdpre'){
            echo "Degree of Interest: " . "Software Development" . "<br>";
        }
        elseif($_SESSION['degreebtn']=='netpre'){
            echo "Degree of Interest: " . "Networking & Security" . "<br>";
        }                              
        if($_SESSION['prereq1']=='prereq1'){
            echo "Programming 1 and 2 (CS 141&145 or CS 131&132" . "<br>";
        }
        if($_SESSION['prereq2']=='prereq2'){
            echo "IT 201: Database Fundamentals or equivalent" . "<br>";
        }
        if($_SESSION['prereq3']=='prereq3'){
            echo "IT 190: Intro to Linux or LPI1, or Linux Essentials" . "<br>";
        }
        if($_SESSION['prereq4']=='prereq4'){
            echo "IT 121: HTML/CSS, or equivalent" . "<br>";
        }
        if($_SESSION['req1']=='req1'){
            echo "IT 210 or CCENT" . "<br>";
        }
        if($_SESSION['req2']=='req2'){
            echo "IT 160 or MTA" . "<br>";
        }
        if($_SESSION['req3']=='req3'){
            echo "IT 190 or LPI1 or Linux Essentials" . "<br>";
        }
        if($_SESSION['req4']=='req4'){
            echo "IT 102 or a Programming Course" . "<br>";
        }
        ?>
        <br><a href="#" onclick="enable()" id="close-btn"  class="btn btn-success">Close</a>
    </div>
</body>
</html>