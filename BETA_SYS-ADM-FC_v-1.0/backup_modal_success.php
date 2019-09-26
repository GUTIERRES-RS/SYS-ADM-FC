
				<div class="modal fade" id="Modal_OK" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_BACKUP" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_OK">
							BACKUP GERADO COM SUCESSO: <span class="badge badge-warning"><?= $FILE_NAME;?></span> <span class="badge badge-success">OK</span>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">

						<div class="card-body">
						
							<div class="card-title">

								<pre style="max-height: 30vh">
<?
									//DEBUG
									print_r ( $NEW_DADOS );
?>
								</pre>

							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
