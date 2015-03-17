<?php
 //this starts the session
    session_start();
    ob_start();

     //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //print_r($_POST);
   // print_r($_SESSION);
   // echo session_id();
    $errors = array();
   
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <link rel="stylesheet" href = "/resources/demos/style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
     <style>.error{color: #ff0000;}
     label {
    display: inline-block;
    width: 5 em;
}
     </style>
      <script>
     window.addDashes = function addDashes(f) {
        var r = /(\D+)/g,
        npa = '',
        nxx = '',
        last4 = '';
        f.value = f.value.replace(r, '');
        npa = f.value.substr(0, 3);
        nxx = f.value.substr(3, 3);
        last4 = f.value.substr(6, 4);
        f.value = npa + '-' + nxx + '-' + last4;
     }
     $(function() {
    $(document).tooltip();
});
     </script>
   
</head>
<body>
    <div class="panel panel-success" id="main-body">
        <div class="panel-body">
            <?php 
            // Define variables and set to empty values;
            $fNameErr = $lNameErr = "";
            $emailErr = $phoneErr= $degreeErr ="";
            $e = 0;
            //initialize the session variables
            $_SESSION['fname'] = "";
            $_SESSION['lname'] = "";
            $_SESSION['email'] = "";
            $_SESSION['phone'] = "";
            $_SESSION['degreebtn'] = "";
            
            // Serverside validation
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            // posting all the values in the session    
            foreach ($_POST as $key => $value) 
                { 
                    $_SESSION[$key] = $value; 
                }
                
                if(empty($_POST["fname"])){
                    $fNameErr = "First Name is required";
                    $e = $e + 1;
                     
                }
                else if(!ctype_alpha($_POST['fname'])) {
                        $fNameErr = "Please only enter letters and white spaces.";
                        $e = $e + 1;
                } else {
                   
                    $_SESSION['fname'] = $_POST['fname'];
        
                }
                
        
        
                if(empty($_POST["lname"])){
                    $lNameErr = "Last Name is required";
                    $e = $e + 1;
                } else if(!ctype_alpha($_POST['lname'])) {
                        $lNameErr = "Please only enter letters and white spaces.";
                        $e = $e + 1;
                }
                else{
                    $_SESSION['lname'] = $_POST['lname'];
                }
                
        
                $email = $_POST['mail'];
                $emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
        
                 if (filter_var($emailSanitized, FILTER_SANITIZE_EMAIL))
                    {
                         $_SESSION['email'] = $_POST['mail'];
                    } else {
                    $emailErr = "Please enter a valid email address.";
                    $e = $e + 1;
        
                    }
        
        
                if(empty($_POST["degreebtn"])){
                    $degreeErr = "Please select one";
                    $e = $e + 1;
                }
                else {    
                    $_SESSION['degreebtn'] = $_POST['degreebtn'];
                }
        
         
                if(empty($_POST['phone'])) {
                    $phoneErr = "Please enter a contact number.";
                    $e = $e + 1;
                } else if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['phone'])) {
                    $phoneErr = "Please enter a valid numberical phone number.";
                    $e = $e + 1;
                } else {
                     $_SESSION['phone'] = $_POST['phone'];
                     
                }
        
        
                // If validation success, then redirect
                if($e === 0){
                    header("Location:tellusmore.php");
                    exit;
                }
            }  
            ?>
            <div class="container">
                <h2>Contact Info</h2>
                <span class="error">*required</span>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <div class="form-group">
                    <div class="container-fluid">
                        <div class="col-xs-4">
                            First Name: <span class="error">* <?php echo $fNameErr?></span>
                            <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" value="<?php echo $_SESSION['fname'];?>">
                                
                            Last Name:  <span class="error">* <?php echo $lNameErr;?></span>
                            <input type="text" name="lname" placeholder="Last Name" class="form-control" value="<?php echo $_SESSION['lname'];?>">
                                
                        </div>
                        <div class="col-xs-5">
                            Email:
                            (If Green River Student, use student email):<span class="error">* <?php echo $emailErr;?></span><br>
                            <input type="email" name="mail" placeholder="Email" required class="form-control" value="<?php echo $_SESSION['email'];?>">
                        
                        
                             Contact Number (xxx-xxx-xxxx):<span class="error">* <?php echo $phoneErr;?></span><br>
                            <input type="tel"  name="phone" placeholder="Phone Number" class="form-control" maxlength="15" size="25" onKeyup='addDashes(this)' value="<?php echo $_SESSION['phone'];?>">
                        </div>   
                    </div>
                    <br>
                    <div class="container-fluid">
                        <div class="col-xs-6">
                            <div id="content">
                            
                                 What type of degree are you interested in?<span class="error">*<?php echo $degreeErr;?></span> <br> 
                                
                                <div class="radio">
                                    <label><input type="radio" name ="degreebtn"  id="degreebtn" value="sdpre" <?php if($_SESSION['degreebtn'] == "sdpre") { print ' checked="checked"'; } ?>>Software Development </label><a href = "http://www.greenriver.edu/Documents/academic-programs/degrees/proftech/it_software_development_bas.pdf"
                                    title = "This Bachelors of Applied Science degree is designed to prepare students for employment in a variety of software development positions, such as software developer, software test developer, systems analyst, quality assurance analyst, mobile application developer, and web developer. Click the link for more information."> <em>(learn more)</em></a>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name ="degreebtn" value="netpre" <?php if($_SESSION['degreebtn'] == "netpre") { print ' checked="checked"'; } ?>>Networking & Security</label><a href = "http://www.greenriver.edu/Documents/academic-programs/degrees/proftech/info_tech_network_admin_security_bas.pdf" title = "This Bachelors of Applied Science degree program is designed to prepare students for employment in a variety of information technology positions, such as network and computer systems administrators, information security analysts, or computer support specialists. This degree provides students with the opportunity to acquire a deep technical foundation and competency in network administration and security. Click the link for more information."> <em>(learn more)</em></a>
                                </div>    
                                <div class="radio">
                                    <label><input type="radio" name ="degreebtn" value="undecided" <?php if($_SESSION['degreebtn'] == "undecided") { print ' checked="checked"'; } ?>>Undecided</label>
                                </div> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="container-fluid">
                <div class="col-xs-6">
                    <input type="submit" name="submit" value="Continue" class="btn btn-success">
                </div>
            </div>
        </form>
            </div>
        
        </div>
    </div>
    </div>
</body>