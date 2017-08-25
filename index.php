<?php 
	include 'header.php'; 
	require_once 'databaseinit.php';
	require_once 'debugtools.php';
	require_once 'session.php';
?>
<div class="container">
	<div class="jumbotron"> 
		<h1> <span class="glyphicon glyphicon-king"></span> King's Land University </h1> 
		<p> United we learn </p>
	</div>
</div>
<div class="container">
	<?php 	
	echo getMsg(); ?>
	<div class="row">
		<div class="col-sm-6">
			<div class="card">
			  <div class="card-block">
			    <h3 class="card-title"> Schedule </h3>
			    <p class="card-text">See today's time table of lectures and labs. This is padding text.</p>
			    <a href="#" class="btn btn-primary">See Schedule</a>
			  </div>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="card">
			  <div class="card-block">
			    <h3 class="card-title">Special title treatment</h3>
			    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			    <a href="#" class="btn btn-primary">Go somewhere</a>
			  </div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
