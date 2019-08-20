
    <div class="container-fluid">

<? include ('administracao_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Administração</li>
		</ol>

		<div class="row">
		
			<div class="col-12">
	
				<h3><span class="text-warning">Administração:</span></h3>
				<p>Aqui se libera e bloqueia o acesso ao site e altera algumas informações</p>

				<hr>

				<div style="width: 100%;">
				
					<div class="row">
					
						<!-- CARD SESSÂO -->
						<div class="col-md-4">
							<div class="shadow card mb-4">
								<div class="card-header">
									<h5>Dados da sessão:</h5>
								</div>
							
								<div class="card-body">
								
									<h6>SEU LOGIN:</h6>
									<p>
										<strong>SEU ID:</strong> <span class="badge badge-success"><? echo $_SESSION['usuario_usr_p_ID'];?></span><br />
										<strong>EMPRESA ID:</strong> <span class="badge badge-info"><? echo $_SESSION['usuario_usr_p_Empresa'];?></span><br />
										<strong>Nome:</strong> <? echo $_SESSION['usuario_usr_p_Nome'];?><br />
										<strong>Usuario:</strong> <? echo $_SESSION['usuario_usr_p_Login'];?><br />
										<strong>Nivel:</strong> <? if ($_SESSION['usuario_usr_p_Nivel']=='1') {echo "WebMaster";} if ($_SESSION['usuario_usr_p_Nivel']=='2') {echo "Administrador";} if ($_SESSION['usuario_usr_p_Nivel']=='3') {echo "Usuario";}?>
									</p>
								</div>
								
							</div>
						</div>
						<!-- CARD SESSÂO -->
						
						<!-- CARD INFO -->
						<div class="col-md-4">
							<div class="shadow card mb-4">
								<div class="card-header">
									<h5>Informações:</h5>
								</div>
							
								<div class="card-body">

<?
$sql_PAGE_EMP = "SELECT * FROM empresas WHERE id_empresa='$S_EMP_ID';";
$result_PAGE_EMP  = mysqli_query($connect, $sql_PAGE_EMP);

while ($row_PAGE_EMP  = mysqli_fetch_assoc($result_PAGE_EMP )) {

	$view_EP_ID   = $row_PAGE_EMP ['id_empresa'];
	$view_EP_N_F  = $row_PAGE_EMP ['nome_fantasia'];
	$view_EP_CNPJ = $row_PAGE_EMP ['cnpj'];
	$view_EP_FONE = $row_PAGE_EMP ['fone'];

?>
<?
}
?>
									<h6>Dados da empresa:</h6>
									
									<form action="?pag=painel&sec=index&vp=administracao" method="post" enctype="multipart/form-data">
									
										<input type="hidden" name="ep_id" value="<? echo "$view_EP_ID";?>" />
										
										<div class="input-group input-group-sm mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-sm">Nome Fantasia</span>
											</div>
											<input type="text" name="nome_fantasia" value="<? echo "$view_EP_N_F";?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" />
										</div>
										
										<div class="input-group input-group-sm mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-sm">CNPJ</span>
											</div>
											<input type="text" name="cnpj" value="<? echo "$view_EP_CNPJ";?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="00.000.000.0001-00" />
										</div>
										
										<div class="input-group input-group-sm mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-sm">Fone</span>
											</div>
											<input type="text" name="fone" value="<? echo "$view_EP_FONE";?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="51 0000-0000" />
										</div>
										
										<button name="ALT_EMPRESA" type="submit" class="btn btn-primary">Salvar</button>
									</form>

								</div>
								
							</div>
						</div>
						<!-- CARD INFO -->
						
					</div>

				</div>
				
			</div>
			
		</div>
		
	</div>