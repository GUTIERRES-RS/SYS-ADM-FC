<!-- ALTERAR EMPRESA -->
<?

if(isset($_POST['ALT_EMPRESA']))

{

	$EMP_ID   = $_POST['ep_id'];
	$EMP_N_F  = $_POST['nome_fantasia'];
	$EMP_CNPJ = $_POST['cnpj'];
	$EMP_FONE = $_POST['fone'];

	//SQL Alterar informações para o BD.
	$query = "UPDATE empresas SET nome_fantasia='$EMP_N_F', cnpj='$EMP_CNPJ', fone='$EMP_FONE' WHERE id_empresa='$EMP_ID';";
	//echo '$query<BR>';

// INI TOSATS ALERTA

  	$result1 = !mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY); //mysqli_error($CONNECT_PRIMARY);

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//print_r("R3: $result3");	

	$R1 = '<strong>R1:</strong> '.$result1.'<br />';
	$R2 = '<strong>R2:</strong> '.$result2.'<br />';
	$R3 = '<strong>R3:</strong> '.$result3.'<br />';
	$R4 = '<strong>R4:</strong> '.$query.'';
	

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = 'OK_ALTER';
	$INFO  = '<strong>ID:</strong> '.$EMP_ID.' <strong>Nome:</strong> '.$EMP_N_F.'';
} else {
	$ALERT = 'NO_ALTER';
	$INFO  = '<br />'.$R1.' '.$R2.' '.$R3.' '.$R4.'';
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA

}
?>
<!-- ALTERAR EMPRESA -->