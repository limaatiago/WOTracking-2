jQuery(document).ready(function($){

	/* INPUTS DE NÚMEROS */

	// Cadastro OS
	$( '#cpf_cliente, #rg_cliente, #num_cpf, #fone_um_cliente, #fone_dois_cliente, #cep_cliente, #num_cliente' ).keyup(function() {
		this.value = this.value.replace(/[^0-9\.]/g,'').replace('.','');
	});

	// Orçamento
	$( '#qtd_orc, #valor_servi, #valor_desc, #valor_total, #valor-total, #tempo-serv, #tempo-garantia' ).keyup(function() {
		this.value = this.value.replace(/[^0-9\,.]/g,'');
	});

	// Faturamento
	$( '#descon_pag, #val_total, #val_final' ).keyup(function() {
		this.value = this.value.replace(/[^0-9\,.]/g,'');
	});


	/* CÁLCULO ORÇAMENTO */

	$( '#wot_tabela input' ).blur(function(e) {
		var quantidade = $('#qtd_orc').val().replace(',','.');
		var valor_servi = $('#valor_servi').val().replace(',','.');
		
		var equacao_orc	= quantidade * valor_servi;
		// var equacao_orc	= quantidade * ( + (+valor_servi) - (+valor_desc) );
		
		$('#valor_total').val(equacao_orc);

	});


	/* CÁLCULO FATURAMENTO */

	$( 'input' ).blur(function(e) {
		var val_total = $('#val_total').val().replace(',','.');
		var desconto = $('#descon_pag').val().replace(',','.');
		
		var equacao_fat	= val_total - desconto;
		
		$('#val_final').val(equacao_fat);

	});



	/* UPLOADER DO BANNER */

	var custom_uploader;
	$('#upload_image_button, #upload_image').click(function(e) {
		e.preventDefault();
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Selecionar Imagem',
			button: {
			text: 'Selecionar Imagem'
			},
			multiple: false
		});
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#upload_image').val(attachment.url);
		});
		custom_uploader.open();
	});
	
	/* UPLOADER FOTOS */

	var custom_uploader;
	$('#upload_photo_button1, #upload_photo1').click(function(e) {
		e.preventDefault();
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Anexar Imagens',
			button: {
			text: 'Anexar Imagens'
			},
			multiple: true
		});
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#upload_photo1').val(attachment.url);
		});
		custom_uploader.open();
	});
	
	var custom_uploader2;
	$('#upload_photo_button2, #upload_photo2').click(function(e) {
		e.preventDefault();
		if (custom_uploader2) {
			custom_uploader2.open();
			return;
		}
		custom_uploader2 = wp.media.frames.file_frame = wp.media({
			title: 'Anexar Imagens',
			button: {
			text: 'Anexar Imagens'
			},
			multiple: true
		});
		custom_uploader2.on('select', function() {
			attachment = custom_uploader2.state().get('selection').first().toJSON();
			$('#upload_photo2').val(attachment.url);
		});
		custom_uploader2.open();
	});

});