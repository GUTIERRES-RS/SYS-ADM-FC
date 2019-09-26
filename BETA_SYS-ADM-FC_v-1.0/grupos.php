    <div class="container-fluid">

<? include ('grupos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Grupos</li>
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
				<h3><span class="text-warning">Grupos</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Grupos. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar Grupos e necessario que todos os campos sejam preenchidos.
				</div>

<? include ('grupos_modal_insert.php'); ?>

			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">
					
				<div class="input-group mb-3">
					<div class="input-group">
						<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#Modal_INSERT">
							<i class="fa fa-fw fa-plus"></i>Inserir novo item
						</button>
					</div>
				</div>

				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">DESCRIÇÃO</th>
					  <th scope="col" class="text-center" style="width:30px;">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>

<?
$sql_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
//echo "$sql_GRP";
$result_GRP  = mysqli_query($CONNECT_CLIENTE, $sql_GRP);

while ($row_GRP  = mysqli_fetch_assoc($result_GRP )) {

	$VW_GRP_ID    = $row_GRP ['id_lanc_grupo'];
	$VW_GRP_E_ID  = $row_GRP ['id_empresa'];
	$VW_GRP_DESCR = $row_GRP ['descricao'];
	$VW_GRP_ATIVO = $row_GRP ['ativo'];

$GRP_ID = $_POST['GRP_ID'];

if ( $VW_GRP_ID=="$GRP_ID" ) { $BG_TR_L="bg-warning"; } else { $BG_TR_L=""; }

?>

					<tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><? echo "$VW_GRP_ID";?></th>
					  <td><? echo "$VW_GRP_DESCR";?></td>
					  <td class="text-left">

						<div class="d-inline-block">
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="GRP_ID" value="<? echo "$VW_GRP_ID";?>" />
								<!-- Button trigger modal -->
								<button class="btn btn-sm btn-primary btn-link text-white" name="EDITAR_GRP_<? echo "$VW_GRP_ID";?>">
									<i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-placement="left" title="EDITAR"></i>
								</button>

							</form>
						</div>
						
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="GRP_ID" value="<? echo "$VW_GRP_ID";?>" />
								<input type="hidden" name="GRP_DESCR" value="<? echo "$VW_GRP_DESCR";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name ="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="DELETAR"></i>
								</button>
								
							</form>
						</div>

					  </td>
					</tr>

<!-- Modal -->
<?
if(isset($_POST['EDITAR_GRP_'.$VW_GRP_ID.''])) {
?>
					<tr>
					  <th colspan="7">
					  <span class="badge badge-secondary">EDITANDO ID.:</span> <span class="badge badge-warning"><? echo"$VW_GRP_ID";?></span>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_<? echo "$VW_GRP_ID";?>').modal('show');
    });
</script>

<? include ('grupos_modal_update.php');?>

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