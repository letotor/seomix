<?php


/**
** chargement feuille de stylecss enfant
**/
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/*
**chragement AOS library + theme.js ->child
**/
 function add_aos_animation() {
      wp_enqueue_style(' AOS_animate', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css', false, null);
    // Enqueue AOS script library dans footer
    wp_enqueue_script('AOS', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js', false, null, true);
    wp_enqueue_script('theme-js',get_stylesheet_directory_uri() . '/js/theme.js', array( 'AOS' ), null, true);
 }
add_action( 'wp_enqueue_scripts', 'add_aos_animation' );


/*
**BEGIN custom page back admin
**/

/* chargement login-style.css pour le logo dans page  Login  */
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login/login-style.css' );    
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


/* non actif admin-bar.css */
function add_custom_style()
{
    wp_enqueue_style('custom-admin', get_bloginfo('template_url') . '/assets/css/admin-bar.css', false, '1.0');
}
// add_action('admin_enqueue_scripts', 'add_custom_style');


/* checkbox par defaut sur la page admin activer par defaut */
function sf_check_rememberme(){
	global $rememberme;
	$rememberme = 1;
}
add_action("login_form", "sf_check_rememberme");


/* Custom Login Logo */
function wpc_custom_login_logo() {
	$custom_logo_url = get_stylesheet_directory_uri() . '/assets/img/wp-login-back.png';
	$custom_logo_width = 217;
	$custom_logo_height = 83;

	if ($custom_logo_url) {
		echo
		'<style>
			h1 a{
				background-image:url("'.$custom_logo_url.'")!important;
				background-size:'.$custom_logo_width.'px '.$custom_logo_height.'px!important;
			}
			.login h1 a {
				height:'.$custom_logo_height.'px;
				width:'.$custom_logo_width.'px;
			} 
            
            #wp-submit {
                background-color : #54C2D4;
            }
            #wp-submit:hover {
               opacity:0.8;
            }

		</style>';
	}
}
add_action('login_head', 'wpc_custom_login_logo');

/*
** END custom page back admin
**/


/* Modification du  footer -> copyright*/
if( ! function_exists( 'blossom_spa_footer_bottom' ) ) :
   
    /**
     * Emplacement Footer Bottom
    */
    function blossom_spa_footer_bottom(){ ?>
        <div class="footer-b">
            <div class="container">
                <div class="copyright">           
                <?php
                    blossom_spa_get_footer_copyright();

                    esc_html_e( ' Propulsé par ', 'blossom-spa' );
                    echo '<a href="' . esc_url( 'https://vgwebcreation.fr/' ) .'" rel="nofollow" target="_blank">' . esc_html__( ' VGWebcreation', 'blossom-spa' ) . '</a>.';
                    
                    printf( esc_html__( '', 'blossom-spa' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-spa' ) ) .'" target="_blank"></a>. ' );
                    if ( function_exists( 'the_privacy_policy_link' ) ) {
                        the_privacy_policy_link();
                    }
                ?>               
                </div>
                <?php blossom_spa_social_links( true, false ); ?>
                <button aria-label="<?php esc_attr_e( 'go to top', 'blossom-spa' ); ?>" class="back-to-top">
                    <i class="fas fa-chevron-up"></i>
                </button>
            </div>
        </div>
        <?php
    }
endif;
//remove_action('blossom_spa_footer', 'blossom_spa_footer_bottom'); //Ici on décroche la fonction du thème parent
//add_action('blossom_spa_footer', 'blossom_spa_footer_bottom'); //Ici on accroche la fonction du thème enfant, on utilise le même hook que pour la fonction du thème parent (ce n’est pas obligatoire mais plus pratique)

/*
** END copyright 
**/

