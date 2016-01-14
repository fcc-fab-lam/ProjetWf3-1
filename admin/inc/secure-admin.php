<?php
if($_SESSION['role'] != admin){
    header('Location: accueil.php');
}