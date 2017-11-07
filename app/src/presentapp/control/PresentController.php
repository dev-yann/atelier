<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:56
 */

namespace presentapp\control;
use \presentapp\model\Liste as Liste;

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

    public function viewForm(){

        $vue = new \presentapp\view\PresentView('');
        return $vue->render('renderViewForm');
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


}