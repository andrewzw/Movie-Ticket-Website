<?php

require_once("db.php");

// Abort if id not set
if(!isset($_POST['id'])) {
    header('Location: manager.php');
    exit;
}

$id = $_POST['id'];
$res = $conn->query("delete from s103574757_db.orders where order_id = " . $id);

header('Location: manager.php');

?>