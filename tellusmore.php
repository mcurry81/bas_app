<?php
    session_start();
    ob_start();
   // print_r($_POST);
    //print_r($_SESSION);
    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $Chosen = $_SESSION['degreebtn'];
    
     //print_r($_SESSION);
     //echo session_id();
     
    if(!empty($_POST['studentYesNo'])){
        $_SESSION['student'] = $_POST['studentYesNo'];
    }
    if(!empty($_POST['SID'])){
        $_SESSION['sid'] = $_POST['SID'];
    }
    
    $errors = array();
     

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tell Us More</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css.css">
    <style>.error{color: #ff0000;}</style>
      
     
</head>
<body>
     <?php
     // Define variables and set to empty values;
    $studentErr = $sidErr = "";
    $_SESSION['sid'] = '';
    $e = 0;

     // Serverside validation
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    // posting all the values in the session    
    foreach ($_POST as $key => $value) 
        { 
            $_SESSION[$key] = $value; 
        }
        
      //check if is a student that 9 digit student id is entered  
    if($_POST['studentYesNo']=='yes') {
        if(strlen($_POST['SID']) == 9) {
            $_SESSION['sid'] = $_POST['SID'];
        } else {
            $studentErr = "Please enter your 9-digit student id.";
            $e = $e + 1;
        }
    }
    
        //if selection is made, then session variable is saved
        //if not, then alert selection needs to be made
     if(!empty($_POST['studentYesNo'])) {
        $_SESSION['studentYesNo'] = $_POST['SID'];
    } else {
        $studentErr = "Please go back and select if you are a student or not.";
        $e = $e + 1;
    }

            
     if(isset($_POST['veteran'])) {
        $_SESSION['veteran'] = $_POST['veteran'];
    } else {
        $_SESSION['veteran'] = "na";
    }
     if(isset($_POST['international'])) {
        $_SESSION['international'] = $_POST['international'];
    } else {
        $_SESSION['international'] = "na";
    }
     if(isset($_POST['runningStart'])) {
        $_SESSION['runningStart'] = $_POST['runningStart'];
    } else {
        $_SESSION['runningStart'] = "na";
    }
        
        
        
         // If validation success, then redirect
        if($e === 0){
            header("Location:$Chosen.php");
            exit;
        }
}
        ?>
    <div class="panel panel-success" id="main-body">
        <div class="panel-body">
            <div id="main-div">
                <div class="container">
                    <h2>Tell us More</h2>
                    <span class="error">*required</span>
                <form method="post" action="tellusmore.php" id="studentForm" onsubmit="checkSID();">
                    <fieldset>
                        <legend>Please Select One:<span class="error">*<?php echo $studentErr?></span></legend>
                        <label class="radio-inline">
                            <input type="radio" name="studentYesNo" id="YesStu" required value="<?php if($_SESSION['student'] == 'yes') {
                                                                                                            print 'checked="checked"';
                                                                                                      }else{
                                                                                                        echo "yes";
                                                                                                    }?>">I am currently a student at Greenriver<br>
                        </label>
                            <div id="hideSID">
                                <label id="SID">Student ID (xxxxxxxxx):<input type="text" pattern="^\d{3}\d{3}\d{3}$" name="SID" value="<?php echo $_SESSION['sid'];?>">
                                    <span class="error">*<?php echo $sidErr?></span>
                                </label>
                                
                            </div>
                        <label class="radio-inline">
                            <input type="radio" name="studentYesNo" id="NoStu" required value="<?php if($_SESSION['student'] == "no") {
                                                                                                            print 'checked="checked"';
                                                                                                    }else{
                                                                                                        echo "no";
                                                                                                    }?>">I am a new student.
                        </label>
                    </fieldset>
                    <div class="checkbox">
                    <fieldset>
                        <legend>I am a (please check all that apply):</legend>
                        <label><input type="checkbox" name="veteran" value="veteran">Veteran<br></label>
                        <label><input type="checkbox" name="international" value="international">International Student<br></label>
                        <label><input type="checkbox" name="runningStart" value="runningStart">Running Start Student</label>
                    </fieldset>
                    </div>
                    <a href="javascript:history.back()"><input type="button" id="back" value="Previous" class="btn btn-success"></a>
                    <input type="submit" id="submit" value="Continue" class="btn btn-success">
                </form>
                </div>
            </div>
        </div>
    </div>    

    <script>
        var IDnum = document.getElementById("SID");
        var StuYes = document.getElementById("YesStu");
        var StuNo = document.getElementById("NoStu");

        StuYes.onclick = toggleDisplayOn;
        StuNo.onclick = toggleDisplayOff;
        
        window.onload = toggleDisplayOff;
        
        function checkSID(){
            var SIDvalid = document.getElementById("SID").value;
            if (SIDvalid.length == 9) {
                return true;
            }
            return false;
        }
        
        function toggleDisplayOn(){
            IDnum.style.display = "block";
        }

        function toggleDisplayOff(){
            IDnum.style.display = "none";
        }
    </script>
</body>