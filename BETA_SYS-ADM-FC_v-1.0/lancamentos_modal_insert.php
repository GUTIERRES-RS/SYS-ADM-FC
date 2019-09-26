
			<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_INSERT" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_INSERT" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_INSERT">
							NOVO LANÇAMENTO <?=$TITULO?>: <small class="text-muted">Preecha todos os dados</small><br />
							GRUPO: <span class="badge badge-warning"><?echo "$LANC_GRP_DESCR"; ?></span>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="LANC_ID" value="0" />

<?if( $_GET['md']== 'diario' ) {?>
						<input type="hidden" name="LANC_MODO" value="LD" />
<?}?>
<?if( $_GET['md']== 'pagar' ) {?>
						<input type="hidden" name="LANC_MODO" value="LP" />
<?}?>
<?if( $_GET['md']== 'receber' ) {?>
						<input type="hidden" name="LANC_MODO" value="LR" />
<?}?>

						<input type="hidden" name="LANC_GRP_ID" value="<? echo "$LANC_GRP_ID";?>" />

						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect_LANC_TIPO">TIPO</label>
								  </div>
								  <select name="LANC_TIP_ID" class="custom-select" id="inputGroupSelect_LANC_TIPO">

<?
$sql_TIP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
//echo "$sql_TIP";
$result_TIP  = mysqli_query($CONNECT_PRIMARY, $sql_TIP);

while ($row_TIP  = mysqli_fetch_assoc($result_TIP )) {

	$VW_TIP_ID    = $row_TIP ['id_lanc_tipo'];
	$VW_TIP_DESCR = $row_TIP ['descricao'];

if( $_GET['md']== 'diario' ) {
?>
									<option value="<? echo "$VW_TIP_ID";?>"><? echo "$VW_TIP_DESCR";?></option>
<?
}

if( $_GET['md']== 'pagar' ) {
	if ($VW_TIP_ID=='2') {
?>
									<option value="<? echo "$VW_TIP_ID";?>"><? echo "$VW_TIP_DESCR";?></option>
<?
	}
}

if( $_GET['md']== 'receber' ) {
	if ($VW_TIP_ID=='1') {
?>
									<option value="<? echo "$VW_TIP_ID";?>"><? echo "$VW_TIP_DESCR";?></option>
<?
	}
}

}
?>

								  </select>
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Observação</span>
								  </div>
								  <input type="text" name="LANC_OBSERVACAO" value="" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="Breve descrição sobre" />
								</div>
								
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Valor R$</span>
								  </div>
								  <input type="text" name="LANC_VALOR" value="0,00" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="0,00" />
								</div>
								
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Data</span>
								  </div>
								  <input type="text" name="LANC_DATA" value="<? echo"$LANC_DATA"; ?>" class="form-control" aria-label="Titulo" aria-describedby="basic-addon1" placeholder="dd/mm/aaaa" />
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