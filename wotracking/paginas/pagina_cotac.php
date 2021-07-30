<?php

require_once('../wp-load.php');

global $wpdb, $tabela_cotacao, $current_user;

$num_cotac		=	$_GET['num'];
$salvar_cot		=	$_POST['salvar_cot'];
$salvar_orc		=	$_POST['salvar_orc'];
$salvar_env		=	$_POST['salvar_env'];
$cotac_os		=	$_POST['cotac_os'];

	// CLIENTE
	$nome_cliente_cotac			=	$_POST['nome_cliente'];	
	$email_cliente_cotac		=	$_POST['email_cliente'];
	$fone_um_cliente_cotac		=	$_POST['fone_um_cliente'];
	$tipo_fone_um_cotac			=	$_POST['radio_fone_um'];
	$fone_dois_cliente_cotac	=	$_POST['fone_dois_cliente'];
	$tipo_fone_dois_cotac		=	$_POST['radio_fone_dois'];
	
	//PRODUTO
	$marca_cotac				=	$_POST['marca_produto'];
	$modelo_cotac				=	$_POST['modelo_produto'];	
	$ref_cotac					=	$_POST['referencia_produto'];
	$peca_cotac					=	$_POST['peca_produto'];
	$descricao_cotac			=	$_POST['descricao_produto'];
	$resp_cotac					=	$_POST['resp_cotac'];
	
	// ORCAMENTO
	$disponib_cotac			=	$_POST['disponib_cotac'];
	$desc_orc_cotac			=	$_POST['desc_orc_cotac'];
	$valor_cotac			=	str_replace(',', '.', $_POST['valor_cotac']);
	$prazo_cotac			=	$_POST['prazo_cotac'];
	$obs_cotac				=	$_POST['obs_cotac'];
	$data_orc_cotac			=	str_replace('/', '-', $_POST['data_orc_cotac']);
	$resp_orc_cotac			=	$_POST['resp_orc_cotac'];
	
	// ENVIO
	$meio_env_cotac			=	$_POST['meio_env_cotac'];
	$data_env_cotac			=	str_replace('/', '-', $_POST['data_env_cotac']);
	$resp_env_cotac			=	$_POST['resp_env_cotac'];
	
	
/* FUNÇÕES */

if ( $salvar_cot ) {
	
	$wpdb->update(
	$tabela_cotacao,
	array(
		'nome_cliente_cotac' 		=> $nome_cliente_cotac,
		'email_cliente_cotac' 		=> $email_cliente_cotac,
		'fone_um_cliente_cotac' 	=> $fone_um_cliente_cotac,
		'tipo_fone_um_cotac'		=> $tipo_fone_um_cotac,
		'fone_dois_cliente_cotac'	=> $fone_dois_cliente_cotac,
		'tipo_fone_dois_cotac'		=> $tipo_fone_dois_cotac,
		'marca_cotac' 				=> $marca_cotac,
		'modelo_cotac' 				=> $modelo_cotac,
		'ref_cotac' 				=> $ref_cotac,
		'peca_cotac'				=> $peca_cotac,
		'descricao_cotac'			=> $descricao_cotac,
		'resp_cotac'				=> $resp_cotac
		),
	array( 'id' => $num_cotac )
	);
	
}
	
if ( $salvar_orc ) {
	
	$wpdb->update(
	$tabela_cotacao,
	array(
		'status_cotac'		=> 2,
		'disponib_cotac' 	=> $disponib_cotac,
		'desc_orc_cotac' 	=> $desc_orc_cotac,
		'valor_cotac' 		=> $valor_cotac,
		'prazo_cotac'		=> $prazo_cotac,
		'obs_cotac' 		=> $obs_cotac,
		'data_orc_cotac'	=> date('Y-m-d', strtotime($data_orc_cotac)),
		'resp_orc_cotac'	=> $resp_orc_cotac 
		),
	array( 'id' => $num_cotac )
	);

}

if ( $salvar_env ) {
	
	$wpdb->update(
	$tabela_cotacao,
	array(
		'status_cotac'		=> 3,
		'meio_env_cotac' 	=> $meio_env_cotac,
		'data_env_cotac' 	=> date('Y-m-d', strtotime($data_env_cotac)),
		'resp_env_cotac' 	=> $resp_env_cotac
		),
	array( 'id' => $num_cotac )
	);

}
if ( $cotac_os ) {
	
	$wpdb->update(
	$tabela_cotacao,
	array(
		'cotac_os'		=> 1,
		'data_os'		=> current_time( 'mysql' )
		),
	array( 'id' => $num_cotac )
	);
	
	$num_cotac	=	$_POST['num_cotac'];
	$redir_os	=	admin_url("admin.php?page=wot_novaos&cotac=" . $num_cotac . "");
	echo "<script>location.href='" . $redir_os . "'</script>";
	
}

$cotac_info 		= $wpdb->get_row("SELECT * FROM " . $tabela_cotacao . " WHERE id=" . $num_cotac . ";");

if ( $cotac_info ) {
	?>

	<div class="wrap">			
		<h2>
			Solicitação #<?php echo $cotac_info->id ?>
			<?php if ( $cotac_info->status_cotac == 3 ) { ?>
				<form method="post">
					<input type="hidden" name="num_cotac" id="num_cotac" value="<?php echo $cotac_info->id ?>"/>
					<input type="submit" name="cotac_os" id="cotac_os" class="button button-primary" value="Gerar OS"/>
				</form>
			<?php } ?>
		</h2> 
		<div id="conteudo">

	<?php
	
	/* Controla o conteúdo da página de acordo com o status */
	if ( $cotac_info->status_cotac > 1 ) { ?>
		
		<form method="post">
			<h3>Envio de Cotação</h3>
			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<label for="meio_env_cotac">Meio de contato</label>
						</th>
						<td>
							<select name="meio_env_cotac" id="meio_env_cotac" class="wot_cliente" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required>
								<optgroup label="-- Selecione --" disabled></optgroup>
								<option value="1" <?php if ( $cotac_info->meio_env_cotac == 1 ) { echo "selected"; } ?>>WhatsApp</option>
								<option value="2" <?php if ( $cotac_info->meio_env_cotac == 2 ) { echo "selected"; } ?>>Ligação</option>
								<option value="3" <?php if ( $cotac_info->meio_env_cotac == 3 ) { echo "selected"; } ?>>E-mail</option>
								<option value="4" <?php if ( $cotac_info->meio_env_cotac == 4 ) { echo "selected"; } ?>>Pessoalmente</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label for="data_env_cotac">Data</label>
						</th>
						<td>
							<input type="text" name="data_env_cotac" id="data_env_cotac" class="wot_cliente" value="<?php if ( $cotac_info->data_env_cotac == null ) { $horaatual = current_time( 'mysql' ); echo date('d/m/Y', strtotime( $horaatual )); } else { echo date('d/m/Y', strtotime( $cotac_info->data_env_cotac )); } ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required/>
						</td>
					</tr>
					<tr>
						<th>
							<label for="resp_env_cotac">Responsável</label>
						</th>
						<td>
							<input type="text" name="resp_env_cotac" id="resp_env_cotac" class="wot_cliente" value="<?php if ( $cotac_info->status_cotac == 2 ) { echo $current_user->display_name; } else { echo $cotac_info->resp_env_cotac; } ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required/>
						</td>
					</tr>
				</tbody>
			</table>
			
			<?php if ( $cotac_info->status_cotac < 3 ) { ?>
			<p class="submit">
				<input type="submit" name="salvar_env" class="button button-primary" value="Salvar" />
			</p>
			<?php } ?>
		</form>
	<?php
	}
	?>
	
	<form method="post">
		<h3>Orçamento</h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="disponib_cotac">Disponibilidade</label>
					</th>
					<td>
						<select name="disponib_cotac" id="disponib_cotac" class="wot_cliente" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required>
							<optgroup label="-- Selecione --" disabled></optgroup>
							<option value="1" <?php if ( $cotac_info->disponib_cotac == 1 ) { echo "selected"; } ?>>Estoque</option>
							<option value="2" <?php if ( $cotac_info->disponib_cotac == 2 ) { echo "selected"; } ?>>Encomenda Nacional</option>
							<option value="3" <?php if ( $cotac_info->disponib_cotac == 3 ) { echo "selected"; } ?>>Encomenda Internacional</option>
							<option value="4" <?php if ( $cotac_info->disponib_cotac == 4 ) { echo "selected"; } ?>>Possível de Adaptação</option>
							<option value="5" <?php if ( $cotac_info->disponib_cotac == 5 ) { echo "selected"; } ?>>Saiu de Linha</option>
							<option value="6" <?php if ( $cotac_info->disponib_cotac == 6 ) { echo "selected"; } ?>>Indisponível</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						<label for="desc_orc_cotac">Descrição</label>
					</th>
					<td>
						<input type="text" name="desc_orc_cotac" id="desc_orc_cotac" class="wot_cliente" value="<?php echo $cotac_info->desc_orc_cotac; ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required/> 
					</td>
				</tr>
				<tr>
					<th>
						<label for="valor_cotac">Valor (R$)</label>
					</th>
					<td>
						<input type="text" name="valor_cotac" id="valor_cotac" class="wot_cliente" value="<?php echo $valor_convert = str_replace(".", ",", $cotac_info->valor_cotac) ; ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="prazo_cotac">Prazo (dias)</label>
					</th>
					<td>
						<input type="text" name="prazo_cotac" id="prazo_cotac" class="wot_cliente" value="<?php echo $cotac_info->prazo_cotac; ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="obs_cotac">Observação</label>
					</th>
					<td>
						<textarea type="text" name="obs_cotac" id="obs_cotac" class="wot_cliente" style="width:25em; height: 80px; resize: none;" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>><?php if ( $cotac_info->obs_cotac != "" ) { echo $cotac_info->obs_cotac; } ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<label for="data_orc_cotac">Data</label>
					</th>
					<td>
						<input type="text" name="data_orc_cotac" id="data_orc_cotac" class="wot_cliente" value="<?php if ( $cotac_info->data_orc_cotac == null ) { $horaatual = current_time( 'mysql' ); echo date('d/m/Y', strtotime( $horaatual )); } else { echo date('d/m/Y', strtotime( $cotac_info->data_orc_cotac )); } ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="resp_orc_cotac">Responsável</label>
					</th>
					<td>
						<input type="text" name="resp_orc_cotac" id="resp_orc_cotac" class="wot_cliente" value="<?php if ( $cotac_info->status_cotac == 1 ) { echo $current_user->display_name; } else { echo $cotac_info->resp_orc_cotac; } ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> required/>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php if ( $cotac_info->status_cotac < 3 ) { ?>
			<p class="submit">
				<input type="submit" name="salvar_orc" class="button button-primary" value="Salvar" />
			</p>
		<?php } ?>
	</form>
	
	<form method="post">
		<h3>Dados do Produto</h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="">Marca</label>
					</th>
					<td>
						<input type="text" id="marca_produto" name="marca_produto" class="wot_cliente" value="<?php echo $cotac_info->marca_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Modelo</label>
					</th>
					<td>
						<input type="text" id="modelo_produto" name="modelo_produto" class="wot_cliente" value="<?php echo $cotac_info->modelo_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Referência</label>
					</th>
					<td>
						<input type="text" id="referencia_produto" name="referencia_produto" class="wot_cliente" value="<?php echo $cotac_info->ref_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Peça</label>
					</th>
					<td>
						<input type="text" id="peca_produto" name="peca_produto" class="wot_cliente" value="<?php echo $cotac_info->peca_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Descrição</label>
					</th>
					<td>
						<textarea type="text" style="width:25em; height: 80px; resize: none;" id="descricao_produto" class="wot_cliente" name="descricao_produto" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>><?php echo $cotac_info->descricao_cotac ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Foto 1</label>
					</th>
					<td>
						<a href="<?php echo $cotac_info->foto_um_cotac ?>" target="_blank">Visualizar</a>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Foto 2</label>
					</th>
					<td>
						<a href="<?php echo $cotac_info->foto_dois_cotac ?>" target="_blank">Visualizar</a>
					</td>
				</tr>
			</tbody>
		</table>
		
		<h3>Dados do Cliente</h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="cpf_cliente">CPF</label>
					</th>
					<td>
						<input type="text" id="cpf_cliente" name="cpf_cliente" class="wot_cliente" value="<?php echo $cotac_info->cpf_cliente_cotac ?>" disabled />
					</td>
				</tr>
				<tr>
					<th>
						<label for="nome_cliente">Nome</label>
					</th>
					<td>
						<input type="text" id="nome_cliente" name="nome_cliente" class="wot_cliente" value="<?php echo $cotac_info->nome_cliente_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<th>
						<label for="email_cliente">E-mail</label>
					</th>
					<td>
						<input type="text" id="email_cliente" name="email_cliente" class="wot_cliente" value="<?php echo $cotac_info->email_cliente_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="fone_um_cliente">Fone 1</label>
					</th>
					<td>
						<input type="text" id="fone_um_cliente" name="fone_um_cliente" class="wot_cliente" value="<?php echo $cotac_info->fone_um_cliente_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> /><br/>
						<fieldset style="margin-top:0.5em;" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>>
							<label>
								<input type="radio" name="radio_fone_um" value="1" <?php if ( $cotac_info->tipo_fone_um_cotac == 1 ) { echo "checked"; } ?> />
								Celular
							</label>
							<label>
								<input type="radio" name="radio_fone_um" value="2" style="margin-left:0.5em;" <?php if ( $cotac_info->tipo_fone_um_cotac == 2 ) { echo "checked"; } ?> />
								WhatsApp
							</label>
							<label>
								<input type="radio" name="radio_fone_um" value="3" style="margin-left:0.5em;" <?php if ( $cotac_info->tipo_fone_um_cotac == 3 ) { echo "checked"; } ?> />
								Fixo
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th>
						<label for="fone_dois_cliente">Fone 2</label>
					</th>
					<td>
						<input type="text" id="fone_dois_cliente" name="fone_dois_cliente" class="wot_cliente" value="<?php echo $cotac_info->fone_dois_cliente_cotac ?>" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>/><br/>
						<fieldset style="margin-top:0.5em;" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?>>
							<label>
								<input type="radio" name="radio_fone_dois" value="1" <?php if ( $cotac_info->tipo_fone_dois_cotac == 1 ) { echo "checked"; } ?> />
								Celular
							</label>
							<label>
								<input type="radio" name="radio_fone_dois" value="2" style="margin-left:0.5em;" <?php if ( $cotac_info->tipo_fone_dois_cotac == 2 ) { echo "checked"; } ?> />
								WhatsApp
							</label>
							<label>
								<input type="radio" name="radio_fone_dois" value="3" style="margin-left:0.5em;" <?php if ( $cotac_info->tipo_fone_dois_cotac == 3 ) { echo "checked"; } ?> />
								Fixo
							</label>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php if ( $cotac_info->status_cotac < 3 ) { ?>
			<p class="submit">
				<input type="hidden" name="num_cotac" value="<?php echo $num_cotac ?>">
				<input type="submit" name="salvar_cot" class="button" value="Salvar" <?php if ( $cotac_info->status_cotac == 3 ) { echo "disabled"; } ?> />
			</p>
		<?php } ?>
	</form>
		</div>
	</div>
	<?php
}
else { echo "<h2>Solicitação Não Localizada</h2>"; }
	?>