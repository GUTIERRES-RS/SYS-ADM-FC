
			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_INSERT" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_INSERT" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_INSERT">INSERIR NOVO TIPO <small class="text-muted">Preecha abaixo com os dados do novo Tipo</small></h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="TIP_ID" value="0" />

						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Descrição</span>
								  </div>
								  <input type="text" name="TIP_DESCR" value="" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="Breve descrição sobre" />
								</div>
							
							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-primary" name="INSERT"><i class="fa fa-fw fa-save"></i> Salvar</button>
					  </div>
					</div>
				  </div>
				</div>

			</form>