<?php ob_start(); ?>
<?php session_start(); ?>

<?php 

$_SESSION['username'] = null;
    
header("Location: upload.php");

?>

