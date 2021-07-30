<div id="blocos-conteudo">
	<h3>Orçamento</h3>
	
	<table id="wot_tabela" class="widefat">
		<thead>
			<tr>
				<th scope="col" width="15%" class="esconder-orcamento">Produto/Serviço</th>
				<th scope="col" id="desc_serv">Descrição</th>
				<th scope="col" width="3%" align="center" id="essencial_serv">E</th>
				<th scope="col" width="5%" id="qtd_serv" class="esconder-orcamento">Qtd.</th>
				<th scope="col" width="15%" class="esconder-orcamento">Valor (R$)</th>
				<th scope="col" width="15%" colspan="2">Total (R$)</th>
			</tr>
		</thead>
		<tbody>
		<!-- Exibe os itens da tabela de orçamento de acordo com o número da OS -->
		<?php
			global $wpdb, $tabela_orcamento;
			$query_linhas	=	$wpdb->get_results("SELECT * FROM " . $tabela_orcamento . " WHERE num_os=" . $num_os . " ;");
				
			foreach($query_linhas as $query_linhas) {
				
				echo "
					<tr>
						<td class='esconder-orcamento'>";
						if ( $query_linhas->prod_serv == 1 ) { echo "Produto"; }
						elseif ( $query_linhas->prod_serv == 2 ) { echo "Serviço"; }
						else { echo "-"; }
				echo "	</td>
						<td> " . $query_linhas->desc_serv . " </td>
						<td> ";
						if ( $query_linhas->e_o_serv == 1 ) { echo "X"; }
						else { echo "-"; } 
				echo "	
						</td>
						<td class='esconder-orcamento'> " . $query_linhas->qtd_serv . " </td>
						<td class='esconder-orcamento'> " . $valor_convert = str_replace(".", ",", $query_linhas->val_serv) . " </td>
						<td> " . $valor_convert = str_replace(".", ",", $query_linhas->val_total) . " </td>";
						if ( $os_info->status_os == 7 || $os_info->status_os == 6 || $os_info->status_os == 5 || $os_info->status_os == 4 || $os_info->status_os == 3 || $os_info->status_os == 2 || $os_info->status_os == 1 ) { 
						echo "<td> <form method='post'>
						<input type='hidden' name='deletarId' value='" . $query_linhas->id . "'>
						<input type='hidden' name='numeroOs' value='" . $num_os . "' />
						<input type='submit' name='deletarOpcao' value='x' class='button' />"; }
						echo "</form>
						</td>
					</tr> ";	
			}
			?>
		</tbody>
		<!-- O formulário para inserir itens só é exibidos para as OS que ainda não foram finalizadas -->
		<?php if ( $os_info->status_os == 7 || $os_info->status_os == 6 || $os_info->status_os == 5 || $os_info->status_os == 4 || $os_info->status_os == 3 || $os_info->status_os == 2 || $os_info->status_os == 1 ) { ?> 
		<tfoot>
			<form id="enviar_orcamento" method="post" >
				<tr>
					<th scope="col" width="10%" class="esconder-orcamento" style="border-top:0;">
						<select name="prod_serv" id="prod_serv" <?php if ( $os_info->status_os > 8 ) { echo "disabled"; } ?> required>
							<optgroup label="-- Selecione --" disabled></optgroup>
							<option value="1">Produto</option>
							<option value="2">Serviço</option>
						</select>
					</th>
					<th scope="col" style="border-top:0;">
						<input type="text" id="descricao" name="descricao" required />
					</th>
					<th scope="col" width="3%" align="center" style="border-top:0;">
						<input type="checkbox" id="essencial" name="essencial"/>
					</th>
					<th scope="col" width="5%" class="esconder-orcamento" style="border-top:0;">
						<input type="text" id="qtd_orc" name="quantidade" value="1"/>
					</th>
					<th scope="col" width="15%" class="esconder-orcamento" style="border-top:0;">
						<input type="text" id="valor_servi" name="valor_servi"/>
					</th>
					<th scope="col" width="15%" style="border-top:0;">
						<input type="text" id="valor_total" name="valor_total" required />
					</th>
					<th scope="col" width="5%" style="border-top:0;">
						<input type="hidden" name="numeroOs" value="<?php echo $num_os ?>" />
						<input type="submit" class="button-primary" name="add_item" value="+" />
					</th>
				</tr>
			</form>
		</tfoot> <?php } ?>
	</table>
	
	<form method="post">	
	<table id="wot_tabela" class="form-table">
		<tbody>
			<tr>
				<th><label>Possível de conserto?</label>
				</th>
				<td>
					<fieldset <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?>>
						<label title="cons_sim">
							<input type="radio" name="possib_cons" id="cons_sim" value="1" required <?php if ( $os_info->possib_cons == 1 ) { echo "checked"; } ?> />
							Sim
						</label> <br/>
						<label title="cons_nao">
							<input type="radio" name="possib_cons" id="cons_nao" value="2" <?php if ( $os_info->possib_cons == 2 ) { echo "checked"; } ?>/>
							Não
						</label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th><label for="calibre_prod">Calibre</label>
				</th>
				<td>
					<input type="text" name="calibre_prod" class="wot_cliente" value="<?php if ( $os_info->calibre_prod != "" ) { echo $os_info->calibre_prod; } ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
				</td>
			</tr>
			<tr>
				<th>
					<label for="val_total">Valor Total (R$)</label>
				</th>
				<td>
					<input type="text" name="val_total" id="val_total" class="wot_cliente" value="<?php
					$soma_coluna = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(val_total) FROM " . $tabela_orcamento . " WHERE num_os=" . $num_os . " ", 0 ) );
					$valor_convert = str_replace(".", ",", $soma_coluna);
					if ( $valor_convert > 0 ) {
						echo $valor_convert;
					}
					?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
				</td>
			</tr>
			<tr>
				<th>
					<label for="desc_pag">Desconto (R$)</label></label>
				</th>
				<td>
					<input type="text" name="descon_pag" id="descon_pag" class="wot_cliente" value="<?php echo $os_info->descon_pag; ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
				</td>
			</tr>
			<tr>
				<th>
					<label for="val_final">Total Líquido (R$)</label></label>
				</th>
				<td>
					<input type="text" name="val_final" id="val_final" class="wot_cliente" value="<?php if ( $os_info->valor_final != "0.00" ) { echo $os_info->valor_final; } ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
				</td>
			</tr>
			<tr>
				<th>
					<label for="tempo-servico">Tempo de Serviço (dias)</label></label>
				</th>
				<td>
					<input type="number" name="tempo-servico" id="tempo-servico" class="wot_cliente" value="<?php if ( $os_info->dias_serv > 0 ) { echo $os_info->dias_serv; } ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> required />
				</td>
			</tr>
			<tr>
				<th>
					<label for="tempo-garantia">Garantia (meses)</label>
				</th>
				<td>
					<input type="number" name="tempo-garantia" id="tempo-garantia" class="wot_cliente" value="<?php if ( $os_info->tempo_garantia > 0 ) { echo $os_info->tempo_garantia; } ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?>  required />
				</td>
			</tr>
			<tr>
				<th>
					<label for="tempo-garantia">Observação</label>
				</th>
				<td>
					<textarea name="obs-orcamento" id="obs-orcamento" class="wot_cliente" style="width:25em; height: 80px; resize: none;" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?>><?php if ( $os_info->obs_orc != "" ) { echo $os_info->obs_orc; } ?></textarea>
				</td>
			</tr>
			<tr>
				<th>
					<label for="data-orcamento">Data</label>
				</th>
				<td>
					<input type="text" name="data_orcam" id="data_orcam" class="wot_cliente" value="<?php if ( $os_info->data_orcam == "0000-00-00 00:00:00" ) { $horaatual = current_time( 'mysql' ); echo date('d/m/Y', strtotime( $horaatual )); } else { echo date('d/m/Y', strtotime( $os_info->data_orcam )); } ?>" required <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> />
				</td>
			</tr>
			<tr>
				<th>
					<label for="tecnico-responsavel">Responsável</label>
				</th>
				<td>
					<input type="text" name="tecnico-responsavel" id="tecnico-responsavel" class="wot_cliente" value="<?php if ( $os_info->tecnico_orcam != "" ) { echo $os_info->tecnico_orcam; } ?>" <?php if ( $os_info->status_os > 7 ) { echo "disabled"; } ?> required />
				</td>
			</tr>
		</body>
	</table>

	<?php if ( $os_info->status_os == 7 || $os_info->status_os == 6 || $os_info->status_os == 5 || $os_info->status_os == 4 || $os_info->status_os == 3 || $os_info->status_os == 2 || $os_info->status_os == 1 ) { ?>
	<p class="submit">
			<input type="hidden" name="numeroOs" value="<?php echo $num_os ?>">
			<input type="submit" name="botao_os" class="button<?php if ( $os_info->status_os == 1 ) { echo "-primary";} ?>" value="Salvar Orçamento" /> 
	</p>
	<?php } ?>
	</form>
	
	
</div>