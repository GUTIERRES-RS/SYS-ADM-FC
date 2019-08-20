				<form action="?pag=painel&sec=index&vp=usuarios" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_<? echo "$view_P_ID";?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_<? echo "$view_P_ID";?>" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_<? echo "$view_P_ID";?>">ALTERAR USUÁRIO <small class="text-muted">ID.: <? echo "$view_P_ID";?></small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="p_id" value="<? echo "$view_P_ID";?>" />
						<input type="hidden" name="senha_old" value="<? echo "$view_SENHA";?>" />
						<input type="hidden" name="ativo" value="<? echo "$view_STATUS";?>" />
							
						<!-- Card - 1 -->
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Nome:</span>
						  </div>
						  <input type="text" name="nome" value="<? echo "$view_NOME";?>" class="form-control" aria-label="Nome" aria-describedby="basic-addon1" placeholder="Aqui vai o Nome">
						</div>
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Login:</span>
						  </div>
						  <input type="text" name="usuario" value="<? echo "$view_USUARIO";?>" class="form-control" aria-label="Usuario" aria-describedby="basic-addon1" placeholder="Aqui vai o Usuario">
						</div>
<? if ($_SESSION['usuario_usr_p_Nivel']=='3') {?>
						<input type="hidden" name="nivel" value="<? echo "$view_NIVEL";?>" />
<?} else {?>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">Nivel</label>
						  </div>
						  <select name="nivel" class="custom-select" id="inputGroupSelect01">
							<option value="<? echo "$view_NIVEL";?>" selected>Escolha o tipo de acesso...</option>
							<!--option value="1">Webmaster</option-->
							<option value="2">Administrador</option>
							<option value="3">Usuario</option>
						  </select>
						</div>
<?}?>
						<div class="input-group mb-3">
							<button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample-<? echo "$view_P_ID";?>" aria-expanded="false" aria-controls="collapseExample-<? echo "$view_P_ID";?>">Alterar Senha:</button>
						</div>
						
						<div class="collapse" id="collapseExample-<? echo "$view_P_ID";?>">
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