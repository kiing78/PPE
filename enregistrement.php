<?php
      
if (isset($_POST['submit']))
{
   /* on test si les champ sont bien remplis */
    if(!empty($_POST['Nom']) and !empty($_POST['Prenom']) and !empty($_POST['Email']) and !empty($_POST['password']) and !empty($_POST['repeatpassword']))
    {
        /* on test si le mdp contient bien au moins 6 caractère */
        if (strlen($_POST['password'])>=6)
        {      
            /* on test si les deux mdp sont bien identique */
                if($_POST['password']==$_POST['repeatpassword'])
            {
                // On crypte le mot de passe
                $_POST['password']= md5($_POST['password']);

                // on se connecte à MySQL et on sélectionne la base
                try {
                    $pdo=new PDO("mysql:host=127.0.0.1;dbname=achatenligne","root",""); 
                    echo "<br>Connexion BDD OK";
                   
                    $req = $pdo->prepare("INSERT INTO connexion (Nom,Prenom,Email,password) VALUES (?,?,?,?)");
                    
                    $req->execute (array($_POST["Nom"],$_POST["Prenom"],$_POST["Email"],$_POST["password"]));
                    echo "<br>Donnée entrée dans la BDD ";
                
                    }   
                catch(PDOException $e) { 
                    echo $e->getMessage();

                                        }                         
                //Confirmation inscription
                            
            }  else echo "Les mots de passe ne sont pas identiques !"; 
         }
        else echo " Le mot de passe est trop court !";

    } else echo "Veuillez saisir tous les champs !";
} 
?>