<?php

global $wpdb, $tabela_os, $tabela_empresa, $tabela_orcamento, $current_user;

/* EDITAR OS */

$salvar_os	=	$_POST['salvar_os'];
	
if ( $salvar_os || $imprimir_os ) {

	#Carrega informações do Cliente
	$nome_cliente_os		=	$_POST['nome_cliente'];	
	$email_cliente_os		=	$_POST['email_cliente'];
	$fone_um_cliente_os		=	$_POST['fone_um_cliente'];
	$tipo_fone_um_os		=	$_POST['radio_fone_um'];
	$fone_dois_cliente_os	=	$_POST['fone_dois_cliente'];
	$tipo_fone_dois_os		=	$_POST['radio_fone_dois'];

	#Carrega informações do Produto
	$tipo_prod_os			=	$_POST['tipo_produto'];
	$marca_prod_os			=	$_POST['marca_produto'];
	$ref_prod_os			=	$_POST['referencia_produto'];
	$mod_prod_os			=	$_POST['modelo_produto'];
	$desc_prod_os			=	$_POST['descricao_produto'];
	$carac_prod_os			=	$_POST['caracteristicas_produto'];
	$def_prod_os			=	$_POST['defeitos_produto'];
	
	$wpdb->update(
	$tabela_os,
	array(
		'nome_cliente_os' 		=> $nome_cliente_os,
		'email_cliente_os' 		=> $email_cliente_os,
		'fone_um_cliente_os' 	=> $fone_um_cliente_os,
		'tipo_fone_um_os'		=> $tipo_fone_um_os,
		'fone_dois_cliente_os' 	=> $fone_dois_cliente_os,
		'tipo_fone_dois_os'		=> $tipo_fone_dois_os,

		'tipo_prod_os' 			=> $tipo_prod_os,
		'marca_prod_os' 		=> $marca_prod_os,
		'ref_prod_os' 			=> $ref_prod_os,
		'mod_prod_os' 			=> $mod_prod_os,
		'desc_prod_os' 			=> $desc_prod_os,
		'carac_prod_os' 		=> $carac_prod_os,
		'def_prod_os' 			=> $def_prod_os 
		),
	array( 'id' => $num_os )
		);

}


/* EDITAR ORÇAMENTO */

$add_item	=	$_POST['add_item'];

if ( $add_item ) {
	$prod_serv		= $_POST['prod_serv'];
	$quantidade  	= $_POST['quantidade'];	
	$descricao 		= $_POST['descricao']; 	
	$essencial 		= ( isset( $_POST['essencial'] ) ) ? 1 : 0;
	$val_serv 	= str_replace(',', '.', $_POST['valor_servi'] ); 
	$val_desc 	= str_replace(',', '.', $_POST['valor_desc'] ); 
	$val_total 	= str_replace(',', '.', $_POST['valor_total'] );

	$wpdb->insert( $tabela_orcamento, array(
		'num_os'		=> $num_os, 
		'prod_serv'		=> $prod_serv,
		'qtd_serv' 		=> $quantidade,
		'desc_serv' 	=> $descricao,
		'e_o_serv' 		=> $essencial,
		'val_serv' 		=> $val_serv,
		'val_desc'		=> $val_desc,
		'val_total' 	=> $val_total
		)
	);

}

$deletaropc		=	$_POST['deletarOpcao'];
$numIdDeletar	=	$_POST['deletarId'];

if ( $deletaropc ) {

	$wpdb->delete( $tabela_orcamento, array(
		'id'	=> $numIdDeletar
	) ); 

}

$att_orc		=	$_POST['botao_os'];
if ( $att_orc ) {
	
	$data_orcam	 			= str_replace('/', '-', $_POST['data_orcam'] );
	$possib_cons			= $_POST["possib_cons"];
	$calibre_prod			= $_POST["calibre_prod"];
	$valor_total  			= $_POST["val_total"];
	$descon_pag  			= $_POST["descon_pag"];
	$valor_final  			= $_POST["val_final"];
	$tempo_serv 			= $_POST["tempo-servico"];
	$tecnico_responsavel 	= $_POST["tecnico-responsavel"];
	$tempo_garantia			= $_POST["tempo-garantia"];
	$obs_orc 				= $_POST["obs-orcamento"];
	
	if ( $os_info->status_os < 2   ) {
		$wpdb->update(
		$tabela_os,
		array(
			'status_os' 		=> 2,
			'possib_cons'		=> $possib_cons,
			'calibre_prod'		=> $calibre_prod,
			'data_orcam' 		=> date('Y-m-d', strtotime($data_orcam)),
			'tecnico_orcam'		=> $tecnico_responsavel,
			'valor_total' 		=> $valor_total,
			'descon_pag' 		=> $descon_pag,
			'valor_final' 		=> $valor_final,
			'dias_serv'			=> $tempo_serv,
			'tempo_garantia' 	=> $tempo_garantia,
			'obs_orc' 			=> $obs_orc
			),
		array( 'id' => $num_os )
			);
	}
	else {
	$wpdb->update(
	$tabela_os,
	array(
		'calibre_prod'			=> $calibre_prod,
		'data_orcam' 			=> $data_orcam,
		'valor_total' 			=> $valor_total,
		'dias_serv' 			=> $tempo_serv,
		'tempo_garantia' 		=> $tempo_garantia
		),
	array( 'ID' => $num_os )
		);
	}

}

/* STATUS AUTORIZAÇÃO, EXECUÇÃO E ENTREGA */

$autorizacao_sim		=	$_POST['autorizacao_sim'];
$autorizacao_agd		=	$_POST['autorizacao_agu'];
$autorizacao_nao		=	$_POST['autorizacao_nao'];
$prazo_ent				=	$_POST['dias_serv'];
$func_resp_orc			=	$current_user->display_name;
$executado_sim			=	$_POST['executado_sim'];
$executado_agd			=	$_POST['executado_agu'];
$executado_nao			=	$_POST['executado_nao'];
$tecnico_resp			=	$_POST['tecnico_resp'];
$entregue_sim			=	$_POST['entregue_sim'];
$entregue_rep_cli		=	$_POST['entregue_rep_cli'];
$entregue_rep_tec		=	$_POST['entregue_rep_tec'];
$entregue_agd			=	$_POST['entregue_agu'];
$func_resp_ent			=	$current_user->display_name;

if ( $autorizacao_sim ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 3, 'data_resposta' => current_time( 'mysql' ), 'prazo_ent' => date('Y-m-d', strtotime( '+ ' . $prazo_ent . ' days' )), 'func_resp_orc' => $func_resp_orc ), array( 'ID' => $num_os ) ); }
if ( $autorizacao_nao ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 4, 'data_resposta' => current_time( 'mysql' ), 'func_resp_orc' => $func_resp_orc  ), array( 'ID' => $num_os ) ); }

	
if ( $executado_sim ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 5, 'data_exec' => current_time( 'mysql' ), 'tecnico_resp' => $tecnico_resp ), array( 'ID' => $num_os ) ); }
if ( $executado_nao ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 6, 'data_exec' => current_time( 'mysql' ), 'tecnico_resp' => $tecnico_resp ), array( 'ID' => $num_os ) ); }

	
if ( $entregue_sim ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 7, 'data_entrega' => current_time( 'mysql' ), 'func_resp_ent' => $func_resp_ent ), array( 'ID' => $num_os ) ); }
if ( $entregue_rep_cli ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 9, 'data_entrega' => current_time( 'mysql' ), 'func_resp_ent' => $func_resp_ent ), array( 'ID' => $num_os ) ); }
if ( $entregue_rep_tec ) { 
	$wpdb->update( $tabela_os, array( 'status_os' => 10, 'data_entrega' => current_time( 'mysql' ), 'func_resp_ent' => $func_resp_ent ), array( 'ID' => $num_os ) ); }
if ( $autorizacao_agd || $executado_agd || $entregue_agd ) { 
	$proximo_link	=	admin_url('admin.php?page=wot_os');
	header("location:$proximo_link");}

	
/* FATURAMENTO */

$att_faturamento	=	$_POST['salvarPagamento'];

$cpf_cliente		=	$_POST['cpf_cliente'];
$cliente_info 		= 	$wpdb->get_row("SELECT * FROM " . $tabela_clientes . " WHERE cpf_cliente=" . $cpf_cliente . ";");

$descon_pag			=	str_replace(',', '.', $_POST['descon-pag']);
$valor_final		=	str_replace(',', '.', $_POST['valor-final']);
$form_pag			=	$_POST['form-pag'];
$desc_pag			=	$_POST['desc-pag'];
$nome_pag			=	$_POST['nome-pag'];
$cpf_pag			=	$_POST['cpf-pag'];
$receb_pag			=	$_POST['receb-pag'];
$data_pag			=	current_time( 'mysql' );
$val_conv			=	absint( $valor_final );
$pont_cliente		=	$cliente_info->pont_cliente + ( $val_conv / 15 );


if ( $att_faturamento ) {
	
	$wpdb->update( $tabela_os, array(
	'status_os' 	=> 8,
	'descon_pag' 	=> $descon_pag,
	'valor_final' 	=> $valor_final,
	'forma_pag' 	=> $form_pag,
	'desc_pag' 		=> $desc_pag,
	'nome_pag' 		=> $nome_pag,
	'cpf_pag' 		=> $cpf_pag,
	'receb_pag' 	=> $receb_pag,
	'data_pag' 		=> $data_pag
	),
	array( 'id' 	=> $num_os ) );
	
	$wpdb->update( $tabela_clientes, array(
	'pont_cliente' 	=> $pont_cliente
	),
	array( 'cpf_cliente' 	=> $cpf_cliente ) );

}
?>