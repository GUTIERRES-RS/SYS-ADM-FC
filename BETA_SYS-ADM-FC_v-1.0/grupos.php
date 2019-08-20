    <div class="container-fluid">

<? include ('grupos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Grupos</li>
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
				<h3><span class="text-warning">Grupos</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Grupos. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar Grupos e necessario que todos os campos sejam preenchidos.
				</div>

<? include ('grupos_modal_insert.php'); ?>
					
				<div class="input-group mb-3">
					<div class="input-group">
						<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#Modal_INSERT">
							<i class="fa fa-fw fa-plus"></i>Inserir novo item
						</button>
					</div>
				</div>

				<table class="table table-striped">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">DESCRIÇÂO</th>
					  <th scope="col">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>

<?
$sql_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao DESC;";
//echo "$sql_GRP";
$result_GRP  = mysqli_query($connect, $sql_GRP);

while ($row_GRP  = mysqli_fetch_assoc($result_GRP )) {

	$VW_GRP_ID    = $row_GRP ['id_lanc_grupo'];
	$VW_GRP_E_ID  = $row_GRP ['id_empresa'];
	$VW_GRP_DESCR = $row_GRP ['descricao'];
	$VW_GRP_ATIVO = $row_GRP ['ativo'];

$GRP_ID = $_POST['GRP_ID'];

if ( $VW_GRP_ID=="$GRP_ID" ) { $BG_TR_L="bg-info text-white"; } else { $BG_TR_L=""; }

?>

					<tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><? echo "$VW_GRP_ID";?></th>
					  <td><? echo "$VW_GRP_DESCR";?></td>
					  <td class="align-right" style="width:115px;">
					  
						<div class="float-left">
							<!-- Button trigger modal -->
							<a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#Modal_<? echo "$VW_GRP_ID";?>">
								<i class="fa fa-fw fa-edit"></i>
							</a>
						</div>
						
						<div class="float-right" style="width:10px;">&nbsp;</div>
						
						<div class="float-right">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=grupos" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="GRP_ID" value="<? echo "$VW_GRP_ID";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger" name ="DELETAR">
									<i class="fa fa-fw fa-trash"></i>
								</button>
								
							</form>
						</div>

					  </td>
					</tr>
						<!-- Modal -->
<? include ('grupos_modal_update.php');?>
						<!-- Modal -->
<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->