    <div class="container-fluid">

<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Relatórios</li>
		</ol>

		<div class="row overflow-auto">
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
					Para gerar relatórios você tem que selecionar ao menos 1 opção dos campos: GRUPO e TIPO.<br />
					Se for gerar relatório de grupos especificos desmarque a opção TODOS no campo: GRUPO se ela estiver marcada ela sera priorizada e gerara um relatório de todos os GRUPOS.
				</div>

<?
// Aqui vai o recebimento das opções e tratamento primario para geração dos relatorios
include ('relatorios_options.php');
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

$result_LANC_GRP  = mysqli_query($connect, $SQL_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$GRP_ID    = $row_LANC_GRP ['id_lanc_grupo'];
	$GRP_DESCR = $row_LANC_GRP ['descricao'];

if ( $C_DATA=='1' ) {
// Ex.: $D_X_A "ANO - OK"; YEAR(data) = '2019'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_A."') ORDER BY id_lanc_grupo, id_lanc_tipo, data DESC;";
}

if ( $C_DATA=='2' ) {
// Ex.: $D_X_A/$D_X_B "MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_B."' AND MONTH(data) = '".$D_X_A."') ORDER BY id_lanc_tipo, id_lanc_grupo, data DESC;";
}

if ( $C_DATA=='3' ) {
// Ex.: $D_X_A/$D_X_B/$D_X_C "DIA/MÊS/ANO - OK"; YEAR(data) = '2019' AND MONTH(data) = '07' AND DAY(data) = '15'
$SQL_REL_VW="SELECT * FROM lancamentos WHERE id_empresa='".$S_EMP_ID."' AND id_lanc_grupo='".$GRP_ID."'".$SQL_ID_TIP." AND (YEAR(data) = '".$D_X_C."' AND MONTH(data) = '".$D_X_B."' AND DAY(data) = '".$D_X_A."') ORDER BY id_lanc_tipo, id_lanc_grupo, data DESC;";
}
// DEBUG SQL_REL_VW
//echo "$SQL_REL_VW<br />";

$result_LANC  = mysqli_query($connect, $SQL_REL_VW);

$NUM_ROWS_LANC = mysqli_num_rows($result_LANC);
//DEBUG NUM_ROWS_LANC
//echo "$NUM_ROWS_LANC<br />";

if ( $NUM_ROWS_LANC=="0" ) {
	
} else {

?>
					<tr class="bg-info text-white">
					  <th scope="row" colspan="6">GRUPO: <? echo "$GRP_DESCR"; ?></th>
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
					  <td><? echo "$GRP_DESCR";?></td>

<?
$SQL_DESC_TIP = "SELECT * FROM lanc_tipos WHERE id_lanc_tipo='".$VW_LANC_L_T_ID."';";
$result_DESC_TIP  = mysqli_query($connect, $SQL_DESC_TIP);

while ($row_DESC_TIP  = mysqli_fetch_assoc($result_DESC_TIP )) {

	$VW_L_TIP_DESCR = $row_DESC_TIP ['descricao'];

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
$N="0";
$sql_LANC_TIP = "SELECT * FROM lanc_tipos".$SQL_ID_TIP_SOMA."ORDER BY id_lanc_tipo ASC;";
//echo "$sql_LANC_TIP";
$result_LANC_TIP  = mysqli_query($connect, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$TIP_ID    = $row_LANC_TIP ['id_lanc_tipo'];
	$TIP_DESCR = $row_LANC_TIP ['descricao'];

if ( $TIP_ID=='1' ) { $BG_TR_E_S = "alert-success"; } else { $BG_TR_E_S = "alert-danger"; }

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

$result_LANC_SOMA = mysqli_query($connect, $SQL_REL_SOMA);

while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
	
	$VW_ID_L_G   = $row_LANC_SOMA["id_lanc_grupo"];
	$VW_TOTAL_BD = $row_LANC_SOMA["SOMA"];

	// Cria um Array com os valores da soma
	$V_SOMA[$N]  = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
	$N++; // aqui eu vou aumentando a variavel

	// Formata moeda para exibição: FUNÇÃO
	// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.
	$VALOR_MOEDA_BD   = "$VW_TOTAL_BD";            		// Pega valor original do BD.
	$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
	$SOMENT_CENT      = $SEPAR_CENTS[1];                // Pega só os centavos.
	$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.

	if ($CONT_CARACT_CENT<"2") {$CONT_CARACT_CENT_T="2";} else {$CONT_CARACT_CENT_T="$CONT_CARACT_CENT";} // Verifica se e menor que 2.

	$VW_TOTAL = number_format($VW_TOTAL_BD, $CONT_CARACT_CENT_T, ',', '.');
	//echo "$VW_TOTAL";

?>
					<tr class="<? echo "$BG_TR_E_S"; ?>">
					  <th scope="row" colspan="1"></th>
					  <th scope="row" colspan="3">TOTAL: <? echo "$GRP_DESCR"; ?>, <? echo "$TIP_DESCR"; ?></th>
					  <th scope="row">R$ <? echo "$VW_TOTAL"; ?></th>
					  <th scope="row"></th>
					</tr>
<?
}

}

if ($LANC_TIPO[0]=='0') {

$TOTAL_E_S_BD = $V_SOMA[0]-$V_SOMA[1];

$VALOR_F = number_format($TOTAL_E_S_BD, 2, '.', '');

$SALDO_GERAL_DATA += $VALOR_F; //usar "+=" somar, "-=" Subtrair, "*=" Mutiplicar e "/=" Dividir.

if ( $TOTAL_E_S_BD<='0' ) { $BG_TR = "bg-danger text-white"; } else { $BG_TR = "bg-success text-white"; }

//Formata moeda para exibição: FUNÇÃO
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.
$VALOR_MOEDA_BD   = "$TOTAL_E_S_BD";            	// Pega valor original do BD.
$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
//$SOMENT_CENT      = $SEPAR_CENTS[1];              // Pega só os centavos.
//echo "$SOMENT_CENT";
$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.

if ($CONT_CARACT_CENT<"2") {$CONT_CARACT_CENT_T="2";} else {$CONT_CARACT_CENT_T="$CONT_CARACT_CENT";} // Verifica se e menor que 2.

$VW_TOTAL_E_S = number_format($TOTAL_E_S_BD, $CONT_CARACT_CENT_T, ',', '.');
//echo "$VW_TOTAL";

?>
					<tr class="<? echo "$BG_TR";?>">
					  <th scope="row" colspan="3"></th>
					  <th scope="row">TOTAL de 
<?
$sql_LANC_TIP_D = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
$result_LANC_TIP_D  = mysqli_query($connect, $sql_LANC_TIP_D);
$T="0";
while ($row_LANC_TIP_D  = mysqli_fetch_assoc($result_LANC_TIP_D )) {

	$ID_L_G    = $row_LANC_TIP_D ['id_lanc_tipo'];
	
	// Cria um Array com os valores da soma
	$D[$T] = $row_LANC_TIP_D ['descricao']; // aqui eu guardo em uma array o valor do while para ela nao substituir
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
}

}

if ( $NUM_ROWS_LANC=="0" ) {

} else {
?>
					<tr class="bg-white">
					  <th scope="row" colspan="6"></th>
					</tr>
<?
}
} //NUM_ROWS_LANC

if ($LANC_TIPO[0]=='0') {
//Formata moeda para exibição: FUNÇÃO
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.
$SALDO_GERAL_DATA_T  = "$SALDO_GERAL_DATA";            	// Pega valor original do BD.
$SEPAR_CENTS_TG_X    = explode(".", $SALDO_GERAL_DATA_T);  // Separa o valor dos centavos.
$SOMENT_CENT_TG      = $SEPAR_CENTS_TG_X[1];              // Pega só os centavos.
$CONT_CARACT_CENT_TG = strlen($SOMENT_CENT_TG);           // Conta a quantidade de caracteres.

if ($CONT_CARACT_CENT_TG<"2") {$CONT_CARACT_CENT_T_G="2";} else {$CONT_CARACT_CENT_T_G="$CONT_CARACT_CENT_TG";} // Verifica se e menor que 2.

$VW_TOTAL_T_G_E_S = number_format($SALDO_GERAL_DATA, $CONT_CARACT_CENT_T_G, ',', '.');
//echo "$VW_TOTAL";

if ( $SALDO_GERAL_DATA<='0' ) { $BG_TR_TG = "alert-danger"; } else { $BG_TR_TG = "alert-success"; }
?>
					<tr class="bg-primary text-white">
					  <th scope="row" colspan="6">TOTAL GERAL PARA GRUPOS E DATA SELECIONADOS</th>
					</tr>
					<tr class="<? echo "$BG_TR_TG"; ?>">
					  <th scope="row" colspan="6">R$ <? echo "$VW_TOTAL_T_G_E_S"; ?></th>
					</tr>
<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->