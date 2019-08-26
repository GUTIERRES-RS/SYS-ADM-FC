    <div class="container-fluid">

<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Lançamentos</li>
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
				<h3><span class="text-warning">Lançamentos</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Lançamentos. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar lançamentos e necessario que todos os campos sejam preenchidos.<br />
					No campo DATA a mesma deve estar completa Ex: "dd/mm/aaaa"
				</div>

<?
// Aqui vai o recebimento das opções e tratamento primario para geração dos relatorios
include ('lancamentos_options.php');
?>
			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">

				<table class="table table-striped text-nowrap">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">GRUPO</th>
					  <th scope="col">TIPO</th>
					  <th scope="col">OBSERVAÇÃO</th>
					  <th scope="col">VALOR</th>
					  <th scope="col">DATA</th>
					  <th scope="col" class="text-right">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>

<?
$sql_LANC = "SELECT * FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A' ORDER BY id_lanc_tipo, data, id_lancamento DESC;";
//echo "$sql_LANC";
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

//------------------------------------------------------------------------------------
$LANC_ID = $_POST['LANC_ID'];

if ( $VW_LANC_L_ID=="$LANC_ID" ) { $BG_TR_L="bg-info text-white"; } else { $BG_TR_L=""; }

?>

					<tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><? echo "$VW_LANC_L_ID";?></th>
<?
$sql_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_lanc_grupo='$VW_LANC_L_G_ID';";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$VW_L_GRP_ID	= $row_LANC_GRP ['id_lanc_grupo'];
	$VW_L_GRP_DESCR = $row_LANC_GRP ['descricao'];

?>
					  <td><? echo "$VW_L_GRP_DESCR";?></td>
<?
}
?>

<?
$sql_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_lanc_tipo='$VW_LANC_L_T_ID';";
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
					  <td class="text-right" style="width:10%;">

						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

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
							<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />
								<input type="hidden" name="LANC_OBSERVACAO" value="<? echo "$VW_LANC_OBS";?>" />
								<input type="hidden" name="LANC_VALOR" value="<? echo "$VW_LANC_VALOR";?>" />
								
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
					  <td colspan="7">
					  <span class="badge badge-warning">EDITANDO ID.:</span> <span class="badge badge-warning"><? echo"$VW_LANC_L_ID";?></span>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_EDIT_LANC_<? echo "$VW_LANC_L_ID";?>').modal('show');
    });
</script>
						<!-- Modal -->
<? include ('lancamentos_modal_update.php');?>
						<!-- Modal -->
					  </td>
					</tr>
<?
}
?>

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
?>
<!-- FUNÇÂO SOMA -->
<?
$N="0";
$sql_LANC_GRP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);
while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$ID_L_G    = $row_LANC_GRP ['id_lanc_tipo'];
	$DESCR_L_G = $row_LANC_GRP ['descricao'];


$sql_LANC_SOMA = "SELECT id_lanc_grupo, id_lanc_tipo, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_tipo='$ID_L_G' AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A';";

    $result_LANC_SOMA = mysqli_query($connect, $sql_LANC_SOMA);
    while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
        
		$VW_ID_TIP = $row_LANC_SOMA["id_lanc_tipo"];
		
		$VW_TOTAL_BD  = $row_LANC_SOMA["SOMA"];
		
		// Cria um Array com os valores da soma
		$V_SOMA[$N] = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
		$N++; // aqui eu vou aumentando a variavel
		
//Formata moeda para exibição: FUNÇÃO
// Separa centavos do valor para contar o numero de caracteres para a formatação correta do valor.

$VALOR_MOEDA_BD   = "$VW_TOTAL_BD";            // Pega valor original do BD.
$SEPAR_CENTS      = explode(".", $VALOR_MOEDA_BD);  // Separa o valor dos centavos.
//$SOMENT_CENT      = $SEPAR_CENTS[1];                // Pega só os centavos.
//echo "$SOMENT_CENT";
$CONT_CARACT_CENT = strlen($SOMENT_CENT);           // Conta a quantidade de caracteres.

if ($CONT_CARACT_CENT<"2") {$CONT_CARACT_CENT_T="2";} else {$CONT_CARACT_CENT_T="$CONT_CARACT_CENT";} // Verifica se e menor que 2.

$VW_TOTAL = number_format($VW_TOTAL_BD, $CONT_CARACT_CENT_T, ',', '.');
//echo "$VW_TOTAL";

if ( $VW_ID_TIP=='1') { $TR_T_BG="alert-success"; } else { $TR_T_BG="alert-danger"; }

?>
					<tr class="<? echo "$TR_T_BG"; ?>">
					  <th scope="row" colspan="2"></th>
					  <th scope="row" colspan="2">TOTAL de <? echo "$DESCR_L_G"; ?></th>
					  <th scope="row">R$ <? echo "$VW_TOTAL"; ?></th>
					  <th scope="row" colspan="2"></th>
					</tr>
<?
}
}

$TOTAL_E_S_BD = $V_SOMA[0]-$V_SOMA[1];

if ( $TOTAL_E_S_BD<='0' ) { $BG_TR_T = "bg-danger text-white"; } else { $BG_TR_T = "bg-success text-white"; }

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

?>
					<tr class="<? echo "$BG_TR_T";?>">
					  <th scope="row" colspan="2"></th>
					  <th scope="row" colspan="2">TOTAL de 
<?
$sql_LANC_GRP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
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

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->