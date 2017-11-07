<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:56
 */

namespace presentapp\control;


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

    // Show login form
    public function viewLogin(){
        $vue = new $vue = new \presentapp\view\PresentView('');
        $vue->render('renderLogin');
    }

    public function check_login(){
        $vue = new $vue = new \presentapp\view\PresentView('');
        $vue->render('renderLogin');
    }


}