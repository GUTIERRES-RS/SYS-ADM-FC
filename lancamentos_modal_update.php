			<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_<? echo "$VW_LANC_L_ID";?>" role="dialog" aria-labelledby="ModalLabel_<? echo "$VW_LANC_L_ID";?>" aria-hidden="true"><!-- On modal disable this tabindex="-1" for ckeditor fuction is ok-->
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_<? echo "$VW_LANC_L_ID";?>"><? echo "$VW_L_TIP_DESCR";?> <small class="text-muted">ID.: <? echo "$VW_LANC_L_ID";?></small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="L_ID" value="<? echo "$VW_LANC_L_ID";?>" />
						
						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect_LANC_TIPO">TIPO</label>
								  </div>
								  <select name="LANC_TIPO" class="custom-select" id="inputGroupSelect_LANC_TIPO">
								  
									<option value="<? echo "$VW_LANC_L_T_ID";?>" selected><? echo "$VW_L_TIP_DESCR";?></option>
<?							
$sql_OP_LANC_TIP = "SELECT * FROM lanc_tipos WHERE id_empresa='$S_EMP_ID' AND id_lanc_grupo='$VW_LANC_L_G_ID' ORDER BY descricao ASC;";
$result_OP_LANC_TIP  = mysqli_query($connect, $sql_OP_LANC_TIP);

while ($row_OP_LANC_TIP  = mysqli_fetch_assoc($result_OP_LANC_TIP )) {

	$VW_L_OP_ID_TIP    = $row_OP_LANC_TIP ['id_lanc_tipo'];
	$VW_L_OP_TIP_DESCR = $row_OP_LANC_TIP ['descricao'];
	
	if ($VW_LANC_L_T_ID==$VW_L_OP_ID_TIP) {
?>

<?
	} else {
?>
								<option value="<? echo "$VW_L_OP_ID_TIP";?>"><? echo "$VW_L_OP_TIP_DESCR";?></option>
<?
	}
}
?>	

								  </select>
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Observação</span>
								  </div>
								  <input type="text" name="OBSERVACAO" value="<? echo "$VW_LANC_OBS";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="Breve descrição sobre"  />
								</div>
								
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Valor R$</span>
								  </div>
								  <input type="text" name="VALOR" value="<? echo "$VW_LANC_VALOR";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="0,00" />
								</div>
								
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Data</span>
								  </div>
								  <input type="text" name="DATA" value="<? echo "$VW_LANC_DATA";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="dd/mm/aaaa" />
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