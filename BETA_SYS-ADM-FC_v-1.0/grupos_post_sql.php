<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$GRP_ID    = $_POST['GRP_ID'];
	$GRP_DESCR = $_POST['GRP_DESCR'];
	
	$GRP_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$GRP_ATIVO   = "1"; //Entra sempre como ativo

	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lanc_grupos (id_lanc_grupo, id_empresa, descricao, ativo) VALUES ('$GRP_ID','$GRP_EMPRESA','$GRP_DESCR','$GRP_ATIVO');";
	//echo "$query<BR>";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($connect, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($connect);
	$result3 = mysqli_error($connect);

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
	$INFO  = '<strong>NOVO GRUPO</strong><br /><strong>DESCRIÇÃO:</strong> '.$GRP_DESCR.'';
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

	$GRP_ID    = $_POST['GRP_ID'];
	$GRP_DESCR = $_POST['GRP_DESCR'];

	$GRP_ATIVO   = "1"; //Entra sempre como ativo

	//SQL Alterar informações para o BD.
	$query = "UPDATE lanc_grupos SET descricao='$GRP_DESCR' WHERE id_lanc_grupo='$GRP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($connect, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($connect);
	$result3 = mysqli_error($connect);

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
	$INFO  = '<strong>GRUPO ID:</strong> '.$GRP_ID.'<br /><strong>DESCRIÇÃO:</strong> '.$GRP_DESCR.'';
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

	$GRP_ID    = $_POST['GRP_ID'];
	$GRP_DESCR = $_POST['GRP_DESCR'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lanc_grupos WHERE id_lanc_grupo = '$GRP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($connect, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($connect);
	$result3 = mysqli_error($connect);

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
	$INFO  = '<strong>GRUPO ID:</strong> '.$GRP_ID.'<br /><strong>DESCRIÇÃO:</strong> '.$GRP_DESCR.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- DELETAR PRODUTO -->