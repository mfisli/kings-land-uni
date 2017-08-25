<?php ob_start(); 
?>
<html>
<head>
	<title> King's Land University </title>
    <link href="https://bootswatch.com/cerulean/bootstrap.min.css" rel="stylesheet" />
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-king"></span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./index.php">Home</a></li>
                    <li><a href="./about.html">About</a></li>
                    <li><a href="./contact.html">Contact Us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                    require_once  'session.php';
                    @session_start(); 
                    checkInactivity();
                    if(isset($_SESSION['studentID']) && !empty($_SESSION['studentID'])) {
                        echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Log Out</a></li>";
                        echo "<li><a href='edit-profile.php'><span class='glyphicon glyphicon-cog'></span> " . $_SESSION['studentID'] ."</a></li>";
                    } else {
                        echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                    }
                    ?>
				</ul>
            </div>
        </div>
    </nav>