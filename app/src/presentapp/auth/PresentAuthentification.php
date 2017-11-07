<?php

namespace presentapp\auth;

use presentapp\model\Createur;

class PresentAuthentification extends \mf\auth\Authentification {

	/*
	* Classe TweeterAuthentification qui dÃ©finie les mÃ©thodes qui dÃ©pendent
	* de l'application (liÃ©e Ã  la manipulation du modÃ¨le User) 
	*
	*/

	/* niveaux d'accÃ¨s de TweeterApp 
	*
	* Le niveau USER correspond a un utilisateur inscrit avec un compte
	* Le niveau ADMIN est un plus haut niveau (non utilisÃ© ici)
	* 
	* Ne pas oublier le niveau NONE un utilisateur non inscrit est hÃ©ritÃ© 
	* depuis AbstractAuthentification 
	*/
	const ACCESS_LEVEL_USER  = 100;   
	const ACCESS_LEVEL_ADMIN = 200;

	/* constructeur */
	public function __construct(){
		parent::__construct();
	}

	/* La mÃ©thode createUser 
	* 
	*  Permet la crÃ©ation d'un nouvel utilisateur de l'application
	* 
	*  
	* @param : $username : le nom d'utilisateur choisi 
	* @param : $pass : le mot de passe choisi 
	* @param : $fullname : le nom complet 
	* @param : $level : le niveaux d'accÃ¨s (par dÃ©faut ACCESS_LEVEL_USER)
	* 
	* Algorithme :
	*
	*  Si un utilisateur avec le mÃªme nom d'utilisateur existe dÃ©jÃ  en BD
	*     - soulever une exception 
	*  Sinon      
	*     - crÃ©er un nouvel modÃ¨le User avec les valeurs en paramÃ¨tre 
	*       ATTENTION : Le mot de passe ne doit pas Ãªtre enregistrÃ© en clair.
	* 
	*/

	public function createUser($username, $pass, $fullname,$email,
				$level=self::ACCESS_LEVEL_USER) {

		$utilisateur=Createur::select('email')->where('email','=',$email)->first();
		if(isset($utilisateur->username)){ //S'il y a déjà un utilisateur
			throw new \Exception(" Un utilisateur avec ce nom utilisateur éxiste déja.");
		}else{//Sinon tout va bien !
			$user=new Createur();
			$user->nom=$username;
			$user->password=$this->hashPassword($pass);
			$user->prenom=$fullname;
			$user->level=$level;
			$user->email=$email;
			$user->save();
		}
	}

	/* La mÃ©thode login
	*  
	* permet de connecter un utilisateur qui a fourni son nom d'utilisateur 
	* et son mot de passe (depuis un formulaire de connexion)
	* 
	* @param : $username : le nom d'utilisateur   
	* @param : $password : le mot de passe tapÃ© sur le formulaire
	*
	* Algorithme :
	* 
	*  RÃ©cupÃ©rer l'utilisateur avec le nom d'utilisateur $username depuis la BD
	*  Si aucun de trouvÃ© 
	*      soulever une exception 
	*  sinon 
	*      si $password correspond au mot de passe cryptÃ© en BD 
	*          charger la session de l'utilisateur
	*      sinon soulever une exception
	*
	*/

	public function login($email, $password){
		$userBDD=user::select('password','level')->where('email','=',$email)->first();
		if(!isset($userBDD)){
			throw new \Exception(" Login ou mot de pass incorrecte.");
		}else{
			if($this->verifyPassword($password, $userBDD->password)){
				$this->updateSession($email,$userBDD->level);
			}else{
				throw new \Exception(" Login ou mot de pass incorrecte.");
			}
		}
	}

}

