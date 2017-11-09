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
        <h1 class="logo"><a class="menu_link" href="$this->script_name/liste/"><img src="$this->app_root/app/src/mf/html/web/img/png/003-gift.png" alt="icon" class="icon">Mecado</a></h1>
                <span class="icon-menu" id="btn-menu"></span>
                <nav class="nav" id="nav">
                    <ul class="menu">
                        <li class="menu_item"><a class="menu_link select" href="$this->script_name/logout/">Deconnexion</a></li>
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
		<p>Pour le mdp : au moins une minuscule, une majuscule, un chiffre et un caractère spécial</p>
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
        $html .= "<h1>Mes Listes</h1>";
        if(isset($_SESSION['user_login'])){
        $html .= '<a href="'.$this->script_name.'/addliste/" class="col-3 offset-9 sp"><div>
        <h3>Ajouter une liste</h3>
        </div></a>';
        }
		foreach ($this->data as $value){

            $html .="<div class='col-3 sp'>
            <h2>".$value->nom."</h2>";
			//$html .= "Commence le : " . $value->date_debut . "</br>";
            $html .= "<h4>Reservation possible jusqu'au: </h4><p>".$value->date_final."</p>";
		
            if(isset($_SESSION['user_login'])){
                $html .= "<h4>Lien de partage : </h4><p>http://localhost".$this->script_name."/listeItem/?idListe=".$value->idPartage."</p>";
            }
            $html .= '<a href="'.$this->script_name.'/supprliste/?idListe='.$value->id.'"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>';
            $html .= '<a href="' . $this->script_name. '/listeItem/?idListe=' . $value->idPartage . '"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>';
            $html .= "</div>";
            
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
        <form method="post" action="$this->script_name/checkaddliste/">
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
      <div class="formulaire">
       <legend>Connexion</legend>
        <form method="post" action="$this->script_name/check_login/">
         <input type="email" name="email" placeholder="email" required> 
         <input type="password" name="pw" placeholder="password" required>  
         <input type="submit" value="login">
        </form>
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
<h1 class="container">Défaut</h1>
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
         <input type="url" id="url" placeholder="Url vers un autre site" name="url"> 
         <Textarea rows="4" cols="15" placeholder="Description" name="description"></Textarea>
         <input type="text" name="urlImage" id="urlimage" placeholder="Ajouter le lien d'une image"/>
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

    public function renderViewModifierItem(){
        $idListe = $this->data->idListe;
        $id = $this->data->id;
        $nom = $this->data->nom;
        $tarif = $this->data->tarif;
        $url = $this->data->url;
        $description = $this->data->description;
        $urlImage = $this->data->urlImage;

        $html = <<<EOT
        
        <div class="container">
     <div class="col-8 offset-2">
      <div class="formulaire">
       <legend>Modifier le cadeau</legend>
       
       <form method="post" enctype="multipart/form-data" action="$this->script_name/modifierItemBDD/?idListe=$idListe&idItem=$id">
       
       <label for="nom">Nom</label><input type="text" id="nom" name="nom" value="$nom" required/>
         
       <label for="tarif">Tarif</label><input id="tarif" name="tarif" type="number" value="$tarif" step="0.01"/>
         <input type="url" id="url" value="$url"> 
         <textarea rows="4" cols="15" name="description">$description</textarea>
         <input type="text" name="image" id="urlimage" value="$urlImage"/>
         <input type="submit" value="Modifier">
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

    public function renderViewListeItem(){

        $html = '<div class="container">';
        if($this->data['msg'] !== null){
            $html .= "<div class='alert alert-success col-12'>".$this->data['msg']."</div>";
        }
        $html .="<h1 class='col-12'>Liste pour l'évenement: " . $this->data->nom . "</h1><br>";
        $html .= "<h4 class='col-12'>Date de l'évènement : ".$this->data->date_final . "</h4>";

        if(isset($_SESSION['user_login'])){
            $html .= "<a href=".$this->script_name."/ViewAddItem/?idListe=".$this->data->idPartage." class='col-3 offset-9 sp'><div>
                    <h3>Ajouter Cadeau</h3>

                    </div></a>";
        }
        //$id_list = $this->data->id;

        $tab = $this->data->items()->where('id_list','=',$this->data->id)->get();

        foreach ($tab as $key => $value){
            if($value['status']==0){
                $status= 'disponible </br>';
				$status .= "<p><a href=".$this->script_name."/reserverMessageItem/?idListe=".$this->data->idPartage."&idItem=".$value['id'].">je souhaite reserver ce cadeau</a></p>";
            }else{
                $status="déjà pris";
            }

            $html .= '<div class="col-3 sp">';
            $html .= '<h3 class="sp1">'.$value['nom'].'</h3>';
            $html .= '<img src="'.$value['urlImage'].'" alt="'.$value['urlimage'].'" class="cadeau"/>';
            $html .= '<h4>Description : </h4><p>'.$value['description'].'</p>';
            $html .= '<h4>'.$value['tarif'].'€</h4>';
			$html .= '<h4><a href="'.$value['url'].'">Lien vers la boutique</a></h4>';
            
			if(!isset($_SESSION['user_login'])){
                $html .= "<p>Status : $status</p>";
                $html .= "<a class='button' href=".$value['url'].">Plus d'information</a>";
            }
            if(isset($_SESSION['user_login'])){
			    $html .= '<a href="'.$this->script_name.'/supprItem/?idListe='.$this->data->idPartage.'&idItem='.$value->id.'"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>';
                $html .= '<a href="'.$this->script_name.'/modifierItem/?idListe='.$this->data->idPartage.'&idItem='.$value->id.'">modifier item</a>';
            }
            $html .= '</div>';
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