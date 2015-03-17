<?php

    session_start();

    ob_start();

    if($_SESSION['loggedIn'] != "true"){

        header("Location: main_login.php");

    }

    require 'db.php';

    //echo $_SESSION['loggedIn'];

    //define session variables to equal what post variable inputs are

    //$_SESSION['username'] = $_POST['username'];

    //$_SESSION['password'] = $_POST['password'];

    

    //prints username in welcome message and has links to logout and to changepassword

    /*if ($_SESSION['username']){

            echo "Welcome, ".$_SESSION['username']."!<br><a href = 'logout.php'>Logout</a><br><a href = 'changepassword.php'>Change Password</a> ";

            //link to add user/remove user

            echo '<a href="addRemove.php">Add/Remove User</a>';

            //data table

    }

    else {

            die("You must be logged in");

               //<a href = 'logout.php'>Logout</a><br>

    //<a href = 'changepassword.php'>Change Password</a><br>

    //<a class=btn href='addRemove.php'>Add User</a>";

    }*/

    

    echo "Welcome, " . $_SESSION['username'] . "!";

 

?>

<head>

    <title>Summary Table</title>   



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    

    <!-- DataTables CSS -->

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css">

		

    <!-- jQuery -->

    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="http://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>

    

    <!-- DataTables -->

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script>

    

    <!-- Card view -->

    <link rel="stylesheet" href="bootstrap-table-master/dist/bootstrap.min.css">

    <link rel="stylesheet" href="bootstrap-table-master/src/bootstrap-table.css">

    <script src="bootstrap-table-master/dist/jquery.min.js"></script>

    <script src="bootstrap-table-master/docs/assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="bootstrap-table-master/src/bootstrap-table.js"></script>

    

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

</head>

<body>

    <div class="bs-example">

	<ul class="nav nav-pills pull-right btn" >

        <li><a href="changepassword.php">Change Password</a></li>

        <li><a href="addRemove.php">Add User</a></li>

        <li><a href="logout.php">Logout</a></li>

	</ul>

</div>

    

        <h1>Summary Table</h1>



    <?php

    // Connecting to the database

    try {

            $dbh = new PDO("mysql:host=$hostname;

                           dbname=amaninde_grcc", $username, $password);

            //echo "Connected to database.";

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    ?>

    

    <br>

    <div id="transform-buttons" class="btn-group btn-default">

        <button class="btn btn-default" id="transform">

            <i class="glyphicon glyphicon-transfer"></i>

            <span data-zh="??" data-es="Transformar">Card View</span>

        </button>

        <button class="btn btn-default" id="destroy">

            </i> <span data-zh="??" data-es="Destruir">Table View</span>

        </button>

    </div>

    

<table id="table-transform" data-card-view="true" data-toolbar="#transform-buttons"

	class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">

        <thead>

	<tr>

            <th>First Name </th>

            <th>Last Name </th>

            <th>Email </th>

            <th>Phone</th>

            <th>Degree</th>

            <th>Student ID</th>

            <th>Status</th>

            <th>Completed Prereqs</th>

            <th>Transcripts</th>

        </tr>

        </thead>

    

    <?php
    require"db.php";            

        // Get Data from DB, last data entery on the top

        $sql = "SELECT * FROM `bas` ORDER BY time desc";

        $result = $dbh->query($sql);

        

        // If there is not student id display not a student

        foreach($result as $row){

            $idlength = strlen($row['sid']);

            $prereq1 = '';

            $prereq2 = '';

            $prereq3 = '';

            $prereq4 = '';

            $req1 = '';

            $req2 = '';

            $req3 = '';

            $req4 = '';

            if($idlength === 9){

                $studentID = $row['sid'];

            }

            else{

                $studentID = 'Not a Student';

            }

            if(!empty($row['prereq1'])){

                $prereq1 = 'Programming 1 and 2 (CS 141&145 or CS 131&132)' . '<br>';

            }

            if(!empty($row['prereq2'])){

                $prereq2 = 'IT 201: Database Fundamentals or equivalent' . '<br>';

            }

            if(!empty($row['prereq3'])){

                $prereq3 = 'IT 190: Intro to Linux or LPI1, or Linux Essentials' . '<br>';

            }

            if(!empty($row['prereq4'])){

                $prereq4 = 'IT 121: HTML/CSS, or equivalent' . '<br>';

            }

            if(!empty($row['req1'])){

                $req1 = 'IT 210 or CCENT' . '<br>';

            }

            if(!empty($row['req2'])){

                $req2 = 'IT 160 or MTA' . '<br>';

            }

            if(!empty($row['req3'])){

                $req3 = 'IT 190 or LPI1 or Linux Essentials' . '<br>';

            }

            if(!empty($row['req4'])){

                $req4 = 'IT 102 or a Programming Course' . '<br>';

            }

            

        // Display the values from the DB.     

        echo "<tr class>

                <td>{$row['fname']}</td>

                <td>{$row['lname']}</td>

                <td>{$row['email']}</td>

                <td>{$row['phone']}</td>

                <td>{$row['degree']}</td>

                <td>{$studentID}</td>

                <td>{$row['veteran']} / {$row['international']} / {$row['runningstart']}</td>

                <td>{$prereq1}{$prereq2}{$prereq3}{$prereq4}{$req1}{$req2}{$req3}{$req4}</td>

                <td><a href='{$row['upload']}'>Transcripts</a></td>

              </tr>";

                  

        }

    //session_destroy();

    ?>

</table>



<script>

    $(function () {

        var $myTable = $('#table-transform');

        $('#transform').click(function () {

            $myTable.bootstrapTable();

        });

        $('#destroy').click(function () {

            $myTable.bootstrapTable('destroy');

        });

    });



</script>

<script>

  //Script for the data table to look good and searchable.

    $(document).ready( function () {

        $('#table-transform').DataTable({"aaSorting": []});

    });

</script>

</body>