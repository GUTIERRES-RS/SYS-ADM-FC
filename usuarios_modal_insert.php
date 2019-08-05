				<form action="?pag=painel&sec=index&vp=usuarios" method="post" enctype="multipart/form-data">

				<div class="modal fade" id="Modal_INSERT" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_INSERT" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel_INSERT">INSERIR NOVO USUARIO <small class="text-muted">Preecha abaixo com os dados do novo usuario</small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<input type="hidden" name="p_id" value="0" />
						<input type="hidden" name="ativo" value="0" />
							
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
							<!--option value="1">Webmaster</option-->
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