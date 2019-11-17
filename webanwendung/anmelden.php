<form action="" method="post">
  Dein Benutzername:<br>
  <input type="text" name="benutzername" placeholder="Benutzername"><br>
  Dein Passwort:<br>
  <input type="password" name="passwort" placeholder="Passwort"><br>
  <input type="submit" name="absenden" value="Absenden"><br>
</form>
<?php

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
    header('Location: /webanwendung');
  else:
    echo 'Deine Angaben sind falsch! Überprüfe diese bitte noch einmal';
  endif;
endif;