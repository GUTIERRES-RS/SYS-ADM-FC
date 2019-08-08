    <div class="container-fluid">

<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Relatórios</li>
		</ol>

		<div class="row">
			<div class="col-12">
<!--Ajuda alerta hide show-->
<script>
$(document).ready(function(){
	$( "#o_ajuda" ).click(function() {
	  $( "#ajuda" ).toggleClass( "d-none" );
	});
});
</script>
				<h3><span class="text-warning">Relatórios</span> <small  class="text-muted" style="font-size:16px;">Aqui você gera os Relatórios. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong> Para gerar os relatórios é necessário preecher todos os campos.<br />
					No campo DATA você pode pesquisar por um Dia especifico Ex: "dd/mm/aaaa", Mês especifico Ex: "mm/aaaa" ou Ano especifico Ex: "aaaa"<br />
					Para gerar relatorios com o campo TIPO você tem que selecionar no campo GRUPO a opção TODOS e no campo TIPO uma das opções de Entrada e outra das opções de Saida para o correto funcionamento.
				</div>
<?	
if(isset($_POST['INSERT_LANC_GRUPO']))
{
	$LANC_GRUPO = $_POST['LANC_GRUPO'];
	$LANC_TIPO  = $_POST['LANC_TIPO'];
	$LANC_DATA  = $_POST['LANC_DATA'];
	
//print_r ($LANC_TIPO);
//print_r ('<br />');

if ( $LANC_TIPO=='' | $LANC_TIPO==' ' ) {} else {

	$SELECT_OPCOES_DELIMIT = implode('|', $LANC_TIPO);
	
	$OPCOES_TIPO  = "$SELECT_OPCOES_DELIMIT";
	
	$PIECES_OP_TIPO = explode("|", $OPCOES_TIPO);

	$COUNT_P_T = count ($PIECES_OP_TIPO);

	//NOVA FORMULA PARA CALCULAR OPÇÕES INICIO ----------------------------
	
	foreach($PIECES_OP_TIPO as $OPCOES_PROD_FOREACH){
		$sql_OP_TIPO[] = "id_lanc_tipo='{$OPCOES_PROD_FOREACH}'";
	}
	

	
	$sql_OPS_TIP = ' AND ('.implode(' OR ', $sql_OP_TIPO).')'; unset($sql_OP_TIPO);

//echo "$sql_OPS_TIP";

}

//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
$DATA = explode("/", $LANC_DATA);
$D_X_A = $DATA[0];
$D_X_B = $DATA[1];
$D_X_C = $DATA[2];

$N_DT_X = count($DATA);

//------------------------------------------------- INICIO 2 --------------------------------------------------------
?>
				<form action="?pag=painel&sec=index&vp=relatorios" method="post" enctype="multipart/form-data">
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" for="inputGroupSelect_DATA">DATA</span>
						</div>
						<input type="text" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" id="inputGroupSelect_DATA" class="form-control" aria-label="Titulo" aria-describedby="button-addon1" placeholder="00/00/0000" />
					</div>
					
					<div class="input-group mb-3">

						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">GRUPO</label>
						</div>
						<select name="LANC_GRUPO" class="custom-select" id="inputGroupSelect_LANC_GRUPO">

							<option value="*">TODOS</option>
<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];
	
if ($LANC_GRUPO==$VW_L_OP_ID_GRP) {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>" selected><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
} else {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?

}

}
?>

						</select>
						
					</div>
					
					<div class="input-group mb-3">
					
						<div class="input-group-prepend">
							<span class="input-group-text">TIPO</span>
						</div>

						<select name="LANC_TIPO[]" class="form-control selectpicker" data-max-options="2" data-live-search="true" multiple>

<?
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];

?>

							<optgroup label="<? echo "$VW_L_OP_GRP_DESCR";?>">

<?

$sql_OP_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$VW_L_OP_ID_GRP' ORDER BY descricao ASC;";
$result_OP_LANC_TIP  = mysqli_query($connect, $sql_OP_LANC_TIP);

while ($row_OP_LANC_TIP  = mysqli_fetch_assoc($result_OP_LANC_TIP )) {

	$VW_L_OP_ID_TIP    = $row_OP_LANC_TIP ['id_lanc_tipo'];
	$VW_L_OP_TIP_DESCR = $row_OP_LANC_TIP ['descricao'];
	
if ($LANC_TIPO==$VW_L_OP_ID_TIP) {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>" data-tokens="<? echo "$VW_L_OP_TIP_DESCR";?>" selected><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?
} else {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>" data-tokens="<? echo "$VW_L_OP_TIP_DESCR";?>"><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?

}

}
?>

							</optgroup>
<?
}
?>

						</select>

						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Gerar Relatorio
							</button>
						</div>

					</div>

				</form>
<?
}
//------------------------------------------------- FIM 2 --------------------------------------------------------
else
//------------------------------------------------- INICIO 1 --------------------------------------------------------
{
?>
				<form action="?pag=painel&sec=index&vp=relatorios" method="post" enctype="multipart/form-data">

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" for="inputGroupSelect_DATA">DATA</span>
						</div>
						<input type="text" name="LANC_DATA" value="<? echo "$TO_D/$TO_M/$TO_A";?>" id="inputGroupSelect_DATA" class="form-control" aria-label="Titulo" aria-describedby="button-addon1" placeholder="00/00/0000" />
					</div>

					<div class="input-group mb-3">

						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">GRUPO</label>
						</div>
						<select name="LANC_GRUPO" class="custom-select" id="inputGroupSelect_LANC_GRUPO">

							<option value="*">TODOS</option>
<?	
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
}
?>

						</select>

					</div>
					
					<div class="input-group mb-3">

						<div class="input-group-prepend">
							<span class="input-group-text">TIPO</span>
						</div>

						<select name="LANC_TIPO[]" class="form-control selectpicker" data-max-options="2" data-live-search="true" multiple>
<?
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];

?>

							<optgroup label="<? echo "$VW_L_OP_GRP_DESCR";?>">

<?

$sql_OP_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$VW_L_OP_ID_GRP' ORDER BY descricao ASC;";
$result_OP_LANC_TIP  = mysqli_query($connect, $sql_OP_LANC_TIP);

while ($row_OP_LANC_TIP  = mysqli_fetch_assoc($result_OP_LANC_TIP )) {

	$VW_L_OP_ID_TIP    = $row_OP_LANC_TIP ['id_lanc_tipo'];
	$VW_L_OP_TIP_DESCR = $row_OP_LANC_TIP ['descricao'];
	
if ($LANC_TIPO==$VW_L_OP_ID_TIP) {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>" data-tokens="<? echo "$VW_L_OP_TIP_DESCR";?>" selected><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?
} else {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>" data-tokens="<? echo "$VW_L_OP_TIP_DESCR";?>"><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?

}

}
?>

							</optgroup>
<?
}
?>

						</select>
						
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Gerar Relatorio
							</button>
						</div>

					</div>

				</form>
<?
}
//------------------------------------------------- FIM 1 --------------------------------------------------------
?>
				<table class="table table-striped">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">GRUPO</th>
					  <th scope="col">TIPO</th>
					  <th scope="col">OBSERVAÇÃO</th>
					  <th scope="col">VALOR</th>
					  <th scope="col">DATA</th>
					</tr>
				  </thead>

				  <tbody>

<?

if(isset($_POST['INSERT_LANC_GRUPO'])) {

if ( $COUNT_P_T=='1' ) {

// se somente um tipo for selecionado
?>
					<tr>
					  <th scope="row" colspan="7"><h5>Selecione um tipo de "Entrada" e um tipo de "Saida".</h5></th>
					</tr>
<?
} else {


if ($LANC_GRUPO=="*") {
	
$SQL_ID_GRP="";
$SQL_OPS_T="$sql_OPS_TIP";

} else {

$SQL_ID_GRP = "AND id_lanc_grupo='$LANC_GRUPO'";
$SQL_OPS_T="$sql_OPS_TIP";

}

if ( $N_DT_X=='1' ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_GRP="SELECT * FROM lancamentos WHERE id_empresa='$S_EMP_ID' $SQL_ID_GRP $SQL_OPS_T AND (YEAR(data) = '$D_X_A') ORDER BY id_lanc_grupo, data DESC;";
}

if ( $N_DT_X=='2' ) {
//echo "MÊS e ANO - OK";
$SQL_REL_GRP="SELECT * FROM lancamentos WHERE id_empresa='$S_EMP_ID' $SQL_ID_GRP $SQL_OPS_T AND (YEAR(data) = '$D_X_B' AND MONTH(data) = '$D_X_A') ORDER BY id_lanc_grupo, data DESC;";
}

if ( $N_DT_X=='3' ) {
//echo "DIA/MÊS/ANO - OK";
$SQL_REL_GRP="SELECT * FROM lancamentos WHERE id_empresa='$S_EMP_ID' $SQL_ID_GRP $SQL_OPS_T AND (YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A') ORDER BY id_lanc_grupo, data DESC;";
}
//echo "$SQL_REL_GRP<br />";

//--------------------------------------------------------------------------------------------------------------------------------------
$sql_LANC = "$SQL_REL_GRP";
$result_LANC  = mysqli_query($connect, $sql_LANC);

$NUM_LANC = mysqli_num_rows($result_LANC);

while ($row_LANC  = mysqli_fetch_assoc($result_LANC )) {

	$VW_LANC_L_ID     = $row_LANC ['id_lancamento'];
	$VW_LANC_E_ID     = $row_LANC ['id_empresa'];
	$VW_LANC_L_G_ID   = $row_LANC ['id_lanc_grupo'];
	$VW_LANC_L_T_ID   = $row_LANC ['id_lanc_tipo'];
	$VW_LANC_OBS      = $row_LANC ['observacao'];
	$VW_LANC_VALOR_BD = $row_LANC ['valor'];
	$VW_LANC_DATA_BD  = $row_LANC ['data'];
	$VW_LANC_ATIVO    = $row_LANC ['ativo'];

//Formata moeda para exibição: FUNÇÃO 2
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.

$VALOR_MOEDA_BD   = "$VW_LANC_VALOR_BD";            // Pega valor original do BD.
$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
$SOMENT_CENT      = $SEPAR_CENTS[1];                // Pega só os centavos.
$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.
	
$VW_LANC_VALOR = number_format($VW_LANC_VALOR_BD, $CONT_CARACT_CENT, ',', '.');
//echo "$VW_LANC_VALOR";
//-------------------------------------------------------------------------------------------------------------

//Formata a Data para exibição:
$dia = substr("$VW_LANC_DATA_BD", -2);     // retorna "dd"
$mes = substr("$VW_LANC_DATA_BD", -5 ,2);  // retorna "mm"
$ano = substr("$VW_LANC_DATA_BD", -11 ,4); // retorna "yyyy"
$VW_LANC_DATA = "$dia/$mes/$ano";

?>

					<tr>
					  <th scope="row"><? echo "$VW_LANC_L_ID";?></th>
<?
$sql_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_lanc_grupo='$VW_LANC_L_G_ID';";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$VW_L_GRP_DESCR = $row_LANC_GRP ['descricao'];

?>
					  <td><? echo "$VW_L_GRP_DESCR";?></td>
<?
}
?>

<?
$sql_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' AND id_lanc_tipo='$VW_LANC_L_T_ID';";
$result_LANC_TIP  = mysqli_query($connect, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$VW_L_TIP_DESCR = $row_LANC_TIP ['descricao'];

?>
					  <td><? echo "$VW_L_TIP_DESCR";?></td>
<?
}
?>
					  <td><? echo "$VW_LANC_OBS";?></td>
					  <td>R$ <? echo "$VW_LANC_VALOR";?></td>
					  <td><? echo "$VW_LANC_DATA";?></td>
					</tr>
<?
}

// Nenhum Resultado encontrado no BD
if ($NUM_LANC=='0') {
?>
					<tr>
					  <th scope="row" colspan="7"><h5>Nenhum lançamento encontrado para a data selecionada.</h5></th>
					</tr>
<?
}
if ($LANC_GRUPO=="*") {
	
$SQL_ID_GRP="";
$SQL_OPS_T="$sql_OPS_TIP";

} else {

$SQL_ID_GRP = "WHERE id_lanc_grupo='$LANC_GRUPO'";
$SQL_OPS_T="$sql_OPS_TIP";

}

$N="0";
$sql_LANC_GRP = "SELECT * FROM lanc_grupos $SQL_ID_GRP ORDER BY id_lanc_grupo ASC;";
//echo "$sql_LANC_GRP";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$ID_L_G    = $row_LANC_GRP ['id_lanc_grupo'];
	$DESCR_L_G = $row_LANC_GRP ['descricao'];

if ( $N_DT_X=='1' ) {
	
if ( $LANC_TIPO[0]=='') { $SQL_L_T_A = "$sql_OPS_TIP"; } else { $SQL_L_T_A= "AND id_lanc_tipo='$LANC_TIPO[0]'"; }
if ( $LANC_TIPO[1]=='') { $SQL_L_T_B = "$sql_OPS_TIP"; } else { $SQL_L_T_B = "AND id_lanc_tipo='$LANC_TIPO[1]'"; }
	
if ( $LANC_TIPO=='' | $LANC_TIPO==' ' ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' AND YEAR(data) = '$D_X_A';";
} else {
if ( $ID_L_G=="1" ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_A AND YEAR(data) = '$D_X_A';";
} else {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_B AND YEAR(data) = '$D_X_A';";
}
}

}

if ( $N_DT_X=='2' ) {

if ( $LANC_TIPO[0]=='') { $SQL_L_T_A = ""; } else { $SQL_L_T_A= "AND id_lanc_tipo='$LANC_TIPO[0]'"; }
if ( $LANC_TIPO[1]=='') { $SQL_L_T_B = ""; } else { $SQL_L_T_B = "AND id_lanc_tipo='$LANC_TIPO[1]'"; }

if ( $LANC_TIPO=='' | $LANC_TIPO==' ' ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' AND YEAR(data) = '$D_X_B' AND MONTH(data) = '$D_X_A';";
} else {
if ( $ID_L_G=="1" ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_A AND YEAR(data) = '$D_X_B' AND MONTH(data) = '$D_X_A';";
} else {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_B AND YEAR(data) = '$D_X_B' AND MONTH(data) = '$D_X_A';";

}
}

}

if ( $N_DT_X=='3' ) {

if ( $LANC_TIPO[0]=='') { $SQL_L_T_A = ""; } else { $SQL_L_T_A= "AND id_lanc_tipo='$LANC_TIPO[0]'"; }
if ( $LANC_TIPO[1]=='') { $SQL_L_T_B = ""; } else { $SQL_L_T_B = "AND id_lanc_tipo='$LANC_TIPO[1]'"; }

if ( $LANC_TIPO=='' | $LANC_TIPO==' ' ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A';";
} else {
if ( $ID_L_G=="1" ) {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_A AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A';";
} else {
//echo "ANO-OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOM="SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$ID_L_G' $SQL_L_T_B AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A';";
}
}

}

//echo "$SQL_REL_SOM<br />";

$sql_LANC_SOMA = "$SQL_REL_SOM";

    $result_LANC_SOMA = mysqli_query($connect, $sql_LANC_SOMA);
	
    while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
        
		$VW_TOTAL_BD = $row_LANC_SOMA["SOMA"];
		//echo "$VW_TOTAL_BD";

		// Cria um Array com os valores da soma
		$V_SOMA[$N] = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
		$N++; // aqui eu vou aumentando a variavel
		
//Formata moeda para exibição: FUNÇÃO
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.

$VALOR_MOEDA_BD   = "$VW_TOTAL_BD";            // Pega valor original do BD.
$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
$SOMENT_CENT      = $SEPAR_CENTS[1];                // Pega só os centavos.
$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.

if ($CONT_CARACT_CENT<"2") {$CONT_CARACT_CENT_T="2";} else {$CONT_CARACT_CENT_T="$CONT_CARACT_CENT";} // Verifica se e menor que 2.

$VW_TOTAL = number_format($VW_TOTAL_BD, $CONT_CARACT_CENT_T, ',', '.');
//echo "$VW_TOTAL";

?>
					<tr class="bg-secondary text-white">
					  <th scope="row" colspan="3"></th>
					  <th scope="row">TOTAL de <? echo "$DESCR_L_G"; ?></th>
					  <th scope="row">R$ <? echo "$VW_TOTAL"; ?></th>
					  <th scope="row" colspan="2"></th>
					</tr>
<?
}
}

$TOTAL_E_S_BD = $V_SOMA[0]-$V_SOMA[1];

if ( $TOTAL_E_S_BD<='0' ) { $BG_TR = "bg-danger text-white"; } else { $BG_TR = "bg-success text-white"; }

//Formata moeda para exibição: FUNÇÃO
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.

$VALOR_MOEDA_BD   = "$TOTAL_E_S_BD";            // Pega valor original do BD.
$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
//$SOMENT_CENT      = $SEPAR_CENTS[1];                // Pega só os centavos.
//echo "$SOMENT_CENT";
$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.

if ($CONT_CARACT_CENT<"2") {$CONT_CARACT_CENT_T="2";} else {$CONT_CARACT_CENT_T="$CONT_CARACT_CENT";} // Verifica se e menor que 2.

$VW_TOTAL_E_S = number_format($TOTAL_E_S_BD, $CONT_CARACT_CENT_T, ',', '.');
//echo "$VW_TOTAL";

if ($LANC_GRUPO=="*") {
?>
					<tr class="<? echo "$BG_TR";?>">
					  <th scope="row" colspan="3"></th>
					  <th scope="row">TOTAL de 
<?
$sql_LANC_GRP = "SELECT * FROM lanc_grupos ORDER BY id_lanc_grupo ASC;";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$ID_L_G    = $row_LANC_GRP ['id_lanc_grupo'];
	
	// Cria um Array com os valores da soma
	$D[$T] = $row_LANC_GRP ['descricao']; // aqui eu guardo em uma array o valor do while para ela nao substituir
	$T++; // aqui eu vou aumentando a variavel

}
$DESCR = implode(" - ", $D);
?>
					  <? echo "$DESCR "; ?>
					  </th>
					  <th scope="row">R$ <? echo "$VW_TOTAL_E_S"; ?></th>
					  <th scope="row" colspan="2"></th>
					</tr>
<?
} else {}
//------------------------------------------------------------------------------------------------------------------------------

}

} else {

// NADA

}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->