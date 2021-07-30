<div id="conteudo">
	<form method="post">
		<table id="wot_tabela" class="widefat" style="width: 49%;margin-right:2%;clear:none;float:left;">
			<thead>
				<th colspan="12"><b>Dados do Cliente</b></th>
			</thead>
			<tbody>
				<tr>
					<td colspan="6">
						<label for="id_cliente">ID Natal Watch</label> <br/>
						<input type="text" id="id_cliente" name="id_cliente" value="<?php echo $os_info->id_cliente_os ?>" disabled />
					</td>
					<td colspan="6">
						<label for="cpf_cliente">CPF</label> <br/>
						<input type="number" id="cpf_cliente" name="cpf_cliente" value="<?php echo $os_info->cpf_cliente_os ?>" disabled />
					</td>
				</tr>
				<tr>
					<td colspan="12">
						<label for="nome_cliente">Nome</label> <br/>
						<input type="text" id="nome_cliente" name="nome_cliente" value="<?php echo $os_info->nome_cliente_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="12">
						<label for="email_cliente">E-mail</label> <br/>
						<input type="email" id="email_cliente" name="email_cliente" value="<?php echo $os_info->email_cliente_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<label for="fone_um_cliente">Fone 1</label> <br/>
						<input type="tel" id="fone_um_cliente" name="fone_um_cliente" value="<?php echo $os_info->fone_um_cliente_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> /> <br/>
						<fieldset style="margin-top:0.5em;" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?>>
							<label>
								<input type="radio" name="radio_fone_um" value="1" <?php if ( $os_info->tipo_fone_um_os == 1 ) { echo "checked"; } ?> />
								Celular
							</label>
							<label>
								<input type="radio" name="radio_fone_um" value="2" style="margin-left:0.5em;" <?php if ( $os_info->tipo_fone_um_os == 2 ) { echo "checked"; } ?> />
								WhatsApp
							</label>
							<label>
								<input type="radio" name="radio_fone_um" value="3" style="margin-left:0.5em;" <?php if ( $os_info->tipo_fone_um_os == 3 ) { echo "checked"; } ?> />
								Fixo
							</label>
						</fieldset>
					</td>
					<td colspan="6">
						<label for="fone_dois_cliente"></label>Fone 2<br/>
						<input type="tel" id="fone_dois_cliente" name="fone_dois_cliente"  value="<?php echo $os_info->fone_dois_cliente_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> /> <br/>
						<fieldset style="margin-top:0.5em;">
							<label>
								<input type="radio" name="radio_fone_dois" value="1" <?php if ( $os_info->tipo_fone_dois_os == 1 ) { echo "checked"; } ?> />
								Celular
							</label>
							<label>
								<input type="radio" name="radio_fone_dois" value="2" style="margin-left:0.5em;" <?php if ( $os_info->tipo_fone_dois_os == 2 ) { echo "checked"; } ?> />
								WhatsApp
							</label>
							<label>
								<input type="radio" name="radio_fone_dois" value="3" style="margin-left:0.5em;" <?php if ( $os_info->tipo_fone_dois_os == 3 ) { echo "checked"; } ?> />
								Fixo
							</label>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		<table id="wot_tabela" class="widefat" style="width: 49%;clear:none;float:left;">
			<thead>
				<th colspan="2"> <b>Dados do Produto</b> </th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="tipo_produto">Tipo</label> <br/>
						<input type="text" id="tipo_produto" name="tipo_produto" value="<?php echo $os_info->tipo_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
					<td>
						<label for="marca_produto">Marca</label> <br/>
						<input type="text" id="marca_produto" name="marca_produto" value="<?php echo $os_info->marca_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td>
						<label for="referencia_produto">Referência</label> <br/>
						<input type="text" id="referencia_produto" name="referencia_produto" value="<?php echo $os_info->ref_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
					<td>
						<label for="modelo_produto">Modelo</label> <br/>
						<input type="text" id="modelo_produto" name="modelo_produto" value="<?php echo $os_info->mod_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="descricao_produto">Descrição</label> <br/>
						<input type="text" id="descricao_produto" name="descricao_produto" value="<?php echo $os_info->desc_prod_os ?>"  <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="caracteristicas_produto">Características Externas</label> <br/>
						<input type="text" id="caracteristicas_produto" name="caracteristicas_produto" value="<?php echo $os_info->carac_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="defeitos_produto">Defeito(s) Segundo o Cliente</label> <br/>
						<input type="text" id="defeitos_produto" name="defeitos_produto" value="<?php echo $os_info->def_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="servico_produto">Serviço(s) a Executar</label> <br/>
						<input type="text" id="servico_produto" name="servico_produto" value="<?php echo $os_info->serv_prod_os ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php if ( $os_info->status_os == 7 || $os_info->status_os == 6 || $os_info->status_os == 5 || $os_info->status_os == 4 || $os_info->status_os == 3 || $os_info->status_os == 2 || $os_info->status_os == 1 ) { ?>
		<div class="buttons-bottom">
			<input type="hidden" name="num_os" value="<?php echo $num_os ?>">
			<input type="submit" name="salvar_os" class="button" value="Salvar Dados" <?php if ( $os_info->status_os == 8 ) { echo "disabled"; } ?> /> 
		</div>
		<?php } ?>
	
	</form>
</div>