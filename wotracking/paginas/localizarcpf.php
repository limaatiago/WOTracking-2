<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	
	<p>Insira abaixo o número do CPF do cliente</p>
	
	<table class="form-table">
		<tbody>
			<form id="form-loc-cpf" name="form-loc-cpf" method="post">
				<tr class="form-field form-required">
					<th scope="row">
						<label for="num_cpf">CPF</label>
					</th>
					<td>
						<input type="number" name="num_cpf" id="num_cpf" class="cpf wot_cliente" <?php if ( $_GET['cotac'] ) { echo "value=" . $cotac_info->cpf_cliente_cotac . ""; } ?> required />
						<input type="submit" name="loc_cpf" id="loc_cpf" class="button" value="OK" />
						<p class="description" id="tagline-description">
							Apenas números
						</p>
					</td>
				</tr>
			</form>
		</tbody>
	</table>
</div>