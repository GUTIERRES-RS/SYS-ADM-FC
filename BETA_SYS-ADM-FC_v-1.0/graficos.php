
    <div class="container-fluid">

<script type="text/javascript" src="vendor/charts/loader.js"></script>
<?
$sql_LANC_TIP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
$result_LANC_TIP  = mysqli_query($connect, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$DESCR_L_T[] = $row_LANC_TIP ['descricao'];
}
?>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([

          ['ANO <? echo "$TO_A";?>', '<? echo $DESCR_L_T[0];?>s', '<? echo $DESCR_L_T[1];?>s'],

<? 
for ($x = 1; $x <= 12; $x++) {

$N = '0';
$sql_LANC_TIP = "SELECT * FROM lanc_tipos ORDER BY id_lanc_tipo ASC;";
$result_LANC_TIP  = mysqli_query($connect, $sql_LANC_TIP);

while ($row_LANC_TIP  = mysqli_fetch_assoc($result_LANC_TIP )) {

	$ID_L_T      = $row_LANC_TIP ['id_lanc_tipo'];

$sql_LANC_SOMA = "SELECT id_empresa, SUM(valor) as SOMA FROM lancamentos WHERE id_empresa='$S_EMP_ID' AND id_lanc_tipo='$ID_L_T' AND YEAR(data) = '$TO_A' AND MONTH(data) = '$x';";

    $result_LANC_SOMA = mysqli_query($connect, $sql_LANC_SOMA);
	
    while ($row_LANC_SOMA = mysqli_fetch_assoc($result_LANC_SOMA)) {
        
		$V_SOMA[$N] = $row_LANC_SOMA['SOMA']; // aqui eu guardo em uma array o valor do while para ela nao substituir
		$N++; // aqui eu vou aumentando a variavel

	}

}
// ENTRADAS
if ( $V_SOMA[0]=='' | $V_SOMA[0]==' ' | $V_SOMA[0]=='0') {
$V_T_SOMA_E = "0.00";
} else {
$V_T_SOMA_E = $V_SOMA[0];
}

// SAIDAS
if ( $V_SOMA[1]=='' | $V_SOMA[1]==' ' | $V_SOMA[1]=='0') {
$V_T_SOMA_S = "0.00";
} else {
$V_T_SOMA_S = $V_SOMA[1];
}
?>
		  [ 'Mês <?echo "$x";?>', <? echo "$V_T_SOMA_E";?>, <? echo "$V_T_SOMA_S";?> ],		
<?
} 
?>

        ]);

        var options = {
          chart: {
            title: 'Performance Mensal da Empresa',
            subtitle: '<? echo $DESCR_L_T[0];?>s, <? echo $DESCR_L_T[1];?>s',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Graficos</li>
		</ol>

		<div class="row">
		
			<div class="col-12">
	
				<h3><span class="text-warning">Graficos:</span></h3>
				<p>Area de visualização dos graficos de Performance da Empresa</p>

				<hr>

				<div style="width: 100%;">
				
					<div class="row">
					
						<!-- CARD SESSÂO -->
						<div class="col-md-12">
							<div class="shadow card mb-12">
								<div class="card-header">
									<h5 class="text-uppercase"><? echo $DESCR_L_T[0];?>s e <? echo $DESCR_L_T[1];?>s <? echo "$TO_A";?>:</h5>
								</div>
							
								<div class="card-body">
								
									<div id="columnchart_material" style="width: 100%; height: 400px"></div>

								</div>
								
							</div>
						</div>
						<!-- CARD SESSÂO -->
					
					</div>
				
				</div>
				
			</div>
			
		</div>
		
	</div>