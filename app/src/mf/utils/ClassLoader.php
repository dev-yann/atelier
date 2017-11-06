<?php
namespace mf\utils;

class ClassLoader{
	
	private $prefix;

	public function __construct($nom){
		$this->prefix=$nom;
	}

	public function loadClass($nomclasse){	
		if($nomclasse=="\\"){
			$nomclasse=substr($nomclasse,1);
		}
		$nomclasse=str_replace("\\", DIRECTORY_SEPARATOR, $nomclasse);
		$nomclasse= $this->prefix.$nomclasse.".php";
		$test=substr($nomclasse,0,1);
		if(file_exists($nomclasse)){
			require_once($nomclasse);
		}
	}

	public function register(){
		$tab[0]=$this;
		$tab[1]="loadClass";
		spl_autoload_register($tab);	
	}
}
