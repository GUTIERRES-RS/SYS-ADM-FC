    <div class="container-fluid">

<? include ('lancamentos_post_sql.php'); ?>

		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="?pag=painel&sec=index&vp=home">Painel</a>
		</li>
		<li class="breadcrumb-item active">Relatórios</li>
		</ol>

		<div class="row overflow-auto">
			<div class="col-12">
<!--Ajuda alerta hide show-->
<script>
$(document).ready(function(){
	$( "#o_ajuda" ).click(function() {
	  $( "#ajuda" ).toggleClass( "d-none" );
	});
});
</script>
				<h3><span class="text-warning">Relatórios</span> <small  class="text-muted" style="font-size:16px;">Aqui você gera os Relatórios. </small><button class="btn btn-sm btn-info" id="o_ajuda"><i class="fa fa-fw fa-question-circle"></i> Ajuda</button></h3>
				
				<div id="ajuda" class="alert alert-info alert-dismissible d-none" role="alert">
					<strong>Informação:</strong> Para gerar os relatórios é necessário preecher todos os campos.<br />
					No campo DATA você pode pesquisar por um Dia especifico Ex: "dd/mm/aaaa", Mês especifico Ex: "mm/aaaa" ou Ano especifico Ex: "aaaa"<br />
					Para gerar relatorios com o campo TIPO você tem que selecionar no campo GRUPO a opção TODOS e no campo TIPO uma das opções de Entrada e outra das opções de Saida para o correto funcionamento.
				</div>

<?
// Aqui vai as opções para geração dos relatorios
include ('relatorios_options.php');
?>

				<table class="table table-striped">
				  <thead>
					<tr class="bg-primary text-white">
					  <th scope="col">ID</th>
					  <th scope="col">GRUPO</th>
					  <th scope="col">TIPO</th>
					  <th scope="col">OBSERVAÇÃO</th>
					  <th scope="col">VALOR</th>
					  <th scope="col">DATA</th>
					</tr>
				  </thead>

				  <tbody>

					<tr>
					  <th scope="row">ID_V<? echo "$VW_LANC_L_ID";?></th>
					  <td>GRUPO_V<? echo "$VW_L_GRP_DESCR";?></td>
					  <td>TIPO_V<? echo "$VW_L_TIP_DESCR";?></td>
					  <td>OBSERVAÇÃO_V<? echo "$VW_LANC_OBS";?></td>
					  <td>VALOR_V R$ <? echo "$VW_LANC_VALOR";?></td>
					  <td>DATA_V<? echo "$VW_LANC_DATA";?></td>
					</tr>

					<tr class="bg-secondary text-white">
					  <th scope="row" colspan="3"></th>
					  <th scope="row">TOTAL de <? echo "$DESCR_L_G"; ?></th>
					  <th scope="row">R$ <? echo "$VW_TOTAL"; ?></th>
					  <th scope="row" colspan="2"></th>
					</tr>

					<tr class="<? echo "$BG_TR";?>">
					  <th scope="row" colspan="3"></th>
					  <th scope="row">TOTAL de </th>
					  <th scope="row">R$ <? echo "$VW_TOTAL_E_S"; ?></th>
					  <th scope="row" colspan="2"></th>
					</tr>

					<tr style="height:500px;">
					  <th scope="row" colspan="7"><h5>Nenhum lançamento encontrado para a data selecionada.</h5></th>
					</tr>

					<tr style="height:500px;">
					  <th scope="row" colspan="7"><h5>Selecione um tipo de "Entrada" e um tipo de "Saida".</h5></th>
					</tr>

					<tr>
					  <th scope="row" colspan="7"><h5>Selecione as opções para Gerar o Relatorio.</h5></th>
					</tr>

				  </tbody>

				</table>
				
			</div><!-- col-12 -->
		</div><!-- row -->

	</div><!-- container-fluid -->