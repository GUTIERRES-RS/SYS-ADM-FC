<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_GRP_ID		= $_POST['LANC_GRP_ID'];
	$LNC_TIP_ID		= $_POST['LANC_TIP_ID'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_DATA       = $_POST['LANC_DATA'];
	$LNC_MODO       = $_POST['LANC_MODO'];
	
	$LNC_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_ATIVO = "1"; //Entra sempre como ativo

//Formata a Moeda para BD: ex: 1.000,00 para 1000.00 ou 1 para 1.00

$LNC_VAL_X_P   = explode(".",$LNC_VALOR);
$LNC_VAL_I_S_P = implode("", $LNC_VAL_X_P);

$LNC_VAL_X_V   = explode(",",$LNC_VAL_I_S_P);
$LNC_VAL_I_S_V = implode(".",$LNC_VAL_X_V);

$LNC_VALOR_BD = number_format($LNC_VAL_I_S_V, 2, '.', '');

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
$DATA_X = explode("/", $LNC_DATA);
$D_X_D = $DATA_X[0];
$D_X_M = $DATA_X[1];
$D_X_A = $DATA_X[2];

$LNC_DATA_BD = "$D_X_A-$D_X_M-$D_X_D";

	//SQL Alterar informações para o BD.
	$query = "INSERT INTO $TABLE_SELECT (id_lancamento, id_empresa, id_lanc_grupo, id_lanc_tipo, observacao, valor, data, modo, ativo) VALUES ('$LNC_ID','$LNC_ID_EMPRESA','$LNC_GRP_ID','$LNC_TIP_ID','$LNC_OBSERVACAO','$LNC_VALOR_BD','$LNC_DATA_BD','$LNC_MODO','$LNC_ATIVO');";
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
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>NOVO LANÇAMENTO</strong><br /><strong>OBSERVAÇÃO:</strong> '.$LNC_OBSERVACAO.'<br /><strong>VALOR:</strong> R$ '.$LNC_VALOR.'<br /><strong>DATA:</strong> '.$LNC_DATA.'';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- INSERIR NOVO PRODUTO -->

<!-- ALTERAR PRODUTO -->
<?

if(isset($_POST['ALTERAR']))

{

	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_GRP_ID		= $_POST['LANC_GRP_ID'];
	$LNC_TIP_ID		= $_POST['LANC_TIP_ID'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_DATA       = $_POST['LANC_DATA'];
	$LNC_MODO       = $_POST['LANC_MODO'];
	
	$LNC_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_ATIVO = "1"; //Entra sempre como ativo

//Formata a Moeda para BD: ex: 1.000,00 para 1000.00 ou 1 para 1.00

$LNC_VAL_X_P   = explode(".",$LNC_VALOR);
$LNC_VAL_I_S_P = implode("", $LNC_VAL_X_P);

$LNC_VAL_X_V   = explode(",",$LNC_VAL_I_S_P);
$LNC_VAL_I_S_V = implode(".", $LNC_VAL_X_V);

$LNC_VALOR_BD = number_format($LNC_VAL_I_S_V, 2, '.', '');

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
$DATA_X = explode("/", $LNC_DATA);
$D_X_D = $DATA_X[0];
$D_X_M = $DATA_X[1];
$D_X_A = $DATA_X[2];

$LNC_DATA_BD = "$D_X_A-$D_X_M-$D_X_D";

	//SQL Alterar informações para o BD.
	$query = "UPDATE $TABLE_SELECT SET id_lanc_grupo='$LNC_GRP_ID', id_lanc_tipo='$LNC_TIP_ID', observacao='$LNC_OBSERVACAO', valor='$LNC_VALOR_BD', data='$LNC_DATA_BD' WHERE id_lancamento='$LNC_ID';";
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
	$INFO  = '<strong>LANÇAMENTO ID:</strong> '.$LNC_ID.'<br /><strong>OBSERVAÇÃO:</strong> '.$LNC_OBSERVACAO.'<br /><strong>VALOR:</strong> R$ '.$LNC_VALOR.'<br /><strong>DATA:</strong> '.$LNC_DATA.'';
} else {
	$ALERT = "NO_ALTER";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA

}
?>

<!-- ALTERAR PRODUTO -->

<!-- DELETAR PRODUTO -->
<?

if(isset($_POST['DELETAR']))

{
	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_DATA       = $_POST['LANC_DATA'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM $TABLE_SELECT WHERE id_lancamento = '$LNC_ID';";
	// echo "$query";

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
	$ALERT = "OK_DELET";
	$INFO  = '<strong>LANÇAMENTO ID:</strong> '.$LNC_ID.'<br /><strong>OBSERVAÇÃO:</strong> '.$LNC_OBSERVACAO.'<br /><strong>VALOR:</strong> R$ '.$LNC_VALOR.'<br /><strong>DATA:</strong> '.$LNC_DATA.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- DELETAR PRODUTO -->