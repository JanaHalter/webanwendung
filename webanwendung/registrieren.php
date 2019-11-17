<form action="" method="post">
  Dein Benutzername:<br>
  <input type="text" name="benutzername" placeholder="Benutzername"><br>
  Dein Passwort:<br>
  <input type="password" name="passwort" placeholder="Passwort"><br>
  Widerhole dein Passwort:<br>
  <input type="password" name="passwort_widerholen" placeholder="Passwort"><br>
  <input type="submit" name="absenden" value="Absenden"><br>
</form>
<?php
// Als Daten müssen folgende nacheinander eingetragen werden
// Host | Meist localhost
// Benutzer | Benutzername der Datenbank
// Passwort | Passwort der Datenbank. Wenn keins vorhanden einfach leer lasssen
// Datenbank | Name der Datenbank
$db = new mysqli('localhost','root','','Webanwendung');
if($db->connect_error):
  echo $db->connect_error;
endif;
if(isset($_POST['absenden'])):

  $benutzername = $_POST['benutzername'];
  $passwort = $_POST['passwort'];
  $passwort_widerholen = $_POST['passwort_widerholen'];

  $search_user = $db->prepare("SELECT id FROM users WHERE benutzername = ?");
  $search_user->bind_param('s',$benutzername);
  $search_user->execute();
  $search_result = $search_user->get_result();

  if($search_result->num_rows == 0):
    if($passwort == $passwort_widerholen):
      $passwort = md5($passwort);
      $insert = $db->prepare("INSERT INTO users (benutzername,passwort) VALUES (?,?)");
      $insert->bind_param('ss',$benutzername,$passwort);
      $insert->execute();
      if($insert !== false):
        echo 'Dein Account wurde erfolgreich erstellt!';
      endif;
    else:
      echo 'Deine Passwörter stimmen nicht überein!';
    endif;
  else:
    echo 'Der Benutzername ist leider schon vergeben!';
  endif;

endif;
