<h2>Dados do produto</h2>
<form id="formulario-ordem-servico" name="formulario-ordem-servico" method="post">
	<input name="cpf_os" type="hidden" value="<?php echo $cpf_cliente; ?>" />
	<table class="form-table">
		<tbody>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="os_externa">OS externa</label>
				</th>
				<td>
					<input type="text" name="os_externa" id="os_externa" class="wot_cliente"/>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">Tipo de OS
				</th>
				<td>
					<fieldset>
						<label title="fora_garantia">
							<input type="radio" name="radio_os" id="fora_garantia" value="1" required />
							Padrão
						</label> <br/>
						<label title="em_garantia">
							<input type="radio" name="radio_os" id="em_garantia" value="2" />
							Em garantia
						</label> <br/>
						<label title="em_garantia">
							<input type="radio" name="radio_os" id="ped_peca" value="3" <?php if ( $_GET['cotac'] ) { echo "checked"; } ?>/>
							Pedido de peças
						</label>
					</fieldset>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="tipo_produto">Produto</label>
				</th>
				<td>
					<input name="tipo_produto" type="text" id="tipo_produto" class="wot_cliente" value="Relógio" required />
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">Máquina</th>
				<td>
					<fieldset>
						<label title="maquina_quartz">
							<input type="radio" name="radio_maquina" id="maquina-quartz" value="1" required />
							Quartz
						</label> <br/>
						<label title="maquina_autoquarz">
							<input type="radio" name="radio_maquina" id="maquina_autoquarz" value="2" />
							Autoquartz
						</label> <br/>
						<label title="maquina_automatica">
							<input type="radio" name="radio_maquina" id="maquina_automatica" value="3" />
							Automática
						</label> <br/>
						<label title="maquina_corda">
							<input type="radio" name="radio_maquina" id="maquina_corda" value="4" />
							Corda manual
						</label>
					</fieldset>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="marca_produto">Marca</label>
				</th>
				<td>
					<select name="marca_produto" id="marca_produto" class="wot_cliente" required>
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
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="modelo_produto">Modelo</label>
				</th>
				<td>
					<input name="modelo_produto" type="text" id="modelo_produto" class="wot_cliente" <?php if ( $_GET['cotac'] ) { echo "value='" . $cotac_info->modelo_cotac . "'"; } ?>>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="referencia_produto">Referência</label>
				</th>
				<td>
					<input name="referencia_produto" type="text" id="referencia_produto" class="wot_cliente" <?php if ( $_GET['cotac'] ) { echo "value='" . $cotac_info->ref_cotac . "'"; } ?>>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="descricao_produto">Descrição</label>
				</th>
				<td>
					<textarea name="descricao_produto" type="text" id="descricao_produto" class="wot_cliente" required style="resize: none;"></textarea>
					<p class="description" id="tagline-description">
						Cores, formatos, tamanhos, quantidades etc.
					</p>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="caracteristicas_produto">Características externas</label>
				</th>
				<td>
					<textarea type="text" id="caracteristicas_produto" name="caracteristicas_produto" required style="width:25em; height: 80px; resize: none;" ></textarea>
					<p class="description" id="tagline-description">
						Riscos, amassos, descascamentos etc.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="defeitos_produto">Defeito(s) segundo o cliente</label>
				</th>
				<td>
					<textarea type="text" id="defeitos_produto" name="defeitos_produto" required style="width:25em; height: 80px; resize: none;" ></textarea>
					<p class="description" id="tagline-description">
						Descrição do problema ou defeito apresentado
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="servico_produto">Serviço(s) a executar</label>
				</th>
				<td>
					<textarea type="text" id="servico_produto" name="servico_produto" style="width:25em; height: 80px; resize: none;" ><?php if ( $_GET['cotac'] ) { echo "Pedido de peça: " . $cotac_info->peca_cotac . ""; } ?></textarea>
					<p class="description" id="tagline-description">
						Orçamento, polimento, cotação de peças etc.
					</p>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="nome_autor">OS cadastrada por</label>
				</th>
				<td>
					<input name="nome_autor" type="text" id="nome_autor" class="wot_cliente" value="<?php echo $current_user->display_name; ?>" required />
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" name="incluirordem" class="button button-primary" value="Salvar e imprimir" />
	</p>
</form>