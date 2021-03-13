<?php
//on récupère les valeurs mis dans le formulaire pour les affecter dans les variables
$mail=$_POST['mail'];
$mdp=$_POST['pwd'];

// test si "valid" est envoyé
if (isset($_POST['valid']))

{
   /* on test si les champ sont bien remplis */
    if(!empty($mail) and !empty($mdp))
    {
        try {//connexion à la BDD achatenligne
            $pdo=new PDO("mysql:host=127.0.0.1;dbname=achatenligne","root",""); 
            echo "<br>Connexion BDD OK";
            }   
        catch(PDOException $e) 
        { 
            //envoie un message d'erreur si il y a une erreur de connexion BDD
            echo $e->getMessage();
        }
        /*requete pour rechercher les correspondances entre les champs de la BDD et entrer dans le formulaire "connexion" */
            $req=$pdo->prepare("SELECT mail  FROM connexion WHERE Email = '$mail' and password='$mdp'");
            $req->execute();// execute la requete

            // Si la requete a un nombre de tour égal à 0 alors la personne n'existe pas et est ensuite envoyé vers la page *enregistrer.html*
            if($req->rowCount()==0)
            { 
                //si le mail et le mdp n'existent pas donc la personne est envoyé sur *connexion2.html*
                header("location:connexion2.html");
            }
            else
            {   //si la personne entre le bon mail et mdp alors il est envoyé sur la vitrine
                 header("location:vitrine.html"); 
            }
        
     }
        //la personne n'a pas rempli tout les champs
        else echo"Veuillez saisir tout les champs !";    
}  
?>
