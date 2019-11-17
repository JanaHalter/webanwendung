  <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Meine Einkaufsliste</title>
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fixed.css">
</head>

<body data-spy="scroll" data-target="#navbarResponsive">
	
	<!-- Start Home Section-->
	<div id="home">
	</div>
	
	<!-- Navigation-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">	
	<a class="navbar-brand" href="#">Einkaufsliste.de</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class ="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#home">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#beschreibung">Einkaufsliste</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#kontakt">Kontakt</a>
      </li>
      <li class="nav-item">
				<a class="nav-link" href="#logout">Logout</a>
			</li>
		</ul>
	</div>
</nav>
<!-- End Navigation-->

<!-- Start Landing Page Section-->
<div class="landing">
	<div class="home-wrap">
		<div class="home-inner">
		</div>
	</div>
</div>
<div class="caption text-center">
	<h1>Meine Einkaufsliste</h1>
	<h3>Willkommen zurück!</h3>
</div>
<!-- End Landing Page Section-->

<?php require_once 'process.php';?>

<?php
if (isset($_SESSION['message'])):?>
<!-- Bootstrap Klassen alert alert-warning und alert alert-danger-->
<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>

</div>
<?php endif ?>
<div class="container">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'Webanwendung') or die(mysqli_error($mysqli));
$result =$mysqli->query("SELECT * FROM data") or die($mysqli->error);
//pre_r($result);
//pre_r($result->fetch_assoc());
?>
<div class="row justify-content-center">
  <table class="table">
  <thead>
    <tr>
      <th>Einkauf</th>
      <th>Anzahl</th>
      <th>Supermarkt</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>

<?php
while ($row = $result->fetch_assoc()):?>
    <tr>
          <td><?php echo $row['einkauf'];?></td>
          <td><?php echo $row['anzahl'];?></td>
          <td><?php echo $row['supermarkt'];?></td>
          <td>
            <a href="index.php?edit=<?php echo $row['id'];?>"
            class ="btn btn-info btn-md">Bearbeiten</a>
            <a href="process.php?delete=<?php echo $row['id'];?>"
            class ="btn btn-danger">Löschen</a>
          </td>
    </tr>
<?php endwhile;?>
</table>
</div>

<?php
function pre_r($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
?>

<div id="einkaufsliste" class="offset"> 
<div class="jumbotron">
<div class="narrow">
<h3>Die Einkaufsliste</h3>
<div class="row justify-content-center">
    <form action="process.php" method="POST">
        <div class="form-group">
        <label>Einkauf</label>
        <input type="text" name="einkauf" class="form-control" value="Was musst du kaufen?">
        </div>
        <div class="form-group">
        <label>Anzahl</label>
        <input type="text" name="anzahl" class="form-control" value="Wie viel brauchst du?">
        </div>
        <div class="form-group">
        <label>Supermarkt</label>
        <input type="text" name="supermarkt" class="form-control" value="Wo willst du es kaufen?">
        </div>
        <div class="form-group">
        <input class="btn btn-secondary btn-md" type="submit" name="speichern" value="Speichern">
        </div>
      </form>
</div>
</div>
</div>
</div>
</div>
	
	<div id="kontakt" class="offset">
	<footer>
		<div class="row justify-content-center">
			<div class="col-12 narrow text-center">
				<P>Bei Fragen bitte melden.</p>
				<p><b>Kontaktinformationen:</b></p> 
				</p>Matrikelnummer: 2955996</p>
		</div>
	</div>

<!--- Script Source Files -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
<!--- End of Script Source Files -->

</body>
</html>