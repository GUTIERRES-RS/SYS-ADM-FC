<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$LNC_G_ID     = $_POST['L_G_ID'];
	$LNC_G_DESCR  = $_POST['DESCRICAO'];
	
	$LNC_G_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_G_ATIVO = "1"; //Entra sempre como ativo
      
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lanc_grupos (id_lanc_grupo, id_empresa, descricao, ativo) VALUES ('$LNC_G_ID','$LNC_G_ID_EMPRESA','$LNC_G_DESCR','$LNC_G_ATIVO');";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>
	<strong>Sucesso:</strong> Grupo Inserido!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

</div>
<?
}
?>

<!-- INSERIR NOVO PRODUTO -->

<!-- ALTERAR PRODUTO -->
<?

if(isset($_POST['ALTERAR']))

{

	$LNC_G_ID     = $_POST['L_G_ID'];
	$LNC_G_DESCR  = $_POST['DESCRICAO'];

	$LNC_G_ATIVO = "1"; //Entra sempre como ativo
     
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "UPDATE lanc_grupos SET descricao='$LNC_G_DESCR' WHERE id_lanc_grupo='$LNC_G_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>

	<strong>Sucesso:</strong> Grupo <span class="text-danger">"ID: <? echo "$LNC_G_ID";?>"</span> atualizado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?
}
?>

<!-- ALTERAR PRODUTO -->

<!-- DELETAR PRODUTO -->
<?

if(isset($_POST['DELETAR']))

{

	$LNC_G_ID     = $_POST['L_G_ID'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lanc_grupos WHERE id_lanc_grupo = '$LNC_G_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Grupo <span class="text-danger">"ID: <? echo "$LNC_G_ID";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR PRODUTO -->