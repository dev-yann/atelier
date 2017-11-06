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
    private  function renderViewForm(){
        $html = <<<EOT

<h1>form</h1>

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