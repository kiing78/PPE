package PPE;

import java.awt.Color;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.Statement;
import java.util.LinkedList;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;



public class PPE extends JFrame implements ActionListener, ItemListener{


	//création des boutons
	JButton boutonCons = new JButton("Consultation");
	JButton boutonDel = new JButton("Delete");
	JButton boutonInser = new JButton("Inserer");
	JButton boutonClear = new JButton("Clear");
	JButton boutonClearStock = new JButton("Effacer stock");

	
	//création des éléments des listes
	String [] Genre = {"Homme", "Femme"};
	String [] optionsCouleurs = {"Rouge", "Bleu", "Vert", "Noir", "Beige"};
	String [] Taille = {"1an-6ans", "7ans-12ans", "13ans-18ans", "Adulte"};
	String [] TypeVetement = {"Chemise","Pantalon","Veste","Robe","Jupe"};
	
	// Créations des listes déroulantes
	private JComboBox listeCouleurs = new JComboBox(optionsCouleurs);
	private JComboBox genre = new JComboBox(Genre);
	private JComboBox taille = new JComboBox(Taille);
	private JComboBox typeVetement = new JComboBox(TypeVetement);
	
	//Labels
	private JLabel labelPrix = new JLabel("Saisir prix");
	private JLabel labelQte = new JLabel("Saisir une Quantité");
	private JLabel labelRef = new JLabel("Saisir une Référence");
	
	//zone de résultat
	private JTextArea zoneResultat = new JTextArea(10,30);
	private JScrollPane scroll = new JScrollPane(zoneResultat);
	
	//zone de saisie
	private JTextField prix = new JTextField(20);
	private JTextField ref = new JTextField(20);
	private JTextField qte = new JTextField(20);
	


	private BddAccess refBdd;
	
	public PPE() {
		
//-------création de la fenetre ------------------------------------------------------
		//titre de la fenetre
		setTitle("Fenetre");
		
		//fermeture du processus
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		
		// endroit ou apparait la fenetre au début
		setLocationRelativeTo(null);
		
		
		// taille de la fenetre
		setSize(600,400);
		
		// visibilité de la fenetre
		setVisible(true);
		
//---------fin de création de fenetre -------------------------------------------------
		
		//création de l'objet panel
		JPanel pan = new JPanel();
		
		//couleur du background
		pan.setBackground(Color.yellow);
		
		//associe la fenetre avec le panel
		setContentPane(pan);
		
		//ajout des boutons sur le panel
		pan.add(boutonCons);
		pan.add(boutonDel);
		pan.add(boutonInser);
		pan.add(boutonClear);
		pan.add(boutonClearStock);
		pan.add(labelRef);
		pan.add(ref);
		pan.add(genre);
		pan.add(typeVetement);
		pan.add(taille);
		pan.add(listeCouleurs);
		pan.add(labelPrix);
		pan.add(prix);
		pan.add(labelQte);
		pan.add(qte);
		pan.add(zoneResultat);
		pan.add(scroll);
		
		
		
		//associe les actions des boutons à cette fenetre
		boutonCons.addActionListener(this);
		boutonDel.addActionListener(this);
		boutonInser.addActionListener(this);
		boutonClear.addActionListener(this);
		boutonClearStock.addActionListener(this);
		genre.addActionListener(this);
		taille.addActionListener(this);
		typeVetement.addActionListener(this);
		listeCouleurs.addActionListener(this);
		prix.addActionListener(this);
		qte.addActionListener(this);
		ref.addActionListener(this);
		
		//associe les items à cette fenetre
		
	// Sélectionne un élément de la liste
	genre.setSelectedIndex(1);
	taille.setSelectedIndex(3);
	typeVetement.setSelectedIndex(3);
	listeCouleurs.setSelectedIndex(4);
	
	
	


}
	
		@Override
		public void actionPerformed(ActionEvent e) {
			//création des variables
			String genre1=(String) genre.getSelectedItem();
	 		String taille1=(String) taille.getSelectedItem();
	 		String typeVet=(String) typeVetement.getSelectedItem();
	 		String couleur=(String) listeCouleurs.getSelectedItem();
	 		String Prix= prix.getText();
	 		String Qte= qte.getText();
	 		String Ref= ref.getText();
		 	
	 		//Consultation
		 	if(e.getSource()==boutonCons) {
		 		
		 		refBdd.envoiRequeteSel("SELECT * from stock");
		 		refBdd.rechercheResultatsVersIhm();
		 	}
		 	//Insertion
		 	else if (e.getSource()==boutonInser) {
		 			//Si prix et quantité ne sont pas vide
		 			if(!Prix.isEmpty() && !Qte.isEmpty()) {
		 		String	req = "INSERT INTO stock (Genre, TypeVet, Taille, Couleur,PrixUnite,QuantiteDispo) VALUES (";
					req = req + "'"+genre1 + "'"+","+ "'"+typeVet + "'"+ ","+ "'"+taille1 +"'"+","+"'"+couleur +"'"+","+"'"+Prix+"'"+","+"'"+Qte+"'"+")";
				
		 		refBdd.envoiRequeteUpdate(req);
		 		zoneResultat.append("votre demande a été valider\n");
				
		 		}
		 		else {
		 			zoneResultat.append("veuillez entrer un prix et une quantité\n");
		 		}
		 	}
		 	//Supprimer
		 	else if(e.getSource()== boutonDel){
		 		if(!Ref.isEmpty()) {
		 			String	req = "DELETE FROM stock WHERE Reference="+Ref;
					
				
		 		refBdd.envoiRequeteUpdate(req);
		 		zoneResultat.append("votre demande a été valider\n");
		 		}
		 		else {
		 			zoneResultat.append("Veuillez saisir uniquement une référence à supprimer\n");
		 		}
		 		
		 		
		 	}
		 	//Nettoyer la zone de résultat
		 	else if (e.getSource()== boutonClear){
		 		zoneResultat.setText("");
		 		
		 	}
		 	//Supprimer tous les éléments de la table de stock
		 	else if (e.getSource()== boutonClearStock){
		 		
		 		
		 		refBdd.envoiRequeteUpdate("DELETE stock.* from stock");
		 		zoneResultat.append("votre demande a été valider\n");
		 		
		 	}
		 	else {
		 		
		 	}
		}
		
		// methode de référence BDD
	public void setRefBdd(BddAccess refBdd) {
		this.refBdd = refBdd;
	}

	@Override
	public void itemStateChanged(ItemEvent e) {
		// TODO Auto-generated method stub
		
	}
	//Méthode pour afficher les résultats
	public void afficheZoneResultats(String ligne) {
		// TODO Auto-generated method stub
		zoneResultat.append(ligne);
		
	}


}

