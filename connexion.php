<?php
$mail=$_POST['mail'];
$mdp=$_POST['pwd'];

$Good_mail="kevin";
$Good_pwd="moi";
if($login==$Good_mail && $mdp==$Good_pwd){
    header('location:vitrine.html');
    exit();
}
else{
  
    header('location:connexion2.html');
    exit();

}
?>
