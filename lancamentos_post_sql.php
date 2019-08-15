<!-- INSERIR NOVO PRODUTO -->
<?

if(isset($_POST['INSERT']))

{

	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_GRP_ID		= $_POST['LANC_GRP_ID'];
	$LNC_TIP_ID		= $_POST['LANC_TIP_ID'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_DATA       = $_POST['LANC_DATA'];
	
	$LNC_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_ATIVO = "1"; //Entra sempre como ativo

//Formata a Moeda para BD: ex: 1.000,00 para 1000.00 ou 1 para 1.00

$LNC_VAL_X_P   = explode(".",$LNC_VALOR);
$LNC_VAL_I_S_P = implode("", $LNC_VAL_X_P);

$LNC_VAL_X_V   = explode(",",$LNC_VAL_I_S_P);
$LNC_VAL_I_S_V = implode(".",$LNC_VAL_X_V);

$LNC_VALOR_BD = number_format($LNC_VAL_I_S_V, 2, '.', '');

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
$DATA_X = explode("/", $LNC_DATA);
$D_X_D = $DATA_X[0];
$D_X_M = $DATA_X[1];
$D_X_A = $DATA_X[2];

$LNC_DATA_BD = "$D_X_A-$D_X_M-$D_X_D";

?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "INSERT INTO lancamentos (id_lancamento, id_empresa, id_lanc_grupo, id_lanc_tipo, observacao, valor, data, ativo) VALUES ('$LNC_ID','$LNC_ID_EMPRESA','$LNC_GRP_ID','$LNC_TIP_ID','$LNC_OBSERVACAO','$LNC_VALOR_BD','$LNC_DATA_BD','$LNC_ATIVO');";
	//echo "$query<BR>";
	
  	mysqli_query($connect, $query);// envia a query
?>
	<strong>Sucesso:</strong> Lançamento Inserido!
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

	$LNC_ID			= $_POST['LANC_ID'];
	$LNC_GRP_ID		= $_POST['LANC_GRP_ID'];
	$LNC_TIP_ID		= $_POST['LANC_TIP_ID'];
	$LNC_OBSERVACAO = $_POST['LANC_OBSERVACAO'];
	$LNC_VALOR      = $_POST['LANC_VALOR'];
	$LNC_DATA       = $_POST['LANC_DATA'];
	
	$LNC_ID_EMPRESA = "$S_EMP_ID"; //Pegar valor da Session
	$LNC_ATIVO = "1"; //Entra sempre como ativo

//Formata a Moeda para BD: ex: 1.000,00 para 1000.00 ou 1 para 1.00

$LNC_VAL_X_P   = explode(".",$LNC_VALOR);
$LNC_VAL_I_S_P = implode("", $LNC_VAL_X_P);

$LNC_VAL_X_V   = explode(",",$LNC_VAL_I_S_P);
$LNC_VAL_I_S_V = implode(".", $LNC_VAL_X_V);

$LNC_VALOR_BD = number_format($LNC_VAL_I_S_V, 2, '.', '');

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
$DATA_X = explode("/", $LNC_DATA);
$D_X_D = $DATA_X[0];
$D_X_M = $DATA_X[1];
$D_X_A = $DATA_X[2];

$LNC_DATA_BD = "$D_X_A-$D_X_M-$D_X_D";

?>
<div class="alert alert-success alert-dismissible" role="alert">
<?
	//SQL Alterar informações para o BD.
	$query = "UPDATE lancamentos SET id_lanc_grupo='$LNC_GRP_ID', id_lanc_tipo='$LNC_TIP_ID', observacao='$LNC_OBSERVACAO', valor='$LNC_VALOR_BD', data='$LNC_DATA_BD' WHERE id_lancamento='$LNC_ID';";
	//echo "$query<BR>";

  	mysqli_query($connect, $query);// envia a query

?>

	<strong>Sucesso:</strong> Lançamento <span class="text-danger">"ID: <? echo "$LNC_ID";?>"</span> atualizado!
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
	$LNC_ID	= $_POST['LANC_ID'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM lancamentos WHERE id_lancamento = '$LNC_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
?>	
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>Sucesso:</strong> Lançamento <span class="text-danger">"ID: <? echo "$LNC_ID";?>"</span> apagado!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
<?
}
?>

<!-- DELETAR PRODUTO -->