<?php 
// commentaires d’en-tête » avec diverses informations qui seront lues/affichées par WordPress

/*
Plugin Name: Mon premier plugin
Description: C'est mon deuxième plugin 
Author: Ibtissem
Version: 0.1
*/

//Inclu mfp-functions.php avec le chemin du répertoire,  require_once pour arrêter le script si mfp-functions.php n'est pas trouvé
require_once plugin_dir_path(__FILE__) . 'includes/mfp-functions.php';
//require_once plugin_dir_path(__FILE__) . 'includes/mfp-sec-acp-page.php';