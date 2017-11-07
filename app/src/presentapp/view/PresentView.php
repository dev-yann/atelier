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
<a href="$this->script_name/logout/">logout</a>
<a href="$this->script_name/addliste/">Ajouter une liste</a>


EOT;
        return $html;//<a href="$this->script_name//"></a>
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

	 // LISTE
    private  function renderViewListe(){
        $html ="<h1>Liste</h1>";
		foreach ($this->data as $value){
			 
			$html .="<div class='unEvenement'><a href=" . $this->script_name. "/listeItem/?id=" . $value->id . ">". $value->nom . "</a></br>";
			$html .= "Aujourd'hui : " . $value->date_debut . "</br>";
			$html .= $value->date_final."</br>";
			$html .= '<a href="'.$this->script_name.'/supprliste/?id='.$value->id.'">Supprimer une liste</a></br></br></br>';
		}
		$html .= '<a href="'.$this->script_name.'/addliste/">Ajouter une liste</a></br>';
		$html .= '<a href="'.$this->script_name.'/supprliste/">Supprimer une liste</a>';
        return $html;
    }
	
	// ADD LISTE
    private  function renderViewAddListe(){
        $html ="<h1>Liste</h1>";
	
		$html .= 
			<<<EOT
        <section>
                <form method="post" action="$this->script_name/check_addliste/">
                    <input type="text" name="nomListe" placeholder="Nom de l'évènement"/>
					<input type="text" name="dateFinale" placeholder="Date de l'évènement"/>

                    <input type="submit" value="Ajouter"/>
                </form>
        </section>
EOT;
        return $html;
    }
	// SUPPR LISTE
	
	
	
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
        /*echo $_SESSION['user_login'];
        echo $_SESSION['access_level'];*/
        $html = <<<EOT
<h1>Défaut</h1>
EOT;
        return $html;

    }

    // RENDER ADD ITEM
    private function renderViewAddItem(){

        $html = <<<EOT
<section>
    <form method="post" action="$this->script_name/addItem/">
    <label for="nom">Nom</label><input id="nom" name="nom"/>
    <label for="tarif">Tarif</label><input id="Tarif" name="tarif"/>
    <textarea placeholder="description" name="description"></textarea>
    <input type="submit" value="ajouter"/>
</form>
</section>
EOT;

        return $html;


    }

    // Items presentation
    private function renderViewItems(){
        $tab = $this->data->items()->get();

        foreach($tab as $key => $value){

            echo "$key => $value";

        }

    }

    public function renderViewListeItem(){

        $html ="<h1>Liste pour l'évenement: " . $this->data->nom . "</h1>";
        $html .= "<a href=".$this->script_name."/ViewAddItem/?id=".$this->data->id.">Ajouter une item</a>";
        $html .="<div class='unEvenement'>". $this->data->nom . "</br>";
        $html .= "Aujourd'hui : " . $this->data->date_debut . "</br>";
        $html .= $this->data->date_final . "</br></br></br> MDRRR";

        /*$tab = $this->data->items()->get();

        foreach ($tab as $key => $value){
            $html .= '<div class="item">';
            
            $html .= '<p>Nom : '.$value['nom'].'</p>';
            $html .= '<p>Tweet : <a href="'.$this->script_name.'/view/?id='.$value['id'].'">'.$value['text'].'</a></p>';
            $html .= '<p>Date : '.$value['created_at'].'</p>';
            $html .= '<p>Followers : '.$this->data->followers.'</p>';
            $html .= '</div>';
        }*/
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