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
					
				<div class="input-group mb-3">
					<div class="input-group-append">
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
$sql_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY id_lanc_grupo DESC;";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$VW_LANC_GRP_L_G_ID = $row_LANC_GRP ['id_lanc_grupo'];
	$VW_LANC_GRP_DESCR  = $row_LANC_GRP ['descricao'];
	$VW_LANC_GRP_ATIVO  = $row_LANC_GRP ['ativo'];

?>

					<tr>
					  <th scope="row"><? echo "$VW_LANC_GRP_L_G_ID";?></th>
					  <td><? echo "$VW_LANC_GRP_DESCR";?></td>
					  <td class="align-right" style="width:115px;">
					  
						<div class="float-left">
							<!-- Button trigger modal -->
							<a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#Modal_<? echo "$VW_LANC_GRP_L_G_ID";?>">
								<i class="fa fa-fw fa-edit"></i>
							</a>
						</div>
						
						<div class="float-right" style="width:10px;">&nbsp;</div>
						
						<div class="float-right">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=grupos" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="L_G_ID" value="<? echo "$VW_LANC_GRP_L_G_ID";?>" />
								
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