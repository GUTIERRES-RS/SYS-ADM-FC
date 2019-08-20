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

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Informações alteradas.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>
<!-- ALTERAR EMPRESA -->