
			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_RESTAURAR" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_BACKUP" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_BACKUP">
							RESTAURAÇÃO DOS DADOS: <small class="text-muted">Armazenados no BACKUP.</small><br />
							SQL CARREGADO: <span class="badge badge-warning"><?=$BKP_DB_NAME?></span>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">

						<div class="card-body">
						
							<div class="card-title">

								<input type="hidden" name="BKP_ID" value="<?= $BKP_ID;?>" />
								<input type="hidden" name="BKP_EMP_ID" value="<?= $BKP_EMP_ID;?>" />
								<input type="hidden" name="BKP_DATA" value="<?= $BKP_DATA;?>" />
								<input type="hidden" name="BKP_DB_NAME" value="<?= $BKP_DB_NAME;?>" />
<?
$ZIP = new ZipArchive();
 
if( $ZIP->open( "$BKP_URL_DOWNLOAD" )  === true){

    $BKP_CONTEUDO_SQL = $ZIP->getFromName( "$BKP_DB_NAME" );

	$BKP_CONTEUDO_PHP = $ZIP->getFromIndex(0);
?>
									<pre style="max-height: 60vh">
<?
										//DEBUG
										print_r ( $BKP_CONTEUDO_SQL );
?>
									</pre>

									<textarea name="BKP_CONTEUDO_SQL" style="width:100%;" rows="50" hidden>
<?
										//DEBUG
										print_r ( $BKP_CONTEUDO_PHP );
?>
									</textarea>
<?
}
?>

							</div>

						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-success" name="RESTAURAR"><i class="fa fa-fw fa-retweet"></i> RESTAURAR DE: <span class="badge badge-pill badge-warning"><?= $BKP_DB_NAME;?></span></button>
					  </div>
					</div>
				  </div>
				</div>

			</form>
