
			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_QUERY" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_BACKUP" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_BACKUP">
							QUERY: <small class="text-muted">Para correções e updates.</small><br />
							SQL CARREGADO PARA: <span class="badge badge-warning"><?=$DB_SELECT?></span>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">

						<div class="card-body">
						
							<div class="card-title">

								<input type="hidden" name="BKP_ID" value="<?= $BKP_ID;?>" />
								<input type="hidden" name="DB_SELECT" value="<?= $DB_SELECT;?>" />
								<input type="hidden" name="BKP_DATA" value="<?= $BKP_DATA;?>" />
								<input type="hidden" name="BKP_DB_NAME" value="<?= $BKP_DB_NAME;?>" />

								<textarea name="BKP_CONTEUDO_SQL" style="width:100%;" rows="20"></textarea>

							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-success" name="QUERY"><i class="fa fa-fw fa-terminal"></i> EXECUTAR QUERY EM: <span class="badge badge-pill badge-warning"><?=$DB_SELECT?></span></button>
					  </div>
					</div>
				  </div>
				</div>

			</form>
