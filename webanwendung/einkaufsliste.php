<?php

$db = new mysqli('localhost','root','','Webanwendung');
if($db->connect_error):
  echo $db->connect_error;
endif;

$search_user= $db->prepare('SELECT * FROM users WHERE id = ?');
$search_user->bind_param('i', $_SESSION['user']);
$search_user->execute();
$search_result = $search_user->get_result();

if($_search_result->num_rows == 1):
    $search_object = $search_result->fetch_object();
    echo 'Hallo, .$search_object->benutzername.' ;
endif;
