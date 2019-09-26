<?
// MOEDA_VIEW
function moeDaView($MOEDA_BD, $MODE) {

	// Formata moeda para exibição:
	// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.

	$W_MOEDA_BD   	  = "$MOEDA_BD";            	// Pega valor original do BD.
	$SEPAR_CENTS      = explode(".", $W_MOEDA_BD);  // Separa o valor dos centavos.
	$SOMENT_CENT      = $SEPAR_CENTS[1];            // Pega só os centavos.
	$CONT_CARACT_CENT = strlen($SOMENT_CENT);       // Conta a quantidade de caracteres.

	if ( $MODE=='TABLE' ) {
		$VW_MOEDA = 'R$ '.number_format($MOEDA_BD, $CONT_CARACT_CENT, ',', '.');
	}

	if ( $MODE=='FORM' ) {
		$VW_MOEDA = number_format($MOEDA_BD, $CONT_CARACT_CENT, ',', '.');
	}

	return $VW_MOEDA;
}

// DATA_VIEW
function daTaView($DATA_BD) {

	// Formata a Data para exibição:
	$dia = substr("$DATA_BD", -2);     // retorna "dd"
	$mes = substr("$DATA_BD", -5 ,2);  // retorna "mm"
	$ano = substr("$DATA_BD", -11 ,4); // retorna "yyyy"

	$VW_DATA = "$dia/$mes/$ano";

	return $VW_DATA;
}