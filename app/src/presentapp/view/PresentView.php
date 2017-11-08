<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 17:01
 */

namespace presentapp\view;

use \presentapp\model\Item as Item;


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

        if(isset($_SESSION['user_login'])){
            $html =
                <<<EOT
                
                
                <header class="header theme-backcolor1">
        <h1 class="logo"><img src="$this->app_root/app/src/mf/html/web/img/png/003-gift.png" alt="icon" class="icon">Mecado</h1>
                <span class="icon-menu" id="btn-menu"></span>
                <nav class="nav" id="nav">
                    <ul class="menu">
                        <li class="menu_item"><a class="menu_link select" href="$this->script_name/logout/">logout</a></li>
                        <li class="menu_item"><a class="menu_link" href="$this->script_name/addliste/">Ajouter une liste</a></li>
                        <li class="menu_item"><a class="menu_link" href="$this->script_name/liste/">Mes listes</a></li>
                    </ul>
                </nav> 
        </header>
EOT;
        } else {

            $html = <<<EOT
            <header class="header">
        <h1 class="logo"><img src="$this->app_root/app/src/mf/html/web/img/png/003-gift.png" alt="icon" class="icon">Mecado</h1>
                <span class="icon-menu" id="btn-menu"></span>
                <nav class="nav" id="nav">
                    <ul class="menu">
                        <li class="menu_item"><a  class="menu_link" href="$this->script_name/signup/">inscription</a></li>
                        <li class="menu_item"><a  class="menu_link" href="$this->script_name/login/">connection</a></li>
                    </ul>
                </nav> 
        </header>

EOT;

        }


        return $html;//<a href="$this->script_name//"></a>
    }

    // FOOTER
    private function renderFooter(){

/*        return '<h1>footer</h1>';*/

    }

    // FORM
    private  function renderViewSignUp(){
        $html = <<<EOT
         <section>
        
        <div class="container">
     <div class="col-8 offset-2">
      <div class="formulaire">
       <legend>Inscription</legend>
        <form method="post" action="$this->script_name/check_signup/">
                    <input type="text" name="fullname" placeholder="Prénom" required/>
                    <input type="text" name="username" placeholder="Nom" required/>
                    <input type="email" name="mail" placeholder="mail" required/>
                    <input type="password" name="pw" placeholder="password" required/>
                    <input type="password" name="pw_repeat" placeholder="Repeat password" required/>
                   
                    <input type="submit" value="Créer"/>
        </form>
       </div> 
     </div>
     </div>
                
        </section>
EOT;
        return $html;


    }

	 // LISTE
    private  function renderViewListe(){

        $html ="<div class='container'>";
		foreach ($this->data as $value){

			$html .="<div class='unEvenement'><a href=" . $this->script_name. "/listeItem/?idListe=" . $value->idPartage . ">". $value->nom . "</a></br>";
			$html .= "Commence le : " . $value->date_debut . "</br>";
            $html .= "<p>Reservation possible jusqu'au: ".$value->date_final."</p></br>";
		
            if(isset($_SESSION['user_login'])){
                $html .= "<p><a href='http://localhost".$this->script_name."/listeItem/?idListe=".$value->idPartage."'>Lien de partage</a></p>";
            }
            $html .= '<a href="'.$this->script_name.'/supprliste/?idListe='.$value->id.'">Supprimer cette liste</a></br></br></br>';
            
        }
        if(isset($_SESSION['user_login'])){
            $html .= '<a href="'.$this->script_name.'/addliste/">Ajouter une liste</a></br>';
		    
        }
		$html .= "</div>";
		
        return $html;
    }

	// ADD LISTE
    private  function renderViewAddListe(){
        $html ="<h1>Liste</h1>";
	
		$html .= 
			<<<EOT
      
<div class="container">
     <div class="col-8 offset-2">
      <div class="formulaire">
       <legend>Ajouter une nouvelle liste : </legend>
        <form method="post" action="$this->script_name/check_addliste/">
            <input type="text" name="nomListe" placeholder="Nom de l'évènement" required/>
            <textarea placeholder="description" name="description"></textarea>
            <input type="date" id="date" name="dateFinale" placeholder="Date de l'évènement : AAAA-MM-JJ" required/>
            
            <input type="submit" value="Ajouter"/>
        </form>
        </div> 
    </div>
 </div>
EOT;
        return $html;
    }
	// SUPPR LISTE

    public function renderLogin(){
        $html =
        
        <<<EOT
                
    <section>
           <div class="container">
     <div class="col-8 offset-2">
      <div class="formulaire">
       <legend>Connexion</legend>
        <form method="post" action="$this->script_name/check_login/">
         <input type="email" name="email" placeholder="email" required> 
         <input type="password" name="pw" placeholder="password" required>  
         <input type="submit" value="login">
        </form>
       </div> 
     </div>
     </div>         
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
        /*$get = new \presentapp\control\PresentController();
        $idList = $get->request->get['id'];*/
        $idList = $this->data; //a faire mieux comme en haut mais pb de protected
        $html = <<<EOT
        
        <div class="container">
     <div class="col-8 offset-2">
      <div class="formulaire">
       <legend>Cadeau</legend>
       
       <form method="post" enctype="multipart/form-data" action="$this->script_name/addItem/?idListe=$idList">
       
       <label for="nom">Nom</label><input type="text" id="nom" name="nom" placeholder="Nom" required/>
         
       <label for="tarif">Tarif</label><input id="tarif" name="tarif" type="number" placeholder="Tarif" step="0.01"/>
         <input type="url" id="url" placeholder="Url vers un autre site"> 
         <Textarea rows="4" cols="15" placeholder="Description" name="description"></Textarea>
         <input type="text" name="image" id="urlimage" placeholder="Ajouter le lien d'une image"/>
         <input type="submit" value="ajouter">
        </form>
       </div> 
     </div>
     </div>
             
</form>
</section>
</div>
EOT;

        return $html;


    }

    // Item presentation
    private function renderViewItem(){
        $tab = $this->data->items()->get();

        foreach($tab as $key => $value){

            echo "$key => $value";

        }

    }

    public function renderViewListeItem(){

        $html = '<div class="container">';
        if($this->data['msg'] !== null){
            $html .= "<h1 class='alert'>".$this->data['msg']."</h1>";
        }
        
        $html .="<h1>Liste pour l'évenement: " . $this->data->nom . "</h1>";
        //if(isset($_SESSION['user_login'])){
        $html .= "<p><a href=".$this->script_name."/ViewAddItem/?idListe=".$this->data->idPartage.">Ajouter une item</a></p>";
        //}
        $html .= "Aujourd'hui : " . $this->data->date_debut . "</br>";
        $html .= "Date de l'évènement : ".$this->data->date_final . "</br></br></br>";

        //$id_list = $this->data->id;

        $tab = $this->data->items()->where('id_list','=',$this->data->id)->get();

        foreach ($tab as $key => $value){
            if($value['status']==0){
                $status="<a href=".$this->script_name."/reserverMessageItem/?idListe=".$this->data->idPartage."&idItem=". $value['id'] .">reserver</a>";
            }else{
                $status="déjà pris";
            }

            $html .= '<div class="item">';
            
            $html .= '<p>Nom : '.$value['nom'].'</p>';
            $html .= '<p>Description : '.$value['description'].'</a></p>';
            $html .= '<p>Tarif : '.$value['tarif'].'€</p>';
            $html .= '<p>Description : '.$value['description'].'</a></p>';
            $html .= '<p>image : <img src="'.$value['urlImage'].'" alt="'.$value['nom'].'"></p>';
            if(!isset($_SESSION['user_login'])){
                $html .= "<p>Status : $status</p>";
            }
            $html .= '</div>';
            $html .= '</div>';
			$html.= $value->id;
			$html .= '<a href="'.$this->script_name.'/supprItem/?idListe='.$this->data->idPartage.'&idItem='.$value->id.'">Supprimer cet item</a>';
			/* $this->data->nom*/
        }
        return $html;
    }

    public function renderViewReserverItem(){
        
        $idItem = $this->data['idItem'];
        $idListe = $this->data['idListe'];
        $nom = $this->data['nom']->nom;
        
        $html = "<h1>Reserver : ". $nom."</h1>";
        $html .= "
        <form method='post' action=".$this->script_name."/reserverItem/?idItem=".$idItem."&idListe=".$idListe.">
            <label for='nom'>Nom</label>
            <input type='text' placeholder='Votre nom' name='nom'/>
            <label for='message'>Message</label>
            <textarea placeholder='Message' name='message'></textarea>
            <input type='submit' value='Reserver'/>
        </form>";
        return $html;        
    }



    protected function renderBody($selector=null){

        $header = $this->renderHeader();
        $footer = $this->renderFooter();

        $body = $this->$selector();

        $html =

            <<<EOT

        ${header}
        <section id="container" class="theme-backcolor2">
            ${body}
        </section>
        <footer class="theme-backcolor1">${footer}</footer>

EOT;

        return  $html;
    }
}