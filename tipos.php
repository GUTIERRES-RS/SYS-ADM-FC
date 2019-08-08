    <div class="container-fluid">

<? include ('tipos_post_sql.php'); ?>

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
				<h3><span class="text-warning">Tipos</span> <small  class="text-muted" style="font-size:16px;">Aqui você insere, edita e deleta os Tipos. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong>	Para inserir ou editar Tipos e necessario que todos os campos sejam preenchidos.
				</div>
<?	
if(isset($_POST['INSERT_LANC_GRUPO']))
{
	$LNC_LANC_GRUPO = $_POST['LANC_GRUPO'];
	//echo "$LNC_LANC_TIPO";
?>
<? include ('tipos_modal_insert.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_INSERT').modal('show');
    });
</script>
				<form action="?pag=painel&sec=index&vp=tipos" method="post" enctype="multipart/form-data">
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">LANC GRUPO</label>
						</div>
						<select name="LANC_GRUPO" class="custom-select" id="inputGroupSelect_LANC_GRUPO">

<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];
	
if ($LNC_LANC_GRUPO==$VW_L_OP_ID_GRP) {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>" selected><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
} else {

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?

}

}
?>

						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Inserir novo item
							</button>
						</div>
					</div>

				</form>
<?
}
else
{
?>
				<form action="?pag=painel&sec=index&vp=tipos" method="post" enctype="multipart/form-data">
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">LANC GRUPO</label>
						</div>
						<select name="LANC_GRUPO" class="custom-select" id="inputGroupSelect_LANC_GRUPO">

<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];

?>
							<option value="<? echo "$VW_L_OP_ID_GRP";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
}
?>

						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-sm btn-success" name="INSERT_LANC_GRUPO">
								<i class="fa fa-fw fa-plus"></i>Inserir novo item
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
					  <th scope="col">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>

<?
$sql_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' ORDER BY id_lanc_grupo ASC;";
$result_LANC_TIP  = mysqli_query($connect, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$VW_LANC_TIP_L_ID     = $row_LANC_TIP ['id_lanc_tipo'];
	$VW_LANC_TIP_E_ID     = $row_LANC_TIP ['id_empresa'];
	$VW_LANC_TIP_L_G_ID   = $row_LANC_TIP ['id_lanc_grupo'];
	$VW_LANC_TIP_DESCR    = $row_LANC_TIP ['descricao'];
	$VW_LANC_TIP_ATIVO    = $row_LANC_TIP ['ativo'];

?>

					<tr>
					  <th scope="row"><? echo "$VW_LANC_TIP_L_ID";?></th>
<?
$sql_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo=$VW_LANC_TIP_L_G_ID;";
$result_LANC_GRP  = mysqli_query($connect, $sql_LANC_GRP);

while ($row_LANC_GRP  = mysqli_fetch_assoc($result_LANC_GRP )) {

	$VW_L_GRP_DESCR = $row_LANC_GRP ['descricao'];

?>
					  <td><? echo "$VW_L_GRP_DESCR";?></td>
<?
}
?>
					  <td><? echo "$VW_LANC_TIP_DESCR";?></td>
					  <td class="align-right" style="width:115px;">
					  
						<div class="float-left">
							<!-- Button trigger modal -->
							<a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#Modal_<? echo "$VW_LANC_TIP_L_ID";?>">
								<i class="fa fa-fw fa-edit"></i>
							</a>
						</div>
						
						<div class="float-right" style="width:10px;">&nbsp;</div>
						
						<div class="float-right">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=tipos" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="L_TIP_ID" value="<? echo "$VW_LANC_TIP_L_ID";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger" name ="DELETAR">
									<i class="fa fa-fw fa-trash"></i>
								</button>
								
							</form>
						</div>

					  </td>
					</tr>
						<!-- Modal -->
<? include ('tipos_modal_update.php');?>
						<!-- Modal -->
<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->