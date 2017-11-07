<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 17:01
 */

namespace presentapp\view;


use mf\view\AbstractView;

class PresentView extends AbstractView
{

    /* Constructeur
    *
    * Appelle le constructeur de la classe \mf\view\AbstractView
    */
    public function __construct( $data ){
        parent::__construct($data);
    }


    // HEADER
    private function renderHeader(){
        $html =
            <<<EOT

<h1>header</h1>
EOT;
        return $html;
    }


    // FOOTER
    private function renderFooter(){

        return '<h1>footer</h1>';

    }

    // FORM
    private  function renderViewSignUp(){
        $html = <<<EOT
        
        <section>
                <form method="post" action="$this->script_name/check_signup/">
                    <input type="text" name="fullname" placeholder="Prénom"/>
                    <input type="text" name="username" placeholder="Nom"/>
                    <input type="email" name="mail" placeholder="mail"/>
                    <input type="password" name="pw" placeholder="password"/>
                    <input type="password" name="pw_repeat" placeholder="Repeat password"/>
                   
                    <input type="submit" value="create"/>
                </form>
        </section>
EOT;
        return $html;


    }


    public function renderLogin(){
        $html =
        
        <<<EOT
                <section>
                    <form method="post" action="$this->script_name/check_login/">
                        <input type="text" name="email" placeholder="email"/>
                        <input type="password" name="pw" placeholder="password"/>
                        
                        <input type="submit" value="login"/>
                    </form>
                </section>  
EOT;
        
                return $html;
    }

    // DEFAULT
    private function renderViewPresent(){
        $html = <<<EOT
<h1>Défaut</h1>
EOT;
        return $html;

    }




    protected function renderBody($selector=null){

        $header = $this->renderHeader();
        $footer = $this->renderFooter();

        $body = $this->$selector();

        $html =

            <<<EOT

        <header class="theme-backcolor1">${header}</header>
        <section id="container" class="theme-backcolor2">
            ${body}
        </section>
        <footer class="theme-backcolor1">${footer}</footer>

EOT;

        return  $html;
    }
}