    <div class="container-fluid">

<? include ('usuarios_post_sql.php'); ?>
<? include ('usuarios_modal_insert.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Usuários</li>
		</ol>

		<div class="row">
			<div class="col-12">
			
				<h3><span class="text-warning">Usuários</span> <small  class="text-muted" style="font-size:16px;">Aqui você edita<? if ($_SESSION['usuario_usr_p_Nivel']=='1' || $_SESSION['usuario_usr_p_Nivel']=='2') { ?>, desativa ou deleta os usuarios do painel.<?} else {?> seu usuario do painel.<?}?></small></h3>
<? if ($_SESSION['usuario_usr_p_Nivel']=='1' || $_SESSION['usuario_usr_p_Nivel']=='2') { ?>		
				<p>
					<a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#Modal_INSERT">
						<i class="fa fa-fw fa-plus"></i>Inserir novo login
					</a>
				</p>
<?}?>
			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">
				<table class="table table-striped text-nowrap">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">EMPRESA</th>
					  <th scope="col">NOME</th>
					  <th scope="col">LOGIN</th>
					  <th scope="col">NIVEL</th>
					  <th scope="col">STATUS</th>
					  <th scope="col" class="text-right">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>
<?
 if ($_SESSION['usuario_usr_p_Nivel']=='1') { // Nivel 1 WebMaster
$sql_PAGE_USER = "SELECT * FROM users_painel ORDER BY id_empresa ASC;";
}

 if ($_SESSION['usuario_usr_p_Nivel']=='2') { // Nivel 2 Administrador
$sql_PAGE_USER = "SELECT * FROM users_painel WHERE id_empresa='$S_EMP_ID' ORDER BY id DESC;";
}

 if ($_SESSION['usuario_usr_p_Nivel']=='3') { // Nivel 3 Usuario
$ID_USER = $_SESSION['usuario_usr_p_ID'];
$sql_PAGE_USER = "SELECT * FROM users_painel WHERE id='$ID_USER';";
}

$result_PAGE_USER  = mysqli_query($connect, $sql_PAGE_USER);

while ($row_PAGE_USER  = mysqli_fetch_assoc($result_PAGE_USER )) {

	$view_P_ID     = $row_PAGE_USER ['id'];
	$view_ID_EMP   = $row_PAGE_USER ['id_empresa'];
	$view_NOME     = $row_PAGE_USER ['nome'];
	$view_USUARIO  = $row_PAGE_USER ['usuario'];
	$view_SENHA    = $row_PAGE_USER ['senha'];
	$view_STATUS   = $row_PAGE_USER ['ativo'];
	$view_NIVEL    = $row_PAGE_USER ['nivel'];

?>

					<tr>
					  <th scope="row"><? echo "$view_P_ID";?></th>
<?
$sql_EMP = "SELECT * FROM empresas WHERE id_empresa='$view_ID_EMP';";
$result_EMP  = mysqli_query($connect, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EMP_N_F = $row_EMP ['nome_fantasia'];

?>
					  <td><? echo "$VW_EMP_N_F";?></td>
<?
}
?>
					  <td><? echo "$view_NOME";?></td>
					  <td><? echo "$view_USUARIO";?></td>
					  <td><? if ($view_NIVEL=='1') {echo "WebMaster";} if ($view_NIVEL=='2') {echo "Administrador";} if ($view_NIVEL=='3') {echo "Usuario";}?></td>
					  <td><? if ($view_STATUS=='0') { echo "<spam class='badge badge-danger'>DESATIVADO</span>"; } else { echo "<spam class='badge badge-success'>ATIVO</span>"; } ?></td>
					  <td class="text-right" style="width:10%;">
					  
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<button class="btn btn-sm btn-primary btn-link text-white" data-toggle="modal" data-target="#Modal_<? echo "$view_P_ID";?>">
								<i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-placement="top" title="EDITAR"></i>
							</button>
						</div>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1' || $_SESSION['usuario_usr_p_Nivel']=='2') {?>			
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=usuarios" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="p_id" value="<? echo "$view_P_ID";?>" />
<? if ($view_STATUS=='0') { ?>
								<input type="hidden" name="ativo" value="1" />
								
								<button type="submit" class="btn btn-sm btn-success btn-link text-white" name="ATIVAR">
									<i class="fa fa-fw fa-check-circle-o" data-toggle="tooltip" data-placement="top" title="ATIVAR"></i>
								</button>
<? } else { ?>
								<input type="hidden" name="ativo" value="0" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name="ATIVAR">
									<i class="fa fa-fw fa-ban" data-toggle="tooltip" data-placement="top" title="DESATIVAR"></i>
								</button>
<? } ?>							
							</form>
						</div>

<? if ($view_P_ID==$_SESSION['usuario_usr_p_ID'] || $_SESSION['usuario_usr_p_Nivel']=='3') {} else {?>						
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="?pag=painel&sec=index&vp=usuarios" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="p_id" value="<? echo "$view_P_ID";?>" />
								<input type="hidden" name="nome" value="<? echo "$view_NOME";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="DELETAR"></i>
								</button>
								
							</form>
						</div>
<?}?>
<?}?>
					  </td>
					</tr>
						<!-- Modal -->
<? include ('usuarios_modal_update.php');?>
						<!-- Modal -->
<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->