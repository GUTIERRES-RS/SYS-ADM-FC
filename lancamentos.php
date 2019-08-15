    <div class="container-fluid">

<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Lançamentos</li>
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
				<h3><span class="text-warning">Lançamentos</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Lançamentos. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar lançamentos e necessario que todos os campos sejam preenchidos.<br />
					No campo DATA a mesma deve estar completa Ex: "dd/mm/aaaa"
				</div>
<?
if(isset($_POST['INSERT_LANC_GRUPO'])) {

	$LANC_GRP_ID_DESCR = $_POST['LANC_GRP_ID_DESCR'];
	
	$X_L_G_I_D = explode("|", $LANC_GRP_ID_DESCR);
	$LANC_GRP_ID = $X_L_G_I_D[0];
	$LANC_GRP_DESCR = $X_L_G_I_D[1];

	$LANC_DATA   = $_POST['LANC_DATA'];
	//echo "$LANC_DATA";
	
	$COUNT_CRT = strlen($LANC_DATA); // Conta a quantidade de caracteres.
	
	//Formata a Data para consulta SQL separando DD/MM/AAAA
	$DATA_W = explode("/", $LANC_DATA);
	$D_X_A = $DATA_W[0];
	$D_X_B = $DATA_W[1];
	$D_X_C = $DATA_W[2];

// Filtra o POST pra verificar se os parametros necessarios estão sendo enviados corretamente.
if ( $LANC_GRP_ID_DESCR=='' | $LANC_GRP_ID_DESCR=='0' | $LANC_DATA=='' | $D_X_A=='00' | $D_X_B=='00' | $D_X_C=='0000' | $COUNT_CRT!='10' ) {

?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<strong>Aviso:</strong>	Para inserir ou editar lançamentos e necessario que todos os campos sejam preenchidos.<br />
					No campo DATA a mesma deve estar completa Ex: "dd/mm/aaaa" e no campo Grupo pelo menos um deve ser selecionado.
					<? echo "$COUNT_CRT";?>
				</div>
<?

} else {

?>
<? include ('lancamentos_modal_insert.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_INSERT').modal('show');
    });
</script>
<?
}
?>
				<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">
	
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

						<select name="LANC_GRP_ID_DESCR" class="form-control selectpicker" data-max-options="1" data-live-search="true" multiple>

<?							
$sql_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
//echo "$sql_GRP";
$result_GRP  = mysqli_query($connect, $sql_GRP);

while ($row_GRP  = mysqli_fetch_assoc($result_GRP )) {

	$VW_GRP_ID    = $row_GRP ['id_lanc_grupo'];
	$VW_GRP_E_ID  = $row_GRP ['id_empresa'];
	$VW_GRP_DESCR = $row_GRP ['descricao'];
	$VW_GRP_ATIVO = $row_GRP ['ativo'];
	
if ($LANC_GRP_ID==$VW_GRP_ID) {

?>
							<option value="<? echo "$VW_GRP_ID";?>|<? echo "$VW_GRP_DESCR";?>" selected><? echo "$VW_GRP_DESCR";?></option>
<?
} else {

?>
							<option value="<? echo "$VW_GRP_ID";?>|<? echo "$VW_GRP_DESCR";?>"><? echo "$VW_GRP_DESCR";?></option>
<?

}

}
?>

						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Inserir novo item 2
							</button>
						</div>
					</div>

				</form>
<?
} else {
//-----------------------------------------------------
if ( isset($_POST['INSERT']) || isset($_POST['ALTERAR']) || isset($_POST['DELETAR']) ) {
//Formata a Data para consulta SQL separando DD/MM/AAAA
$LANC_DATA   = $_POST['LANC_DATA'];
$LANC_GRP_ID = $_POST['LANC_GRP_ID'];
} else {
$LANC_DATA = "$TO_D/$TO_M/$TO_A"; //Hoje
}

// Passa o valor $_POST['LANC_ID'] e $_POST['LANC_DATA'] para o "select grupo" e "imput date" manter o id do grupo e data de inserção.
if(isset($_POST['LANC_EDIT'])) {

$LANC_DATA   = $_POST['LANC_DATA'];
$LANC_GRP_ID = $_POST['LANC_GRP_ID'];

}

$DATA_W = explode("/", $LANC_DATA);
$D_X_A = $DATA_W[0];
$D_X_B = $DATA_W[1];
$D_X_C = $DATA_W[2];

?>
				<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

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

						<select name="LANC_GRP_ID_DESCR" class="form-control selectpicker" data-max-options="1" data-live-search="true" multiple>

<?							
$sql_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
//echo "$sql_GRP";
$result_GRP  = mysqli_query($connect, $sql_GRP);

while ($row_GRP  = mysqli_fetch_assoc($result_GRP )) {

	$VW_GRP_ID    = $row_GRP ['id_lanc_grupo'];
	$VW_GRP_E_ID  = $row_GRP ['id_empresa'];
	$VW_GRP_DESCR = $row_GRP ['descricao'];
	$VW_GRP_ATIVO = $row_GRP ['ativo'];

if ($LANC_GRP_ID==$VW_GRP_ID) {

?>
							<option value="<? echo "$VW_GRP_ID";?>|<? echo "$VW_GRP_DESCR";?>" selected><? echo "$VW_GRP_DESCR";?></option>
<?
} else {

?>
							<option value="<? echo "$VW_GRP_ID";?>|<? echo "$VW_GRP_DESCR";?>"><? echo "$VW_GRP_DESCR";?></option>
<?

}

}
?>

						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Inserir novo item 1
							</button>
						</div>
					</div>

				</form>
<?

}
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
					  <th scope="col">AÇÕES</th>
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
					  <td class="align-right" style="width:115px;">
					  
						<div class="float-left">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_EDIT" value="OK" />
								<input type="hidden" name="LANC_GRP_ID" value="<? echo "$VW_L_GRP_ID";?>" />

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />

								<button type="submit" class="btn btn-sm btn-primary text-white" name="EDIT_LANC_<? echo "$VW_LANC_L_ID";?>">
									<i class="fa fa-fw fa-edit"></i>
								</button>

							</form>
						</div>
						
						<div class="float-right" style="width:10px;">&nbsp;</div>
						
						<div class="float-right">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

								<input type="hidden" name="LANC_ID" value="<? echo "$VW_LANC_L_ID";?>" />
								<input type="hidden" name="LANC_DATA" value="<? echo "$LANC_DATA";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger" name ="DELETAR">
									<i class="fa fa-fw fa-trash"></i>
								</button>

							</form>
						</div>

					  </td>
					</tr>
<?
if(isset($_POST['EDIT_LANC_'."$VW_LANC_L_ID"])) {
?>
					<tr style="">
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


$sql_LANC_SOMA = "SELECT id_lanc_grupo, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_tipo='$ID_L_G' AND YEAR(data) = '$D_X_C' AND MONTH(data) = '$D_X_B' AND DAY(data) = '$D_X_A';";

    $result_LANC_SOMA = mysqli_query($connect, $sql_LANC_SOMA);
    while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
        
		$VW_ID_GRP = $row_LANC_SOMA["id_lanc_tipo"];
		
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

?>
					<tr class="bg-secondary text-white">
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