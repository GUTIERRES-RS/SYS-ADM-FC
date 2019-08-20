<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$GRP_ID    = $_POST['GRP_ID'];
	$GRP_DESCR = $_POST['GRP_DESCR'];
	
	$GRP_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$GRP_ATIVO   = "1"; //Entra sempre como ativo
      
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lanc_grupos (id_lanc_grupo, id_empresa, descricao, ativo) VALUES ('$GRP_ID','$GRP_EMPRESA','$GRP_DESCR','$GRP_ATIVO');";
	//echo "$query<BR>";

  	mysqli_query($connect, $query);// envia a query

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

	$GRP_ID    = $_POST['GRP_ID'];
	$GRP_DESCR = $_POST['GRP_DESCR'];

	$GRP_ATIVO   = "1"; //Entra sempre como ativo
     
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "UPDATE lanc_grupos SET descricao='$GRP_DESCR' WHERE id_lanc_grupo='$GRP_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>

	<strong>Sucesso:</strong> Grupo <span class="text-danger">"ID: <? echo "$GRP_ID";?>"</span> atualizado!
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

	$GRP_ID    = $_POST['GRP_ID'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lanc_grupos WHERE id_lanc_grupo = '$GRP_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Grupo <span class="text-danger">"ID: <? echo "$GRP_ID";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR PRODUTO -->