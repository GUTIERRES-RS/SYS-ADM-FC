<?// VERIFICA LANC SQL
include ('verifica_lanc_sql.php');
?>

	<div aria-live="polite" aria-atomic="true" style="position:relative;">
		<!-- Position it -->
		<div style="position:absolute; width:400px; top:10px; right:10px; z-index:1068;">

<?// VERIFICA LANC

$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' 
AND modo IN('LP','LR')
AND (YEAR(data) <= '".$TO_A."' 
AND MONTH(data) <= '".$TO_M."' 
AND DAY(data) <= '".$TO_D."') 
ORDER BY id_lanc_tipo, id_lancamento DESC;";

$result_LANC  = mysqli_query($CONNECT_CLIENTE, $SQL_REL_VW);

$NUM_ROWS_LANC = mysqli_num_rows($result_LANC);

while ($row_LANC = mysqli_fetch_assoc($result_LANC )) {

	$VW_LANC_L_ID     = $row_LANC ['id_lancamento'];
	$VW_LANC_E_ID     = $row_LANC ['id_empresa'];
	$VW_LANC_L_G_ID   = $row_LANC ['id_lanc_grupo'];
	$VW_LANC_L_T_ID   = $row_LANC ['id_lanc_tipo'];
	$VW_LANC_OBS      = $row_LANC ['observacao'];
	$VW_LANC_VALOR_BD = $row_LANC ['valor'];
	$VW_LANC_DATA_BD  = $row_LANC ['data'];
	$VW_LANC_MODO     = $row_LANC ['modo'];
	$VW_LANC_ATIVO    = $row_LANC ['ativo'];

//Formata moeda para exibição:
$VW_LANC_VALOR      = moeDaView($VW_LANC_VALOR_BD, 'TABLE');
$VW_LANC_VALOR_FORM = moeDaView($VW_LANC_VALOR_BD, 'FORM');
//echo "$VW_LANC_VALOR";
//-------------------------------------------------------------------------------------------------------------

//Formata a Data para exibição:
$VW_LANC_DATA = daTaView($VW_LANC_DATA_BD);
//echo "$VW_LANC_DATA";

if ($VW_LANC_MODO=='LR') { $D_MODO = 'Conta a Receber'; $B_MODO = 'RECEBER'; }
if ($VW_LANC_MODO=='LP') { $D_MODO = 'Conta a Pagar'; $B_MODO = 'PAGAR'; }

// TIPO DESCR
$SQL_DESC_TIP = "SELECT * FROM lanc_tipos WHERE id_lanc_tipo='".$VW_LANC_L_T_ID."';";
$result_DESC_TIP  = mysqli_query($CONNECT_PRIMARY, $SQL_DESC_TIP);

while ($row_DESC_TIP  = mysqli_fetch_assoc($result_DESC_TIP )) {
	$VW_L_TIP_DESCR = $row_DESC_TIP ['descricao'];
}

// GRUPO DESCR
$SQL_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='".$S_EMP_ID."';";
$result_LANC_GRP  = mysqli_query($CONNECT_CLIENTE, $SQL_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {
	$GRP_DESCR = $row_LANC_GRP ['descricao'];
}

$ALERT = 'VERIFICA_LANC';
$INFO =  $NUM_ROWS_LANC.' '.$SQL_REL_VW."\n";

if ( $ALERT=='VERIFICA_LANC' ) {
?>
			<div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-info">ATENÇÃO</span></strong>
				<small>Conta a <strong> <?=$B_MODO; ?></strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body">

				<div class="col-md-16">

					<div class="shadow card mb-4 bg-light">

						<div class="card-header"><strong><?=$D_MODO; ?>:</strong> <span class="badge badge-warning" style="font-size:14px;"><strong>ID:</strong> <?=$VW_LANC_L_ID; ?></span></div>

						<ul class="list-group list-group-flush">

							<li class="list-group-item"><strong>TIPO:</strong> <?=$VW_L_TIP_DESCR; ?></li>
							<li class="list-group-item"><strong>GRUPO:</strong> <?=$GRP_DESCR; ?></li>
							<li class="list-group-item"><strong>OBSERVAÇÃO:</strong> <?=$VW_LANC_OBS; ?></li>
							<li class="list-group-item"><strong>VALOR:</strong> <?=$VW_LANC_VALOR; ?></li>

						</ul>

					</div>

				</div>

				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

					<input type="hidden" name="LANC_ID" value="<?=$VW_LANC_L_ID; ?>" />
					<input type="hidden" name="LANC_GRP_DESCR" value="<?=$GRP_DESCR; ?>" />
					<input type="hidden" name="LANC_TIP_DESCR" value="<?=$VW_L_TIP_DESCR; ?>" />
					<input type="hidden" name="LANC_OBSERVACAO" value="<?=$VW_LANC_OBS; ?>" />
					<input type="hidden" name="LANC_VALOR" value="<?=$VW_LANC_VALOR; ?>" />
					<input type="hidden" name="LANC_VALOR_BD" value="<?=$VW_LANC_VALOR_BD; ?>" />
					<input type="hidden" name="LANC_MODO_BD" value="<?=$VW_LANC_MODO; ?>" />
					<input type="hidden" name="LANC_MODO_NEW" value="LD" />
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">DATA:</span>
						</div>
						<input type="text" class="form-control" name="LANC_DATA" value="<?="$VW_LANC_DATA";?>" />
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success text-white" name="UPDATE_LR_LP">
								<i class="fa fa-fw fa-usd" data-toggle="tooltip" data-placement="top" title="<?=$B_MODO; ?>"></i>
							</button>
						</div>
					</div>
					
				</form>

			  </div>
			</div>
<?
}
}
?>

		</div>

	</div>



	<script type="text/javascript">
	$(document).ready(function(){

		$(".toast").toast({ delay: 60000 });
		$('.toast').toast('show');

	});
	</script>
