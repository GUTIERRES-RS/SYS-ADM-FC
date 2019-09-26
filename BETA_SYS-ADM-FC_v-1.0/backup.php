
    <div class="container-fluid">

<?
//ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);//force php to show any error message
include ('backup.fc.php'); 
include ('backup_post.php');
include ('backup_post_exec.php');
?>


		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">BACKUP</li>
		</ol>

		<div class="row">
			<div class="col-12">

				<h3><span class="text-warning">Backup:</span> <small  class="text-muted" style="font-size:16px;">Aqui você faz o backup do banco de dados do sistema.</small></h3>

				<div style="width: 100%;">

					<form action="<?=$_SERVER['REQUEST_URI'];?>" method= "post"  enctype="multipart/form-data">

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { ?>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect_DB_SELECT">SELECIONE A DATA BASE</label>
					  </div>
					  <select name="DB_SELECT" id="inputGroupSelect_DB_SELECT" class="form-control selectpicker" data-max-options="1" data-live-search="true" data-style="custom-select" data-width="75%" multiple>

						<option value="0">DB PRIMARY: <?=$DB_PRIMARY;?></option>

<?
$sql_EMP = "SELECT * FROM empresas;";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EMP);

	while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

		$VW_EMP_ID  = $row_EMP ['id_empresa'];
		$VW_EMP_N_F = $row_EMP ['nome_fantasia'];

?>
						<option value="<?=$VW_EMP_ID;?>">DB CLIENTE: <?=$VW_EMP_N_F;?> - <?=''.$DB_CL_PREFIX.''.$VW_EMP_ID.'';?></option>
<?
	}
?>

					  </select>
					</div>
<?
} else {
?>
					<input type="hidden" name="DB_SELECT" value="<?= $S_EMP_ID;?>" />
<?
}
?>

					<div class="input-group mb-3">
						<div class="input-group">
							<button type="submit" class="btn btn-sm btn-success" name="BACKUP_INI">
								<span class="badge badge-pill badge-warning">INICIAR</span>
							</button>
						</div>
					</div>

					<script type="text/javascript">
					$(document).ready(function(){

						jQuery( function(){
						   //var pre = jQuery("#rolarDown");
							//pre.scrollTop( pre.prop("scrollHeight") );
							$('pre').scrollTop(9999999,$('pre').innerHeight());
						});

					});
					</script>
		
				</div>
				
			</div>
		</div>

		<div class="row overflow-auto">
			<div class="col-12">

				<table class="table table-striped text-nowrap table-sm">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">EMPRESA</th>
					  <th scope="col">ARQUIVO</th>
					  <th scope="col">TAMANHO ZIP</th>
					  <th scope="col">TAMANHO EXTRAIDO</th>
					  <th scope="col">DATA</th>
					  <th scope="col" class="text-center" style="width:30px;">AÇÕES</th>
					</tr>
				  </thead>

				  <tbody>
<?
if ($_SESSION['usuario_usr_p_Nivel']=='1') {

	$SQL_BKP_EMP_ID = "";
	
} else {

	$SQL_BKP_EMP_ID = " WHERE id_empresa='".$S_EMP_ID."'";

}

$sql_BKP = 'SELECT * FROM backups'.$SQL_BKP_EMP_ID.' ORDER BY data_hora DESC;';
//DEBUG
//echo "$sql_EMP";
$result_BKP  = mysqli_query($CONNECT_PRIMARY, $sql_BKP);

while ($row_BKP  = mysqli_fetch_assoc( $result_BKP )) {

	$VW_BKP_ID           = $row_BKP ['id_backup'];
	$VW_BKP_EMP_ID       = $row_BKP ['id_empresa'];
	$VW_BKP_DB_NAME      = $row_BKP ['bkp_db_name'];
	$VW_BKP_DATA_DB      = $row_BKP ['data_hora'];
	$VW_BKP_URL_DOWNLOAD = $row_BKP ['url_download'];
	
	$VW_BKP_DATA = dataTime( $VW_BKP_DATA_DB, 'VW' );

if ( $VW_BKP_EMP_ID=="$EMP_ID" ) { $BG_TR_L="bg-warning"; } else { $BG_TR_L=""; }
?>
				    <tr class="<? echo "$BG_TR_L";?>">
					  <th scope="row"><?= $VW_BKP_ID; ?></th>
<?
$sql_EMP = "SELECT * FROM empresas WHERE id_empresa='$VW_BKP_EMP_ID';";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EMP_N_F = $row_EMP ['nome_fantasia'];

?>
					  <td><? echo "$VW_EMP_N_F";?></td>
<?
}
?>
					  <td><?= $VW_BKP_DB_NAME; ?></td>
					  <td><?= get_zip_size($VW_BKP_URL_DOWNLOAD); ?></td>
					  <td><?= get_zip_originalsize($VW_BKP_URL_DOWNLOAD); ?></td>
					  <td><?= $VW_BKP_DATA; ?></td>
					  <td class="text-left">

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { ?>
						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="BKP_ID" value="<? echo "$VW_BKP_ID";?>" />
								<input type="hidden" name="BKP_EMP_ID" value="<? echo "$VW_BKP_EMP_ID";?>" />
								<input type="hidden" name="BKP_EMP_N_F" value="<? echo "$VW_EMP_N_F";?>" />
								<input type="hidden" name="BKP_DATA" value="<? echo "$VW_BKP_DATA";?>" />
								<input type="hidden" name="BKP_DB_NAME" value="<? echo "$VW_BKP_DB_NAME";?>" />
								<input type="hidden" name="BKP_URL_DOWNLOAD" value="<? echo "$VW_BKP_URL_DOWNLOAD";?>" />

								<button type="submit" class="btn btn-sm btn-warning btn-link text-white" name ="QUERY_INI">
									<i class="fa fa-fw fa-terminal" data-toggle="tooltip" data-placement="left" title="QUERY"></i>
								</button>

							</form>
						</div>
<?}?>

						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="BKP_ID" value="<? echo "$VW_BKP_ID";?>" />
								<input type="hidden" name="BKP_EMP_ID" value="<? echo "$VW_BKP_EMP_ID";?>" />
								<input type="hidden" name="BKP_EMP_N_F" value="<? echo "$VW_EMP_N_F";?>" />
								<input type="hidden" name="BKP_DATA" value="<? echo "$VW_BKP_DATA";?>" />
								<input type="hidden" name="BKP_DB_NAME" value="<? echo "$VW_BKP_DB_NAME";?>" />
								<input type="hidden" name="BKP_URL_DOWNLOAD" value="<? echo "$VW_BKP_URL_DOWNLOAD";?>" />

								<button type="submit" class="btn btn-sm btn-info btn-link text-white" name ="RESTAURAR_INI">
									<i class="fa fa-fw fa-retweet" data-toggle="tooltip" data-placement="left" title="RESTAURAR"></i>
								</button>

							</form>
						</div>

						<div class="d-inline-block">

							<a class="btn btn-sm btn-success btn-link text-white" href="<?= $VW_BKP_URL_DOWNLOAD; ?>">
								<i class="fa fa-fw fa-download" data-toggle="tooltip" data-placement="left" title="DOWNLOAD"></i>
							</a>

						</div>

						<div class="d-inline-block">
							<!-- Button trigger modal -->
							<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="BKP_ID" value="<? echo "$VW_BKP_ID";?>" />
								<input type="hidden" name="BKP_DATA" value="<? echo "$VW_BKP_DATA";?>" />
								<input type="hidden" name="BKP_DB_NAME" value="<? echo "$VW_BKP_DB_NAME";?>" />
								<input type="hidden" name="BKP_URL_DOWNLOAD" value="<? echo "$VW_BKP_URL_DOWNLOAD";?>" />

								<button type="submit" class="btn btn-sm btn-danger btn-link text-white" name ="DELETAR">
									<i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="left" title="DELETAR"></i>
								</button>

							</form>
						</div>

					  </td>
					</tr>
<?}?>

				  </tbody>
				</table>
<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { ?>

<?
	// Lista conteudo de um diretorio
	$PASTA = 'backup_sql/'.''.$DB_PRIMARY.'/';
	$ARQUIVOS = glob("$PASTA{*.zip,*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);
	foreach($ARQUIVOS as $ARQUIVOS_MATH){
	   echo $ARQUIVOS_MATH.'<br />';
	}

$sql_EMP = "SELECT * FROM empresas;";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EMP_ID  = $row_EMP ['id_empresa'];
	$VW_EMP_N_F = $row_EMP ['nome_fantasia'];


	// Lista conteudo de um diretorio
	$PASTA = 'backup_sql/'.''.$DB_CL_PREFIX.''.$VW_EMP_ID.'/';
	$ARQUIVOS = glob("$PASTA{*.zip,*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);
	foreach($ARQUIVOS as $ARQUIVOS_MATH){
	   echo $ARQUIVOS_MATH.'<br />';
	}

}
?>

<?}?>
			</div>
		</div>
		
	</div>