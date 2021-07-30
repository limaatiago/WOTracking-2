<?php
require_once('../wp-load.php');
global $current_user, $wpdb, $tabela_os;

$prazo_orc	=	get_option( 'wot_prazo_orc' )

?>

<div class="wrap">
	<h2><?php echo get_admin_page_title() ; ?></h2>
	<div id="conteudo-principal">
	
	<p>Orçamentos com vencimentos próximos</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="17%"><b>Marca</b></th>
					<th scope="col" id="hide" width="17%"><b>Data de entrada</b></th>
					<th scope="col" width="17%"><b>Prazo orçamento</b></th>
					<th scope="col" width="10%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			
			$venc_orc	= date('Y-m-d', strtotime('-' . $prazo_orc - 2 . ' days'));
			
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 1 AND data_entrada <= ' $venc_orc ' ");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td>" . date('d/m/Y', strtotime( '' . $resultados_os->data_entrada . '+ ' . $prazo_orc . ' days' )) . "</td>
					<td align='right'> 
							<a href='admin.php?page=" . wot_os . "&num=". $resultados_os->id . "'>Ver OS</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Orçamentos em dia</center></td></tr>"; }
			?>
			</tbody>
		</table>
		
	<p style="margin-top: 40px;">Orçamentos aguardando resposta</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="17%"><b>Marca</b></th>
					<th scope="col" id="hide" width="17%"><b>Data de entrada</b></th>
					<th scope="col" width="17%"><b>Data do orçamento</b></th>
					<th scope="col" width="10%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 2");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td>" . date('d/m/Y', strtotime( $resultados_os->data_orcam )) . "</td>
					<td align='right'> 
							<a href='admin.php?page=" . wot_os . "&num=". $resultados_os->id . "'>Ver OS</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Autorizações em dia</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<p style="margin-top: 40px;">Serviços próximos dos prazos</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="17%"><b>Marca</b></th>
					<th scope="col" id="hide" width="17%"><b>Data de entrada</b></th>
					<th scope="col" width="17%"><b>Prazo de entrega</b></th>
					<th scope="col" width="10%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 3 ORDER BY data_resposta");
			
			if ( $resultados_os ) {
				
				foreach ($resultados_os as $resultados_os) {
					
					$venc_serv	=	date('Y-m-d', strtotime( '' . $resultados_os->data_resposta . '+ ' . $resultados_os->dias_serv . ' days' ));
					$dia_atual	=	current_time( 'mysql' );
					$prox_dias	=	date('Y-m-d', strtotime( '+ 7 days'));
					
					if ( $venc_serv <= $dia_atual || $venc_serv <= $prox_dias ) {
						echo "
						<tr>
							<td><b>" . $resultados_os->id . "</b></td>
							<td>" . $resultados_os->nome_cliente_os . "</td>
							<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
							<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
							<td>" . date('d/m/Y', strtotime( '' . $resultados_os->data_resposta . '+ ' . $resultados_os->dias_serv . ' days' )) . "</td>
							<td align='right'> 
									<a href='admin.php?page=" . wot_os . "&num=". $resultados_os->id . "'>Ver OS</a>
							</td>
						</tr>
						";
					}

				}
			}
			else { echo "<tr><td colspan='7'><center>Serviços em dia</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<p style="margin-top: 40px;">Serviços próximos dos prazos (nova coluna)</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="17%"><b>Marca</b></th>
					<th scope="col" id="hide" width="17%"><b>Data de entrada</b></th>
					<th scope="col" width="17%"><b>Prazo de entrega</b></th>
					<th scope="col" width="10%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 3 AND prazo_ent != '0000-00-00 00:00:00' ORDER BY prazo_ent");
			
			if ( $resultados_os ) {
				
				foreach ($resultados_os as $resultados_os) {
					
					$venc_serv	=	$resultados_os->prazo_ent;
					$dia_atual	=	current_time( 'mysql' );
					$prox_dias	=	date('Y-m-d', strtotime( '+ 7 days'));
					
					if ( $venc_serv <= $dia_atual || $venc_serv <= $prox_dias) {
						echo "
						<tr>
							<td><b>" . $resultados_os->id . "</b></td>
							<td>" . $resultados_os->nome_cliente_os . "</td>
							<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
							<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
							<td>" . date('d/m/Y', strtotime( $resultados_os->prazo_ent )) . "</td>
							<td align='right'> 
									<a href='admin.php?page=" . wot_os . "&num=". $resultados_os->id . "'>Ver OS</a>
							</td>
						</tr>
						";
					}
				
				}
			}
			else { echo "<tr><td colspan='7'><center>Nenhuma OS nesse processo</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<div id="falta-editar" style="display:none;">
	<p>Aguardando retirada</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="17%"><b>Marca</b></th>
					<th scope="col" id="hide" width="17%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="17%"><b>Status</b></th>
					<th scope="col" width="5%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 5 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>" . date('d/m/Y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td align='right'> 
							<a href='admin.php?page=" . wot_os . "&num=". $resultados_os->id . "'>Consultar</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Retiradas em dia</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<p>Aguardando faturamento</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 7 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Todos os pagamentos estão em dia</center></td></tr>"; }
			?>
			</tbody>
		</table>
		
	<p>Produtos entregues com orçamento aprovado</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 8 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhum produto com orçamento aprovado foi entregue</center></td></tr>"; }
			?>
			</tbody>
		</table>
		
	<p>Orçamentos reprovados aguardando retirada</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 4 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhum orçamento reprovado com produto na assistência</center></td></tr>"; }
			?>
			</tbody>
		</table>
		
	<p>Serviços irrealizáveis aguardando retirada</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 6 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhum serviço reprovado com produto na assistência</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<p>Produtos entregues com orçamento reprovado</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 9 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhum orçamento reprovado com produto já entregue</center></td></tr>"; }
			?>
			</tbody>
		</table>
	
	<p>Produtos entregues com serviço não realizado</p>
	<table id="tabela-consulta" class="widefat">
			<thead>
				<tr>
					<th scope="col" id="ajustar" width="5%"><b>OS</b></th>
					<th scope="col" width="25%"><b>Nome do Cliente</b></th>
					<th scope="col" id="hide" width="12%"><b>CPF</b></th>
					<th scope="col" id="hide" width="11%"><b>Marca</b></th>
					<th scope="col" id="hide" width="11%"><b>Entrada</b></th>
					<th scope="col" id="hide" width="15%"><b>Status</b></th>
					<th scope="col" width="12%"> </th>
				</tr>
			</thead>
			<tbody>
			<?php
			$resultados_os 	= $wpdb->get_results("SELECT * FROM " . $tabela_os . " WHERE status_os = 10 ORDER BY id DESC");
			
			if ( $resultados_os ) {
				foreach ($resultados_os as $resultados_os) {
				echo "
				<tr>
					<td><b>" . $resultados_os->id . "</b></td>
					<td>" . $resultados_os->nome_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->cpf_cliente_os . "</td>
					<td id='hide'>" . $resultados_os->marca_prod_os . "</td>
					<td id='hide'>" . date('d/m/y', strtotime( $resultados_os->data_entrada )) . "</td>
					<td id='hide'>";
					$status_echo_os = $resultados_os->status_os;
					if ( $resultados_os->status_os == 1 ) { echo "Aguardando Orçamento"; }
					elseif ( $resultados_os->status_os == 2 ) { echo "Aguardando Autorização"; }
					elseif ( $resultados_os->status_os == 3 ) { echo "Serviço em Execução"; }
					elseif ( $resultados_os->status_os == 4 ) { echo "Orçamento Reprovado"; }
					elseif ( $resultados_os->status_os == 5 ) { echo "Aguardando Retirada"; }
					elseif ( $resultados_os->status_os == 6 ) { echo "Serviço Irrealizável"; }
					elseif ( $resultados_os->status_os == 7 ) { echo "Aguardando Pagamento"; }
					elseif ( $resultados_os->status_os == 8 ) { echo "OS Finalizada"; }
					else { echo "-"; }
					echo " </td>
					<td align='right'> 
							<a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "'>Ver</a>
							| <a href='admin.php?page=" . $pagina_atual . "&num=". $resultados_os->id . "&imprimir=os'>Imprimir</a>
					</td>
				</tr>
				";}
			}
			else { echo "<tr><td colspan='7'><center>Nenhum serviço reprovado com produto já entregue</center></td></tr>"; }
			?>
			</tbody>
		</table>
		</div>
	</div>
	<div id="conteudo-principal" style="display:none;">
		<!-- Quadro de boas-vindas com o nome do atual usuário -->
		<table id="wot_bemvindo" class="widefat">
			<thead>
				<th>Bem vindo!</th>
			</thead>
			<tr>
				<td>
				<p>
				Olá <b><?php echo $current_user->display_name ?></b>, bem-vindo ao plugin WOTracking! Escolha ao lado uma das opções de acesso<br/><br/>Não esqueça que você pode disponibilizar aos seus clientes o acompanhamento dos serviços através do <a href="<?php echo admin_url("widgets.php"); ?>">widget</a> ou do shortcode <code>[WOTracking]</code>
				</p>
				</td>
			</tr>
		</table>
		<table id="tabela_principal" >
			<!-- Quadro de Nova OS -->
			<tr class="box-principal" onclick="window.location = '<?php echo admin_url("admin.php?page=wot_criar_nova"); ?>';">
				<td style="width:20%;background:#488ffb url('<?php echo plugins_url('../imagens/add.png', __FILE__)?>') no-repeat center;"></td>
				<td style="width:70%;">
					<div id="textos">
						<h2>Cadastrar Ordem de Serviço</h2>
						<p>Clique aqui para registrar novas entradas de serviços na assistência</p>
					</div>
				</td>
			</tr>
			<!-- Quadro de Localizar OS -->
			<tr class="box-principal" style="margin-top:16px;" onclick="window.location = '<?php echo admin_url("admin.php?page=wot_consultar"); ?>';">
				<td style="width:20%;background:#ffd205 url('<?php echo plugins_url('../imagens/localizar.png', __FILE__)?>') no-repeat center;"></td>
				<td style="width:70%;">
					<div id="textos">
						<h2>Localizar Ordem de Serviço</h2>
						<p>Acompanhe o andamento da OS ou edite informações cadastradas</p>
					</div>
				</td>
			</tr>
			<!-- Quadro de Informações Empresa -->
			<tr class="box-principal" style="margin-top:16px;" onclick="window.location = '<?php echo admin_url("admin.php?page=wot_configuracoes"); ?>';">
				<td style="width:20%;background:#ff679a url('<?php echo plugins_url('../imagens/config.png', __FILE__)?>') no-repeat center;"></td>
				<td style="width:70%;">
					<div id="textos">
						<h2>Informações da Assistência</h2>
						<p>
							<!-- Exibe a mensagem de acordo com as opções preenchidas na página de Configurações -->
							<?php if ( get_option( 'wot_banner_empresa' ) == "" || get_option( 'wot_nome_empresa' ) == "" || get_option( 'wot_ender_empresa' ) == "" || get_option( 'wot_tel1_empresa' ) == "" || get_option( 'wot_info_empresa' ) == "" ) {
							echo "Você precisa preencher alguns dados importantes da empresa";
							}
							else { echo "Maravilha! Os dados da empresa estão devidamente preenchidos"; }?>
						</p>
					</div>
				</td>
			</tr>
		</table>	
	</div>
</div>