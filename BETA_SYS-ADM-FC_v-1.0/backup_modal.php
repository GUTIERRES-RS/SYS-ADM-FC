			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_BACKUP" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_BACKUP" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_BACKUP">
							BACKUP DOS DADOS: <small class="text-muted">Armazenados no sistema.</small><br />
							SQL GERADO: <span class="badge badge-warning">OK</span>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">

						<div class="card-body">
						
							<div class="card-title">

								<input type="hidden" name="DATA" value="<?= $DATE_TIME_FILE;?>" />
								<input type="hidden" name="DB_SELECT" value="<?= $OP_DB_SELECT;?>" />
								<input type="hidden" name="FILE_NAME" value="<?= $NEW_FILE_NAME;?>" />

									<pre style="max-height: 60vh">
<?
										//DEBUG
										print_r ( $SQL_BACKUP );
?>
									</pre>

									<textarea name="NEW_DADOS" style="width:100%;" rows="50" hidden>
<?
										//DEBUG
										print_r ( $SQL_BACKUP );
?>
									</textarea>

							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-success" name="START"><i class="fa fa-fw fa-save"></i> SAVE AS: <span class="badge badge-pill badge-warning"><?= $NEW_FILE_NAME;?></span></button>
					  </div>
					</div>
				  </div>
				</div>

			</form>