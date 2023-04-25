<?php
session_start();
if (!empty($_GET)) { //verification que le form n'est pas vide
    $_SESSION['day']= $_GET['date']; 
    header("Location: ../pages/dashboard.php");
}
?>