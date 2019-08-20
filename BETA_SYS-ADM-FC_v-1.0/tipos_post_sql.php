<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$TIP_ID	   = $_POST['TIP_ID'];
	$TIP_DESCR = $_POST['TIP_DESCR'];
	
	$TIP_EMPRESA_ID = "$S_EMP_ID"; //Pegar valor da Session
	$TIP_ATIVO = "1"; //Entra sempre como ativo
      
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lanc_tipos (id_lanc_tipo, id_empresa, descricao, ativo) VALUES ('$TIP_ID','$TIP_EMPRESA_ID','$TIP_DESCR','$TIP_ATIVO');";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>
	<strong>Sucesso:</strong> Tipo Inserido!
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

	$TIP_ID	   = $_POST['TIP_ID'];
	$TIP_DESCR = $_POST['TIP_DESCR'];

	$TIP_ATIVO = "1"; //Entra sempre como ativo
     
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "UPDATE lanc_tipos SET descricao='$TIP_DESCR' WHERE id_lanc_tipo='$TIP_ID';";
	echo "$query<BR>";

  	mysqli_query($connect, $query);// envia a query
?>

	<strong>Sucesso:</strong> Tipo <span class="text-danger">"ID: <? echo "$TIP_ID";?>"</span> atualizado!
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
	$TIP_ID = $_POST['TIP_ID'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lanc_tipos WHERE id_lanc_tipo = '$TIP_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Tipo <span class="text-danger">"ID: <? echo "$TIP_ID";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR PRODUTO -->