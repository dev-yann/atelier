<?php
session_start();
use mf\router\Router;
use presentapp\auth\PresentAuthentification;
// Require autoload
require_once ("vendor/autoload.php");
//require_once ("password-policy/vendor/autoload.php");
require_once ("app/src/mf/utils/ClassLoader.php");
$loader = new mf\utils\ClassLoader('app/src');
$loader->register();


// initialisation connection
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();

// Définition des routes
$router = new Router();


// ROUTE DE CONNECTION
$router->addRoute('signup','/signup/','\presentapp\control\PresentController', 'viewSignUp',PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logout','/logout/','\presentapp\control\PresentController', 'logout', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('login','/login/','\presentapp\control\PresentController', 'viewLogin', PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_login','/check_login/','\presentapp\control\PresentController', 'check_login',PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_signup',   '/check_signup/','\presentapp\control\PresentController','checkSignup', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);

// ROUTE DES LISTES
$router->addRoute('checkaddliste',   '/checkaddliste/','\presentapp\control\PresentController','checkaddliste', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('liste','/liste/','\presentapp\control\PresentController', 'viewListe', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('supprliste',   '/supprliste/','\presentapp\control\PresentController','viewSupprliste', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('addliste','/addliste/','\presentapp\control\PresentController', 'viewaddListe',PresentAuthentification::ACCESS_LEVEL_USER);

// ROUTE DES ITEMS
$router->addRoute('addItem','/addItem/','\presentapp\control\PresentController', 'addItem',PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('viewAddItem','/ViewAddItem/','\presentapp\control\PresentController', 'viewAddItem',PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('item','/item/','\presentapp\control\PresentController','viewItem', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('supprItem','/supprItem/','\presentapp\control\PresentController','viewsupprItem', PresentAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('reserverMessageItem','/reserverMessageItem/','\presentapp\control\PresentController', 'viewReserverItem',PresentAuthentification::ACCESS_LEVEL_INVIT);
$router->addRoute('listeItem','/listeItem/','\presentapp\control\PresentController', 'viewListeItem',PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('reserverMessageItem','/reserverMessageItem/','\presentapp\control\PresentController', 'viewReserverItem',PresentAuthentification::ACCESS_LEVEL_INVIT);
$router->addRoute('reserverItem','/reserverItem/','\presentapp\control\PresentController', 'reserverItem',PresentAuthentification::ACCESS_LEVEL_INVIT);

// AFFICHAGE DES MESSAGE A LA FIN DE LA DATE



$router->run();
