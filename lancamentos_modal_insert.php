
			<form action="?pag=painel&sec=index&vp=lancamentos" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_INSERT" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_INSERT" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_INSERT">NOVO LANÇAMENTO: <span class="badge badge-warning"><?echo "$LANC_GRP_DESCR"; ?></span> <small class="text-muted">Preecha todos os dados</small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="LANC_ID" value="0" />
						<input type="hidden" name="LANC_GRP_ID" value="<? echo "$LANC_GRP_ID";?>" />

						<div class="card-body">
						
							<div class="card-title">

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect_LANC_TIPO">TIPO</label>
								  </div>
								  <select name="LANC_TIP_ID" class="custom-select" id="inputGroupSelect_LANC_TIPO">

<?
$sql_TIP = "SELECT * FROM lanc_tipos ORDER BY descricao ASC;";
//echo "$sql_TIP";
$result_TIP  = mysqli_query($connect, $sql_TIP);

while ($row_TIP  = mysqli_fetch_assoc($result_TIP )) {

	$VW_TIP_ID    = $row_TIP ['id_lanc_tipo'];
	$VW_TIP_DESCR = $row_TIP ['descricao'];
?>
									<option value="<? echo "$VW_TIP_ID";?>"><? echo "$VW_TIP_DESCR";?></option>
<?
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