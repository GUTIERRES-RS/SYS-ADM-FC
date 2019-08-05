			<form action="?pag=painel&sec=index&vp=tipos" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_<? echo "$VW_LANC_TIP_L_ID";?>" role="dialog" aria-labelledby="ModalLabel_<? echo "$VW_LANC_TIP_L_ID";?>" aria-hidden="true"><!-- On modal disable this tabindex="-1" for ckeditor fuction is ok-->
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_<? echo "$VW_LANC_TIP_L_ID";?>"><? echo "$VW_LANC_TIP_DESCR";?> <small class="text-muted">ID.: <? echo "$VW_LANC_TIP_L_ID";?></small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="L_TIP_ID" value="<? echo "$VW_LANC_TIP_L_ID";?>" />
						
						<div class="card-body">
						
							<div class="card-title">
							
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect_LANC_GRUPO">LANC GRUPO</label>
								  </div>
								  <select name="LANC_GRUPO_TIP" class="custom-select" id="inputGroupSelect_LANC_GRUPO">
								  
									<option value="<? echo "$VW_LANC_TIP_L_G_ID";?>" selected><? echo "$VW_L_GRP_DESCR";?></option>
<?							
$sql_OP_LANC_GRP = "SELECT * FROM lanc_grupos WHERE id_empresa='$S_EMP_ID' ORDER BY descricao ASC;";
$result_OP_LANC_GRP  = mysqli_query($connect, $sql_OP_LANC_GRP);

while ($row_OP_LANC_GRP  = mysqli_fetch_assoc($result_OP_LANC_GRP )) {

	$VW_L_OP_ID_GRP    = $row_OP_LANC_GRP ['id_lanc_grupo'];
	$VW_L_OP_GRP_DESCR = $row_OP_LANC_GRP ['descricao'];
	
	if ($VW_LANC_TIP_L_G_ID==$VW_L_OP_ID_GRP) {
?>

<?
	} else {
?>
								<option value="<? echo "$VW_L_OP_ID_GRP";?>"><? echo "$VW_L_OP_GRP_DESCR";?></option>
<?
	}
}
?>

								  </select>
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Descrição</span>
								  </div>
								  <input type="text" name="DESCR_TIP" value="<? echo "$VW_LANC_TIP_DESCR";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1">
								</div>

							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-primary" name="ALTERAR"><i class="fa fa-fw fa-save"></i> Atualizar</button>
					  </div>
					</div>
				  </div>
				</div>

			</form>