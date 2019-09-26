    <div class="container-fluid">

		<!-- Breadcrumbs-->
		<ol class="breadcrumb d-print-none">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Relatórios</li>
		</ol>

		<div class="row d-print-none">
			<div class="col-12">
<!--Ajuda alerta hide show-->
<script>
$(document).ready(function(){

	$( "#o_ajuda" ).click(function() {
	  $( "#ajuda" ).toggleClass( "d-none" );
	});

	$("#btnExport").click(function(){
	  $("#table2excel").table2excel({
		  //exclude: ".noExl",
		  name: "Worksheet Name",
		  filename: "Export Table",
		  fileext: ".xls",
		  preserveColors:false,
		  exclude_img: true,
		  exclude_links: true,
		  exclude_inputs: true
	  }); 
	});

});
</script>
				<h3><span class="text-warning">Relatórios</span> <small  class="text-muted" style="font-size:16px;">Aqui você gera os Relatórios. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong> Para gerar os relatórios é necessário preecher todos os campos.<br />
					No campo DATA você pode pesquisar por um Dia especifico Ex: "dd/mm/aaaa", Mês especifico Ex: "mm/aaaa" ou Ano especifico Ex: "aaaa"<br />
					Para gerar relatórios você tem que selecionar ao menos 1 opção dos campos: GRUPO e TIPO.<br />
					Se for gerar relatório de grupos especificos desmarque a opção TODOS no campo: GRUPO se ela estiver marcada ela sera priorizada e gerara um relatório de todos os GRUPOS.
				</div>

<?
// Aqui vai o recebimento das opções e tratamento primario para geração dos relatorios
include ('relatorios_options.php');
?>
			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12" id="table2excel">

				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">GRUPO</th>
					  <th scope="col">TIPO</th>
					  <th scope="col">MODO</th>
					  <th scope="col">OBSERVAÇÃO</th>
					  <th scope="col">VALOR</th>
					  <th scope="col">DATA</th>
					</tr>
				  </thead>

				  <tbody>
<?
 $CSV .= "ID;GRUPO;TIPO;OBSERVAÇÃO;VALOR;DATA"."\n";

if ($LANC_GRUPO[0]=='0') {
	$SQL_OPS_LANC_GRP = "";
} else {
	// Insere o delimitador para as opções de GRUPO e separa elas.
	$OPS_GRP_DELIMIT = implode("','", $LANC_GRUPO);
	$SQL_OPS_LANC_GRP = " AND id_lanc_grupo IN('".$OPS_GRP_DELIMIT."') ";
}

if ($LANC_TIPO=='0') {
	$SQL_ID_TIP = "";
	$SQL_ID_TIP_SOMA = " ";
} else {
	$SQL_ID_TIP 	 = " AND id_lanc_tipo IN('".$LANC_TIPO."') ";
	$SQL_ID_TIP_SOMA = " WHERE id_lanc_tipo IN('".$LANC_TIPO."') ";
}

$SALDO_GERAL_DATA='0';

$SQL_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='".$S_EMP_ID."'".$SQL_OPS_LANC_GRP.";";
// DEBUG SQL_LANC_GRP
//echo "$SQL_LANC_GRP<br />";

$result_LANC_GRP  = mysqli_query($CONNECT_CLIENTE, $SQL_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$GRP_ID    = $row_LANC_GRP ['id_lanc_grupo'];
	$GRP_DESCR = $row_LANC_GRP ['descricao'];

if ( $C_DATA=='1' ) {
// Ex.: $D_X_A "ANO - OK"; YEAR(data) = '2019'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_A."') ORDER BY id_lanc_tipo, data DESC;";
}

if ( $C_DATA=='2' ) {
// Ex.: $D_X_A/$D_X_B "MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_B."' AND MONTH(data) = '".$D_X_A."') ORDER BY id_lanc_tipo, data DESC;";
}

if ( $C_DATA=='3' ) {
// Ex.: $D_X_A/$D_X_B/$D_X_C "DIA/MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_C."' AND MONTH(data) = '".$D_X_B."' AND DAY(data) = '".$D_X_A."') ORDER BY id_lanc_tipo, data DESC;";
}
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
					  <th scope="row" colspan="7">GRUPO: <? echo "$GRP_DESCR"; $CSV .= "GRUPO: $GRP_DESCR;;;;;"."\n";?></th>
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
	$VW_LANC_MODO_BD  = $row_LANC ['modo'];
	$VW_LANC_ATIVO    = $row_LANC ['ativo'];

//Formata moeda para exibição:
$VW_LANC_VALOR = moeDaView($VW_LANC_VALOR_BD, 'TABLE');
//echo "$VW_LANC_VALOR";
//-------------------------------------------------------------------------------------------------------------

//Formata a Data para exibição:
$VW_LANC_DATA = daTaView($VW_LANC_DATA_BD);
//echo "$VW_LANC_DATA";

?>
					<tr>
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
<?
// MODO DESCRIÇÃO
if ( $VW_LANC_MODO_BD == 'LD') { $VW_LANC_MODO_DESCR = 'Lançamento Diario'; }
if ( $VW_LANC_MODO_BD == 'LP') { $VW_LANC_MODO_DESCR = 'Conta a Pagar'; }
if ( $VW_LANC_MODO_BD == 'LR') { $VW_LANC_MODO_DESCR = 'Conta a Receber'; }
?>
					  <td><? echo "$VW_LANC_MODO_DESCR";?></td>
					  <td><? echo "$VW_LANC_OBS";?></td>
					  <td><? echo "$VW_LANC_VALOR";?></td>
					  <td><? echo "$VW_LANC_DATA";?></td>
					</tr>
<?
	$CSV .= "$VW_LANC_L_ID;$GRP_DESCR;$VW_L_TIP_DESCR;$VW_LANC_OBS;$VW_LANC_VALOR;$VW_LANC_DATA"."\n";

}
$N="0";
$sql_LANC_TIP = "SELECT * FROM lanc_tipos".$SQL_ID_TIP_SOMA."ORDER BY id_lanc_tipo ASC;";
//echo "$sql_LANC_TIP";
$result_LANC_TIP  = mysqli_query($CONNECT_PRIMARY, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$TIP_ID    = $row_LANC_TIP ['id_lanc_tipo'];
	$TIP_DESCR = $row_LANC_TIP ['descricao'];

if ( $TIP_ID=='1' ) { $BG_TR_E_S = "total-success"; } else { $BG_TR_E_S = "total-danger"; }

if ( $C_DATA=='1' ) {
// Ex.: $D_X_A "ANO - OK"; YEAR(data) = '2019'
$SQL_REL_SOMA="SELECT id_lanc_grupo, SUM(valor) as SOMA  FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$VW_LANC_L_G_ID."' AND id_lanc_tipo='".$TIP_ID."' AND (YEAR(data) = '".$D_X_A."') GROUP BY id_lanc_grupo ORDER BY id_lanc_grupo ASC;";
}

if ( $C_DATA=='2' ) {
// Ex.: $D_X_A/$D_X_B "MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07'
$SQL_REL_SOMA="SELECT id_lanc_grupo, SUM(valor) as SOMA  FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$VW_LANC_L_G_ID."' AND id_lanc_tipo='".$TIP_ID."' AND (YEAR(data) = '".$D_X_B."' AND MONTH(data) = '".$D_X_A."') GROUP BY id_lanc_grupo ORDER BY id_lanc_grupo ASC;";
}

if ( $C_DATA=='3' ) {
// Ex.: $D_X_A/$D_X_B/$D_X_C "DIA/MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_SOMA="SELECT id_lanc_grupo, SUM(valor) as SOMA  FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$VW_LANC_L_G_ID."' AND id_lanc_tipo='".$TIP_ID."' AND (YEAR(data) = '".$D_X_C."' AND MONTH(data) = '".$D_X_B."' AND DAY(data) = '".$D_X_A."') GROUP BY id_lanc_grupo ORDER BY id_lanc_grupo ASC;";
}
// DEBUG SQL_REL_SOMA
//echo "$SQL_REL_SOMA<br />";

$result_LANC_SOMA = mysqli_query($CONNECT_CLIENTE, $SQL_REL_SOMA);

while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
	
	$VW_ID_L_G   = $row_LANC_SOMA["id_lanc_grupo"];
	$VW_TOTAL_BD = $row_LANC_SOMA["SOMA"];

	// Cria um Array com os valores da soma
	$V_SOMA[$N]  = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
	$N++; // aqui eu vou aumentando a variavel

	//Formata moeda para exibição:
	$VW_TOTAL = moeDaView($VW_TOTAL_BD, 'TABLE');
	//echo "$VW_LANC_VALOR";

$CSV .= ";TOTAL: $TIP_DESCR;;;$VW_TOTAL;"."\n";

?>
					<tr class="<? echo "$BG_TR_E_S"; ?>">
					  <th scope="row" colspan="1"></th>
					  <th scope="row" colspan="4">TOTAL: <? echo "$TIP_DESCR"; ?></th>
					  <th scope="row" colspan="2"><? echo "$VW_TOTAL"; ?></th>
					</tr>
<?
}

}

if ($LANC_TIPO[0]=='0') {

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

$CSV .= ";TOTAL: $DESCR_TIP_IMP;;;$VW_TOTAL_E_S;"."\n";
?>
					<tr class="<? echo "$BG_TR";?>">
					  <th scope="row" colspan="1"></th>
					  <th scope="row" colspan="4">TOTAL: <? echo "$DESCR_TIP_IMP "; ?></th>
					  <th scope="row" colspan="2"><? echo "$VW_TOTAL_E_S"; ?></th>
					</tr>
<?
}

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

if ($LANC_TIPO[0]=='0') {

// Formata pra dois decimais:
$SALDO_GERAL_DATA_2_D = number_format($SALDO_GERAL_DATA, 2, '.', '');

// Formata moeda para exibição:
$VW_TOTAL_T_G_E_S = moeDaView($SALDO_GERAL_DATA_2_D, 'TABLE');
//echo "$VW_TOTAL_T_G_E_S";

if ( $SALDO_GERAL_DATA<='0' ) { $BG_TR_TG = "alert-danger"; } else { $BG_TR_TG = "alert-success"; }

$CSV .= "SALDO GERAL DOS ITENS SELECIONADOS;;;;;"."\n";
$CSV .= "$VW_TOTAL_T_G_E_S;;;;;"."\n";
?>
					<tr class="bg-primary text-white">
					  <th scope="row" colspan="7">SALDO GERAL DOS ITENS SELECIONADOS</th>
					</tr>
					<tr class="<? echo "$BG_TR_TG"; ?>">
					  <th scope="row" colspan="7"><? echo "$VW_TOTAL_T_G_E_S"; ?></th>
					</tr>
<?
}
?>

				  </tbody>

				</table>

<pre style="max-height: 60vh" hidden>
<?
	//DEBUG
	print_r ( $CSV );
?>
</pre>

			</div><!-- col-12 -->
		</div><!-- row -->

		<button class="btn btn-sm btn-info d-print-none" id="btnExport"><i class="fa fa-fw fa-question-circle"></i> Export XLS EXCEL</button>

	</div><!-- container-fluid -->