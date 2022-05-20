<?php
//Toutes mes fonctions 

/* 
Ajout d'un nouveau menu au panneau de configuration de l'administrateur
 */

// Crochet d'action 'admin_menu', execute la fonction 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'mfp_Add_My_Admin_Link' ); 

//Ajout d'un nouveau lien de niveau supérieur au menu de navigation du panneau de contrôle administrateur 

function mfp_Add_My_Admin_Link() {
//Donner un nom à notre menu, un titre et décider qui est autorisé à le voir
    add_menu_page(
        'My First Page', // Titre de la page
        'My First Plugin', // Le texte à afficher en tant que lien de menu
        'manage_options', // La capacité pour l’utilisateur d’afficher le menu
        'includes/mfp-first-acp-page.php' // le 'slug' - le fichier à afficher en cliquant sur le lien
    );
}