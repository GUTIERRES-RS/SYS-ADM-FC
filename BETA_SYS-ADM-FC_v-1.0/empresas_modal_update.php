			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_EDIT_EMP_<? echo "$VW_EMP_ID";?>" role="dialog" aria-labelledby="ModalLabel_<? echo "$VW_EMP_ID";?>" aria-hidden="true"><!-- On modal disable this tabindex="-1" for ckeditor fuction is ok-->
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h5 class="modal-title" id="ModalLabel_<? echo "$VW_EMP_ID";?>">ALTERAR <small class="badge badge-warning">EMPRESA ID.: <? echo "$VW_EMP_ID";?></small></h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="EMP_ID" value="<? echo "$VW_EMP_ID";?>" />
						
						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">NOME FANTASIA</span>
								  </div>
								  <input type="text" name="EMP_N_FANT" value="<? echo "$VW_EMP_N_FANT";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1">
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">CNPJ</span>
								  </div>
								  <input type="text" name="EMP_CNPJ" value="<? echo "$VW_EMP_CNPJ";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1">
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">FONE</span>
								  </div>
								  <input type="text" name="EMP_FONE" value="<? echo "$VW_EMP_FONE";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1">
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