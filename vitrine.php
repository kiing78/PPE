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

            } if($BtonConsultationAchat == 'achat' and  is_numeric($Quantite) and $Quantite > 0 and !empty($Quantite))
                     {      
                        $req=$pdo->prepare("SELECT  QuantiteDispo,TypeVet  FROM stock WHERE TypeVet='$TypeVetement' and Taille = '$Taille' and Couleur='$Couleur' and Genre='$genre'");
                        $req->execute();// execute la requete
                      
            
                        // Si la requete a un nombre de tour égal à 0 alors la personne n'existe pas et est ensuite envoyé vers la page *enregistrer.html*
                        if($req->rowCount()==0)
                        { 
                            //si l'article demander existe pas
                            echo " l'article demander n'existe pas ";
                        }
                        else
                        {  
                               
                            //recupere les valeur de la colonne de la variable requete(ici qte) et la stock dans $result
                            //mais vu qu'on a preciser la condition de la requete typeVet alors c'est juste la valeur de 
                            $result = $req->fetchColumn(0);
                            //verification si la quantité est inferieur ou egal a 0
                            if($result <= 0){
                                echo "cette article n'a plus de stock";
                            }
                            else{
                            //soustraction de la  valeur et stock dans une nouvelle variable
                            $Quantite = $result-$Quantite;
                            //requete update qui permet de mettre la nouvelle quantité soustraite dans le typeVetement selectionner
                            $req1=$pdo->prepare("UPDATE stock SET QuantiteDispo='$Quantite' WHERE TypeVet='$TypeVetement' and Taille = '$Taille' and Couleur='$Couleur' and Genre='$genre'");
                            $req1->execute();
                            print_r("quantité=$Quantite");
                            }
                            
                         
                        }
                        

        }else {
                echo "Veuillez saisir tous les champs ";
        }
        
   }
}





?>