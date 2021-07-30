<h2>Dados da Peça</h2>
<form id="formulario-ordem-servico" name="formulario-ordem-servico" method="post">
	<input name="cpf_cotacao" type="hidden" value="<?php echo $cpf_cliente; ?>" />
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="marca_produto">Marca do Relógio</label>
				</th>
				<td>
					<input name="marca_produto" type="text" id="marca_produto" class="wot_cliente" required />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="modelo_produto">Modelo</label>
				</th>
				<td>
					<input name="modelo_produto" type="text" id="modelo_produto" class="wot_cliente" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="referencia_produto">Referência</label>
				</th>
				<td>
					<input name="referencia_produto" type="text" id="referencia_produto" class="wot_cliente" />
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="peca_produto">Peça</label>
				</th>
				<td>
					<input name="peca_produto" type="text" id="peca_produto" class="wot_cliente" required />
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="descricao_produto">Descrição da Peça</label>
				</th>
				<td>
					<textarea name="descricao_produto" type="text" id="descricao_produto" class="wot_cliente" required style="resize: none;"></textarea>
					<p class="description" id="tagline-description">
						Cores, formatos, materiais, quantidades etc.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="foto1_produto">Foto da Frente</label>
				</th>
				<td>
					<input id="upload_photo1" type="text" name="ad_image1" required />
					<input id="upload_photo_button1" class="button" type="button" value="Anexar imagens" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="foto2_produto">Foto do Fundo</label>
				</th>
				<td>
					<input id="upload_photo2" type="text" name="ad_image2"/>
					<input id="upload_photo_button2" class="button" type="button" value="Anexar imagens" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="resp_cotac">Atendente</label>
				</th>
				<td>
					<input id="resp_cotac" type="text" name="resp_cotac" value="<?php echo $current_user->display_name; ?>"/>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" name="incluir_cotacao" class="button button-primary" value="Salvar" />
	</p>
</form>