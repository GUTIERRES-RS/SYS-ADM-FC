<?	
if(isset($_POST['GERAR_RELATORIO']))
{
	$LANC_GRUPO = $_POST['LANC_GRUPO']; // Valores recebidos no POST
	echo "<pre>";
	//print_r ($LANC_GRUPO);
	var_dump ($LANC_GRUPO);
	echo "</pre>";
	
	// Faz a verificação de quantas opções foram selecionadas
	$SELECT_OPCOES_DELIMIT = implode('|', $LANC_GRUPO);
	$OPCOES_GRUPO  = "$SELECT_OPCOES_DELIMIT";
	$PIECES_OP_GRUPO = explode("|", $OPCOES_GRUPO);
	$COUNT_P_T = count ($PIECES_OP_GRUPO);
	$C_LANC_GRUPO = count($LANC_GRUPO);

	// Formata para o SELCT e SQL
	if ($C_LANC_GRUPO=='1') {

	foreach($PIECES_OP_GRUPO as $OPCOES_GRUPO_FOREACH){
		$SELCT_OP_GRP[] = "{$OPCOES_GRUPO_FOREACH}";
	}
	$sql_OPS_GRP = "'".implode(',', $SELCT_OP_GRP)."'"; unset($SELCT_OP_GRP);
	echo "$sql_OPS_GRP<br />";

	} else {

	foreach($PIECES_OP_GRUPO as $OPCOES_GRUPO_FOREACH){
		$SELCT_OP_GRP[] = "{$OPCOES_GRUPO_FOREACH}";
	}
	$sql_OPS_GRP = '['.implode(',', $SELCT_OP_GRP).']'; unset($SELCT_OP_GRP);
	echo "$sql_OPS_GRP<br />";

	}

	$LANC_TIPO  = $_POST['LANC_TIPO'];
	$LANC_DATA  = $_POST['LANC_DATA'];

?>
<script>
$(document).ready(function(){
	
$('.selectpicker').selectpicker('val', <? echo "$sql_OPS_GRP";?>);

});
</script>
<?
	//Formata a Data para BD: ex: 02/01/2019 para 2019-01-02
	$DATA = explode("/", $LANC_DATA);
	$D_X_A = $DATA[0];
	$D_X_B = $DATA[1];
	$D_X_C = $DATA[2];

	$N_DT_X = count($DATA);

} else {

	$LANC_DATA = "$TO_D/$TO_M/$TO_A";

?>
<script>
$(document).ready(function(){
	
$('.selectpicker').selectpicker('val', '0');

});
</script>
<?
	$LANC_GRUPO = "";
	$LANC_TIPO = "";

}

//------------------------------------------------- INICIO OPTIONS 1 --------------------------------------------------------
?>
				<form action="?pag=painel&sec=index&vp=relatorios" method="post" enctype="multipart/form-data">
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" for="inputGroupSelect_DATA">DATA</span>
						</div>
						<input type="text" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" id="inputGroupSelect_DATA" class="form-control" aria-label="Titulo" aria-describedby="button-addon1" placeholder="00/00/0000" />
					</div>
<?// INICIO SELECT GRUPO ?>
					<div class="input-group mb-3">

						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">GRUPO</label>
						</div>
						<select name="LANC_GRUPO[]" class="form-control selectpicker" id="inputGroupSelect_LANC_GRUPO" data-max-options="0" data-live-search="true" multiple>

							<option value="0" data-tokens="TODOS">TODOS</option>
<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];
	
if ($LANC_GRUPO==$VW_L_OP_ID_GRP) {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>" data-tokens="<? echo "$VW_L_OP_GRP_DESCR";?>" selected><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
} else {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>" data-tokens="<? echo "$VW_L_OP_GRP_DESCR";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?

}

}
?>

						</select>
						
					</div>
<?// FIM SELECT GRUPO ?>

<?// INICIO SELECT TIPO ?>
					<div class="input-group mb-3">
					
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_TIPO">TIPO</label>
						</div>
						<select name="LANC_TIPO" class="custom-select" id="inputGroupSelect_LANC_TIPO">

								<option value="0">TODOS</option>
<?
$sql_OP_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_TIP  = mysqli_query($connect, $sql_OP_LANC_TIP);

while ($row_OP_LANC_TIP  = mysqli_fetch_assoc($result_OP_LANC_TIP )) {

	$VW_L_OP_ID_TIP    = $row_OP_LANC_TIP ['id_lanc_tipo'];
	$VW_L_OP_TIP_DESCR = $row_OP_LANC_TIP ['descricao'];

?>



<?
	
if ($LANC_TIPO==$VW_L_OP_ID_TIP) {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>" selected><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?
} else {

?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>"><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?

}
?>

							</optgroup>
<?
}
?>

						</select>
<?// FIM SELECT TIPO ?>

						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="GERAR_RELATORIO">
								<i class="fa fa-fw fa-plus"></i>Gerar Relatorio
							</button>
						</div>

					</div>

				</form>
<?
//------------------------------------------------- FIM OPTIONS 1 --------------------------------------------------------
?>