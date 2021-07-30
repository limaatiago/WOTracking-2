<?php 
	
require_once( '../wp-load.php' );

global $wpdb, $tabela_clientes, $tabela_baterias, $current_user;

/* INPUTS */

$loc_cpf			=	$_POST['loc_cpf'];
$incluir_cliente 	= 	$_POST['incluircliente'];
$editar_cliente 	= 	$_POST['editarcliente'];
$cpf_cliente		=	$_POST['cpf_cliente'];
$add_item			=	$_POST['add_item'];
$del_item			=	$_POST['deletar_item'];

function incluircliente() {

	global $wpdb, $tabela_clientes;

	$cpf_cliente			=	$_POST['cpf_cliente'];
	$radio_cliente			=	$_POST['radio_cliente'];
	$radio_contrib			=	$_POST['radio_contrib'];
	$genero_cliente			=	$_POST['genero_cliente'];
	$nome_cliente			=	$_POST['nome_cliente'];
	$email_cliente			=	$_POST['email_cliente'];
	$sim_email_cliente		=	$_POST['sim_email_cliente'];
	$fone_um_cliente		=	$_POST['fone_um_cliente'];
	$tipo_fone_um			=	$_POST['radio_fone_um'];
	$fone_dois_cliente		=	$_POST['fone_dois_cliente'];
	$tipo_fone_dois			=	$_POST['radio_fone_dois'];
	$wapp_cliente			=	$_POST['wapp_cliente'];
	$data_cadastro			=	current_time( 'mysql' );
	$att_cadastro			=	current_time( 'mysql' );
	$pont_cliente			=	1;

	$wpdb->insert(
		$tabela_clientes,
		array(
			'cpf_cliente' 			=> $cpf_cliente,
			'tipo_cliente'			=> $radio_cliente,
			'contrib_cliente'		=> $radio_contrib,
			'genero_cliente'		=> $genero_cliente,
			'nome_cliente'			=> mb_strtoupper($nome_cliente, 'UTF-8'),
			'email_cliente' 		=> mb_strtoupper($email_cliente, 'UTF-8'),
			'sim_email_cliente'		=> $sim_email_cliente,
			'fone_um_cliente' 		=> $fone_um_cliente,
			'tipo_fone_um' 			=> $tipo_fone_um,
			'fone_dois_cliente' 	=> $fone_dois_cliente,
			'tipo_fone_dois' 		=> $tipo_fone_dois,
			'wapp_cliente'			=> $wapp_cliente,
			'data_cadastro' 		=> $data_cadastro,
			'att_cadastro'			=> $att_cadastro,
			'pont_cliente' 			=> $pont_cliente
		)
	);

}
function editarcliente() {

	global $wpdb, $tabela_clientes;

	$cpf_cliente			=	$_POST['cpf_cliente'];
	$radio_cliente			=	$_POST['radio_cliente'];
	$radio_contrib			=	$_POST['radio_contrib'];
	$genero_cliente			=	$_POST['genero_cliente'];
	$nome_cliente			=	$_POST['nome_cliente'];
	$email_cliente			=	$_POST['email_cliente'];
	$sim_email_cliente		=	$_POST['sim_email_cliente'];
	$fone_um_cliente		=	$_POST['fone_um_cliente'];
	$tipo_fone_um			=	$_POST['radio_fone_um'];
	$fone_dois_cliente		=	$_POST['fone_dois_cliente'];
	$tipo_fone_dois			=	$_POST['radio_fone_dois'];
	$wapp_cliente			=	$_POST['wapp_cliente'];
	$att_cadastro			=	current_time( 'mysql' );

	$wpdb->update(
		$tabela_clientes,
		array(
			'tipo_cliente'			=> $radio_cliente,
			'contrib_cliente'		=> $radio_contrib,
			'genero_cliente'		=> $genero_cliente,
			'nome_cliente' 			=> mb_strtoupper($nome_cliente, 'UTF-8'),
			'email_cliente' 		=> mb_strtoupper($email_cliente, 'UTF-8'),
			'sim_email_cliente'		=> $sim_email_cliente,
			'fone_um_cliente' 		=> $fone_um_cliente,
			'tipo_fone_um' 			=> $tipo_fone_um,
			'fone_dois_cliente' 	=> $fone_dois_cliente,
			'tipo_fone_dois' 		=> $tipo_fone_dois,
			'wapp_cliente'			=> $wapp_cliente,
			'att_cadastro'			=> $att_cadastro
		),
		array( 'cpf_cliente' 		=> $cpf_cliente )
	);

}
if ( $add_item ) {
	
	$marca_rel  	= $_POST['marca_rel'];	
	$refer_rel 		= $_POST['refer_rel']; 	
	$valor_bat 		= str_replace(',', '.', $_POST['valor_bat'] );
	$data_bat		= str_replace('/', '-', $_POST['data_bat'] );
	$resp_bat		= $_POST['resp_bat']; 

	$wpdb->insert(
		$tabela_baterias,
		array(
			'cpf_cliente'	=> $cpf_cliente,
			'marca_rel' 	=> $marca_rel,
			'refer_rel' 	=> $refer_rel,
			'valor_bat' 	=> $valor_bat,
			'data_bat' 		=> date('Y-m-d', strtotime($data_bat)),
			'resp_bat'		=> $resp_bat
		)
	);

}
if ( $del_item ) {
	
	$del_id				=	$_POST['deletar_id'];
	$wpdb->delete( $tabela_baterias, array(
		'id'	=> $del_id
	) ); 

}

if ( $loc_cpf ) {
	
	$num_cpf			=	$_POST['num_cpf'];
	$cliente_info 	= 	$wpdb->get_row("SELECT * FROM " . $tabela_clientes . " WHERE cpf_cliente='" . $num_cpf . "'");
	include( 'formulariocliente.php' );

}
elseif ( $cpf_cliente ) {

	if ( $incluir_cliente ) {
		
		incluircliente();
		
		$cpf_cliente			=	$_POST['cpf_cliente'];
		$radio_cliente			=	$_POST['radio_cliente'];
		$radio_contrib			=	$_POST['radio_contrib'];
		$nome_cliente			=	$_POST['nome_cliente'];
		$email_cliente			=	$_POST['email_cliente'];
		$fone_um_cliente		=	$_POST['fone_um_cliente'];
		
		$url = 'https://bling.com.br/Api/v2/contato/';
		
		if ( $email_cliente == "" ) { 
		
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<tipos_contatos>
					<tipo_contato>
						 <descricao>Cliente</descricao>
					</tipo_contato>
				</tipos_contatos>
			</contato>';

		}
		else {
			
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<emailNfe>' . mb_strtoupper($email_cliente, "UTF-8") . '</emailNfe>
				<email>' . mb_strtoupper($email_cliente, "UTF-8") . '</email>
				<tipos_contatos>
					<tipo_contato>
						 <descricao>Cliente</descricao>
					</tipo_contato>
				</tipos_contatos>
			</contato>';
			
		}
		
		$posts = array (
			"apikey" => "d5b3b29cb7541d13968c1ebda41df600f6313878e5855308f789d33c7cc92942333e1e01",
			"xml" => rawurlencode($xml)
		);
		
		function executeInsertContact($url, $data){
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $url);
			curl_setopt($curl_handle, CURLOPT_POST, count($data));
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($curl_handle);
			curl_close($curl_handle);
			return $response;
		}
		
		$retorno = executeInsertContact($url, $posts);
		
		
	}
	
	if ( $editar_cliente ) {
		
		editarcliente();
		
		$cpf_cliente			=	$_POST['cpf_cliente'];
		$radio_cliente			=	$_POST['radio_cliente'];
		$radio_contrib			=	$_POST['radio_contrib'];
		$nome_cliente			=	$_POST['nome_cliente'];
		$email_cliente			=	$_POST['email_cliente'];
		$fone_um_cliente		=	$_POST['fone_um_cliente'];
		
		$apikey = "d5b3b29cb7541d13968c1ebda41df600f6313878e5855308f789d33c7cc92942333e1e01";
		$cpf_cnpj = "" . $cpf_cliente . "";
		$outputType = "json";
		$url = 'https://bling.com.br/Api/v2/contato/' . $cpf_cnpj . '/' . $outputType;
		
		function executeGetContact($url, $apikey){
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($curl_handle);
			curl_close($curl_handle);
			return $response;
		}
		
		$retorno = executeGetContact($url, $apikey);
		
		$ARRAY = json_decode($retorno);
		$id_cliente = $ARRAY->retorno->contatos[0]->contato->id;
		
		$url2 = 'https://bling.com.br/Api/v2/contato/' . $id_cliente . '';
		
		if ( $email_cliente == "" ) { 
		
			$xml2 = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
			</contato>';

		}
		else {
			
			$xml2 = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<emailNfe>' . mb_strtoupper($email_cliente, "UTF-8") . '</emailNfe>
				<email>' . mb_strtoupper($email_cliente, "UTF-8") . '</email>
			</contato>';
			
		}
		
		$posts = array (
			"apikey" => "d5b3b29cb7541d13968c1ebda41df600f6313878e5855308f789d33c7cc92942333e1e01",
			"xml" => rawurlencode($xml2)
		);
		
		function executeUpdateContact($url2, $data){
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $url2);
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($curl_handle, CURLOPT_POST, count($data));
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($curl_handle);
			curl_close($curl_handle);
			return $response;
		}
		
		$retorno = executeUpdateContact($url2, $posts);
	
	}
	
	include( 'formulariobateria.php' );

}
else {

	include( 'localizarcpf.php' );

}
?>