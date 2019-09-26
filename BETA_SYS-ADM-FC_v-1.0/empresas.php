    <div class="container-fluid">

<? include ('empresas_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Empresas</li>
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
				<h3><span class="text-warning">Empresas</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Empresas. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar Empresas e necessario que todos os campos sejam preenchidos.
				</div>

<? include ('empresas_modal_insert.php'); ?>

				<div class="input-group mb-3">
					<div class="input-group">
						<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#Modal_INSERT">
							<i class="fa fa-fw fa-plus"></i>Inserir novo item
						</button>
					</div>
				</div>

			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">

				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">NOME FANTASIA</th>
					  <th scope="col">CNPJ</th>
					  <th scope="col">FONE</th>
					  <th scope="col" class="text-center" style="width:30px;">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>

<?
$QUERY_VERIFY = 'SHOW DATABASES;';// cliente_'.$VW_EMP_ID.'

$M_Q_VERIFY = mysqli_query($CONNECT_PRIMARY, $QUERY_VERIFY);// envia a query

while ($ROW_Q_VERIFY  = mysqli_fetch_assoc( $M_Q_VERIFY )) {

	$VW_DATABASE[] = $ROW_Q_VERIFY['Database'];
}
//DEBUG
//echo "<pre>";
//print_r ($VW_DATABASE);
//echo "</pre>";

$sql_EMP = "SELECT * FROM empresas;";
//DEBUG
//echo "$sql_EMP";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc( $result_EMP )) {

	$VW_EMP_ID     = $row_EMP ['id_empresa'];
	$VW_EMP_N_FANT = $row_EMP ['nome_fantasia'];
	$VW_EMP_CNPJ   = $row_EMP ['cnpj'];
	$VW_EMP_FONE   = $row_EMP ['fone'];

$EMP_ID = $_POST['EMP_ID'];

if ( $VW_EMP_ID=="$EMP_ID" ) { $BG_TR_L="bg-warning"; } else { $BG_TR_L=""; }

?>

					<tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><? echo "$VW_EMP_ID";?></th>
					  <td><? echo "$VW_EMP_N_FANT";?></td>
					  <td><? echo "$VW_EMP_CNPJ";?></td>
					  <td><? echo "$VW_EMP_FONE";?></td>
					  <td class="text-right">
<?
if ( in_array(''.$DB_CL_PREFIX.''.$VW_EMP_ID.'', $VW_DATABASE) ){ $DISABLED = " disabled"; } else { $DISABLED = ""; }
?>
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="EMP_ID" value="<? echo "$VW_EMP_ID";?>" />

								<button type="submit" class="btn btn-sm btn-success btn-link text-white" name ="CREATE_DATABASE"<? echo "$DISABLED";?>>
									<i class="fa fa-fw fa-database" data-toggle="tooltip" data-placement="top" title="CRIAR DATABASE"></i>
								</button>
								
							</form>
						</div>

						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="EMP_ID" value="<? echo "$VW_EMP_ID";?>" />
								<input type="hidden" name="EMP_N_FANT" value="<? echo "$VW_EMP_N_FANT";?>" />

								<button type="submit" class="btn btn-sm btn-primary btn-link text-white" name ="EDITAR_EMP_<? echo "$VW_EMP_ID";?>">
									<i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-placement="top" title="EDITAR"></i>
								</button>
								
							</form>
						</div>
						
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="EMP_ID" value="<? echo "$VW_EMP_ID";?>" />
								<input type="hidden" name="EMP_N_FANT" value="<? echo "$VW_EMP_N_FANT";?>" />
								<input type="hidden" name="EMP_CNPJ" value="<? echo "$VW_EMP_CNPJ";?>" />
								<input type="hidden" name="EMP_FONE" value="<? echo "$VW_EMP_FONE";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name ="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="DELETAR"></i>
								</button>
								
							</form>
						</div>

					  </td>
					</tr>
<!-- Modal -->
<?
if(isset($_POST['EDITAR_EMP_'."$VW_EMP_ID"])) {
?>
					<tr>
					  <th colspan="5">
					  <span class="badge badge-secondary">EDITANDO ID.:</span> <span class="badge badge-warning"><? echo"$VW_EMP_ID";?></span>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_EDIT_EMP_<? echo "$VW_EMP_ID";?>').modal('show');
    });
</script>

<? include ('empresas_modal_update.php');?>
						
					  </th>
					</tr>
<?
}
?>
<!-- Modal -->

<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->