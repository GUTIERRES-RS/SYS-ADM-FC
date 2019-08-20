<meta http-equiv="refresh" content="900" />

    <div class="container-fluid">

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Usuarios On-Line</li>
		</ol>

		<div class="row">
			<div class="col-12">

				<h3><span class="text-warning">Usuarios On-Line</span> <small  class="text-muted" style="font-size:16px;"> Visualização dos usuarios on-line.</small></h3>

				<table class="table table-striped">

				  <thead>

					<tr class="bg-primary text-white">
					  <th scope="col">USER ID</th>
					  <th scope="col">EMPRESA</th>
					  <th scope="col">NOME</th>
					  <th scope="col">IP</th>
					  <th scope="col">ULT. ATIVIDADE</th>
					  <th scope="col">ATIVO</th>
					  <th scope="col">AÇÕES</th>
					</tr>

				  </thead>

				  <tbody>
<?

$sql_USR_ON = "SELECT * FROM users_painel_on ORDER BY users_painel_temp DESC;";
$result_USR_ON  = mysqli_query($connect, $sql_USR_ON);

while ($row_USR_ON  = mysqli_fetch_assoc($result_USR_ON )) {

	$VW_USR_ON_ID    = $row_USR_ON ['id_users_painel_on'];
	$VW_USR_ON_P_ID  = $row_USR_ON ['users_painel_id'];
	$VW_USR_ON_IP    = $row_USR_ON ['users_painel_ip'];
	$VW_USR_ON_TEMP  = $row_USR_ON ['users_painel_temp'];
	$VW_USR_ON_ATIVO = $row_USR_ON ['users_painel_ativo'];

//Formata a Data do BD para VW: ex: 2019-01-02 para 02/01/2019
$TEMP_D_T = explode(" ", $VW_USR_ON_TEMP);
$X_D = $TEMP_D_T[0]; //0000-12-01
$X_T = $TEMP_D_T[1]; //00:00:00

$TEMP_D = explode("-", $X_D);

$D_X_A = $TEMP_D[0];
$D_X_M = $TEMP_D[1];
$D_X_D = $TEMP_D[2];

$VW_DATA = "$D_X_D/$D_X_M/$D_X_A";

?>
					<tr>
					  <th scope="row"><? echo "$VW_USR_ON_P_ID";?></th>
<?

$sql_USR_P = "SELECT * FROM users_painel WHERE id='$VW_USR_ON_P_ID';";
$result_USR_P  = mysqli_query($connect, $sql_USR_P);

while ($row_USR_P  = mysqli_fetch_assoc($result_USR_P )) {

	$VW_USR_P_ID    = $row_USR_P ['id'];
	$VW_USR_P_ID_EP = $row_USR_P ['id_empresa'];
	$VW_USR_P_NOME  = $row_USR_P ['nome'];
	$VW_USR_P_USR   = $row_USR_P ['usuario'];

$sql_EMP = "SELECT * FROM empresas WHERE id_empresa='$VW_USR_P_ID_EP';";
$result_EMP  = mysqli_query($connect, $sql_EMP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EMP_N_F = $row_EMP ['nome_fantasia'];

?>
					  <td><? echo "$VW_EMP_N_F";?></td>
<?
}
?>
					  <td><? echo "$VW_USR_P_NOME";?></td>
<?
}
?>
					  <td><? echo "$VW_USR_ON_IP";?></td>
					  <td><? echo "$VW_DATA";?> às <? echo "$X_T";?></td>
<?
if ($VW_USR_ON_ATIVO=='1') {$ATIVO="<spam class='badge badge-success'>On-Line</spam>";} else {$ATIVO="<spam class='badge badge-danger'>Off-Line</spam>";}
?>
					  <td><? echo "$ATIVO";?></td>
					  <td class="align-right" style="width:115px;">

						<div class="float-left">
							<!-- Button trigger modal -->
							<a class="btn btn-sm btn-primary text-white">
								<i class="fa fa-fw fa-search-plus"></i>
							</a>
						</div>

					  </td>
					</tr>
<?
}
?>
				  </tbody>
				</table>

			</div>
			
		</div>
		
	</div>