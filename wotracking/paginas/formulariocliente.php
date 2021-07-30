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
	<h2><?php if ( isset( $cliente_info ) ) { echo 'Cliente cadastrado'; } else { echo'Cadastrar cliente'; } ?></h2>	
	<form method="post">
		<h3>Dados pessoais</h3>
		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="cpf_cliente">CPF <span class="description">(obrigatório)</span></label>
					</th>
					<td>
						<input id="cpf_cliente" class="wot_cliente" type="number" value="<?php echo $num_cpf; ?>" disabled />
						<p class="description">
							<a href="javascript:window.history.go(-1)">Editar</a>
						</p>
						<input name="cpf_cliente" type="hidden" value="<?php echo $num_cpf; ?>" />
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						Tipo da pessoa <span class="description">(obrigatório)</span>
					</th>
					<td>
						<fieldset>
							<label title="pessoa_fisica">
								<input type="radio" name="radio_cliente" id="pessoa_fisica" value="F" required <?php if ( $cliente_info->tipo_cliente != "J" ) { echo 'checked="checked"'; }?> />
								Pessoa Física
							</label> <br/>
							<label title="pessoa_juridica">
								<input type="radio" name="radio_cliente" id="pessoa_juridica" value="J" <?php if ( $cliente_info->tipo_cliente == "J" ) { echo 'checked="checked"'; }?>/>
								Pessoa Jurídica
							</label> <br/>
						</fieldset>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="nome_cliente">Nome completo<span class="description">(obrigatório)</span></label>
					</th>
					<td>
						<select name="genero_cliente" style="margin-top:-2px;height:auto;width:5em;">
							<option value="1" <?php if ( $cliente_info->genero_cliente == 1 ) { echo "selected"; }?>>Sr.</option>
							<option value="2" <?php if ( $cliente_info->genero_cliente == 2 ) { echo "selected"; }?>>Sra.</option>
						</select>
						<input name="nome_cliente" id="nome_cliente" type="text" class="wot_cliente" style="width:19.6em !important;" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->nome_cliente . '"'; } ?> required />
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						Contribuinte ICMS <span class="description">(obrigatório)</span>
					</th>
					<td>
						<fieldset>
							<label title="contrib_sim">
								<input type="radio" name="radio_contrib" id="contrib_sim" value="1" required <?php if ( $cliente_info->contrib_cliente == 1 ) { echo 'checked="checked"'; }?> />
								Sim
							</label> <br/>
							<label title="contrib_nao">
								<input type="radio" name="radio_contrib" id="contrib_nao" value="9" <?php if ( $cliente_info->contrib_cliente != 1 ) { echo 'checked="checked"'; }?> />
								Não
							</label> <br/>
						</fieldset>
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
						<input name="email_cliente" id="email_cliente"  type="email" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->email_cliente . '"'; } ?> />
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
				<tr class="form-field form-required" <?php if ( isset( $cliente_info ) ) { if ( $cliente_info->fone_um_cliente == "0" ) { echo 'style="background-color:#ff0;"'; } } ?>>
					<th scope="row">
						<label for="fone_um_cliente">Fone 1 <span class="description">(obrigatório)</span></label>
					</th>
					<td>
						<input name="fone_um_cliente" id="fone_um_cliente" type="tel" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->fone_um_cliente . '"'; } ?>  required />
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
						<input name="fone_dois_cliente" id="fone_dois_cliente" type="tel" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->fone_dois_cliente . '"'; } ?> />
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
		
		<?php $pagina = $_GET['page']; if ( $pagina == wot_novaos ) { ?>
		
			<h3>Endereço</h3>
			<table class="form-table">
				<tbody>
					<tr class="form-field form-required" <?php if ( isset( $cliente_info ) ) { if ( $cliente_info->cep_cliente == "" ) { echo 'style="background-color:#ff0;"'; } } ?>>
						<th scope="row">
							<label for="cep_cliente">CEP</label>
						</th>
						<td>
							<input name="cep_cliente" id="cep_cliente" type="number" class="wot_cliente" <?php if ( isset( $cliente_info ) ) { echo 'value="' . $cliente_info->cep_cliente . '"'; } ?> required />
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
		
		<?php } ?>
		
		<p class="submit">
			<input type="submit" name="<?php if ( isset( $cliente_info ) ) { echo "editarcliente"; } else { echo "incluircliente"; } ?>" class="button button-primary" value="Salvar" />
		</p>
	</form>
</div>