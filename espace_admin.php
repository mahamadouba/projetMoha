<?php 
    session_start();
    if(!isset($_SESSION["login"]))
    {
        header("location:index.php?msg=Veuillez s'authentifier");
        exit();
    }
    else
    {
        echo "<p align='right'>Bienvenu ".$_SESSION["prenom"]." ".$_SESSION["nom"]."</p>";
    }
?>