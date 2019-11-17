<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Die Einkaufsliste</title>
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
				<a class="nav-link" href="#login">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#kontakt">Kontakt</a>
			</li>
		</ul>
	</div>
</nav>
<!-- End Navigation-->

<!-- Landing Page-->
<div class="landing">
	<div class="home-wrap">
		<div class="home-inner">
		</div>
	</div>
</div>
<div class="caption text-center">
	<h1>Die Einkaufsliste</h1>
	<h3>Denk doch einfach dran!</h3>
</div>
<!-- End Landing Page-->


	<div id="beschreibung" class="offset">
	    <div class="col-12 narrow text-center">
			<h1>Die Einkaufsliste für Hund & Katz</h1>
            <p class="lead">Bello braucht neues Futter und Kitty einen neuen Kratzbaum.
            Du hast beim Einkaufen aber schon wieder nicht drangedacht?<br>
			Dann solltest du unbedingt die Einkaufsliste ausprobieren!<br>
				Logge dich ein um die Funktion der Einkaufsliste nutzen zu können.<br> 
				So vergisst du nie wieder etwas!<br>
			<a class="btn btn-secondary btn-md" href="#login">Zum Login</a>
		</div>
	</div>

	<div id="login" class="offset">
		<div class="jumbotron">
		<div class="narrow">
			<div class="col-12 narrow text-center">
				<h3>Login</h3>
				<p>Logge dich ein, um die Funktion der To-Do Liste nutzen zu können.</p>
				<div class="heading-underline"></div>
						<form action="" method="post">
							Dein Benutzername:<br>
							<input type="text" name="benutzername" placeholder="Benutzername"><br>
							Dein Passwort:<br>
							<input type="password" name="passwort" placeholder="Passwort"><br>
							<input class="btn btn-secondary btn-md" type="submit" name="absenden" value="Einloggen"><br>
						  </form>
						  <?php
						  //Login-Formular mit Verbindung zur Datenbank
						  $db = new mysqli('localhost','root','','Webanwendung');
						  if($db->connect_error):
							echo $db->connect_error;
						  endif;
						  
						  if(isset($_POST['absenden'])):
							$benutzername = strtolower($_POST['benutzername']);
							$passwort = $_POST['passwort'];
							$passwort = md5($passwort);
						  
							$search_user = $db->prepare("SELECT id FROM users WHERE benutzername = ? AND passwort = ?");
							$search_user->bind_param('ss',$benutzername,$passwort);
							$search_user->execute();
							$search_result = $search_user->get_result();
						  
							if($search_result->num_rows == 1):
							  $search_object = $search_result->fetch_object();
						  
							 $_SESSION['user'] = $search_object->id;
							 echo 'Perfekt';
							  header('Location: /webanwendung/index.php');
							else:
							  echo 'Deine Angaben sind falsch! Überprüfe diese bitte noch einmal';
							endif;
                          endif;
                          ?>
				</form>
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