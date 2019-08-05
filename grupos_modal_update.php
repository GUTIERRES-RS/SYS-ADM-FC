			<form action="?pag=painel&sec=index&vp=grupos" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_<? echo "$VW_LANC_GRP_L_G_ID";?>" role="dialog" aria-labelledby="ModalLabel_<? echo "$VW_LANC_GRP_L_G_ID";?>" aria-hidden="true"><!-- On modal disable this tabindex="-1" for ckeditor fuction is ok-->
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_<? echo "$VW_LANC_GRP_L_G_ID";?>"><? echo "$VW_LANC_GRP_DESCR";?> <small class="text-muted">ID.: <? echo "$VW_LANC_GRP_L_G_ID";?></small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="L_G_ID" value="<? echo "$VW_LANC_GRP_L_G_ID";?>" />
						
						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Descrição</span>
								  </div>
								  <input type="text" name="DESCRICAO" value="<? echo "$VW_LANC_GRP_DESCR";?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1">
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