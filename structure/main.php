<?php 
define ('_DIR_','/srv/http/workspace/framework/');
define('_LIENDIR_','/workspace/framework/structure/main.php?action=');
define('_MENU_', _DIR_.'Projet/layout/menu/');
require_once 'kernel.php';
new Kernel();
