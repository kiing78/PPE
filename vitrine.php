<?php

$genre = $_POST['Genre'];
$TypeVetement = $_POST['TypeVetement'];
$Taille = $_POST['Taille'];
$Couleur = $_POST['Couleur'];
$Quantite = $_POST['Quantite'];
$BtonConsultationAchat = $_POST['BtonConsultationAchat'];

$commande = $genre. $TypeVetement .$Taille . $Couleur . $Quantite;

if(isset($_POST['Submit']))
{

    $pdo=new PDO("mysql:host=127.0.0.1;dbname=achatenligne","root",""); 
            echo "<br>Connexion BDD OK<br>";
            echo "<br>";
        

    if(!empty($genre) and !empty($TypeVetement) and !empty($Taille) and !empty($Couleur))
    {
        
            
            if($BtonConsultationAchat == 'consultation')
            {
                
               
                    $req = $pdo->prepare("SELECT * FROM stock");
                    $req->execute();
            
                    echo'<table><tr><td>Genre</td><td>TypeVetement</td><td>Taille</td><td>Couleur</td><td>Prix</td></tr>';
                    while ($data = $req->fetch())
                    {
                        echo'<tr><td>'.$data['Genre'].'</td><td>'.$data['TypeVet'].'</td><td>'.$data['Taille'].'</td><td>'.$data['Couleur'].'</td><td>'.$data['PrixUnite'].'</td></tr>';
}
echo'</table>';

            } if($BtonConsultationAchat == 'achat' and  is_numeric($Quantite))
                     {      

                            echo 'Vous avez commande : <br>';
                            echo '<br>';
                            echo'<table><tr><td>Genre</td><td>TypeVetement</td><td>Taille</td><td>Couleur</td><td>Prix</td></tr>';
                            echo '<tr><td>'.$genre.'</td><td>'.$TypeVetement.'</td><td>'.$Taille.'</td><td>'.$Couleur.'</td><td>'.$Quantite.'</td></tr>';


                        $qte = $pdo->prepare("SELECT QuantiteDispo FROM stock");

                        $req2 = $pdo->prepare("UPDATE stock(QuantiteDispo) VALUE () ");



                        
                      } 
                        

        }else echo "Veuillez selectionnez tous les champs";
        
   }






?>