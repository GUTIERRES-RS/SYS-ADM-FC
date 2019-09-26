<!-- INSERIR NOVO USUARIO -->
<?
if(isset($_POST['INSERT']))

{   // Informações referente ao usuario.
	$USER_ID        = $_POST['USR_ID'];
	$USER_EMP_ID    = $_POST['EMP_ID'];
	$USER_NAME      = $_POST['nome'];
	$USER_LOGIN     = $_POST['usuario'];
	$USER_SENHA     = $_POST['senha'];
	$USER_ATIVO     = $_POST['ativo'];
	$USER_NIVEL     = $_POST['nivel'];
	
	$USER_SENHA_ENC = md5($USER_SENHA);
	
	if ( $USER_NIVEL=='1' ) { $USER_NIVEL_TXT = "WebMaster"; }
	if ( $USER_NIVEL=='2' ) { $USER_NIVEL_TXT = "Administrador"; }
	if ( $USER_NIVEL=='3' ) { $USER_NIVEL_TXT = "Usuario"; }

	// SQL QUERY
	$query = "INSERT INTO users_painel(id, id_empresa, nome, usuario, senha, ativo, nivel) VALUES ('$USER_ID','$USER_EMP_ID','$USER_NAME','$USER_LOGIN','$USER_SENHA_ENC','$USER_ATIVO','$USER_NIVEL');";

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
	$INFO  = '<strong>NOVO USUÁRIO:</strong><br />
              <strong>NOME:</strong> '.$USER_NAME.'<br />
              <strong>LOGIN:</strong> '.$USER_LOGIN.'<br />
			  <strong>SENHA:</strong> '.$USER_SENHA.'<br />
			  <strong>NIVEL:</strong> '.$USER_NIVEL_TXT.'';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- INSERIR NOVO USUARIO -->

<!-- ALTERAR USUARIO -->
<?
if(isset($_POST['ALTERAR']))

{   // Informações referente ao usuario.
	$USER_ID        = $_POST['USR_ID'];
	$USER_EMP_ID    = $_POST['EMP_ID'];
	$USER_NAME      = $_POST['nome'];
	$USER_LOGIN     = $_POST['usuario'];
	$USER_SENHA_OLD = $_POST['senha_old'];
	$USER_SENHA_NEW = $_POST['senha_new'];
	$USER_ATIVO     = $_POST['ativo'];
	$USER_NIVEL     = $_POST['nivel'];
	
	// VERIFICA SE A SENHA FOI ALTERADA E LIBERA PARA A VARIAVEL $USER_SENHA
	if ($USER_SENHA_NEW == "") {
	$USER_SENHA     = "$USER_SENHA_OLD";
	$USER_SENHA_ENC = "$USER_SENHA";
	$USER_SENHA_TXT = "Não alterada";
	} else {
	$USER_SENHA     = "$USER_SENHA_NEW";
	$USER_SENHA_ENC = md5($USER_SENHA);
	$USER_SENHA_TXT = "$USER_SENHA_NEW";
	}
	
	if ( $USER_NIVEL=='1' ) { $USER_NIVEL_TXT = "WebMaster"; }
	if ( $USER_NIVEL=='2' ) { $USER_NIVEL_TXT = "Administrador"; }
	if ( $USER_NIVEL=='3' ) { $USER_NIVEL_TXT = "Usuario"; }
	
	// SQL QUERY
	$query = "UPDATE users_painel SET id_empresa='$USER_EMP_ID', nome='$USER_NAME', usuario='$USER_LOGIN', senha='$USER_SENHA_ENC', ativo='$USER_ATIVO', nivel='$USER_NIVEL' WHERE id='$USER_ID';";

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
	$INFO  = '<strong>USUÁRIO:</strong><br />
              <strong>NOME:</strong> '.$USER_NAME.'<br />
              <strong>LOGIN:</strong> '.$USER_LOGIN.'<br />
			  <strong>SENHA:</strong> '.$USER_SENHA_TXT.'<br />
			  <strong>NIVEL:</strong> '.$USER_NIVEL_TXT.'';
} else {
	$ALERT = "NO_ALTER";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- ALTERAR USUARIO -->

<!-- ATIVAR USUARIO -->
<?

if(isset($_POST['ATIVAR']))

{
	$USER_ID     = $_POST['USR_ID'];
	$USER_NAME   = $_POST['nome'];
	$USER_ATIVO  = $_POST['ativo'];
	
	if( $USER_ATIVO=='1' ) { $USER_ATIVO_TXT = "ATIVO"; }
	if( $USER_ATIVO=='0' ) { $USER_ATIVO_TXT = "DESATIVADO"; }

	// SQL QUERY
	$query = "UPDATE users_painel SET ativo='$USER_ATIVO' WHERE id='$USER_ID';";

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
	$INFO  = '<strong>USUÁRIO:</strong><br />
			  <strong>ID.:</strong> '.$USER_ID.'<br />
              <strong>NOME:</strong> '.$USER_NAME.'<br />
			  <strong>STATUS:</strong> '.$USER_ATIVO_TXT.'';
} else {
	$ALERT = "NO_ALTER";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- ATIVAR USUARIO -->

<!-- DELETAR USUARIO -->
<?

if(isset($_POST['DELETAR']))

{
	$USER_ID   = $_POST['USR_ID'];
	$USER_NAME = $_POST['nome'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM users_painel WHERE id = '$USER_ID'";

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
	$ALERT = "OK_DELET";
	$INFO  = '<strong>USUÁRIO:</strong><br />
              <strong>ID.:</strong> '.$USER_ID.'<br />
              <strong>NOME:</strong> '.$USER_NAME.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- DELETAR USUARIO -->