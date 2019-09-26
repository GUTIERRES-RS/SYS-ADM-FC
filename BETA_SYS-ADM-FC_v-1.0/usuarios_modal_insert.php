				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_INSERT" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_INSERT" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_INSERT">INSERIR NOVO USUARIO: <small class="text-muted">Preecha abaixo com os dados do novo usuario</small></h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="USR_ID" value="0" />
						<input type="hidden" name="ativo" value="0" />

<? if ($_SESSION['usuario_usr_p_Nivel']!='1') {?>
						<input type="hidden" name="EMP_ID" value="<? echo "$S_EMP_ID";?>" />
<?} else {?>
						<!-- Card - 1 -->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">EMPRESA</span>
							</div>
							<select id="EMP_ID" name="EMP_ID" class="form-control selectpicker" data-max-options="1" data-live-search="true" data-style="custom-select" data-width="75%" multiple>

<?							
$sql_EMP_SLC = "SELECT * FROM empresas ORDER BY nome_fantasia ASC;";
//echo "$sql_EMP_SLC";
$result_EMP_SLC  = mysqli_query($CONNECT_PRIMARY, $sql_EMP_SLC);

while ($row_EMP_SLC  = mysqli_fetch_assoc($result_EMP_SLC )) {

	$VW_EP_SC_ID     = $row_EMP_SLC ['id_empresa'];
	$VW_EP_SC_N_FANT = $row_EMP_SLC ['nome_fantasia'];
	$VW_EP_SC_CNPJ   = $row_EMP_SLC ['cnpj'];
	$VW_EP_SC_FONE   = $row_EMP_SLC ['fone'];
?>

								<option value="<? echo "$VW_EP_SC_ID";?>"><? echo "$VW_EP_SC_N_FANT";?></option>

<?
}
?>

							</select>

						</div>
<?}?>

						<!-- Card - 1 -->
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Nome:</span>
						  </div>
						  <input type="text" name="nome" value="" class="form-control" aria-label="Nome" aria-describedby="basic-addon1" placeholder="Aqui vai o Nome">
						</div>
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Login:</span>
						  </div>
						  <input type="text" name="usuario" value="" class="form-control" aria-label="Usuario" aria-describedby="basic-addon1" placeholder="Aqui vai o Usuario">
						</div>
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">Nivel</label>
						  </div>
						  <select name="nivel" class="custom-select" id="inputGroupSelect01">
							<option value="3" selected>Escolha o tipo de acesso...</option>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') {?>
							<option value="1">Webmaster</option>
<?}?>
							<option value="2">Administrador</option>
							<option value="3">Usuario</option>
						  </select>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Digite a senha:</span>
							</div>
							<input type="text" name="senha" value="" class="form-control" aria-label="Digite a nova senha" aria-describedby="basic-addon1" placeholder="Aqui vai a Senha" />
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