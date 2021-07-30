<?php 

/*

Plugin Name: Work Order Tracking
Description: Plugin para cadastro, consulta e administração de Ordens de Serviços. Permite ao administrador disponibilizar em seu site um formulário para que os clientes possam acompanhar o andamento dos seus serviços.
Version: 1.0
Author: Tiago Lima
Author URI: http://www.facebook.com/limaatiago

*/

define( 'WP_DEBUG', true );

// MENU
function wot_menu() {
	add_menu_page( 	'Ordens de Serviço', 	'Ordens', 'edit_pages', 			'wot_os', 				'wot_os', 	'dashicons-format-aside', 4 );
	add_submenu_page( 	'wot_os', 				'Ordens de Serviço', 			'Todas as OS', 			'edit_pages', 		'wot_os' );
	add_submenu_page( 	'wot_os', 				'Nova Ordem de Serviço', 		'Adicionar Nova', 		'edit_pages', 		'wot_novaos', 		'wot_novaos' );
	
	add_options_page( 	'Configurações de Ordens de Serviço', 	'WOTracking', 	'add_users', 		'wot_configuracoes', 	'wot_configuracoes' );
	add_dashboard_page( 'Painel de Serviços', 			'Serviços', 			'edit_pages', 		'wot_painel',		'wot_painel' );
	
	add_menu_page( 	'Clientes', 	'Clientes', 'edit_pages', 		'wot_clientes', 		'wot_clientes', 	'dashicons-groups', 4 );
	add_submenu_page( 	'wot_clientes', 'Clientes', 					'Todos os Clientes', 	'edit_pages', 		'wot_clientes' );
	add_submenu_page( 	'wot_clientes', 'Cadastro de Cliente', 			'Adicionar Novo', 		'edit_pages', 		'wot_novocliente', 		'wot_novocliente' );
	add_submenu_page( 	'wot_clientes', 'Fidelidade ' . get_option( 'blogname' ) . '', 			'Fidelidade', 			'edit_pages', 		'wot_fidelidade', 		'wot_fidelidade' );

	add_menu_page( 	'Cotações de peças', 	'Cotações', 'edit_pages', 		'wot_cotacao', 		'wot_cotacao', 	'dashicons-cart', 4 );
	add_submenu_page( 	'wot_cotacao', 'Cotações de Peças', 	'Todas as Cotações', 	'edit_pages', 		'wot_cotacao' );
	add_submenu_page( 	'wot_cotacao', 'Nova Solicitação', 		'Nova Solicitação', 		'edit_pages', 		'wot_novacotacao', 		'wot_novacotacao' );
}

add_action( 'admin_menu', 'wot_menu' );


// REMOVE MENUS

function remove_menus(){
  
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'wpcf7' );
  
}
add_action( 'admin_menu', 'remove_menus' );

// MUDAR LOGO

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
			height:65px;
			width:320px;
			background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// PAGINAS MENU
function wot_os() {
	include( 'paginas/consultar_os.php' );
}
function wot_novaos() {
	include( 'paginas/nova_os.php' );
}
function wot_clientes() {
	include( 'paginas/consultar_cliente.php' );
}
function wot_novocliente() {
	include( 'paginas/novo_cliente.php' );
}
function wot_fidelidade() {
	include( 'paginas/fidelidade.php' );
}
function wot_configuracoes() {
	include( 'paginas/configuracoes.php' );
}
function wot_painel() {
	include( 'paginas/principal.php' );
}
function wot_cotacao() {
	include( 'paginas/consultar_cotacao.php' );
}
function wot_novacotacao() {
	include( 'paginas/nova_cotacao.php' );
}

// PAGINA OS
function wot_pagina_os() {
	include( 'paginas/pagina_os.php' );
}

function wot_pagina_cliente() {
	include( 'paginas/pagina_cliente.php' );
}

function wot_pagina_cotac() {
	include( 'paginas/pagina_cotac.php' );
}

// CSS E JS
function wot_css_e_js() {
	wp_register_style('wot_css_e_js', plugins_url('css/style.css', __FILE__ ));
	wp_enqueue_style('wot_css_e_js');
	wp_register_script( 'wot_css_e_js', plugins_url('js/script.js', __FILE__ ));
	wp_enqueue_script('wot_css_e_js');
}

add_action( 'admin_init','wot_css_e_js');

//wp_register_style( 'namespace', plugins_url('css/print.css', __FILE__), false, null, 'print' );


// VERSAO DE IMPRESSAO
function wot_css_impressao( $hook ) {
	global $plugin_page, $salvar_os;
	if ( $hook == 'wot_consultar' && $hook == 'wot_criar_nova' ) {
		return;
	}
	wp_enqueue_style( 'prefix-style', plugins_url('css/print.css', __FILE__), false, null, 'print' );
}

add_action( 'admin_enqueue_scripts', 'wot_css_impressao' );


// UPLOADER PARA O BANNER
function wot_add_banner_scripts() {
wp_enqueue_script( 'media-upload' );
wp_enqueue_script( 'thickbox' );
wp_enqueue_script( 'jquery' );
}

function wot_add_banner_style() {
wp_enqueue_style( 'thickbox' );
}

add_action( 'admin_print_scripts', 'wot_add_banner_scripts' );
add_action( 'admin_print_styles', 'wot_add_banner_style' );
add_action( 'admin_enqueue_scripts', 'wot_add_banner' );
 

function wot_add_banner() {
    if ( isset( $_GET['page'] ) && $_GET['page'] == 'wot_configuracoes' ) {
        wp_enqueue_media();
        wp_register_script( 'my-admin-js', WP_PLUGIN_URL.'js/script.js', array( 'jquery' ) );
        wp_enqueue_script( 'my-admin-js' );
    }
}

// UPLOADER FOTOS
function wot_add_photos_scripts() {
wp_enqueue_script( 'media-upload' );
wp_enqueue_script( 'thickbox' );
wp_enqueue_script( 'jquery' );
}

function wot_add_photos_style() {
wp_enqueue_style( 'thickbox' );
}

add_action( 'admin_print_scripts', 'wot_add_photos_scripts' );
add_action( 'admin_print_styles', 'wot_add_photos_style' );
add_action( 'admin_enqueue_scripts', 'wot_add_photos' );
 

function wot_add_photos() {
    if ( isset( $_GET['page'] ) && $_GET['page'] == 'wot_novacotacao' ) {
        wp_enqueue_media();
        wp_register_script( 'my-admin-js', WP_PLUGIN_URL.'js/script.js', array( 'jquery' ) );
        wp_enqueue_script( 'my-admin-js' );
    }
}


// TABELAS E OPTIONS

$tabela_clientes	= $wpdb->prefix . "wot_clientes";
$tabela_os			= $wpdb->prefix . "wot_os";
$tabela_orcamento	= $wpdb->prefix . "wot_orcamento";
$tabela_baterias	= $wpdb->prefix . "wot_baterias";
$tabela_cotacao		= $wpdb->prefix . "wot_cotacao";

include( 'instalador.php' );

add_option( 'wot_banner_empresa', plugins_url('imagens/banner.jpg', __FILE__ ) );
add_option( 'wot_nome_empresa', get_option( 'blogname' ) );
add_option( 'wot_ender_empresa', '' );
add_option( 'wot_tel1_empresa', '' );
add_option( 'wot_tel2_empresa', '' );
add_option( 'wot_email_empresa', get_option( 'admin_email' ) );
add_option( 'wot_site_empresa', get_option( 'home' ) );
add_option( 'wot_prazo_orc', '5' );
add_option( 'wot_info_empresa', '' );

// WIDGET E SHORTCODE

include('paginas/widget.php');
include('paginas/shortcode.php');

?>