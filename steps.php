<?php
 //this starts the session
    session_start();
    ob_start();
    require 'db.php';
    //Turn on error reporting
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);
    //print_r($_POST);
    //print_r($_SESSION);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Next Steps</title>   

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!--Bootstrap -->
    <link rel = "stylesheet" href = "//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href = "/resources/demos/style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css">
   
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script>
    
    <style>
    .error{color: #ff0000;}

    </style>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
    <link type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js">
    <link type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js">
        
        <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
        <title>Steps</title>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="steps.css">
    
    <script>
    $(function() {
      $( "#accordion" ).accordion();
    });
    
    </script>
</head>
<body>

<?php

// Upload Script from W3schools. Right now its uploading all kind of files. 
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);

        
        
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    /*if(isset($_POST["submit"])) {
        $check = shell_exec("pdfinfo ".$your_pdf_file_or_url);
        //$check = getimagesize($_FILES["upload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }*/
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["upload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "doc" ) {
        //echo "Sorry, only JPG, JPEG, PNG, PDF, DOC, DOCS files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
 
    // This Php is for the data table/ summary table.
    
        // Getting values from the session variables into local variable. 
        $firstName = $_SESSION["fname"];
        $lastName = $_SESSION["lname"];
        $email = $_SESSION["email"];
        $phone = $_SESSION["phone"];
        $sid = $_SESSION["sid"];
        $vet = $_SESSION["veteran"];
        $inter = $_SESSION["international"];
        $rs = $_SESSION["runningStart"];
        $prereq1 = $_SESSION["prereq1"];
        $prereq2 = $_SESSION["prereq2"];
        $prereq3 = $_SESSION["prereq3"];
        $prereq4 = $_SESSION["prereq4"];
        $req1 = $_SESSION["req1"];
        $req2 = $_SESSION["req2"];
        $req3 = $_SESSION["req3"];
        $req4 = $_SESSION["req4"];
        $notes = $_SESSION['notes'];
        
        if(empty($sid)){
            $sid = 'Not a Student';
        }
        $student = $_SESSION["studentYesNo"];
       
        //$upload = "http://amaninder.greenrivertech.net/bas-app/".$target_file;
        $upload = "http://amaninder.greenrivertech.net/bas-app/upload/". $_FILES["upload"]["name"];
        
        //Cleaning up the degree names 
        $degree = "";
        if($_SESSION['degreebtn'] === "sdpre"){
            $degree = "Software Development";
        }
        elseif($_SESSION['degreebtn'] === "netpre"){
            $degree = "Networking & Security";
        }
        elseif($_SESSION['degreebtn'] === "undecided"){
            $degree = "Undecided";
        }
        
        
        // Connecting to the Database
        try {
            $dbh = new PDO("mysql:host=$hostname;
                           dbname=amaninde_grcc", $username, $password);
            //echo "Connected to database.";
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
        
        // Writing to db as by this point they should clear all the validation. That's why not checking
        // any validation. 
        $sql = "INSERT INTO `amaninde_grcc`.`bas` (`fname`, `lname`, `email`, `phone`, `degree`,`sid`,`veteran`,`international`,`runningstart`,`prereq1`,`prereq2`,`prereq3`,`prereq4`,`req1`,`req2`,`req3`,`req4`,`student`,`upload`, `time`)
        VALUES (:fname, :lname, :email, :phone, :degree, :sid, :veteran, :international, :runningstart, :prereq1, :prereq2, :prereq3, :prereq4, :req1, :req2, :req3, :req4, :student,'$upload',CURRENT_TIMESTAMP)";
        //$sql = "INSERT INTO `amaninde_grcc`.`bas` (`fname`, `lname`, `email`, `phone`, `degree`, `sid`, `student`, `upload`, `time`)
        //VALUES ('$firstName', '$lastName', '$email', '$phone', '$degree', '$sid', '$student', '$upload', CURRENT_TIMESTAMP)";
        
        $statement = $dbh->prepare($sql);
        
        $statement->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':degree', $degree, PDO::PARAM_STR);
        $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
        $statement->bindParam(':student', $student, PDO::PARAM_STR);
        $statement->bindParam(':veteran', $vet, PDO::PARAM_STR);
        $statement->bindParam(':international', $inter, PDO::PARAM_STR);
        $statement->bindParam(':runningstart', $rs, PDO::PARAM_STR);
        $statement->bindParam(':prereq1', $prereq1, PDO::PARAM_STR);
        $statement->bindParam(':prereq2', $prereq2, PDO::PARAM_STR);
        $statement->bindParam(':prereq3', $prereq3, PDO::PARAM_STR);
        $statement->bindParam(':prereq4', $prereq4, PDO::PARAM_STR);
        $statement->bindParam(':req1', $req1, PDO::PARAM_STR);
        $statement->bindParam(':req2', $req2, PDO::PARAM_STR);
        $statement->bindParam(':req3', $req3, PDO::PARAM_STR);
        $statement->bindParam(':req4', $req4, PDO::PARAM_STR);
        
        $statement->execute();
        //print_r ($statement->errorInfo());

        
        // Sending out email. 
                $to      = $_SESSION['email'];
                $to2     = "prime66@hotmail.com";
                $subject = 'Green River Bachelors Application';
                $subject2 = 'New BAS Applicant';
                $message = ("<html>
                                <body>
                                <p>Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "</p>
                    
                                <p>Thank you for your interest in Green River College's " . $degree . " bachelors program.
                                A program manager has been given your application and will be contacting you soon.
                                Our program managers will help to streamline your acceptance process.
                                Below is a summary of the information you submitted. Be sure to check out
                                our <a href='http://amaninder.greenrivertech.net/bas-app/steps.php'>Next Steps</a> 
                                page to get ahead on your Green River College Acceptance.</p>
                                <p>
                                $firstName  $lastName<br>
                                $email <br>
                                $phone <br>
                                $sid <br>
                                $vet <br>
                                $inter <br>
                                $rs <br>
                                $prereq1 <br>
                                $prereq2 <br>
                                $prereq3 <br>
                                $prereq4 <br>
                                $req1 <br>
                                $req2<br>
                                $req3 <br>
                                $req4 <br>
                                $notes <br>
                                </p><br><br><hr><br>
                                <div style='width: 100%; text-align: center;'>
                                    <p><span><a href='https://www.youtube.com/user/grccgator'><img src='http://www.adweek.com/socialtimes/files/2012/09/YouTube-App-Icon.jpg' alt='visit youtube' width='50' height='50'></a></span>
                                    <span><a href='https://twitter.com/greenrivercc'><img src='https://cdn3.iconfinder.com/data/icons/free-social-icons/67/twitter_circle_color-512.png' alt='visit twitter' width='50' height='50'></a></span>
                                    <span><a href='https://www.facebook.com/GreenRiverCC'><img src='http://static.squarespace.com/static/5374c718e4b0297decd5276c/t/5436908ae4b0ac0c0ccac3df/1412862090639/facebook-icon.png' alt='visit facebook' width='50' height='50'></a></span>
                                    <span><a href='https://www.instagram.com/greenrivertech/'><img src='http://icons.iconarchive.com/icons/uiconstock/socialmedia/512/Instagram-icon.png' alt='visit instagram' width='50' height='50'></a></span>
                                    <span><a href='https://www.linkedin.com/edu/green-river-community-college-20206'><img src='http://www.gilroystainedglass.com/wp-content/uploads/2014/04/LinkedIn_Icon.png' alt='visit linkedin' width='50' height='50'></a></span>
                                    <span><a href='greenrivertech.net/'><img src='http://greenrivertech.net/assets/img/grtech.jpg' alt='visit linkedin' width='50' height='50'></a></span></p>
                                    <div style='display: inline-block'>
                                        <img src='http://greenrivertech.net/assets/img/GR_logo_small.jpg' alt='visit linkedin' ><br>
                                        <p>12401 Southeast 320th Street
                                               Auburn, WA 98092</p>
                                    </div>
                                </div>
                                <body>
                            <html>");
                
                $message2 = "<html>
                                <body>
                                    <p>Hello. You have a new applicant.</p>
                                    <p><a href='http://amaninder.greenrivertech.net/bas-app/loginPage.php'>Click Here</a> to view their application.</p>
                                    <p>Here is their contact info.<br>
                                       Name: $firstName $lastName<br>
                                       Email: $email</p>
                                </body>
                              </html>";
                
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                           'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers2 = 'MIME-Version: 1.0' . "\r\n" .
                           'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                
                mail($to, $subject, $message, $headers);
                mail($to2, $subject2, $message2, $headers2);
        //end of email code
    ?>

<div class="panel panel-success" id="main-body">
        <div class="panel-body">
            <h1>Next Steps</h1> <br>           
                <div id="accordion" >
                  <h2>1.Apply to the college</h2>
                  <div>
                    <h3>Admissions</h3>
                    <p>Admission to the college is open to anyone who has a high school diploma,
                        GED, or is at least 18 years old. Green River welcomes people of all income
                        levels, backgrounds and previous educational experience.</p>
                    <p>Check your email within 2 days of applying for notification of your student
                    identification number (SID) and follow instructions for setting up your Green River 
                    issued, student e-mail account.</p>
                    <p>
                        <button class="btn btn-success"><a href="http://www.greenriver.edu/student-affairs/apply-now.htm">Apply Now</a></button>
                    </p>
                  </div>
                  <h2>2.Submit all official transcripts</h2>
                  <div>
                    <p>
                        <button class="btn btn-success">
                        <a href="http://www.greenriver.edu/student-affairs/enrollment-services/transcripts.htm">Submit Transcripts</a>
                        </button>
                    </p>
                  </div>
                  <h2>3.Complete a transcript evaluation form</h2>
                  <div>
                    <h3>Transcript Evaluation</h3>
                    <p>
                        Transcripts will be evaluated to determine which credits will apply to the
                        program of study you intend to pursue at Green River.  Credits earned at
                        institutions accredited by their regional accrediting association may be
                        accepted.  To find out if an educational institution is accredited by their
                        regional accrediting association, you can use the accreditation database provided
                        by the U.S. Department of Education's Office of Postsecondary Education.
                        On the website, you can search for an institution by its name and find its
                        accrediting agency.
                    </p>
                    <p>
                        Follow the transcript evaluation tab. <br> <br>
                        <button class="btn btn-success">
                      <a href="http://www.greenriver.edu/student-affairs/enrollment-services/transcripts.htm">Transcript Evaluation</a>
                        </button>
                  </div>
                  <h2>4.Activate your Green River email account</h2>
                  <div>
                    <p>
                        Please activate your email by following the link below. <br> <br>
                    
                        <button class="btn btn-success">
                        <a href="http://grcc.greenriver.edu/student-email/">Green River email</a>
                        </button>
                    </p>
                    
                  </div>
                  <h2>5.Apply for Financial Aid</h2>
                  <div>
                    <p>
                        Priority deadline March 15, 2015
                        Financial Aid is available in three forms:
                        <ul>
                            <li>Gift Aid  grants and scholarships</li>
                            <li>Employment the jobs on or off campus</li>
                            <li>Loans the low interest with deferred repayment</li>
                        Financial aid awards are processed throughout the year in the order that
                        files are completed, so it is best to apply as early as possible to receive
                        the funding that is still available. Late applications are less likely
                        to have their award notices completed prior to the start of the quarter.
                    </p>
                    <p>
                        For more info: <br> <br>
                        <button class="btn btn-success">
                        <a href="http://www.greenriver.edu/student-affairs/financial-aid.htm">Financial Aid</a>
                        </button>
                    </p>
                  </div>
            </div>
        </div>
    </div>
</body>
<?php
session_destroy();
?>
