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
	 // LISTE
    private  function renderViewListe(){
        $html ="<h1>Liste</h1>";
		foreach ($this->data as $value){
			 
			$html .='<div class="unEvenement">'. $value->nom . "</br>";
			$html .= "Aujourd'hui : " . $value->date_debut . "</br>";
			$html .= $value->date_final . "</br></br></br>";
		}
		$html .= '<a href="'.$this->script_name.'/addliste/">Ajouter une liste</a>';
        return $html;
    }
	
	// ADD LISTE
    private  function renderViewAddListe(){
        $html ="<h1>Liste</h1>";
	
		$html .= 
			<<<EOT
        <section>
                <form method="post" action="'.$this->script_name.'/liste/">
                    <input type="text" name="NomListe" placeholder="Nom de l'évènement"/>
					<input type="text" name="DateFinal" placeholder="Date de l'évènement"/>
                    <input type="submit" value="Ajouter"/>
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