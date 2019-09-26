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
				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">EMPRESA</th>
					  <th scope="col">NOME</th>
					  <th scope="col">LOGIN</th>
					  <th scope="col">NIVEL</th>
					  <th scope="col">STATUS</th>
					  <th scope="col" class="text-center" style="width:30px;">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>
<?
 if ($_SESSION['usuario_usr_p_Nivel']=='1') { // Nivel 1 WebMaster
$sql_USR = "SELECT * FROM users_painel ORDER BY id_empresa ASC;";
}

 if ($_SESSION['usuario_usr_p_Nivel']=='2') { // Nivel 2 Administrador
$sql_USR = "SELECT * FROM users_painel WHERE id_empresa='$S_EMP_ID' ORDER BY id DESC;";
}

 if ($_SESSION['usuario_usr_p_Nivel']=='3') { // Nivel 3 Usuario
$ID_USER = $_SESSION['usuario_usr_p_ID'];
$sql_USR = "SELECT * FROM users_painel WHERE id='$ID_USER';";
}

$result_USR  = mysqli_query($CONNECT_PRIMARY, $sql_USR);

while ($row_USR  = mysqli_fetch_assoc($result_USR )) {

	$VW_USR_ID      = $row_USR ['id'];
	$VW_USR_EMP_ID  = $row_USR ['id_empresa'];
	$VW_USR_NOME    = $row_USR ['nome'];
	$VW_USR_USUARIO = $row_USR ['usuario'];
	$VW_USR_SENHA   = $row_USR ['senha'];
	$VW_USR_STATUS  = $row_USR ['ativo'];
	$VW_USR_NIVEL   = $row_USR ['nivel'];



if ( $_POST['USR_ID']=="$VW_USR_ID" ) { $BG_EDIT="bg-warning"; } else { $BG_EDIT=""; }
?>
					<tr class="<?echo "$BG_EDIT";?>">
					  <th scope="row"><? echo "$VW_USR_ID";?></th>
<?
$sql_EMP = "SELECT * FROM empresas WHERE id_empresa='$VW_USR_EMP_ID';";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EMP_N_F = $row_EMP ['nome_fantasia'];

?>
					  <td><? echo "$VW_EMP_N_F";?></td>
<?
}
?>
					  <td><? echo "$VW_USR_NOME";?></td>
					  <td><? echo "$VW_USR_USUARIO";?></td>
					  <td><? if ($VW_USR_NIVEL=='1') {echo "WebMaster";} if ($VW_USR_NIVEL=='2') {echo "Administrador";} if ($VW_USR_NIVEL=='3') {echo "Usuario";}?></td>
					  <td><? if ($VW_USR_STATUS=='0') { echo "<spam class='badge badge-danger'>DESATIVADO</span>"; } else { echo "<spam class='badge badge-success'>ATIVO</span>"; } ?></td>
					  <td class="text-left">
					  
						<div class="d-inline-block">
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="USR_ID" value="<? echo "$VW_USR_ID";?>" />
								<!-- Button trigger modal -->
								<button class="btn btn-sm btn-primary btn-link text-white" name="EDITAR_USR_<? echo "$VW_USR_ID";?>">
									<i class="fa fa-fw fa-pencil" data-toggle="tooltip" data-placement="left" title="EDITAR"></i>
								</button>

							</form>
						</div>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1' || $_SESSION['usuario_usr_p_Nivel']=='2') {?>			
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="USR_ID" value="<? echo "$VW_USR_ID";?>" />
								<input type="hidden" name="nome" value="<? echo "$VW_USR_NOME";?>" />
<? if ($VW_USR_STATUS=='0') { ?>
								<input type="hidden" name="ativo" value="1" />
								
								<button type="submit" class="btn btn-sm btn-success btn-link text-white" name="ATIVAR">
									<i class="fa fa-fw fa-check-circle-o" data-toggle="tooltip" data-placement="left" title="ATIVAR"></i>
								</button>
<? } else { ?>
								<input type="hidden" name="ativo" value="0" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name="ATIVAR">
									<i class="fa fa-fw fa-ban" data-toggle="tooltip" data-placement="left" title="DESATIVAR"></i>
								</button>
<? } ?>							
							</form>
						</div>

<? if ($VW_USR_ID==$_SESSION['usuario_usr_p_ID'] || $_SESSION['usuario_usr_p_Nivel']=='3') {} else {?>						
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
							
								<input type="hidden" name="USR_ID" value="<? echo "$VW_USR_ID";?>" />
								<input type="hidden" name="nome" value="<? echo "$VW_USR_NOME";?>" />
								
								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="left" title="DELETAR"></i>
								</button>
								
							</form>
						</div>
<?}?>
<?}?>
					  </td>
					</tr>
<?
if(isset($_POST['EDITAR_USR_'.$VW_USR_ID.''])) {
?>
					<tr>
					  <th colspan="7">
					  <span class="badge badge-secondary">EDITANDO ID.:</span> <span class="badge badge-warning"><? echo"$VW_USR_ID";?></span>
<script type="text/javascript">
	$(document).ready(function() {
        $('#Modal_<? echo "$VW_USR_ID";?>').modal('show');
    });
</script>
						<!-- Modal -->
<? include ('usuarios_modal_update.php');?>
						<!-- Modal -->
					  </th>
					</tr>
<?
}
?>

<?
}
?>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->