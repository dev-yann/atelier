<?php

namespace mf\router;

class Router extends AbstractRouter {

    	public function addRoute($name, $url, $ctrl, $mth){
		$tab[0]=$ctrl;
		$tab[1]=$mth;
		self::$routes[$url] =  $tab;
		self::$routes[$name] =  $tab;
	}

	    /*
	     * Méthode run : execute une route en fonction de la requête 
	     *
	     *
	     * Algorithme :
	     * 
	     * - l'URL de la route est stockée dans l'attribut $path_info de 
	     *         $http_request
	     *   Et si une route existe dans le tableau $route sous le nom $path_info
	     *     - créer une instance du controleur de la route
	     *     - exécuter la méthode de la route 
	     * - Sinon 
	     *     - exécuter la route par défaut : 
	     *        - créer une instance du controleur de la route par défault
	     *        - exécuter la méthode de la route par défault
	     * 
	     */
    
    	public function run(){
		$url=$this->http_req->path_info;

		if(!isset($url)){ // Par défaut
			$route = 'default';
		}else{ // Pas défaut
			if (array_key_exists($url,self::$routes)){
				$route = self::$routes[$url];
			}
			else{
				$route = 'default';
			}
		}
		if($route == 'default'){
			$route = self::$routes['DEFAULT_ROUTE'];
		}
		$actionMAN =  $route[1];
		$ctrl = new $route[0]();
		$ctrl->$actionMAN();

	}

}
    
   
