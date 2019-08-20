<!-- INSERIR NOVO USUARIO -->
<?
if(isset($_POST['INSERT']))

{   // Informações referente ao usuario.
	$USER_ID        = $_POST['p_id'];
	$USER_NAME      = $_POST['nome'];
	$USER_LOGIN     = $_POST['usuario'];
	$USER_SENHA     = $_POST['senha'];
	$USER_ATIVO     = $_POST['ativo'];
	$USER_NIVEL     = $_POST['nivel'];
	
	$USER_ID_EMP    = "S_EMP_ID";
	
	$USER_SENHA_ENC = md5($USER_SENHA);
	
	// Consulta a senha antiga no BD.
	$sql_SENHA = "SELECT * FROM users_painel WHERE id='$USER_ID';";
		$result_SENHA  = mysqli_query($connect, $sql_SENHA);

		while ($row_SENHA  = mysqli_fetch_assoc($result_SENHA )) {

			$view_USER_SENHA     = $row_SENHA ['senha'];

		}

	$query = "INSERT INTO users_painel(id, id_empresa, nome, usuario, senha, ativo, nivel) VALUES ('$USER_ID','$USER_ID_EMP','$USER_NAME','$USER_LOGIN','$USER_SENHA_ENC','$USER_ATIVO','$USER_NIVEL');";   //query para enviar os dados para o banco

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";  

?>

<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
  <p><strong>Usuário INSERIDO com sucesso.</strong></p>
  <p>
  <strong>Nome: </strong><?echo "$USER_NAME";?><br />
  <strong>Login: </strong><?echo "$USER_LOGIN";?><br />
  <strong>Senha: </strong><?echo "$USER_SENHA";?><br />
  <strong>Nivel: </strong><? if ($USER_NIVEL=='2') {echo "Administrador";} if ($USER_NIVEL=='3') {echo "Usuario";}?>
  </p>
  
</div>

<?
}
?>

<!-- INSERIR NOVO USUARIO -->

<!-- ALTERAR USUARIO -->
<?
if(isset($_POST['ALTERAR']))

{   // Informações referente ao usuario.
	$USER_ID        = $_POST['p_id'];
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
	
	
	$query = "UPDATE users_painel SET nome='$USER_NAME', usuario='$USER_LOGIN', senha='$USER_SENHA_ENC', ativo='$USER_ATIVO', nivel='$USER_NIVEL' WHERE id='$USER_ID';";   //query para enviar os dados para o banco

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";  

?>

<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
  <p><strong>Usuário ALTERADO com sucesso.</strong></p>
  <p>
  <strong>Nome: </strong><?echo "$USER_NAME";?><br />
  <strong>Login: </strong><?echo "$USER_LOGIN";?><br />
  <strong>Senha: </strong><?echo "$USER_SENHA_TXT";?><br />
  <strong>Nivel: </strong><? if ($USER_NIVEL=='1') {echo "WebMaster";} if ($USER_NIVEL=='2') {echo "Administrador";} if ($USER_NIVEL=='3') {echo "Usuario";}?>
  </p>
  
</div>

<?
}
?>

<!-- ALTERAR USUARIO -->

<!-- ATIVAR USUARIO -->
<?

if(isset($_POST['ATIVAR']))

{
	$USER_ID     = $_POST['p_id'];
	$USER_ATIVO  = $_POST['ativo'];

	//SQL deleta informação do BD.
	$query = "UPDATE users_painel SET ativo='$USER_ATIVO' WHERE id='$USER_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
<? if ($USER_ATIVO=='0') { ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Usuário <span class="text-danger"><strong>"<? echo "ID.: $USER_ID";?>"</strong></span> desativado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<? } else { ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Usuário <span class="text-danger"><strong>"<? echo "ID.: $USER_ID";?>"</strong></span> Ativado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<? } ?>
<?
}
?>

<!-- ATIVAR USUARIO -->

<!-- DELETAR USUARIO -->
<?

if(isset($_POST['DELETAR']))

{
	$USER_ID   = $_POST['p_id'];
	$USER_NAME = $_POST['nome'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM users_painel WHERE id = '$USER_ID'";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Usuário <span class="text-danger">"<? echo "$USER_NAME";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR USUARIO -->