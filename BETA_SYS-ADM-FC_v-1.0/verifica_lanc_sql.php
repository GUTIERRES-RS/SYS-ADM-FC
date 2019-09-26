<?//-- INI UPDATE --
if(isset($_POST['UPDATE_LR_LP'])) {

	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_DATA       = $_POST['LANC_DATA'];

	$LNC_GRP_DESCR  = $_POST['LANC_GRP_DESCR'];
	$LNC_TIP_DESCR	= $_POST['LANC_TIP_DESCR'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_VALOR_BD   = $_POST['LANC_VALOR_BD'];
	$LNC_MODO_BD    = $_POST['LANC_MODO_BD'];
	$LNC_MODO_NEW   = $_POST['LANC_MODO_NEW'];
	
	$LNC_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_ATIVO = "1"; //Entra sempre como ativo

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
	$DATA_X = explode("/", $LNC_DATA);
	$D_X_D = $DATA_X[0];
	$D_X_M = $DATA_X[1];
	$D_X_A = $DATA_X[2];

	$COUNT_CRT = strlen($LNC_DATA); // Conta a quantidade de caracteres.

// Filtra o POST pra verificar se os parametros necessarios estão sendo enviados corretamente.
if ( $LNC_DATA=='' | $D_X_D=='00' | $D_X_M=='00' | $D_X_A=='0000' | $COUNT_CRT!='10' ) {

	$ALERT = "NO_ALTER";
	$INFO  = '<br / ><strong>LANÇAMENTO ID:</strong> '.$LNC_ID.'<br /><strong>DATA:</strong> '.$LNC_DATA.'<br /><strong>INVALIDA !!!</strong>';

} else {

// VERIFICA DIFERENÇA ENTRE A DATA ANTIGA E ATUAL DO LANCAMENTO.
	$LNC_DATA_BD = "$D_X_A-$D_X_M-$D_X_D";
	$LNC_DATA_TO = "$TO_A-$TO_M-$TO_D";

    $DATA_BD = strtotime("$LNC_DATA_BD");
    $DATA_TO = strtotime("$LNC_DATA_TO");

    $DIFERENCA = $DATA_TO - $DATA_BD;
	//DEBUG
    //echo "$DIFERENCA";

	if ( $DIFERENCA>='0' ) { $MODO_IF = "$LNC_MODO_NEW"; }
	if ( $DIFERENCA<'0' ) { $MODO_IF = "$LNC_MODO_BD"; }


//SQL Alterar informações para o BD.
	$query = "UPDATE lancamentos SET data='$LNC_DATA_BD', modo='$MODO_IF' WHERE id_lancamento='$LNC_ID';";
	//DEBUG
	//echo "$query<BR>";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_CLIENTE, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_CLIENTE);
	$result3 = mysqli_error($CONNECT_CLIENTE);

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3");

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_ALTER";
	$INFO  = '<strong>LANÇAMENTO ID:</strong> '.$LNC_ID.'<br /><strong>GRUPO:</strong> '.$LNC_GRP_DESCR.'<br /><strong>TIPO:</strong> '.$LNC_TIP_DESCR.'<br /><strong>OBSERVAÇÃO:</strong> '.$LNC_OBSERVACAO.'<br /><strong>VALOR:</strong> '.$LNC_VALOR.'<br /><strong>DATA:</strong> '.$LNC_DATA.'';
} else {
	$ALERT = "NO_ALTER";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

}

include ('alert_toasts.php');

// FIM TOSATS ALERTA

}
//-- END UPDATE --
?>