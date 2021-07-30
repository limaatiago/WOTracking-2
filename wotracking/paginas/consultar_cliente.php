<?php

require_once('../wp-load.php');

global $wpdb, $tabela_clientes;

$buscar_ok				=	$_POST['enviarBusca'];
$tipo_pesquisa			=	$_POST['tipoBusca'];
$campo_pesquisa			=	$_POST['campoBusca'];

/* EDITAR CLIENTE */

$id_cliente				=	$_GET['id'];

$pagina_atual			= 	$_GET['page'];

/* 	Verifica se há algum número de OS na URL.
	Se tiver, inclue a página de OS */
if ( isset( $id_cliente ) ) {
	
	include( 'pagina_cliente.php' );

}

/* 	Se não houver, exibe a página de localizar */
else {

	/* Verifica o falor da opção selecionada no filtro */
	if ( $buscar_ok ) { 

		if ( $tipo_pesquisa == 1 ) {
			$filtro_pesquisa	=	"cpf_cliente";
		}
		elseif ( $tipo_pesquisa == 2 ) {
			$filtro_pesquisa	=	"nome_cliente";
		}
		$resultados_clientes 	= $wpdb->get_results("SELECT * FROM " . $tabela_clientes . " WHERE " . $filtro_pesquisa . " LIKE '%" . $campo_pesquisa . "%' ORDER BY id DESC"); 
	}

else { $resultados_clientes 	= $wpdb->get_results("SELECT * FROM " . $tabela_clientes . " ORDER BY id DESC"); }

?>

<div class="wrap">
	<h2>
		<?php echo get_admin_page_title() ; ?>
		<a href="<?php echo admin_url("admin.php?page=wot_novocliente")?>" class="add-new-h2">Cadastrar Novo</a>
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
						<!-- Caso a busca tenha sido ativada, exibe os dados inseridos previamente -->
						<?php if ( $buscar_ok ) {
						if ( $tipo_pesquisa == 1 ) {
						echo "<option value='1' selected>CPF</option>
							<option value='2'>Nome</option>";
						}
						elseif ( $tipo_pesquisa == 2 ) {
						echo "<option value='1'>CPF</option>
							<option value='2' selected>Nome</option>";
						}
						}
						else {
						echo "<option value='1'>CPF</option>
							<option value='2'>Nome</option>";
						}
						?>
						</select>
					</td>
					<td>
						<input type="text" name="campoBusca" style="width:100%;" <?php if ( $buscar_ok ) { echo "value='" . $campo_pesquisa . "'"; }?> required /> <br />
					</td>
					<td width="5%"><input type="submit" name="enviarBusca" class="button" value="Buscar" /></td>
				</tr>
				</form>
			</table>
			<table id="tabela-consulta" class="widefat">
				<thead>
					<tr>
						<th scope="col" width="23%"><b>Nome do Cliente</b></th>
						<th scope="col" id="hide" width="15%"><b>CPF</b></th>
						<th scope="col" id="hide" width="15%"><b>Fone</b></th>
						<th scope="col" id="hide" width="22%"><b>E-mail</b></th>
						<th scope="col" width="10%"> </th>
					</tr>
				</thead>
				<tbody>
				<?php
				if ( $resultados_clientes ) {
					foreach ( $resultados_clientes as $resultados_clientes ) {
					echo "
					<tr>
						<td>" . $resultados_clientes->nome_cliente . "</td>
						<td id='hide'>" . $resultados_clientes->cpf_cliente . "</td>
						<td id='hide'>" . $resultados_clientes->fone_um_cliente . "</td>
						<td id='hide'>" . $resultados_clientes->email_cliente . "</td>
						<td align='right'> 
								<a href='admin.php?page=" . $pagina_atual . "&id=". $resultados_clientes->id . "'>Ver/editar</a>
						</td>
					</tr>
					";}
				}
				else { echo "<tr><td colspan='7'><center>Cliente não cadastrado. <a href='admin.php?page=wot_novocliente'>Cadastrar agora</a>!</center></td></tr>"; }
				?>
				</tbody>
			</table>
	</div>
</div> 
<?php } ?>