<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="cpfcliente">CPF</label>
					</th>
					<td>
						
						<p class="description" id="tagline-description">
							<?php if ( isset( $loc_cpf_db ) ) { echo $loc_cpf_db->cpf_cliente; } else { echo $cpf_cliente; } ?> <br/>
							<a href="javascript:window.history.go(-1)">Editar</a>
						</p>
						
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="nomecliente">Nome</label>
					</th>
					<td>
						Tiago						
					</td>
				</tr>
			</tbody>
			

	</table>
	<table id="wot_tabela" class="widefat">
		<thead>
			<tr>
				<th scope="col" width="35%" id="marca_rel">Marca</th>
				<th scope="col" width="30%" id="refer_rel">Referência</th>
				<th scope="col" width="30%" id="data_bat">Data</th>
				<th scope="col" width="5%" id="data_bat"></th>
			</tr>
		</thead>
		<tbody>
		<!-- Exibe os itens da tabela de orçamento de acordo com o número da OS -->
		<?php
			global $wpdb, $tabela_baterias;
			$query_linhas	=	$wpdb->get_results("SELECT * FROM " . $tabela_baterias . " WHERE cpf_cliente=" . $num_cpf . " ;");
				
			foreach($query_linhas as $query_linhas) {
				
				echo "
					<tr>
						<td> " . $query_linhas->marca_rel . " </td>
						<td> " . $query_linhas->rel_rel . " </td>
						<td> " . $query_linhas->data_bat . " </td>";
				echo "	
						</td>
						<td> " . $valor_convert = str_replace(".", ",", $query_linhas->val_total) . " </td>";
						if ( $os_info->status_os == 7 || $os_info->status_os == 6 || $os_info->status_os == 5 || $os_info->status_os == 4 || $os_info->status_os == 3 || $os_info->status_os == 2 || $os_info->status_os == 1 ) { 
						echo "<td> <form method='post'>
						<input type='hidden' name='deletarId' value='" . $query_linhas->id . "'>
						<input type='hidden' name='numeroOs' value='" . $num_cpf . "' />
						<input type='submit' name='deletarOpcao' value='x' class='button' />"; }
						echo "</form>
						</td>
					</tr> ";	
			}
			?>
		</tbody>
		<!-- O formulário para inserir itens só é exibidos para as OS que ainda não foram finalizadas -->
		<tfoot>
			<form id="enviar_orcamento" method="post" >
				<tr>
					<th scope="col" width="35%" style="border-top:0;">
						<input type="text" id="marca_rel" name="marca_rel" />
					</th>
					<th scope="col" width="30%" style="border-top:0;">
						<input type="text" id="ref_rel" name="ref_rel" />
					</th>
					<th scope="col" width="30%" style="border-top:0;">
						<input type="text" id="data_bat" name="data_bat" />
					</th>
					<th scope="col" width="5%" style="border-top:0;">
						<input type="hidden" name="numeroOs" value="<?php echo $num_os ?>" />
						<input type="submit" class="button-primary" name="add_item" value="+" />
					</th>
				</tr>
			</form>
		</tfoot>
	</table>
</div>