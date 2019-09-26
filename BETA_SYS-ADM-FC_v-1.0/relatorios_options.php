<?	
if(isset($_POST['GERAR_RELATORIO']))
{
	// INI RECEBE valores do POST GERAR_RELATORIO
	$LANC_DATA  = $_POST['LANC_DATA'];
	$LANC_GRUPO = $_POST['LANC_GRUPO'];
	$LANC_TIPO  = $_POST['LANC_TIPO'];

	// DEBUG "LANC_DATA", "LANC_GRUPO", "LANC_TIPO".
	//print_r ($LANC_DATA);
	//echo "<br />";
	//print_r ($LANC_GRUPO);
	//echo "<br />";
	//print_r ($LANC_TIPO);
	//echo "<br />";
	// FIM RECEBE valores do POST GERAR_RELATORIO

	// INI TRATAMENTO DAS INFORMAÇÔES RECEBIDAS DO POST.

	// INI LANC_DATA
	// Separa a data em 3 campos
	$DATA = explode("/", $LANC_DATA);
	$D_X_A = $DATA[0];
	$D_X_B = $DATA[1];
	$D_X_C = $DATA[2];

	$C_DATA = count($DATA);
	// FIM LANC_DATA
	
	// INI LANC_GRUPO
	// Insere o delimitador para as opções de GRUPO e separa elas.
	$SEL_OPS_GRP_DELIMIT = implode(',', $LANC_GRUPO);
	
	//DEBUG "SEL_OPS_GRP_DELIMIT"
	//print_r ($SEL_OPS_GRP_DELIMIT);
	
	// Conta quantas opções foram selecionadas.
	$C_LANC_GRUPO = count($LANC_GRUPO);
	
	// DEBUG "C_LANC_GRUPO"
	//echo "C_LANC_GRUPO: $C_LANC_GRUPO <br />";

	// Formata para o SELECT se for uma 'OP' ou mais de uma [OP,OP,OP] opção
	if ($C_LANC_GRUPO=='1') {

	$SELECT_OPS_GRP = "'".$SEL_OPS_GRP_DELIMIT."'";

	} else {
		
	$SELECT_OPS_GRP = "[".$SEL_OPS_GRP_DELIMIT."]";

	}
	// FIM LANC_GRUPO
	
	// INI LANC_TIPO
	// Formata para o SELECT 'OP'.
	$SELECT_OPS_TIP = "'".$LANC_TIPO."'";
	// FIM LANC_TIPO

	// FIM TRATAMENTO DAS INFORMAÇÔES RECEBIDAS NO POST.

?>
<script>
$(document).ready(function(){
	
$('#LANC_GRUPO').selectpicker('val', <? echo "$SELECT_OPS_GRP";?>);
	
$('#LANC_TIPO').selectpicker('val', <? echo "$SELECT_OPS_TIP";?>);

});
</script>
<?

} else {

	$LANC_DATA = "$TO_D/$TO_M/$TO_A";

	// INI LANC_DATA
	// Separa a data em 3 campos
	$DATA = explode("/", $LANC_DATA);
	$D_X_A = $DATA[0];
	$D_X_B = $DATA[1];
	$D_X_C = $DATA[2];

	$C_DATA = count($DATA);
	// FIM LANC_DATA

?>
<script>
$(document).ready(function(){
	
$('#LANC_GRUPO').selectpicker('val', '0');
	
$('#LANC_TIPO').selectpicker('val', '0');

});
</script>
<?
	$LANC_GRUPO = '0';
	$LANC_TIPO = '0';

}

//------------------------------------------------- INI OPTIONS 1 --------------------------------------------------------
?>
				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" for="LANC_DATA">DATA</span>
						</div>
						<input type="text" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" id="LANC_DATA" class="form-control" aria-label="Titulo" aria-describedby="button-addon1" placeholder="00/00/0000" />
					</div>
<?// INI SELECT GRUPO ?>
					<div class="input-group mb-3">

						<div class="input-group-prepend">
							<label class="input-group-text" for="LANC_GRUPO">GRUPO</label>
						</div>
						<select id="LANC_GRUPO" name="LANC_GRUPO[]" class="form-control selectpicker" data-max-options="0" data-live-search="true" data-style="custom-select" data-width="20%" multiple>

							<option value="0" data-tokens="TODOS">TODOS</option>
<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($CONNECT_CLIENTE, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>" data-tokens="<? echo "$VW_L_OP_GRP_DESCR";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
}
?>

						</select>
						
					</div>
<?// FIM SELECT GRUPO ?>

<?// INI SELECT TIPO ?>
					<div class="input-group mb-3">
					
						<div class="input-group-prepend">
							<label class="input-group-text" for="LANC_TIPO">TIPO</label>
						</div>
						<select id="LANC_TIPO" name="LANC_TIPO" class="form-control selectpicker" data-max-options="1" data-style="custom-select" data-width="20%" multiple>

							<option value="0">TODOS</option>
<?
$sql_OP_LANC_TIP = "SELECT * FROM lanc_tipos ORDER BY descricao DESC;";
$result_OP_LANC_TIP  = mysqli_query($CONNECT_PRIMARY, $sql_OP_LANC_TIP);

while ($row_OP_LANC_TIP  = mysqli_fetch_assoc($result_OP_LANC_TIP )) {

	$VW_L_OP_ID_TIP    = $row_OP_LANC_TIP ['id_lanc_tipo'];
	$VW_L_OP_TIP_DESCR = $row_OP_LANC_TIP ['descricao'];

?>
							<option value="<? echo "$VW_L_OP_ID_TIP";?>"><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?
}
?>

						</select>

						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="GERAR_RELATORIO">
								<i class="fa fa-fw fa-plus"></i>Gerar Relatorio
							</button>
						</div>

					</div>
<?// FIM SELECT TIPO ?>

				</form>
<?
//------------------------------------------------- FIM OPTIONS 1 --------------------------------------------------------
?>