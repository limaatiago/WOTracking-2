<?php

require_once('../wp-load.php');

global $wpdb, $tabela_clientes, $tabela_os, $tabela_baterias;

$id_cliente				=	$_GET['id'];

$editar_cliente			=	$_POST['editarcliente'];

if ( $editar_cliente ) { 
	
	$rg_cliente				=	$_POST['rg_cliente'];
	$genero_cliente			=	$_POST['genero_cliente'];
	$nome_cliente			=	$_POST['nome_cliente'];
	$email_cliente			=	$_POST['email_cliente'];
	$sim_email_cliente		=	$_POST['sim_email_cliente'];
	$fone_um_cliente		=	$_POST['fone_um_cliente'];
	$tipo_fone_um			=	$_POST['radio_fone_um'];
	$fone_dois_cliente		=	$_POST['fone_dois_cliente'];
	$tipo_fone_dois			=	$_POST['radio_fone_dois'];
	$wapp_cliente			=	$_POST['wapp_cliente'];
	$ender_cliente			=	$_POST['ender_cliente'];
	$num_cliente			=	$_POST['num_cliente'];
	$complem_cliente		=	$_POST['complem_cliente'];
	$bairro_cliente			=	$_POST['bairro_cliente'];
	$cidade_cliente			=	$_POST['cidade_cliente'];
	$estado_cliente			=	$_POST['estado_cliente'];
	$cep_cliente			=	$_POST['cep_cliente'];
	$att_cadastro			=	current_time( 'mysql' );
	

	$wpdb->update(
		$tabela_clientes,
		array(
			'rg_cliente'			=> $rg_cliente,
			'genero_cliente'		=> $genero_cliente,
			'nome_cliente' 			=> $nome_cliente,
			'email_cliente' 		=> $email_cliente,
			'sim_email_cliente'		=> $sim_email_cliente,
			'fone_um_cliente' 		=> $fone_um_cliente,
			'tipo_fone_um' 			=> $tipo_fone_um,
			'fone_dois_cliente' 	=> $fone_dois_cliente,
			'tipo_fone_dois' 		=> $tipo_fone_dois,
			'wapp_cliente' 			=> $wapp_cliente,
			'ender_cliente'			=> $ender_cliente,
			'num_cliente'			=> $num_cliente,
			'complem_cliente' 		=> $complem_cliente,
			'bairro_cliente' 		=> $bairro_cliente,
			'cidade_cliente' 		=> $cidade_cliente,
			'estado_cliente'		=> $estado_cliente,
			'cep_cliente'			=> $cep_cliente,
			'att_cadastro'			=> $att_cadastro
		),
		array( 'id' => $id_cliente )
	);
	
	$mensagem	=	'<div class="updated fade" id="message"><p>Dados atualizados com sucesso!</p></div>';

}

$cliente_info 			= 	$wpdb->get_row("SELECT * FROM " . $tabela_clientes . " WHERE id=" . $id_cliente . ";");

/* PÁGINAS */
if ( $cliente_info ) {

?>
	
<head>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script type="text/javascript">

		$(document).ready(function() {

			function limpa_formulário_cep() {
				// Limpa valores do formulário de cep.
				$("#ender_cliente").val("");
				$("#bairro_cliente").val("");
				$("#cidade_cliente").val("");
				$("#estado_cliente").val("");
			}
			
			//Quando o campo cep perde o foco.
			$("#cep_cliente").blur(function() {

				//Nova variável "cep" somente com dígitos.
				var cep = $(this).val().replace(/\D/g, '');

				//Verifica se campo cep possui valor informado.
				if (cep != "") {

					//Expressão regular para validar o CEP.
					var validacep = /^[0-9]{8}$/;

					//Valida o formato do CEP.
					if(validacep.test(cep)) {

						//Preenche os campos com "..." enquanto consulta webservice.
						$("#ender_cliente").val("...");
						$("#bairro_cliente").val("...");
						$("#cidade_cliente").val("...");
						$("#estado_cliente").val("...");

						//Consulta o webservice viacep.com.br/
						$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

							if (!("erro" in dados)) {
								//Atualiza os campos com os valores da consulta.
								$("#ender_cliente").val(dados.logradouro);
								$("#bairro_cliente").val(dados.bairro);
								$("#cidade_cliente").val(dados.localidade);
								$("#estado_cliente").val(dados.uf);
							} //end if.
							else {
								//CEP pesquisado não foi encontrado.
								limpa_formulário_cep();
								alert("CEP não encontrado.");
							}
						});
					} //end if.
					else {
						//cep é inválido.
						limpa_formulário_cep();
						alert("Formato de CEP inválido.");
					}
				} //end if.
				else {
					//cep sem valor, limpa formulário.
					limpa_formulário_cep();
				}
			});
		});

	</script>
</head>
	
	<div class="wrap">			
		<h2><?php echo 'Cliente nº ' . $id_cliente . ''; ?></h2>
			<?php if ( $editar_cliente ) { echo $mensagem; } ?>
		<div id="conteudo">
			<div id="coluna-um" style="float:left;clear:none;width:70%">
				<form method="post">
					<h3>Dados pessoais</h3>
					<table class="form-table">
						<tbody>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="cpf_cliente">CPF</label>
								</th>
								<td>
									<input id="cpf_cliente" class="wot_cliente" type="text" value="<?php if ( isset( $cliente_info ) ) { echo $cliente_info->cpf_cliente; } ?>" disabled />
									<input name="cpf_cliente" type="text" id="cpf_cliente" class="wot_cliente" style="display:none;" value="<?php if ( isset( $cliente_info ) ) { echo $cliente_info->cpf_cliente; } else { echo $num_cpf; } ?>" />
									<span class="description">Não é possível alterar o CPF.</span>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="rg_cliente">RG</label>
								</th>
								<td>
									<input name="rg_cliente" id="rg_cliente" type="text" class="wot_cliente" value="<?php if ( isset( $cliente_info ) ) { echo $cliente_info->rg_cliente; } ?>" />
									<p class="description" id="tagline-description">
										Apenas números
									</p>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="nome_cliente">Nome completo <span class="description">(obrigatório)</span></label>
								</th>
								<td>
									<select name="genero_cliente" style="margin-top:-3px;height:auto;width:5em;">
										<option value="1" <?php if ( $cliente_info->genero_cliente == 1 ) { echo "selected"; }?>>Sr.</option>
										<option value="2" <?php if ( $cliente_info->genero_cliente == 2 ) { echo "selected"; }?>>Sra.</option>
									</select>
									<input name="nome_cliente" id="nome_cliente" type="text" class="wot_cliente" style="width:19.6em !important;" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->nome_cliente . '"'; } ?> required />
								</td>
							</tr>
						</tbody>
					</table>
					<h3>Contato</h3>
					<table class="form-table">
						<tbody>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="email_cliente">E-mail</label>
								</th>
								<td>
									<input name="email_cliente" id="email_cliente"  type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->email_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									Comunicações por e-mail
								</th>
								<td>
									<label for="sim_email_cliente" >
										<input name="sim_email_cliente" id="sim_email_cliente" type="checkbox" value="1" <?php if ( isset ( $cliente_info ) ) { if ( $cliente_info->sim_email_cliente == 1 ) { echo "checked"; } } else { echo "checked"; } ?> > Sim
									</label>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="fone_um_cliente">Fone 1 <span class="description">(obrigatório)</span></label>
								</th>
								<td>
									<input name="fone_um_cliente" id="fone_um_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->fone_um_cliente . '"'; } ?>  required />
									<p class="description">
										<fieldset>
											<label>
												<input type="radio" name="radio_fone_um" value="1" <?php if ( $cliente_info->tipo_fone_um == 1 ) { echo "checked"; } ?> required />
												Celular
											</label>
											<label>
												<input type="radio" name="radio_fone_um" value="2" style="margin-left:2em;" <?php if ( $cliente_info->tipo_fone_um == 2 ) { echo "checked"; } ?> />
												WhatsApp
											</label>
											<label>
												<input type="radio" name="radio_fone_um" value="3" style="margin-left:2em;" <?php if ( $cliente_info->tipo_fone_um == 3 ) { echo "checked"; } ?> />
												Fixo
											</label>
										</fieldset>
									</p>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="fone_dois_cliente">Fone 2</span></label>
								</th>
								<td>
									<input name="fone_dois_cliente" id="fone_dois_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->fone_dois_cliente . '"'; } ?> />
									<p class="description">
										<fieldset>
											<label>
												<input type="radio" name="radio_fone_dois" value="1" <?php if ( $cliente_info->tipo_fone_dois == 1 ) { echo "checked"; } ?> />
												Celular
											</label>
											<label>
												<input type="radio" name="radio_fone_dois" value="2" style="margin-left:2em;" <?php if ( $cliente_info->tipo_fone_dois == 2 ) { echo "checked"; } ?> />
												WhatsApp
											</label>
											<label>
												<input type="radio" name="radio_fone_dois" value="3" style="margin-left:2em;" <?php if ( $cliente_info->tipo_fone_dois == 3 ) { echo "checked"; } ?> />
												Fixo
											</label>
										</fieldset>
									</p>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									Comunicações por WhatsApp
								</th>
								<td>
									<label for="wapp_cliente" >
										<input name="wapp_cliente" id="wapp_cliente" type="checkbox" value="1" <?php if ( isset( $cliente_info ) ) { if ( $cliente_info->wapp_cliente == 1 ) { echo "checked"; } } else { echo "checked"; } ?> > Sim
									</label>
								</td>
							</tr>
						</tbody>
					</table>
					<h3>Endereço</h3>
					<table class="form-table">
						<tbody>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="cep_cliente">CEP</label>
								</th>
								<td>
									<input name="cep_cliente" id="cep_cliente" type="number" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->cep_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="ender_cliente">Lagradouro</label>
								</th>
								<td>
									<input name="ender_cliente" id="ender_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->ender_cliente . '"'; } ?> />
									<p class="description" id="tagline-description">
										Rua, avenida, praça...
									</p>
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="num_cliente">Número</label>
								</th>
								<td>
									<input name="num_cliente" id="num_cliente" type="number" style="width:75px;" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->num_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="complem_cliente">Complemento</label>
								</th>
								<td>
									<input name="complem_cliente" id="complem_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->complem_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="bairro_cliente">Bairro</label>
								</th>
								<td>
									<input name="bairro_cliente" id="bairro_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->bairro_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="cidade_cliente">Cidade</label>
								</th>
								<td>
									<input name="cidade_cliente" id="cidade_cliente" type="text" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->cidade_cliente . '"'; } ?> />
								</td>
							</tr>
							<tr class="form-field form-required">
								<th scope="row">
									<label for="estado_cliente">UF</label>
								</th>
								<td>
									<input name="estado_cliente" id="estado_cliente" type="text" style="width:75px;" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->estado_cliente . '"'; } ?> />
								</td>
							</tr>
						</tbody>
					</table>	
					<p class="submit">
						<input type="submit" name="editarcliente" class="button button-primary" value="Salvar" />
					</p>
				</form>
			</div>
			
			<div id="postbox-container-1" class="postbox-container" style="float:left;clear:none;width:10%">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<form method="post">
						<div id="submitdiv" class="postbox">
							<h3 class="hndle ui-sortable-handle" style="font-size: 14px; padding: 8px 12px; margin: 0; line-height: 1.4; cursor: default;">
								<span>Baterias</span>
							</h3>
							<div class="inside">
							<?php echo $cliente_info->nome_cliente . " "; $qtd_bat	=	$wpdb->get_var( "SELECT COUNT(*) FROM " . $tabela_baterias . " WHERE cpf_cliente=" . $cliente_info->cpf_cliente . ";" ); if ( $qtd_bat == 1 ) { echo "já trocou " . $qtd_bat . " bateria"; } elseif ( $qtd_bat > 1 ) { echo "já trocou " . $qtd_bat . " baterias"; } else { echo "ainda não trocou nenhuma bateria"; } ?> na Natal Watch
							</div>
						</div>
					</form>
					<form method="post">
						<div id="submitdiv" class="postbox">
							<h3 class="hndle ui-sortable-handle" style="font-size: 14px; padding: 8px 12px; margin: 0; line-height: 1.4; cursor: default;">
								<span>Serviços</span>
							</h3>
							<div class="inside">
							<?php echo $cliente_info->nome_cliente . " "; $qtd_serv	=	$wpdb->get_var( "SELECT COUNT(*) FROM " . $tabela_os . " WHERE cpf_cliente=" . $cliente_info->cpf_cliente . ";" ); if ( $qtd_serv == 1 ) { echo "já fez " . $qtd_serv . " serviço"; } elseif ( $qtd_serv > 1 ) { echo "já fez " . $qtd_serv . " serviços"; } else { echo "ainda não fez nenhum serviço"; } ?> na Natal Watch
							<p>
								Pontuação do cliente: <?php echo $cliente_info->pont_cliente ?>
							</p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	
} else {
	
	echo "Cliente não localizado"; 

}
?>