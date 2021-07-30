<div class="wrap">			
	<h2><?php echo get_admin_page_title() ?></h2>
	<table class="form-table">
		<tbody>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="cpf_cliente">CPF</label>
				</th>
				<td>
					<?php echo $cpf_cliente; ?>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="nome_cliente">Nome</label>
				</th>
				<td>
					<?php $cliente_info 	= 	$wpdb->get_row( "SELECT * FROM " . $tabela_clientes . " WHERE cpf_cliente=" . $cpf_cliente . ";" ); echo $cliente_info->nome_cliente; ?>
				</td>
			</tr>
	</table>
	<table id="wot_tabela" class="widefat">
		<thead>
			<tr>
				<th colspan="7">
					<b>Baterias (<?php $qtd_bat	=	$wpdb->get_var( "SELECT COUNT(*) FROM " . $tabela_baterias . " WHERE cpf_cliente=" . $cpf_cliente . ";" ); echo $qtd_bat; ?>)</b>
				</th>
			</tr>
			<tr>
				<th scope="col" width="25%" id="marca_rel">Marca</th>
				<th scope="col" width="23%" id="ref_rel">Referência</th>
				<th scope="col" width="23%" id="valor_bat">Valor (R$)</th>
				<th scope="col" width="25%" id="data_bat" colspan="2">Data</th>
			</tr>
		</thead>
		<tbody>
			<form id="enviar_bateria" method="post" >
				<tr>
					<th scope="col" width="25%" style="border-top:0;">
						<select name="marca_rel" id="marca_rel" required>
							<option selected="true" disabled="disabled">-- SELECIONAR --</option>
							<optgroup label="A">
								<option value="ADIDAS">ADIDAS</option>
								<option value="AKIUM">AKIUM</option>
								<option value="ALLORA">ALLORA</option>
								<option value="ARMANI EXCHANGE">ARMANI EXCHANGE</option>
								<option value="ATLANTIS">ATLANTIS</option>
								<option value="ANNE KLEIN">ANNE KLEIN</option>
								<option value="AUDEMARS PIGUET">AUDEMARS PIGUET</option>
							</optgroup>
							<optgroup label="B">
								<option value="BACKER">BACKER</option>
								<option value="BAUME & MERCIER">BAUME & MERCIER</option>
								<option value="BERING">BERING</option>
								<option value="BREGUET">BREGUET</option>
								<option value="BREITLING">BREITLING</option>
								<option value="BUCHERER">BUCHERER</option>
								<option value="BULOVA">BULOVA</option>
								<option value="BURBERRY">BURBERRY</option>
								<option value="BVLGARI">BVLGARI</option>
							</optgroup>
							<optgroup label="C">
								<option value="CALVIN KLEIN">CALVIN KLEIN</option>
								<option value="CATERPILLAR">CATERPILLAR</option>
								<option value="CARTIER">CARTIER</option>
								<option value="CASIO">CASIO</option>
								<option value="CHAMPION">CHAMPION</option>
								<option value="CHANEL">CHANEL</option>
								<option value="CHILLI BEANS">CHILLI BEANS</option>
								<option value="CHOPARD">CHOPARD</option>
								<option value="CITIZEN">CITIZEN</option>
								<option value="COACH">COACH</option>
								<option value="CONDOR">CONDOR</option>
								<option value="CORUM">CORUM</option>
								<option value="COSMOS">COSMOS</option>
							</optgroup>
							<optgroup label="D">
								<option value="DIESEL">DIESEL</option>
								<option value="DKNY">DKNY</option>
								<option value="DUMONT">DUMONT</option>
								<option value="DOLCE & GABBANA">DOLCE & GABBANA</option>
							</optgroup>
							<optgroup label="E">
								<option value="EDIFICE">EDIFICE</option>
								<option value="EMPORIO ARMANI">EMPORIO ARMANI</option>
								<option value="ETERNA MATIC">ETERNA MATIC</option>
								<option value="EURO">EURO</option>
							</optgroup>
							<optgroup label="F">
								<option value="FENDI">FENDI</option>
								<option value="SCUDERIA FERRARI">FERRARI</option>
								<option value="FESTINA">FESTINA</option>
								<option value="FLIK FLAK">FLIK FLAK</option>
								<option value="FOSSIL">FOSSIL</option>
							</optgroup>
							<optgroup label="G">
								<option value="G-SHOCK">G-SHOCK</option>
								<option value="GARMIN">GARMIN</option>
								<option value="GARRIDO & GUZMAN">GARRIDO & GUZMAN</option>
								<option value="GUESS">GUESS</option>
								<option value="GUESS COLLECTION">GUESS COLLECTION</option>
								<option value="GUCCI">GUCCI</option>
							</optgroup>
							<optgroup label="H">
								<option value="H. STERN">H. STERN</option>
								<option value="HAMILTON">HAMILTON</option>
								<option value="HUBLOT">HUBLOT</option>
								<option value="HUGO BOSS">HUGO BOSS</option>
							</optgroup>
							<optgroup label="I">
								<option value="ICE WATCH">ICE WATCH</option>
								<option value="INVICTA">INVICTA</option>
								<option value="IWC">IWC</option>
							</optgroup>
							<optgroup label="J">
								<option value="JAGUAR">JAGUAR</option>
								<option value="JEAN VERNIER">JEAN VERNIER</option>
								<option value="JEEP">JEEP</option>
							</optgroup>
							<optgroup label="K">
								<option value="KATE SPADE">KATE SPADE</option>
							</optgroup>
							<optgroup label="L">
								<option value="LACOSTE">LACOSTE</option>
								<option value="LAMBORGHINI">LAMBORGHINI</option>
								<option value="LINCE">LINCE</option>
								<option value="LONGINES">LONGINES</option>
								<option value="LOUIS VUITTON">LOUIS VUITTON</option>
							</optgroup>
							<optgroup label="M">
								<option value="MAGNUM">MAGNUM</option>
								<option value="MARC JACOBS">MARC JACOBS</option>
								<option value="MARINER">MARINER</option>
								<option value="MATHEY-TISSOT">MATHEY-TISSOT</option>
								<option value="MICHAEL KORS">MICHAEL KORS</option>
								<option value="MIDO">MIDO</option>
								<option value="MONDAINE">MONDAINE</option>
								<option value="MORMAII">MORMAII</option>
								<option value="MONTBLANC">MONTBLANC</option>
								<option value="MOVADO">MOVADO</option>
							</optgroup>
							<optgroup label="N">
								<option value="NATAN">NATAN</option>
								<option value="NAUTICA">NAUTICA</option>
								<option value="NIBOSI">NIBOSI</option>
								<option value="NIKE">NIKE</option>
							</optgroup>
							<optgroup label="O">
								<option value="OMEGA">OMEGA</option>
								<option value="ORIENT">ORIENT</option>
								<option value="OSLO">OSLO</option>
								<option value="OUTRA">OUTRA</option>
							</optgroup>
							<optgroup label="P">
								<option value="PANERAI">PANERAI</option>
								<option value="PATEK PHILIPPE">PATEK PHILIPPE</option>
								<option value="PATHFINDER">PATHFINDER</option>
								<option value="PIAGET">PIAGET</option>
								<option value="POLAR">POLAR</option>
								<option value="POLICE">POLICE</option>
								<option value="PUMA">PUMA</option>
							</optgroup>
							<optgroup label="Q">
								<option value="Q&Q">Q&Q</option>
							</optgroup>
							<optgroup label="R">
								<option value="RADO">RADO</option>
								<option value="RAYMOND WEIL">RAYMOND WEIL</option>
								<option value="RÉPLICA A">RÉPLICA A</option>
								<option value="RÉPLICA B">RÉPLICA B</option>
								<option value="RICHELIEU">RICHELIEU</option>
								<option value="ROLEX">ROLEX</option>
							</optgroup>
							<optgroup label="S">
								<option value="SECULUS">SECULUS</option>
								<option value="SEIKO">SEIKO</option>
								<option value="SEM MARCA">SEM MARCA</option>
								<option value="SKAGEN">SKAGEN</option>
								<option value="SPEEDO">SPEEDO</option>
								<option value="SUUNTO CORE">SUUNTO CORE</option>
								<option value="SWAROVSKI">SWAROVSKI</option>
								<option value="SWATCH">SWATCH</option>
							</optgroup>
							<optgroup label="T">
								<option value="TAG HEUER">TAG HEUER</option>
								<option value="TECHNOMARINE">TECHNOMARINE</option>
								<option value="TECHNOS">TECHNOS</option>
								<option value="TIMBERLAND">TIMBERLAND</option>
								<option value="TIMEX">TIMEX</option>
								<option value="TISSOT">TISSOT</option>
								<option value="TOMMY HILFIGER">TOMMY HILFIGER</option>
								<option value="TORNADO">TORNADO</option>
								<option value="TORY BURCH">TORY BURCH</option>
								<option value="TOUCH">TOUCH</option>
								<option value="TUDOR">TUDOR</option>
								<option value="TW STEEL">TW STEEL</option>
							</optgroup>
							<optgroup label="U">
								<option value="U-BOAT">U-BOAT</option>
								<option value="UNIVERSAL GENEVE">UNIVERSAL GENEVE</option>
							</optgroup>
							<optgroup label="V">
								<option value="VACHERON CONSTANTIN">VACHERON CONSTANTIN</option>
								<option value="VICEROY">VICEROY</option>
								<option value="VICTOR HUGO">VICTOR HUGO</option>
								<option value="VICTORINOX">VICTORINOX</option>
								<option value="VIVARA">VIVARA</option>
							</optgroup>
							<optgroup label="W">
								<option value="WENGER">WENGER</option>
							</optgroup>
							<optgroup label="X">
								<option value="X GAMES">X GAMES</option>
							<optgroup>
							<optgroup label="Z">
								<option value="ZENITH">ZENITH</option>
							</optgroup>
						</select>
					</th>
					<th scope="col" width="23%" style="border-top:0;">
						<input type="text" id="refer_rel" name="refer_rel" required />
					</th>
					<th scope="col" width="23%" style="border-top:0;">
						<input type="number" id="valor_bat" name="valor_bat" required />
					</th>
					<th scope="col" width="23%" style="border-top:0;">
						<input type="text" id="data_bat" name="data_bat" value="<?php $horaatual = current_time( 'mysql' ); echo date('d/m/Y', strtotime( $horaatual )); ?>" required />
					</th>
					<th scope="col" width="5%" style="border-top:0;">
						<input type="hidden" name="resp_bat" value="<?php echo $current_user->display_name; ?>" />
						<input type="hidden" name="cpf_cliente" value="<?php echo $cpf_cliente ?>" />
						<input type="submit" class="button-primary" name="add_item" value="+" />
					</th>
				</tr>
			</form>
		<?php
			global $wpdb, $tabela_baterias;
			
			$bat_linhas	=	$wpdb->get_results( "SELECT * FROM " . $tabela_baterias . " WHERE cpf_cliente=" . $cpf_cliente . " ORDER BY id DESC;" );
				
			foreach( $bat_linhas as $bat_linhas ) {
				
				echo "
					<tr>
						<td>" . $bat_linhas->marca_rel . "</td>
						<td>" . $bat_linhas->refer_rel . "</td>
						<td>";
							if ( $bat_linhas->valor_bat == 0.00 ) { echo "GRÁTIS"; }
							else { echo
								$valor_convert = str_replace(".", ",", $bat_linhas->valor_bat); }
							echo "
						</td>
						<td colspan='2'>
							<form method='post'>
								<input type='hidden' name='deletar_id' value='" . $bat_linhas->id . "' />
								<input type='hidden' name='numero_cpf' value='" . $cpf_cliente . "' />
								<input type='submit' name='deletar_opcao' value='x' class='button' style ='display:none;'/>
							</form>
							" . date('d/m/Y', strtotime( $bat_linhas->data_bat )) . "
						</td>
					</tr>";
			}					
		?>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col" width="25%" id="marca_rel">Marca</th>
				<th scope="col" width="23%" id="ref_rel">Referência</th>
				<th scope="col" width="23%" id="valor_bat">Valor (R$)</th>
				<th scope="col" width="25%" id="data_bat" colspan="2">Data</th>
			</tr>
		</tfoot>
	</table>
</div>