<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'Webanwendung') or die(mysqli_error($mysqli));
$id=0;
$update = false;
$anzahl='';
$einkauf='';
$supermarkt ='';
if (isset($_POST['speichern'])){
    $einkauf = $_POST['einkauf'];
    $anzahl = $_POST['anzahl'];
    $supermarkt = $_POST['supermarkt'];
    $_SESSION['message'] = "Der Eintrag wurde gespeichert!";
    $_SESSION['msg_type'] = "success";
    header("location: /webanwendung/index.php");
    $mysqli->query("INSERT INTO data (einkauf, anzahl, supermarkt) VALUES('$einkauf', '$anzahl', '$supermarkt')") or 
    die($mysqli->error);
}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or 
    die($mysqli->error);
    $_SESSION['message'] = "Der Eintrag wurde gelöscht!";
    $_SESSION['msg_type'] = "danger";
    header("location: /webanwendung/index.php");
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $einkauf = $row['einkauf'];
        $anzahl = $row['anzahl'];
        $supermarkt = $row['supermarkt'];
    }
}
if(isset($_POST ['update'])){
    $id=$_POST['id'];
    $anzahl=$_POST['anzahl'];
    $supermarkt=$_POST['supermarkt'];
    $einkauf=$_POST['einkauf'];
    $mysqli->query("UPDATE data SET anzahl='$anzahl', einkauf='$einkauf', supermarkt='$supermarkt' WHERE id=$id") or
    die ($mysqli->error);
    $SESSION['message'] = "Der Eintrag wurde geändert";
    $_SESSION['msg_type'] = "warning";
    header("location: /webanwendung/index.php");
}
?>