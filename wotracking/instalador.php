<?php

/* Versão da tabela do plugin */
global $wotracking_versao_db;
$wotracking_versao_db = "1.2";

function criar_tabelas() {

	global $wpdb, $wotracking_versao_db;
	global $tabela_clientes, $tabela_os, $tabela_orcamento, $tabela_baterias;

	if ( $wpdb->get_var( 'SHOW TABLES LIKE ' . $tabela_clientes ) != $tabela_clientes ) {
		$sql_clnt = 'CREATE TABLE ' . $tabela_clientes  . '(
			id int(10) NOT NULL AUTO_INCREMENT,
			cpf_cliente varchar(100) NOT NULL,
			rg_cliente varchar(100) DEFAULT "",
			genero_cliente int(5) NOT NULL DEFAULT 0,
			nome_cliente varchar(150) NOT NULL,
			sobrenome_cliente varchar(150) NOT NULL,
			nasc_cliente date DEFAULT "0000-00-00",
			ender_cliente varchar(150) DEFAULT "",
			num_cliente varchar(20) DEFAULT "",
			complem_cliente varchar(150) DEFAULT "",
			bairro_cliente varchar(150) DEFAULT "",
			cidade_cliente varchar(150) DEFAULT "",
			estado_cliente varchar(100) DEFAULT "",
			cep_cliente varchar(100) DEFAULT "",
			email_cliente varchar(150) DEFAULT "",
			sim_email_cliente int(5) DEFAULT 0,
			fone_um_cliente varchar(50) NOT NULL DEFAULT "",
			tipo_fone_um int(5) NOT NULL DEFAULT 0,
			fone_dois_cliente varchar(50) DEFAULT "",
			tipo_fone_dois int(5) DEFAULT 0,
			wapp_cliente int(5) DEFAULT 0,
			data_cadastro datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			att_cadastro datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			ultimo_serv datetime DEFAULT "0000-00-00 00:00:00",
			pont_cliente int(255) NOT NULL DEFAULT 0,
			UNIQUE KEY id (id, cpf_cliente)
		)';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql_clnt );
	}
	
	/* Cria a tabela das OS */
	if ( $wpdb->get_var( 'SHOW TABLES LIKE ' . $tabela_os ) != $tabela_os ) {
		$sql_os = 'CREATE TABLE ' . $tabela_os  . '(
			id int(10) NOT NULL AUTO_INCREMENT,
			status_os int(5) NOT NULL DEFAULT 1,
			data_entrada datetime NOT NULL,
			id_cliente_os int(10) NOT NULL DEFAULT 0,
			cpf_cliente_os varchar(100) NOT NULL,
			nome_cliente_os varchar(150) NOT NULL,
			email_cliente_os varchar(150) DEFAULT "",
			sim_email_cliente_os int(5) DEFAULT 0,
			ender_cliente_os varchar(150) NOT NULL DEFAULT "",
			fone_um_cliente_os varchar(50) NOT NULL DEFAULT "",
			tipo_fone_um_os int(5) NOT NULL DEFAULT 0,
			fone_dois_cliente_os varchar(50) DEFAULT "",
			tipo_fone_dois_os int(5) DEFAULT 0,
			wapp_cliente_os int(5) DEFAULT 0,
			os_externa varchar(100) DEFAULT "",
			tipo_os int(5) NOT NULL DEFAULT 0,
			tipo_prod_os varchar(50) NOT NULL DEFAULT "",
			maquina_os int(5) NOT NULL DEFAULT 0,
			marca_prod_os varchar(50) NOT NULL DEFAULT "",
			mod_prod_os varchar(250) DEFAULT "",
			ref_prod_os varchar(250) DEFAULT "",
			desc_prod_os varchar(250) NOT NULL DEFAULT "",
			carac_prod_os varchar(250) NOT NULL DEFAULT "",
			def_prod_os varchar(250) NOT NULL DEFAULT "",
			serv_prod_os varchar(250) NOT NULL DEFAULT "",
			autor_os varchar(50) NOT NULL DEFAULT "",
			data_orcam datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			possib_cons int(5) NOT NULL DEFAULT 0,
			calibre_prod varchar(150) NOT NULL DEFAULT "",
			tecnico_orcam varchar(150) NOT NULL DEFAULT "",
			valor_total double(10,2) NOT NULL DEFAULT 0.0,
			dias_serv int(5) NOT NULL DEFAULT 0,
			tempo_garantia int(5) NOT NULL DEFAULT 0,
			obs_orc varchar (250) NOT NULL DEFAULT "",
			prazo_ent datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			descon_pag double(10,2) NOT NULL DEFAULT 0.0,
			valor_final double(10,2) NOT NULL DEFAULT 0.0,
			data_resposta datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			func_resp_orc varchar(150)  NOT NULL DEFAULT "",
			data_exec datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			tecnico_resp varchar(150) NOT NULL DEFAULT "",
			data_entrega datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			func_resp_ent varchar(250) NOT NULL DEFAULT "",
			forma_pag int(5) NOT NULL DEFAULT 0,
			desc_pag varchar(150) NOT NULL DEFAULT "",
			nome_pag varchar(250) NOT NULL DEFAULT "",
			cpf_pag varchar(20) NOT NULL DEFAULT "",
			receb_pag varchar(15) NOT NULL DEFAULT "",
			data_pag datetime NOT NULL DEFAULT "0000-00-00 00:00:00",
			UNIQUE KEY id (id)
		)';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql_os );
	}
	
	/* Cria a tabela de orçamentos */
	if ( $wpdb->get_var( 'SHOW TABLES LIKE ' . $tabela_orcamento ) != $tabela_orcamento ) {
		$sql_orc = 'CREATE TABLE ' . $tabela_orcamento . '(
			id int(10) NOT NULL AUTO_INCREMENT,
			num_os varchar(10) NOT NULL,
			prod_serv int(5) NOT NULL DEFAULT 2,
			qtd_serv int(5) NOT NULL DEFAULT 0,
			desc_serv varchar(150) NOT NULL,
			e_o_serv varchar(5) NOT NULL,
			val_peca double(10,2) NOT NULL DEFAULT 0.0,
			val_serv double(10,2),
			val_total double(10,2) NOT NULL DEFAULT 0.0,
			UNIQUE KEY id (id)
	)';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql_orc);
	}
    
	/* Cria tabela de baterias */
	if ( $wpdb->get_var( 'SHOW TABLES LIKE ' . $tabela_baterias ) != $tabela_baterias ) {
		$sql_bat = 'CREATE TABLE ' . $tabela_baterias . '(
			id int(10) NOT NULL AUTO_INCREMENT,
			cpf_cliente varchar(100) NOT NULL,
			marca_rel varchar(200) NOT NULL,
			refer_rel varchar(150) NOT NULL,
			valor_bat double(10,2) NOT NULL,
			ref_bat varchar(150),
			data_bat date NOT NULL,
			resp_bat varchar(100) NOT NULL,
			UNIQUE KEY id (id)
	)';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql_bat);
	}
	
	add_option( 'wotracking_versao_db', $wotracking_versao_db );

}

register_activation_hook( __FILE__, 'criar_tabelas' );

/* Verifica a versão da tabela */
function wotracking_update_db() {
	
	global $wotracking_versao_db;
	
	if ( get_site_option( 'wotracking_versao_db' ) != $wotracking_versao_db ) {
		criar_tabelas();
    }

}

add_action('plugins_loaded', 'wotracking_update_db');

?>
