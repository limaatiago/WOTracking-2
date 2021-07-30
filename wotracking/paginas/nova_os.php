<?php 
	
require_once( '../wp-load.php' );

global $wpdb, $tabela_clientes, $tabela_os, $tabela_cotacao, $current_user;

if ( $_GET['cotac'] ) {
	
	$num_cotac		=	$_GET['cotac'];
	$cotac_info 	= 	$wpdb->get_row("SELECT * FROM " . $tabela_cotacao . " WHERE id=" . $num_cotac . ";");

}

/* INPUTS */

$loc_cpf			=	$_POST['loc_cpf'];
$incluir_cliente 	=	$_POST['incluircliente'];
$editar_cliente 	=	$_POST['editarcliente'];
$cpf_cliente		= 	$_POST['cpf_cliente'];
$cpf_os				=	$_POST['cpf_os'];

$incluir_ordem 		=	$_POST['incluirordem'];

/* LOCALIZAR CPF */

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
	$cep_cliente			=	$_POST['cep_cliente'];
	$ender_cliente			=	$_POST['ender_cliente'];
	$num_cliente			=	$_POST['num_cliente'];
	$complem_cliente		=	$_POST['complem_cliente'];
	$bairro_cliente			=	$_POST['bairro_cliente'];
	$cidade_cliente			=	$_POST['cidade_cliente'];
	$estado_cliente			=	$_POST['estado_cliente'];
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
			'nome_cliente' 			=> mb_strtoupper($nome_cliente, 'UTF-8'),
			'email_cliente' 		=> mb_strtoupper($email_cliente, 'UTF-8'),
			'sim_email_cliente'		=> $sim_email_cliente,
			'fone_um_cliente' 		=> $fone_um_cliente,
			'tipo_fone_um' 			=> $tipo_fone_um,
			'fone_dois_cliente' 	=> $fone_dois_cliente,
			'tipo_fone_dois' 		=> $tipo_fone_dois,
			'wapp_cliente'			=> $wapp_cliente,
			'cep_cliente' 			=> $cep_cliente,
			'ender_cliente'			=> mb_strtoupper($ender_cliente, 'UTF-8'),
			'num_cliente' 			=> $num_cliente,
			'complem_cliente' 		=> mb_strtoupper($complem_cliente, 'UTF-8'),
			'bairro_cliente' 		=> mb_strtoupper($bairro_cliente, 'UTF-8'),
			'cidade_cliente' 		=> mb_strtoupper($cidade_cliente, 'UTF-8'),
			'estado_cliente' 		=> mb_strtoupper($estado_cliente, 'UTF-8'),
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
	$cep_cliente			=	$_POST['cep_cliente'];
	$ender_cliente			=	$_POST['ender_cliente'];
	$num_cliente			=	$_POST['num_cliente'];
	$complem_cliente		=	$_POST['complem_cliente'];
	$bairro_cliente			=	$_POST['bairro_cliente'];
	$cidade_cliente			=	$_POST['cidade_cliente'];
	$estado_cliente			=	$_POST['estado_cliente'];
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
			'cep_cliente' 			=> $cep_cliente,
			'ender_cliente'			=> mb_strtoupper($ender_cliente, 'UTF-8'),
			'num_cliente' 			=> $num_cliente,
			'complem_cliente' 		=> mb_strtoupper($complem_cliente, 'UTF-8'),
			'bairro_cliente' 		=> mb_strtoupper($bairro_cliente, 'UTF-8'),
			'cidade_cliente' 		=> mb_strtoupper($cidade_cliente, 'UTF-8'),
			'estado_cliente' 		=> mb_strtoupper($estado_cliente, 'UTF-8'),
			'att_cadastro'			=> $att_cadastro
		),
		array( 'cpf_cliente' 		=> $cpf_cliente )
	);

}

function incluiros() {
	
	global $wpdb, $tabela_clientes, $tabela_os;
	
	$cpf_os	= 	$_POST['cpf_os'];
	
	$dados_cliente 	= 	$wpdb->get_row("SELECT * FROM " . $tabela_clientes . " WHERE cpf_cliente=" . $cpf_os . ";");
	
	$id_cliente_os			= 	$dados_cliente->id;
	$cpf_cliente_os			= 	$dados_cliente->cpf_cliente;
	$nome_cliente_os		=	$dados_cliente->nome_cliente;
	$rua_cliente_os			=	$dados_cliente->ender_cliente;		$num_cliente_os = $dados_cliente->num_cliente;		$complem_cliente_os = $dados_cliente->complem_cliente;		$bairro_cliente_os = $dados_cliente->bairro_cliente;	$cidade_cliente_os = $dados_cliente->cidade_cliente; 	$estado_cliente_os = $dados_cliente->estado_cliente;	$cep_cliente_os = $dados_cliente->cep_cliente;
		if ( $dados_cliente->complem_cliente = "") {
			$ender_cliente_os	=	"" . $rua_cliente_os . ", " . $num_cliente_os . ". "  . $bairro_cliente_os . ", " . $cidade_cliente_os . "/" . $estado_cliente_os . ". " . $cep_cliente_os . "";
		} else { 
			$ender_cliente_os		=	"" . $rua_cliente_os . ", " . $num_cliente_os . ". " . $complem_cliente_os . ". "  . $bairro_cliente_os . ", " . $cidade_cliente_os . "/" . $estado_cliente_os . ". " . $cep_cliente_os . "";
		}
	$email_cliente_os		=	$dados_cliente->email_cliente;
	$sim_email_cliente_os	=	$dados_cliente->sim_email_cliente;
	$fone_um_cliente_os		=	$dados_cliente->fone_um_cliente;
	$tipo_fone_um_os		=	$dados_cliente->tipo_fone_um;
	$fone_dois_cliente_os	=	$dados_cliente->fone_dois_cliente;
	$tipo_fone_dois_os		=	$dados_cliente->tipo_fone_dois;
	$wapp_cliente_os		=	$dados_cliente->wapp_cliente;

	$os_externa			=	$_POST['os_externa'];
	$tipo_os			=	$_POST['radio_os'];
	$tipo_prod_os		=	$_POST['tipo_produto'];
	$maquina_os			=	$_POST['radio_maquina'];
	$marca_prod_os		=	$_POST['marca_produto'];
	$mod_prod_os		=	$_POST['modelo_produto'];
	$ref_prod_os		=	$_POST['referencia_produto'];
	$desc_prod_os		=	$_POST['descricao_produto'];
	$carac_prod_os		=	$_POST['caracteristicas_produto'];
	$def_prod_os		=	$_POST['defeitos_produto'];
	$serv_prod_os		=	$_POST['servico_produto'];
	$autor_os			=	$_POST['nome_autor'];
	$data_entrada		=	current_time( 'mysql' );
	$status_os			=	1;
	
	$wpdb->insert(
		$tabela_os,
		array(
			'status_os' 			=> $status_os,
			'data_entrada' 			=> $data_entrada,
			'id_cliente_os'			=> $id_cliente_os,
			'cpf_cliente_os' 		=> $cpf_cliente_os,
			'nome_cliente_os' 		=> $nome_cliente_os,
			'ender_cliente_os' 		=> $ender_cliente_os,
			'email_cliente_os' 		=> $email_cliente_os,
			'sim_email_cliente_os'	=> $sim_email_cliente_os,
			'fone_um_cliente_os' 	=> $fone_um_cliente_os,
			'tipo_fone_um_os'		=> $tipo_fone_um_os,
			'fone_dois_cliente_os' 	=> $fone_dois_cliente_os,
			'tipo_fone_dois_os'		=> $tipo_fone_dois_os,
			'wapp_cliente_os' 		=> $wapp_cliente_os,
			'os_externa'			=> $os_externa,
			'tipo_os' 				=> $tipo_os,
			'tipo_prod_os' 			=> mb_strtoupper($tipo_prod_os, 'UTF-8'),
			'maquina_os' 			=> $maquina_os,
			'marca_prod_os' 		=> mb_strtoupper($marca_prod_os, 'UTF-8'),
			'mod_prod_os' 			=> mb_strtoupper($mod_prod_os, 'UTF-8'),
			'ref_prod_os' 			=> mb_strtoupper($ref_prod_os, 'UTF-8'),
			'desc_prod_os' 			=> mb_strtoupper($desc_prod_os, 'UTF-8'),
			'carac_prod_os' 		=> mb_strtoupper($carac_prod_os, 'UTF-8'),
			'def_prod_os' 			=> mb_strtoupper($def_prod_os, 'UTF-8'),
			'serv_prod_os'			=> mb_strtoupper($serv_prod_os, 'UTF-8'),
			'autor_os' 				=> mb_strtoupper($autor_os, 'UTF-8')
		)
	);

}

if ( $loc_cpf ) {

	$num_cpf			=	$_POST['num_cpf'];
	$cliente_info 	= 	$wpdb->get_row("SELECT * FROM " . $tabela_clientes . " WHERE cpf_cliente=" . $num_cpf . ";");
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
		$cep_cliente			=	$_POST['cep_cliente'];
		$ender_cliente			=	$_POST['ender_cliente'];
		$num_cliente			=	$_POST['num_cliente'];
		$complem_cliente		=	$_POST['complem_cliente'];
		$bairro_cliente			=	$_POST['bairro_cliente'];
		$cidade_cliente			=	$_POST['cidade_cliente'];
		$estado_cliente			=	$_POST['estado_cliente'];
		
		$url = 'https://bling.com.br/Api/v2/contato/';
		
		if ( $email_cliente == "" && $complem_cliente == "" ) { 
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
				<tipos_contatos>
					<tipo_contato>
						 <descricao>Cliente</descricao>
					</tipo_contato>
				</tipos_contatos>
			</contato>';
		
		}
		
		elseif ( $email_cliente == "" ) { 
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<complemento>' . mb_strtoupper($complem_cliente, "UTF-8") . '</complemento>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
				<tipos_contatos>
					<tipo_contato>
						 <descricao>Cliente</descricao>
					</tipo_contato>
				</tipos_contatos>
			</contato>';
		
		}
		
		elseif ( $complem_cliente == "" ) { 
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<emailNfe>' . mb_strtoupper($email_cliente, "UTF-8") . '</emailNfe>
				<email>' . mb_strtoupper($email_cliente, "UTF-8") . '</email>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
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
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<complemento>' . mb_strtoupper($complem_cliente, "UTF-8") . '</complemento>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
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
		$cep_cliente			=	$_POST['cep_cliente'];
		$ender_cliente			=	$_POST['ender_cliente'];
		$num_cliente			=	$_POST['num_cliente'];
		$complem_cliente		=	$_POST['complem_cliente'];
		$bairro_cliente			=	$_POST['bairro_cliente'];
		$cidade_cliente			=	$_POST['cidade_cliente'];
		$estado_cliente			=	$_POST['estado_cliente'];
		
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
		
		if ( $email_cliente == "" && $complem_cliente == "" ) { 
		
		$xml2 = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
			</contato>';
		
		}
		
		elseif ( $email_cliente == "" ) { 
		
		$xml2 = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<complemento>' . mb_strtoupper($complem_cliente, "UTF-8") . '</complemento>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
			</contato>';
		
		}
		
		elseif ( $complem_cliente == "" ) { 
		
		$xml2 = '<?xml version="1.0" encoding="UTF-8"?>
			<contato>
				<nome>' . mb_strtoupper($nome_cliente, "UTF-8") . '</nome>
				<tipoPessoa>' . $radio_cliente . '</tipoPessoa>
				<contribuinte>' . $radio_contrib . '</contribuinte>
				<cpf_cnpj>' . $cpf_cliente . '</cpf_cnpj>
				<fone>' . $fone_um_cliente . '</fone>
				<emailNfe>' . mb_strtoupper($email_cliente, "UTF-8") . '</emailNfe>
				<email>' . mb_strtoupper($email_cliente, "UTF-8") . '</email>
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
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
				<cep>' . $cep_cliente . '</cep>
				<endereco>' . mb_strtoupper($ender_cliente, "UTF-8") . '</endereco>
				<numero>' . $num_cliente . '</numero>
				<complemento>' . mb_strtoupper($complem_cliente, "UTF-8") . '</complemento>
				<bairro>' . mb_strtoupper($bairro_cliente, "UTF-8") . '</bairro>
				<cidade>' . mb_strtoupper($cidade_cliente, "UTF-8") . '</cidade>
				<uf>' . mb_strtoupper($estado_cliente, "UTF-8") . '</uf>
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
	
	include( 'formularioproduto.php' );

}
elseif ( $cpf_os ) {
	
	if ( $incluir_ordem ) { 
	
		incluiros();
		$num_os		=	$wpdb->insert_id;
		
		$os_gerada	=	admin_url("admin.php?page=wot_os&num=" . $num_os . "&imprimir=os");
		echo "<script>location.href='" . $os_gerada . "'</script>";
	
	}

}
else { 

	include( 'localizarcpf.php' );
	
}
?>