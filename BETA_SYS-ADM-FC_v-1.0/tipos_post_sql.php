<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$TIP_ID	   = $_POST['TIP_ID'];
	$TIP_DESCR = $_POST['TIP_DESCR'];
	
	$TIP_EMPRESA_ID = "$S_EMP_ID"; //Pegar valor da Session
	$TIP_ATIVO = "1"; //Entra sempre como ativo

	//SQL QUERY.
	$query = "INSERT INTO lanc_tipos (id_lanc_tipo, id_empresa, descricao, ativo) VALUES ('$TIP_ID','$TIP_EMPRESA_ID','$TIP_DESCR','$TIP_ATIVO');";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>NOVO TIPO</strong><br /><strong>DESCRIÇÃO:</strong> '.$TIP_DESCR.'';
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

	$TIP_ID	   = $_POST['TIP_ID'];
	$TIP_DESCR = $_POST['TIP_DESCR'];

	$TIP_ATIVO = "1"; //Entra sempre como ativo

	//SQL QUERY.
	$query = "UPDATE lanc_tipos SET descricao='$TIP_DESCR' WHERE id_lanc_tipo='$TIP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_ALTER";
	$INFO  = '<strong>TIPO ID:</strong> '.$TIP_ID.'<br /><strong>DESCRIÇÃO:</strong> '.$TIP_DESCR.'';
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
	$TIP_ID = $_POST['TIP_ID'];
	$TIP_DESCR = $_POST['TIP_DESCR'];

	//SQL QUERY.
	$query = "DELETE FROM lanc_tipos WHERE id_lanc_tipo = '$TIP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_CLIENTE, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_CLIENTE);
	$result3 = mysqli_error($CONNECT_CLIENTE);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_DELET";
	$INFO  = '<strong>TIPO ID:</strong> '.$TIP_ID.'<br /><strong>DESCRIÇÃO:</strong> '.$TIP_DESCR.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- DELETAR PRODUTO -->