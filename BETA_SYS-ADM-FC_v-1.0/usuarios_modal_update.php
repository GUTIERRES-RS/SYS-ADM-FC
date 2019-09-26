				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_<? echo "$VW_USR_ID";?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_<? echo "$VW_USR_ID";?>" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">

						<h6 class="modal-title" id="ModalLabel_<? echo "$VW_USR_ID";?>">
							ALTERAR USUÁRIO: <small class="text-muted">Altere abaixo os dados do usuario</small><br />
							<small class="badge badge-warning">ID.: <? echo "$VW_USR_ID";?></small>
						</h6>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="USR_ID" value="<? echo "$VW_USR_ID";?>" />
						<input type="hidden" name="senha_old" value="<? echo "$VW_USR_SENHA";?>" />
						<input type="hidden" name="ativo" value="<? echo "$VW_USR_STATUS";?>" />

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
<?
if ( $VW_USR_EMP_ID==$VW_EP_SC_ID ) {
?>
								<option value="<? echo "$VW_EP_SC_ID";?>" selected><? echo "$VW_EP_SC_N_FANT";?></option>
<?
} else {
?>
								<option value="<? echo "$VW_EP_SC_ID";?>"><? echo "$VW_EP_SC_N_FANT";?></option>
<?
}
}
?>

							</select>

						</div>
<?}?>						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">NOME:</span>
						  </div>
						  <input type="text" name="nome" value="<? echo "$VW_USR_NOME";?>" class="form-control" aria-label="Nome" aria-describedby="basic-addon1" placeholder="Aqui vai o Nome">
						</div>
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">LOGIN:</span>
						  </div>
						  <input type="text" name="usuario" value="<? echo "$VW_USR_USUARIO";?>" class="form-control" aria-label="Usuario" aria-describedby="basic-addon1" placeholder="Aqui vai o Usuario">
						</div>
<? if ($_SESSION['usuario_usr_p_Nivel']=='3') {?>
						<input type="hidden" name="nivel" value="<? echo "$VW_USR_NIVEL";?>" />
<?} else {?>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">NIVEL</label>
						  </div>
						  <select name="nivel" class="custom-select" id="inputGroupSelect01">
							<option value="<? echo "$VW_USR_NIVEL";?>" selected>Escolha o tipo de acesso...</option>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') {?>
							<option value="1">Webmaster</option>
<?}?>
							<option value="2">Administrador</option>
							<option value="3">Usuario</option>
						  </select>
						</div>
<?}?>
						<div class="input-group mb-3">
							<button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample-<? echo "$VW_USR_ID";?>" aria-expanded="false" aria-controls="collapseExample-<? echo "$VW_USR_ID";?>">Alterar Senha:</button>
						</div>
						
						<div class="collapse" id="collapseExample-<? echo "$VW_USR_ID";?>">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Digite a nova senha:</span>
								</div>
								<input type="text" name="senha_new" value="" class="form-control" aria-label="Digite a nova senha" aria-describedby="basic-addon1" placeholder="Aqui vai a Senha" />
							</div>
						</div>

					  </div>
					  <div class="modal-footer">						
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-primary" name="ALTERAR"><i class="fa fa-fw fa-save"></i> Salvar</button>
					  </div>
					</div>
				  </div>
				</div>

				</form>