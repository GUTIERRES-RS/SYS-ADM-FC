<?
//------------------------------------------------- INI POST OPTIONS INSERT_LANC --------------------------------------------------------

// Se a Data não for Atualizada mantem o dia de hj
$LANC_DATA = "$TO_D/$TO_M/$TO_A";

if(isset($_POST['INSERT_LANC'])) {
	
	// INI RECEBE valores do POST GERAR_RELATORIO
	$LANC_DATA  = $_POST['LANC_DATA'];

	$LANC_GRP_ID_DESCR = $_POST['LANC_GRP_ID_DESCR'];
	
	$X_L_G_I_D = explode("|", $LANC_GRP_ID_DESCR);
	$LANC_GRP_ID = $X_L_G_I_D[0];
	$LANC_GRP_DESCR = $X_L_G_I_D[1];

	$LANC_DATA   = $_POST['LANC_DATA'];
	//echo "$LANC_DATA";
	
	$COUNT_CRT = strlen($LANC_DATA); // Conta a quantidade de caracteres.

// Filtra o POST pra verificar se os parametros necessarios estão sendo enviados corretamente.
if ( $LANC_GRP_ID_DESCR=='' | $LANC_GRP_ID_DESCR=='0' | $LANC_DATA=='' | $D_X_A=='00' | $D_X_B=='00' | $D_X_C=='0000' | $COUNT_CRT!='10' ) {

// INI TOSATS ALERTA

	$ALERT = "NO_FILTER";
	$INFO  = '<strong>Aviso:</strong> Para inserir ou editar '.$TITULO.' é necessário que todos os campos sejam preenchidos.<br />No campo DATA a mesma deve estar completa.<br /> Ex: "dd/mm/aaaa" e no campo GRUPO pelo menos um deve ser selecionado.';

include ('alert_toasts.php');

// FIM TOSATS ALERTA

} else {

include ('lancamentos_modal_insert.php');

?>

<script type="text/javascript">
	$(document).ready(function() {

        $('#Modal_INSERT').modal('show');

		$('#LANC_GRP_ID_DESCR').selectpicker('val', <? echo "'".$LANC_GRP_ID_DESCR."'";?>);

    });
</script>
<?

}

} else {

if ( isset($_POST['INSERT']) || isset($_POST['LANC_EDIT']) || isset($_POST['ALTERAR']) || isset($_POST['DELETAR']) ) {

	//Formata a Data para consulta SQL separando DD/MM/AAAA
	$LANC_DATA   	   = $_POST['LANC_DATA'];
	$LANC_GRP_ID 	   = $_POST['LANC_GRP_ID'];
	$LANC_GRP_ID_DESCR = $_POST['LANC_GRP_ID_DESCR'];
	
?>
<script type="text/javascript">
	$(document).ready(function() {

        $('#Modal_INSERT').modal('show');

		$('#LANC_GRP_ID_DESCR').selectpicker('val', <? echo "'".$LANC_GRP_ID_DESCR."'";?>);

    });
</script>
<?

}

}

	$DATA_W = explode("/", $LANC_DATA);
	$D_X_A = $DATA_W[0];
	$D_X_B = $DATA_W[1];
	$D_X_C = $DATA_W[2];

//------------------------------------------------- FIM POST OPTIONS INSERT_LANC --------------------------------------------------------
?>

				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
	
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" for="inputGroupSelect_DATA">DATA</span>
						</div>
						<input type="text" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" id="inputGroupSelect_DATA" class="form-control" aria-label="Titulo" aria-describedby="button-addon1" placeholder="00/00/0000" />
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">GRUPO</span>
						</div>

						<select id="LANC_GRP_ID_DESCR" name="LANC_GRP_ID_DESCR" class="form-control selectpicker" data-max-options="1" data-live-search="true" data-style="custom-select" data-width="20%" multiple>

<?							
$sql_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
//echo "$sql_GRP";
$result_GRP  = mysqli_query($CONNECT_CLIENTE, $sql_GRP);

while ($row_GRP  = mysqli_fetch_assoc($result_GRP )) {

	$VW_GRP_ID    = $row_GRP ['id_lanc_grupo'];
	$VW_GRP_E_ID  = $row_GRP ['id_empresa'];
	$VW_GRP_DESCR = $row_GRP ['descricao'];
	$VW_GRP_ATIVO = $row_GRP ['ativo'];
	


?>
							<option value="<? echo "$VW_GRP_ID";?>|<? echo "$VW_GRP_DESCR";?>"><? echo "$VW_GRP_DESCR";?></option>
<?
}
?>

						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC">
								<i class="fa fa-fw fa-plus"></i>Inserir novo item
							</button>
						</div>
					</div>

				</form>
