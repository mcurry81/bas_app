<?php
    session_start();

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //print information for development checking
    
    
    //initializes some session variables
    $_SESSION['req1']='';
    $_SESSION['req2']='';
    $_SESSION['req3']='';
    $_SESSION['req4']='';
    

?>
<!DOCTYPE html>
<html>
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
    <body>
        
            <div class="panel panel-success" id="main-body">
                <div class="panel-body">
                    <div class="container">
                        <h2>Software Development Prerequisites</h2>
                        <div id="center">
                           
                            <h3>Please check all that you have completed</h3>
                            <p>NOTE: If you don"t have all of the prerequisites, or have extensive industry experience, an advisor will contact
                            you to discuss options</p>
                            <div class="checkbox">
                                <form method="post" action="education.php" >
                                <Input type="checkbox" id="class" name="prereq1" value="prereq1">Programming 1 and 2 (CS 141&145 or CS 131&132)<br/>
                                <Input type="checkbox" id="class" name="prereq2" value="prereq2">IT 201: Database Fundamentals or equivalent<br/>
                                <Input type="checkbox" id="class" name="prereq3" value="prereq3">IT 190: Intro to Linux or LPI1, or Linux Essentials<br/>
                                <Input type="checkbox" id="class" name="prereq4" value="prereq4">IT 121: HTML/CSS, or equivalent<br/><br/>
                                    <input type="checkbox" id="class" name="req1" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req2" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req3" value="" class="hideThis">
                                    <input type="checkbox" id="class" name="req4" value="" class="hideThis">
                            </div>
                            
                            <label for="notes">Notes:</label><br/>
                            <textarea rows="5" cols="50" name="notes" value="<?php echo $_SESSION['notes'];?>"></textarea>
                            <div><br>
                            <a href="javascript:history.back()"><input type="button" id="back" value="Previous" class="btn btn-success"></a>
                            <input type="submit" name="submit" value="Continue" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    
    </body>

</html>