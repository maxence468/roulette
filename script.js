/*
 * TP Roulette
 * script.js
 * Bastien Thouverez
 */
jQuery(document).ready(function($) {
	var jeu = 'nombre'; // ou 'parite'
	
    $("#selecteurJeu").click(function() {
		if(jeu == 'nombre') {
			jeu = 'parite';
			$("#tdJeuParite").show();
			$("#tdJeuNombre").hide();
			$("#tdJeuNombre input").val('');
		} else {
			jeu = 'nombre';
			$("#tdJeuParite").hide();
			$("#tdJeuNombre").show();	
			$(".checkBoxParite").prop('checked', false);
			$(".labelRadioParite").css('background', 'white');
		}
    });
	
	$(".checkBoxParite").css('display', 'none');
	
	$("#labelRadioPair").click(function() {
		$("#labelRadioPair").css('background', '#2196F3');
		$("#labelRadioImpair").css('background', 'white');
	});
	
	$("#labelRadioImpair").click(function() {
		$("#labelRadioImpair").css('background', '#2196F3');
		$("#labelRadioPair").css('background', 'white');
	});
	
});

