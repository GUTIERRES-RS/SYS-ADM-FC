<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$LNC_L_ID_TIP  = $_POST['L_TIP_ID'];
	$LNC_GRUPO_TIP = $_POST['LANC_GRUPO_TIP'];
	$LNC_DESCR_TIP = $_POST['DESCR_TIP'];
	
	$LNC_TIP_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_TIP_ATIVO = "1"; //Entra sempre como ativo
      
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lanc_tipos (id_lanc_tipo, id_empresa, id_lanc_grupo, descricao, ativo) VALUES ('$LNC_L_ID_TIP','$LNC_TIP_ID_EMPRESA','$LNC_GRUPO_TIP','$LNC_DESCR_TIP','$LNC_TIP_ATIVO');";

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

	$LNC_L_ID_TIP  = $_POST['L_TIP_ID'];
	$LNC_GRUPO_TIP = $_POST['LANC_GRUPO_TIP'];
	$LNC_DESCR_TIP = $_POST['DESCR_TIP'];

	$LNC_TIP_ATIVO = "1"; //Entra sempre como ativo
     
?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "UPDATE lanc_tipos SET id_lanc_grupo='$LNC_GRUPO_TIP', descricao='$LNC_DESCR_TIP' WHERE id_lanc_tipo='$LNC_L_ID_TIP';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>

	<strong>Sucesso:</strong> Tipo <span class="text-danger">"ID: <? echo "$LNC_L_ID_TIP";?>"</span> atualizado!
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
	$LNC_L_ID_TIP  = $_POST['L_TIP_ID'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lanc_tipos WHERE id_lanc_tipo = '$LNC_L_ID_TIP';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Tipo <span class="text-danger">"ID: <? echo "$LNC_L_ID_TIP";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR PRODUTO -->