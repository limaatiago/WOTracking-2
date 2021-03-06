<?php 

//wp_enqueue_style('namespace');

?>

<!-- Carrega um lembrete de preenchimento dos dados da assistência -->
<?php if ( get_option( 'wot_banner_empresa' ) == "" || get_option( 'wot_nome_empresa' ) == "" || get_option( 'wot_ender_empresa' ) == "" || get_option( 'wot_tel1_empresa' ) == "" || get_option( 'wot_info_empresa' ) == "" ) { ?>
<script>
	// alert('Você precisa preencher alguns dados importantes da empresa na página de Configurações');
	
function lembrete_config(){
   var dialog_box = confirm("Você pode imprimir! Mas para um resultado apropriado, precisa preencher alguns dados importantes na página de Configurações.\n\nClique em OK para editá-los agora.");
   if( dialog_box == true ){
	location.href="<?php echo admin_url("admin.php?page=wot_configuracoes"); ?>"
	  return true;
   }else{
	  return false;
   }
}

lembrete_config();
	
</script>
<?php } ?>

<!-- Carrega o comando de impressão quando a página carrega -->
<script>
window.print(); 
</script>

<div class="wrap">
	<!-- Título varia de acordo com a requisição -->
	<h2><?php
	if ( $imprimir == 'os' ) { echo "Versão para Impressão"; }
	elseif ( $imprimir == 'orcamento' ) { echo "Imprimir Orçamento"; }
	?>
	</h2>
	
	<!-- Informações da OS -->
	<div id="conteudo">
		<!-- Carrega as informações da empresa inseridas na página de configurações -->
		<table id="topo-os">
			<tbody>
				<tr>
					<td id="banner-empresa" width="74%">
						<img src="<?php echo get_option( 'wot_banner_empresa' ) ?>" width="500" height="70" />
					</td>
					<td id="informacoes-empresa" width="25%">
						<?php echo get_option( 'wot_ender_empresa' ) ?><br/>
						<?php
						if( get_option( 'wot_tel2_empresa' ) == "" ) { echo get_option( 'wot_tel1_empresa' ); }
						else { echo get_option( 'wot_tel1_empresa' ) . " / " . get_option( 'wot_tel2_empresa' ); }
						?><br/>
						<?php echo get_option( 'wot_email_empresa' ) ?><br/>
						<?php echo get_option( 'wot_site_empresa' ) ?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="infos-os">
			<b id="numero_os">OS <?php echo $os_info->id ?></b>
					<?php
					if ( $os_info->tipo_os == 2 ) {
					echo "Em Garantia";
					}
					?>
		</div>
		<div id="informacoes-da-os" style="margin:9px 0 3px 0;"> 
			<b>Data de Entrada:</b> <?php echo date('d/m/Y', strtotime( $os_info->data_entrada )) ?>
		</div>
		
		<div class="clear"></div>
		
		<table id="wot_tabela" class="widefat">
			<thead>
				<th colspan="12" id="dados-cliente"><b>Dados do Cliente</b></th>
			</thead>
			<tbody>
				<tr>
					<td colspan="6" width="50%"> <b>Nome:</b> <?php echo $os_info->nome_cliente_os ?> </td>
					<td colspan="6" width="50%"> <b>CPF/RG:</b> <?php echo $os_info->cpf_cliente_os ?> </td>
				</tr>
				<tr>
					<td colspan="12" width="50%"> <b>Endereço:</b> <?php echo $os_info->ender_cliente_os ?> </td>
				</tr>
				<?php
				/* Se o email não tiver sido preenchido, só exibe a linha do nome */
				if ( $os_info->fone_dois_cliente_os == "" & $os_info->email_cliente_os == "" ) { ?>
					<tr>
						<td colspan="12"> <b>Fone:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; }?></td>
					</tr>
				<?php }
				elseif ( $os_info->fone_dois_cliente_os == "" ) { ?>
					<tr>
						<td colspan="6" width="50%"> <b>Fone:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
						<td colspan="6" width="50%"> <b>E-mail:</b> <?php echo $os_info->email_cliente_os ?> </td>
					</tr>
				<?php }
				elseif ( $os_info->email_cliente_os == "" ) { ?>
				<tr>
					<td colspan="6" width="50%"> <b>Fone 1:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
					<td colspan="6" width="50%"> <b>Fone 2:</b> <?php echo $os_info->fone_dois_cliente_os; if ( $os_info->tipo_fone_dois_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
				</tr>
				<?php }
				else { ?>
				<tr>
					<td colspan="6" width="50%"> <b>Fones:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } echo "; " . $os_info->fone_dois_cliente_os; if ( $os_info->tipo_fone_dois_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
					<td colspan="6" width="50%"> <b>E-mail:</b> <?php echo $os_info->email_cliente_os ?> </td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
<?php

if ( $imprimir == 'os' ) { ?>
	<!-- Dados do Cliente -->
	
	<h2 id="titulo-produto">Dados do <?php echo $os_info->tipo_prod_os ?></h2>
	<!-- Dados do Produto -->
	<table id="wot_tabela" class="widefat">
		<thead>
			<th colspan="2" id="dados-produto"><b>Dados do <?php echo $os_info->tipo_prod_os ?></b></th>
		</thead>
		<tbody>
			<tr>
				<td colspan="1" width="50%"> <b>Marca:</b> <?php echo $os_info->marca_prod_os ?> </td>
				<td colspan="1" width="50%"> <b>Mecanismo:</b> <?php
					if ( $os_info->maquina_os == 1 ) {
					echo "Quartz";
					}
					elseif ( $os_info->maquina_os == 2 ) {
					echo "Autoquartz";
					} 
					elseif ( $os_info->maquina_os == 3 ) {
					echo "Automático";
					}
					elseif ( $os_info->maquina_os == 4 ) {
					echo "Corda manual";
					}
					?>  </td>
			</tr>
			<tr>
				<td colspan="1"> <b>Referência:</b> <?php if ( $os_info->ref_prod_os == "" ) { echo "---"; } else { echo $os_info->ref_prod_os; } ?></td>
				<td colspan="1"> <b>Modelo:</b> <?php if ( $os_info->mod_prod_os == "" ) { echo "---"; } else { echo $os_info->mod_prod_os; } ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Descrição:</b> <?php echo $os_info->desc_prod_os ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Características externas:</b> <?php echo $os_info->carac_prod_os ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Defeito(s) segundo o cliente:</b> <?php echo $os_info->def_prod_os ?> </td>
			</tr>
			<?php if ( $os_info->serv_prod_os == "" ) {} else { ?>
				<tr>
					<td colspan="2"> <b>Serviço(s) a executar:</b> <?php echo $os_info->serv_prod_os ?> </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<!-- Rodapé da OS -->
	<?php if ( get_option( 'wot_info_empresa' ) == "" ) {
		echo 	"<div id='observacoes-os'>
				<div id='assinatura-cliente'><span id='coluna-esquerda'>Estou de acordo com todas as condições citadas acima</span> <span id='coluna-direita'>Assinatura: _________________________________________________________________</span> </div>
				</div>"; }
		else {
		echo 	"<div id='observacoes-os'>
				<b>Importante:</b><br/>" . get_option( 'wot_info_empresa' ) . "
				<div id='assinatura-cliente'><span id='coluna-esquerda'>Estou de acordo com todas as condições citadas acima</span> <span id='coluna-direita'>Assinatura: _________________________________________________________________</span> </div>
				</div>";
		
		}
	?>

	<hr style="border:0;border-top:1px solid #ccc !important;width:100%;float:left;margin:50px 0;"></hr>
	
	<!-- OS 2 -->
	<div id="conteudo">
		<!-- Carrega as informações da empresa inseridas na página de configurações -->
		<table id="topo-os">
			<tbody>
				<tr>
					<td id="banner-empresa" width="74%">
						<img src="<?php echo get_option( 'wot_banner_empresa' ) ?>" width="500" height="70" />
					</td>
					<td id="informacoes-empresa" width="25%">
						<?php echo get_option( 'wot_ender_empresa' ) ?><br/>
						<?php
						if( get_option( 'wot_tel2_empresa' ) == "" ) { echo get_option( 'wot_tel1_empresa' ); }
						else { echo get_option( 'wot_tel1_empresa' ) . " / " . get_option( 'wot_tel2_empresa' ); }
						?><br/>
						<?php echo get_option( 'wot_email_empresa' ) ?><br/>
						<?php echo get_option( 'wot_site_empresa' ) ?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="infos-os">
			<b id="numero_os">OS <?php echo $os_info->id ?></b>
					<?php
					if ( $os_info->tipo_os == 2 ) {
					echo "Em Garantia";
					}  ?>
		</div>
		<div id="informacoes-da-os" style="margin:9px 0 3px 0;"> 
			<b>Data de Entrada:</b> <?php echo date('d/m/Y', strtotime( $os_info->data_entrada )) ?>
		</div>
		
	<div class="clear"></div>
	
	<table id="wot_tabela" class="widefat">
		<thead>
			<th colspan="12" id="dados-cliente"><b>Dados do Cliente</b></th>
		</thead>
		<tbody>
			<tr>
				<td colspan="6" width="50%" > <b>Nome:</b> <?php echo $os_info->nome_cliente_os ?> </td>
				<td colspan="6" width="50%" > <b>CPF/RG:</b> <?php echo $os_info->cpf_cliente_os ?> </td>
			</tr>
			<tr>
				<td colspan="12" width="50%"> <b>Endereço:</b> <?php echo $os_info->ender_cliente_os ?> </td>
			</tr>
			<?php
			/* Se o email não tiver sido preenchido, só exibe a linha do nome */
			if ( $os_info->fone_dois_cliente_os == "" & $os_info->email_cliente_os == "" ) { ?>
				<tr>
					<td colspan="12"> <b>Fone:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; }?></td>
				</tr>
			<?php }
			elseif ( $os_info->fone_dois_cliente_os == "" ) { ?>
				<tr>
					<td colspan="6" width="50%"> <b>Fone:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
					<td colspan="6" width="50%"> <b>E-mail:</b> <?php echo $os_info->email_cliente_os ?> </td>
				</tr>
			<?php }
			elseif ( $os_info->email_cliente_os == "" ) { ?>
			<tr>
				<td colspan="6" width="50%"> <b>Fone 1:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
				<td colspan="6" width="50%"> <b>Fone 2:</b> <?php echo $os_info->fone_dois_cliente_os; if ( $os_info->tipo_fone_dois_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
			</tr>
			<?php }
			else { ?>
			<tr>
				<td colspan="6" width="50%"> <b>Fones:</b> <?php echo $os_info->fone_um_cliente_os; if ( $os_info->tipo_fone_um_os == 2 ) { echo " (WhatsApp)"; } echo "; " . $os_info->fone_dois_cliente_os; if ( $os_info->tipo_fone_dois_os == 2 ) { echo " (WhatsApp)"; } ?> </td>
				<td colspan="6" width="50%"> <b>E-mail:</b> <?php echo $os_info->email_cliente_os ?> </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<h2 id="titulo-produto">Dados do <?php echo $os_info->tipo_prod_os ?></h2>
	<!-- Dados do Produto -->
	<table id="wot_tabela" class="widefat">
		<thead>
			<th colspan="2" id="dados-produto"><b>Dados do <?php echo $os_info->tipo_prod_os ?></b></th>
		</thead>
		<tbody>
			<tr>
				<td colspan="1" width="50%"> <b>Marca:</b> <?php echo $os_info->marca_prod_os ?> </td>
				<td colspan="1" width="50%"> <b>Mecanismo:</b> <?php
					if ( $os_info->maquina_os == 1 ) {
					echo "Quartz";
					}
					elseif ( $os_info->maquina_os == 2 ) {
					echo "Autoquartz";
					} 
					elseif ( $os_info->maquina_os == 3 ) {
					echo "Automático";
					}
					elseif ( $os_info->maquina_os == 4 ) {
					echo "Corda manual";
					}
					?>  </td>
			</tr>
			<tr>
				<td colspan="1"> <b>Referência:</b> <?php if ( $os_info->ref_prod_os == "" ) { echo "---"; } else { echo $os_info->ref_prod_os; } ?></td>
				<td colspan="1"> <b>Modelo:</b> <?php if ( $os_info->mod_prod_os == "" ) { echo "---"; } else { echo $os_info->mod_prod_os; } ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Descrição:</b> <?php echo $os_info->desc_prod_os ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Características externas:</b> <?php echo $os_info->carac_prod_os ?> </td>
			</tr>
			<tr>
				<td colspan="2"> <b>Defeito(s) segundo o cliente:</b> <?php echo $os_info->def_prod_os ?> </td>
			</tr>
			<?php if ( $os_info->serv_prod_os == "" ) {} else { ?>
				<tr>
					<td colspan="2"> <b>Serviço(s) a executar:</b> <?php echo $os_info->serv_prod_os ?> </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<!-- Rodapé da OS -->
	<?php if ( get_option( 'wot_info_empresa' ) == "" ) {
		echo 	"<div id='observacoes-os'>
				<div id='assinatura-cliente'><span id='coluna-esquerda'>Estou de acordo com todas as condições citadas acima</span> <span id='coluna-direita'>Assinatura: _________________________________________________________________</span> </div>
				</div>"; }
		else {
		echo 	"<div id='observacoes-os'>
				<b>Importante:</b><br/>" . get_option( 'wot_info_empresa' ) . "
				<div id='assinatura-cliente'><span id='coluna-esquerda'>Estou de acordo com todas as condições citadas acima</span> <span id='coluna-direita'>Assinatura: _________________________________________________________________</span> </div>
				</div>";
		
		}
	?>

<?php }
elseif ( $imprimir == 'orcamento' ) {
?>
	<h3 id="titulo-produto">Orçamento</h3>
	<span id="data-orc"><b>Data do Orçamento:</b> <?php echo date('d/m/Y', strtotime( $os_info->data_orcam )) ?></span>
	<!-- Dados do Produto -->
	<table id="wot_tabela" class="widefat">
		<thead>
			<th colspan="2" id="dados-produto"><b>Orçamento</b></th>
		</thead>
		<tbody>
			<tr>
				<td colspan="1" width="50%"> <b>Marca:</b> <?php echo $os_info->marca_prod_os ?> </td>
				<td colspan="1" width="50%"> <?php if ( $os_info->ref_prod_os == "" ) { echo "<b>Modelo:</b> " . $os_info->mod_prod_os . ""; } elseif ( $os_info->ref_prod_os == "" & $os_info->mod_prod_os == "" ) { echo "<b>Referência:</b> ---"; } else { echo "<b>Referência:</b> " . $os_info->ref_prod_os . ""; } ?></td>
			</tr>
			<tr>
				<td colspan="2"> <b>Defeito(s) segundo o cliente:</b> <?php echo $os_info->def_prod_os ?> </td>
			</tr>
			<tr>
				<td colspan="1" width="50%"> <b>Calibre:</b> <?php if ( $os_info->calibre_prod == "" ) { echo "---"; } else { echo $os_info->calibre_prod; } ?> </td>
				<td colspan="1" width="50%"> <b>Mecanismo:</b> <?php
					if ( $os_info->maquina_os == 1 ) {
					echo "Quartz";
					}
					elseif ( $os_info->maquina_os == 2 ) {
					echo "Autoquartz";
					} 
					elseif ( $os_info->maquina_os == 3 ) {
					echo "Automático";
					}
					elseif ( $os_info->maquina_os == 4 ) {
					echo "Corda manual";
					}
					?> 
				</td>
			</tr>
		</tbody>
	</table>
	<table id="wot_tabela" class="widefat">
			<thead>
				<tr>
					<th scope="col" style="width:15%;" id="nome_mo"></th>
					<th scope="col" id="desc_serv"><b>Descrição</b></th>
					<th scope="col" style="width:3%;" align="center" id="essencial_serv"><b>E</b></th>
					<th scope="col" style="width:5%;" id="qtd_serv"><b>Qtd.</b></th>
					<th scope="col" style="width:15%;" id="nome_peca"><b>Valor (R$</b>)</th>
					<th scope="col" style="width:15%;" id="valor_serv" colspan="2"><b>Subtotal (R$)</b></th>
				</tr>
			</thead>
			<tbody>
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
					<td style='text-align:left;'> ";
					if ( $query_linhas->e_o_serv == 1 ) { echo "X"; }
					else { echo "-"; } 
			echo "	
					</td>
					<td> " . $query_linhas->qtd_serv . " </td>
					<td> " . str_replace(".", ",", $query_linhas->val_serv) . " </td>
					<td> " . str_replace(".", ",", $query_linhas->val_total) . " </td>
				</tr> ";	
		}
		?>
			</tbody>
		</table>
		<table id="tabela-bottom">
			<tr>
				<td align="left"><b>Valor Total:</b> R$ <?php echo str_replace(".", ",", $os_info->valor_total) ?><?php if ( $os_info->descon_pag != "0.00" ) { echo " - " . $os_info->descon_pag . " = R$ " . $os_info->valor_final; } ?></td>
				<td align="center"><b>Tempo de Serviço:</b> <?php echo $os_info->dias_serv . " dias" ?></td>
				<td align="right"><b>Garantia:</b> <?php echo $os_info->tempo_garantia . " meses" ?></td>
			</tr>
		</table>
		
		<div id='observacoes-os' style='font-size: 10pt !important; border-top: 30px;'>
			Serviço executado por: _______________________________________, em: ________/________/________</div>
		</div>
		
<?php } 

/* OS Indisponível */
else {
	
	echo "Versão para impressão indisponível. Tente novamente!";

}
?>		
		<div id='nao-mostrar-impressao' class='buttons-bottom'>
		<div id='coluna-esquerda'>
			<a href="<?php echo admin_url("admin.php?page=wot_os&num=" . $num_os . "")?>"><button class='button'>Editar OS</button></a>
		</div>
		<div id='coluna-direita'>
			<button name='botao-salvarimprimir' class='button button-primary' value='Imprimir' onClick='window.print();'>Imprimir</button>
		</div>
		</div>
	</div>
</div>
<div class="clear"></div>