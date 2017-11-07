<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:56
 */

namespace presentapp\control;
use \presentapp\model\Liste as Liste;

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

    // Throw check login
    // Control login form
    public function check_login(){
        $vue = new \presentapp\view\PresentView('');
        if(isset($_POST['email'], $_POST['pw']) AND !empty($_POST['email']) AND !empty($_POST['pw'])){
            $user = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
            $pass = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_SPECIAL_CHARS);
            $connect = new PresentAuthentification();
        
            // Si l'authentification retourne vrai
            try{
                $connect->login($user,$pass);
                $this->viewPresent();
                echo $_SESSION['user_login'];
            }catch(\mf\auth\exception\AuthentificationException $e){
                $this->viewLogin();
            }
        } else {
            $this->viewLogin();
        }
    }
	
	public function viewListe(){
		
		$requeteListe = Liste::select()->get(); /* Faire le where avec variable de session */
        $vue = new \presentapp\view\PresentView($requeteListe);
        $vue->render('renderViewListe');
    }
	
	public function viewaddListe(){
		
        $vue = new \presentapp\view\PresentView('');
        $vue->render('renderViewAddListe');
    }

    public function logout(){
        $logout = new \mf\auth\Authentification();
        $logout->logout();
    }


    // CONTROL DE L'INSCRIPTION
    public function checkSignup(){

        if(filter_has_var(INPUT_POST,'fullname') AND filter_has_var(INPUT_POST,'username') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw') AND filter_has_var(INPUT_POST,'pw_repeat') AND filter_has_var(INPUT_POST, 'mail')){

            $email_a = $_POST["mail"];

            if(filter_var($email_a, FILTER_VALIDATE_EMAIL)){

                $fullname = filter_input(INPUT_POST,'fullname',FILTER_SANITIZE_SPECIAL_CHARS);
                $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
                $pw = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_SPECIAL_CHARS);
                $pw_repeat = filter_input(INPUT_POST,'pw_repeat',FILTER_SANITIZE_SPECIAL_CHARS);

                if($pw === $pw_repeat){

                    $signUp = new PresentAuthentification();
                    $signUp->createUser($username, $pw, $fullname,$email_a);

                    $this->viewPresent();

                } else {

                    $this->viewSignUp();
                }

            } else {

                $this->viewSignup();

            }
        }
    }
}