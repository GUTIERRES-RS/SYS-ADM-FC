    <div class="container-fluid">
<?
if( $_GET['md']== 'diario' ) {

	$TABLE_SELECT = "lancamentos";
	$TITULO       = "Lançamentos Diarios";
	$MODO         = "LD";
	//echo "$TABLE_SELECT";
}

if( $_GET['md']== 'pagar' ) {

	$TABLE_SELECT = "lancamentos";
	$TITULO       = "Contas a Pagar";
	$MODO         = "LP";
	//echo "$TABLE_SELECT";
}

if( $_GET['md']== 'receber' ) {

	$TABLE_SELECT = "lancamentos";
	$TITULO       = "Contas a Receber";
	$MODO         = "LR";
	//echo "$TABLE_SELECT";
}
?>
<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active"><?=$TITULO; ?></li>
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
				<h3><span class="text-warning"><?=$TITULO; ?></span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta <?=$TITULO; ?>. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar <?=$TITULO; ?> e necessario que todos os campos sejam preenchidos.<br />
					No campo DATA a mesma deve estar completa Ex: "dd/mm/aaaa" e no campo GRUPO uma opção deve ser selecionada para Inserir Novo Item.
				</div>

<?
// DEBUG
//echo '<span class="badge badge-secondary">DATA BASE:</span> <span class="badge badge-warning">'.$DB_CLIENTE.'</span>';
// Aqui vai o recebimento das opções e tratamento primario para geração dos relatorios
include ('lancamentos_options.php');
?>
			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">

				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">GRUPO</th>
					  <th scope="col">TIPO</th>
					  <th scope="col">OBSERVAÇÃO</th>
					  <th scope="col">VALOR</th>
					  <th scope="col">DATA</th>
					  <th scope="col" class="text-center" style="width:30px;">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>
<?

$SALDO_GERAL_DATA='0';

$SQL_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='".$S_EMP_ID."';";
// DEBUG SQL_LANC_GRP
//echo "$SQL_LANC_GRP<br />";

$result_LANC_GRP  = mysqli_query($CONNECT_CLIENTE, $SQL_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$GRP_ID    = $row_LANC_GRP ['id_lanc_grupo'];
	$GRP_DESCR = $row_LANC_GRP ['descricao'];

$SQL_REL_VW="SELECT * FROM $TABLE_SELECT WHERE id_empresa='".$S_EMP_ID."' AND modo='".$MODO."'
AND id_lanc_grupo='".$GRP_ID."' 
AND (YEAR(data) = '".$D_X_C."' AND MONTH(data) = '".$D_X_B."' AND DAY(data) = '".$D_X_A."') 
ORDER BY id_lanc_tipo, id_lancamento DESC;";

// DEBUG SQL_REL_VW
//echo "$SQL_REL_VW<br />";

$result_LANC  = mysqli_query($CONNECT_CLIENTE, $SQL_REL_VW);

$NUM_ROWS_LANC = mysqli_num_rows($result_LANC);
//DEBUG NUM_ROWS_LANC
//echo "$NUM_ROWS_LANC<br />";

if ( $NUM_ROWS_LANC=="0" ) {
	
} else {

?>
					<tr class="bg-info text-white">
					  <th scope="row" colspan="7">GRUPO: <? echo "$GRP_DESCR"; ?></th>
					</tr>
<?

while ($row_LANC  = mysqli_fetch_assoc($result_LANC )) {

	$VW_LANC_L_ID     = $row_LANC ['id_lancamento'];
	$VW_LANC_E_ID     = $row_LANC ['id_empresa'];
	$VW_LANC_L_G_ID   = $row_LANC ['id_lanc_grupo'];
	$VW_LANC_L_T_ID   = $row_LANC ['id_lanc_tipo'];
	$VW_LANC_OBS      = $row_LANC ['observacao'];
	$VW_LANC_VALOR_BD = $row_LANC ['valor'];
	$VW_LANC_DATA_BD  = $row_LANC ['data'];
	$VW_LANC_ATIVO    = $row_LANC ['ativo'];

//Formata moeda para exibição:
$VW_LANC_VALOR      = moeDaView($VW_LANC_VALOR_BD, 'TABLE');
$VW_LANC_VALOR_FORM = moeDaView($VW_LANC_VALOR_BD, 'FORM');
//echo "$VW_LANC_VALOR";
//-------------------------------------------------------------------------------------------------------------

//Formata a Data para exibição:
$VW_LANC_DATA = daTaView($VW_LANC_DATA_BD);
//echo "$VW_LANC_DATA";


$LANC_ID = $_POST['LANC_ID'];

if ( $VW_LANC_L_ID=="$LANC_ID" ) { $BG_TR_L="bg-warning"; } else { $BG_TR_L=""; }

?>

					<tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><? echo "$VW_LANC_L_ID";?></th>
					  <td><? echo "$GRP_DESCR";?></td>

<?
$SQL_DESC_TIP = "SELECT * FROM lanc_tipos WHERE id_lanc_tipo='".$VW_LANC_L_T_ID."';";
$result_DESC_TIP  = mysqli_query($CONNECT_PRIMARY, $SQL_DESC_TIP);

while ($row_DESC_TIP  = mysqli_fetch_assoc($result_DESC_TIP )) {

	$VW_L_TIP_DESCR = $row_DESC_TIP ['descricao'];

?>
					  <td><? echo "$VW_L_TIP_DESCR";?></td>
<?
}
?>
					  <td><? echo "$VW_LANC_OBS";?></td>
					  <td><? echo "$VW_LANC_VALOR";?></td>
					  <td><? echo "$VW_LANC_DATA";?></td>
					  <td class="text-left">
<? if( $_GET['md']== 'pagar' ) { ?>
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_EDIT" value="OK" />
								<input type="hidden" name="LANC_GRP_ID" value="<? echo "".$VW_L_GRP_ID."|".$VW_L_GRP_DESCR."";?>" />

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />

								<button type="submit" class="btn btn-sm btn-success btn-link text-white" name="EDIT_LANC_<? echo "$VW_LANC_L_ID";?>">
									<i class="fa fa-fw fa-usd" data-toggle="tooltip" data-placement="top" title="PAGAR"></i>
								</button>

							</form>
						</div>
<?}?>
<? if( $_GET['md']== 'receber' ) { ?>
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_EDIT" value="OK" />
								<input type="hidden" name="LANC_GRP_ID" value="<? echo "".$VW_L_GRP_ID."|".$VW_L_GRP_DESCR."";?>" />

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />

								<button type="submit" class="btn btn-sm btn-success btn-link text-white" name="EDIT_LANC_<? echo "$VW_LANC_L_ID";?>">
									<i class="fa fa-fw fa-usd" data-toggle="tooltip" data-placement="top" title="RECEBER"></i>
								</button>

							</form>
						</div>
<?}?>
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_EDIT" value="OK" />
								<input type="hidden" name="LANC_GRP_ID" value="<? echo "".$VW_L_GRP_ID."|".$VW_L_GRP_DESCR."";?>" />

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />

								<button type="submit" class="btn btn-sm btn-primary btn-link text-white" name="EDIT_LANC_<? echo "$VW_LANC_L_ID";?>">
									<i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-placement="top" title="EDITAR"></i>
								</button>

							</form>
						</div>
						
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />
								<input type="hidden" name="LANC_OBSERVACAO" value="<? echo "$VW_LANC_OBS";?>" />
								<input type="hidden" name="LANC_VALOR" value="<? echo "$VW_LANC_VALOR_FORM";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name ="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="DELETAR"></i>
								</button>

							</form>
						</div>

					  </td>
					</tr>
<?
if(isset($_POST['EDIT_LANC_'."$VW_LANC_L_ID"])) {
?>
					<tr>
					  <th colspan="7">
					  <span class="badge badge-warning">EDITANDO ID.:</span> <span class="badge badge-warning"><? echo"$VW_LANC_L_ID";?></span>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_EDIT_LANC_<? echo "$VW_LANC_L_ID";?>').modal('show');
    });
</script>
						<!-- Modal -->
<? include ('lancamentos_modal_update.php');?>
						<!-- Modal -->
					  </th>
					</tr>
<?
}
?>

<?
}
$N="0";
$sql_LANC_TIP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
//echo "$sql_LANC_TIP<br />";
$result_LANC_TIP  = mysqli_query($CONNECT_PRIMARY, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$TIP_ID    = $row_LANC_TIP ['id_lanc_tipo'];
	$TIP_DESCR = $row_LANC_TIP ['descricao'];

if ( $TIP_ID=='1' ) { $BG_TR_E_S = "total-success"; } else { $BG_TR_E_S = "total-danger"; }

// Ex.: $D_X_A "ANO - OK"; YEAR(data) = '2019'
$SQL_REL_SOMA="SELECT id_lanc_grupo, SUM(valor) as SOMA  FROM $TABLE_SELECT WHERE id_empresa='".$S_EMP_ID."' AND modo='".$MODO."' AND id_lanc_grupo='".$VW_LANC_L_G_ID."' AND id_lanc_tipo='".$TIP_ID."' AND (YEAR(data) = '".$D_X_C."' AND MONTH(data) = '".$D_X_B."' AND DAY(data) = '".$D_X_A."') GROUP BY id_lanc_grupo ORDER BY id_lanc_grupo ASC;";

// DEBUG SQL_REL_SOMA
//echo "$SQL_REL_SOMA<br />";

$result_LANC_SOMA = mysqli_query($CONNECT_CLIENTE, $SQL_REL_SOMA);

while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
	
	$VW_ID_L_G   = $row_LANC_SOMA["id_lanc_grupo"];
	$VW_TOTAL_BD = $row_LANC_SOMA["SOMA"];

	// Cria um Array com os valores da soma
	$V_SOMA[$N]  = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
	$N++; // aqui eu vou aumentando a variavel

	// Formata moeda para exibição:
	$VW_TOTAL = moeDaView($VW_TOTAL_BD, 'TABLE');
	//echo "$VW_TOTAL";
?>
					<tr class="<? echo "$BG_TR_E_S"; ?>">
					  <th scope="row" colspan="1"></th>
					  <th scope="row" colspan="3">TOTAL: <? echo "$TIP_DESCR"; ?></th>
					  <th scope="row" colspan="3"><? echo "$VW_TOTAL"; ?></th>
					</tr>
<?
}

}



$TOTAL_E_S = $V_SOMA[0]-$V_SOMA[1];

// Formata pra dois decimais:
$TOTAL_E_S_BD = number_format($TOTAL_E_S, 2, '.', '');

// SOMA OS TOTAIS:
$SALDO_GERAL_DATA += $TOTAL_E_S_BD; //usar "+=" somar, "-=" Subtrair, "*=" Mutiplicar e "/=" Dividir.

if ( $TOTAL_E_S_BD<='0' ) { $BG_TR = "bg-danger text-white"; } else { $BG_TR = "bg-success text-white"; }

// Formata moeda para exibição:
$VW_TOTAL_E_S = moeDaView($TOTAL_E_S_BD, 'TABLE');
//echo "$VW_TOTAL_E_S";

// WHILE PARA DESCRIÇÃO DOS TIPOS
$sql_LANC_TIP_D = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
$result_LANC_TIP_D  = mysqli_query($CONNECT_PRIMARY, $sql_LANC_TIP_D);
$T="0";
while ($row_LANC_TIP_D  = mysqli_fetch_assoc($result_LANC_TIP_D )) {

	$ID_L_G    = $row_LANC_TIP_D ['id_lanc_tipo'];
	
	// Cria um Array com os valores da soma
	$D[$T] = $row_LANC_TIP_D ['descricao']; // aqui eu guardo em uma array o valor do while para ela nao substituir
	$T++; // aqui eu vou aumentando a variavel

}
$DESCR_TIP_IMP = '( '.implode(" - ", $D).' )';
?>
					<tr class="<? echo "$BG_TR";?>">
					  <th scope="row" colspan="1"></th>
					  <th scope="row" colspan="3">TOTAL: <? echo "$DESCR_TIP_IMP "; ?> </th>
					  <th scope="row" colspan="3"><? echo "$VW_TOTAL_E_S"; ?></th>
					</tr>
<?

}

if ( $NUM_ROWS_LANC=="0" ) {

} else {
?>
					<tr class="bg-white">
					  <th scope="row" colspan="7"></th>
					</tr>
<?
}
} //NUM_ROWS_LANC

// Formata pra dois decimais:
$SALDO_GERAL_DATA_2_D = number_format($SALDO_GERAL_DATA, 2, '.', '');

// Formata moeda para exibição:
$VW_TOTAL_T_G_E_S = moeDaView($SALDO_GERAL_DATA_2_D, 'TABLE');
//echo "$VW_TOTAL_T_G_E_S";

if ( $SALDO_GERAL_DATA<='0' ) { $BG_TR_TG = "alert-danger"; } else { $BG_TR_TG = "alert-success"; }
?>
					<tr class="bg-primary text-white">
					  <th scope="row" colspan="7">SALDO GERAL DO DIA</th>
					</tr>
					<tr class="<? echo "$BG_TR_TG"; ?>">
					  <th scope="row" colspan="7"><? echo "$VW_TOTAL_T_G_E_S"; ?></th>
					</tr>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->