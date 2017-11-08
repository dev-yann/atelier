<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:56
 */

namespace presentapp\control;
use \presentapp\model\Liste as Liste;
use \presentapp\model\Item as Item;
use \presentapp\model\Createur as Createur;
use presentapp\auth\PresentAuthentification;


class PresentController extends \mf\control\AbstractController
{
    /* Méthode viewHome :
     *
     * Réalise la fonctionnalité : afficher la liste des cadeaux
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function viewPresent(){
        /*$listTweet = tweet::get();

        $vue = new \tweeterapp\view\TweeterView($listTweet);
        return $vue->render('home');*/
        $vue = new \presentapp\view\PresentView('');
        return $vue->render('renderViewPresent');

    }

    // VUE INSCRIPTION
    public function viewSignUp(){

        $vue = new \presentapp\view\PresentView('');
        return $vue->render('renderViewSignUp');
    }

    // Show login form
    public function viewLogin(){
        $vue = new \presentapp\view\PresentView('');
        $vue->render('renderLogin');
    }

    public function viewItem(){

        $crea = $_SESSION['user_login'];
        $idCrea = Createur::select()->where('email', '=', $crea)->first();
        $id = $idCrea->id;


        $nada = Liste::select('id','=',$id)->first();
        $vue =  new \presentapp\view\PresentView($nada);
        $vue->render('renderViewLogin');

    }

    public function viewAddItem(){
        $id = $this->request->get['idListe']; 

        $vue = new \presentapp\view\PresentView($id);
        $vue->render('renderViewAddItem');

    }

	public function viewListe(){
        $persCo = $_SESSION['user_login'];
        $requeteCrea = Createur::select()->where('email', '=', $persCo)->first();     
        $idc = $requeteCrea->id;
		
		$requeteListe = Liste::select()->where('createur', '=', $idc)->get(); /* Faire le where avec variable de session */
        $vue = new \presentapp\view\PresentView($requeteListe);
        $vue->render('renderViewListe');
    }
	
	public function viewaddListe(){
		
        $vue = new \presentapp\view\PresentView('');
        $vue->render('renderViewAddListe');
    }
	
	public function checkaddliste(){
		
	
        if(filter_has_var(INPUT_POST,'nomListe') AND filter_has_var(INPUT_POST,'dateFinale')){

            $nomListe = filter_input(INPUT_POST,'nomListe',FILTER_SANITIZE_SPECIAL_CHARS);
            $dateFinal = filter_input(INPUT_POST,'dateFinale',FILTER_SANITIZE_SPECIAL_CHARS);
        
			//recuperation de l'id de la personne connecté
			$persCo = $_SESSION['user_login'];
			$requeteCrea = Createur::select()->where('email', '=', $persCo)->first();     
			$idc = $requeteCrea->id;
					
            $l = new Liste();
            $l->nom = $nomListe;
			$l->date_final = $dateFinal;
			$l->createur = $idc;
			$l->save();
			
            $this->viewListe();

        } else {

            $this->checkSignup();
        }
    }
	
	public function viewSupprliste(){
		$idListe = $this->request->get['idListe'];
		
		$affectedRows = Liste::where('id', '=', $idListe)->delete();
		
		$this->viewListe();
    }

    public function addItem(){
        if(filter_has_var(INPUT_POST,'nom') AND filter_has_var(INPUT_POST,'description') AND filter_has_var(INPUT_POST,'tarif') AND filter_has_var(INPUT_POST,'image')){
                // regarder si ca existe
                $nom = filter_input(INPUT_POST,'nom',FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_SPECIAL_CHARS);
                $tarif = filter_input(INPUT_POST,'tarif',FILTER_SANITIZE_SPECIAL_CHARS);

                $item=new Item();

                if(isset($_POST['url'])){
                    $url = filter_input(INPUT_POST,'url',FILTER_SANITIZE_SPECIAL_CHARS);
                    $item->url=$url;
                }

                $idListe = $this->request->get['idListe'];

                $item->nom=$nom;
                $item->description=$description;
                $item->tarif=$tarif;
                $item->id_list = $idListe;
                $item->save();

                $this->viewListeItem();
                $message = "L'item à bien été ajouté";
                echo "<script alert(".$message.")></script>";
                
        }
    }

    public function logout(){
        $logout = new \mf\auth\Authentification();
        $logout->logout();

        // SI DÉCO ALORS PEU PAS AFFICHER VIEWLISTE
        /*$this->viewListe();*/
        $this->viewPresent();
    }

    public function check_login(){

        // on recharge la vue dans le cas d'une error
        $vue = new \presentapp\view\PresentView('');

        if(isset($_POST['email'], $_POST['pw']) AND !empty($_POST['email']) AND !empty($_POST['pw'])){
            $user = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
            $pass = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_SPECIAL_CHARS);

            $connect = new PresentAuthentification();

            // Si l'authentification retourne vrai
            try{

                $connect->login($user,$pass);
                $this->viewListe();
                //echo $_SESSION['user_login'];

            }catch(\mf\auth\exception\AuthentificationException $e){

                $this->viewLogin();
                echo $e->getMessage();

            }

        } else {

            $this->viewLogin();

        }
    }

    // CONTROL DE L'INSCRIPTION
    public function checkSignup(){

        if(filter_has_var(INPUT_POST,'fullname') AND filter_has_var(INPUT_POST,'username') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw_repeat') AND filter_has_var(INPUT_POST, 'mail')){

            $email_a = $_POST["mail"];

            if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){

                $fullname = filter_input(INPUT_POST,'fullname',FILTER_SANITIZE_STRING);
                $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
                $pw = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_SPECIAL_CHARS);
                $pw_repeat = filter_input(INPUT_POST,'pw_repeat',FILTER_SANITIZE_SPECIAL_CHARS);

                if($pw === $pw_repeat){

                    $signUp = new PresentAuthentification();

                    try{

                        $signUp->createUser($username, $pw, $fullname,$email_a);

                        // Si tous se passe bien on renvoie sur les listes
                        $this->viewListe();

                    }catch (\Exception $e){

                        // si la création du user à échouée
                        $this->viewSignUp();
                        echo $e->getMessage();

                    }

                } else {

                    echo "Les mots de passes ne sont pas les mêmes";
                    $this->viewSignUp();
                }

            } else {

                echo "L'adresse email n'a pas le bon format";

            }

        } else {

            echo "Certaines données sont manquantes";
            $this->viewSignup();
        }
    }


    public function viewListeItem(){
        
                $id = $this->request->get['idListe'];        
                $l= Liste::where('id','=',$id)->first();
       
                $vue = new \presentapp\view\PresentView($l);
                $vue->render('renderViewListeItem');
    }

    public function viewReserverItem(){
        $tab['idItem'] = $this->request->get['idItem'];
        $tab['idListe'] = $this->request->get['idListe'];

        $item = new Item();
        $nomItem = $item->select('nom')->where('id', '=', $tab['idItem'])->first();

        $tab['nom'] = $nomItem;

        $vue = new \presentapp\view\PresentView($tab);
        $vue->render('renderViewReserverItem');
    }

    public function reserverItem(){
        $idItem = $this->request->get['idItem'];

        if(filter_has_var(INPUT_POST,'nom') AND filter_has_var(INPUT_POST,'message')){
            $message = filter_input(INPUT_POST,'message',FILTER_SANITIZE_STRING);
            $nom = filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING);

            $item = new Item();
            $update = $item->where('id', '=', $idItem)->first();
            $update->status = 1;
            $update->message = $message;
            $update->reservePart = $nom;
            $update->save();

            $this->viewListeItem();
        }else{
            $this->viewReserverItem();
        }

        
    }
}