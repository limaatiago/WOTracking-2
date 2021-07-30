<?php

require_once('../wp-load.php');

global $wpdb, $tabela_cotacao;
$buscar_ok				=	$_POST['enviarBusca'];
$tipo_pesquisa			=	$_POST['tipoBusca'];
$campo_pesquisa			=	$_POST['campoBusca'];

$pagina_atual			=	$_GET['page'];

/* 	Verifica se há algum número de OS na URL.
	Se tiver, inclue a página de OS */
if ( isset( $_GET['num'] ) ) {
	
	wot_pagina_cotac();

}

/* 	Se não houver, exibe a página de localizar */
else {

	/* Verifica o falor da opção selecionada no filtro */
	if ( $buscar_ok ) { 

		if ( $tipo_pesquisa == 1 ) {
			$filtro_pesquisa	=	"cpf_cliente_cotac";
		}
		elseif ( $tipo_pesquisa == 2 ) {
			$filtro_pesquisa	=	"nome_cliente_cotac";
	}
	$resultados_cotac 	= $wpdb->get_results("SELECT * FROM " . $tabela_cotacao . " WHERE " . $filtro_pesquisa . " LIKE '%" . $campo_pesquisa . "%' ORDER BY id DESC"); 
}

else { $resultados_cotac 	= $wpdb->get_results("SELECT * FROM " . $tabela_cotacao . " ORDER BY id DESC"); }

?>

<div class="wrap">
	<h2>
		<?php echo get_admin_page_title() ; ?> <a href="admin.php?page=wot_novacotacao" class="add-new-h2">Cadastrar Nova</a>
	</h2>
	<div id="conteudo">
		<table style="width:100%;padding-top:9px">
			<form method="post" >
				<tr>
					<td colspan="2">
					<label for="tipoBusca">Consultar por:</label>
					</td>
				</tr>
				<tr>
					<td width="20%">
						<select name="tipoBusca" id="tipoBusca" style="width:100%;" required >
							<optgroup label="-- Selecione --" disabled></optgroup>
							<option value="1" <?php if ( $buscar_ok ) { if ( $tipo_pesquisa == 1 ) { echo "selected"; } } ?>>CPF do Cliente</option>
							<option value="2" <?php if ( $buscar_ok ) { if ( $tipo_pesquisa == 2 ) { echo "selected"; } } ?>>Nome do Cliente</option>
						</select>
					</td>
					<td>
						<input type="text" name="campoBusca" style="width:100%;" <?php if ( $buscar_ok ) { echo "value='" . $campo_pesquisa . "'"; } ?> required /> <br />
					</td>
					<td width="5%"><input type="submit" name="enviarBusca" class="button" value="Buscar" /></td>
				</tr>
			</form>
		</table>
		<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="13%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" width="15%"><b>Peça</b></th>
					<th scope="col" id="hide" width="11%"><b>Data</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			if ( $resultados_cotac ) {
				foreach ($resultados_cotac as $resultados_cotac) {
				echo "
				<tr>
					<td>" . $resultados_cotac->nome_cliente_cotac . "</td>
					<td id='hide'>" . $resultados_cotac->cpf_cliente_cotac . "</td>
					<td id='hide'>" . $resultados_cotac->marca_cotac . "</td>
					<td>" . $resultados_cotac->peca_cotac . "</td>
					<td id='hide'>" . date('d/m/Y', strtotime( $resultados_cotac->data_cotac )) . "</td>
					<td id='hide'>";
					$status_echo_cotac = $resultados_cotac->status_cotac;
					if ( $resultados_cotac->status_cotac == 1 ) { echo "Aguardando Cotação"; }
					elseif ( $resultados_cotac->status_cotac == 2 ) { echo "Ag. Envio Cliente"; }
					elseif ( $resultados_cotac->status_cotac == 3 ) { echo "Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_cotac->id . "'>Ver</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhuma Cotação Localizada. Tente Novamente!</center></td></tr>"; }
			?>
			</tbody>
		</table>
	</div>
</div> 
<?php } ?>