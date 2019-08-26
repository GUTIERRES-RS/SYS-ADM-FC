	<div aria-live="polite" aria-atomic="true" style="position:relative;">
		<!-- Position it -->
		<div style="position:fixed; width:400px; bottom:10px; right:10px; z-index:99999999;">
<?
// FILTER
if ( $ALERT=='NO_FILTER' ) {
?>
			<div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-info">ATENÇÃO</span></strong>
				<small>Não<strong> executada!</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body">
				<? echo $INFO; ?>
			  </div>
			</div>
<?
}
// FILTER
?>
<?
// INSERT
if ( $ALERT=='OK_INSERT' ) {
?>
			<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-success">INSERÇÃO</span></strong>
				<small>Executada<strong> com sucesso.</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<? echo $INFO; ?><br />
				<span class="badge badge-pill badge-warning">Inserido com sucesso.</span>
			  </div>
			</div>
<?
}
?>
<?
if ( $ALERT=='NO_INSERT' ) {
?>
			<div class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-danger">INSERÇÃO</span></strong>
				<small>Não<strong> executada!</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<span class="badge badge-pill badge-warning">Erro na execução:</span>
				<? echo $INFO; ?>
			  </div>
			</div>
<?
}
// INSERT
?>
<?
// ALTER
if ( $ALERT=='OK_ALTER' ) {
?>
			<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-primary">ALTERAÇÃO</span></strong>
				<small>Executada<strong> com sucesso.</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<? echo $INFO; ?><br />
				<span class="badge badge-pill badge-warning">Alterado com sucesso.</span>
			  </div>
			</div>
<?
}
?>
<?
if ( $ALERT=='NO_ALTER' ) {
?>
			<div class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-danger">ALTERAÇÃO</span></strong>
				<small>Não<strong> executada!</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<span class="badge badge-pill badge-warning">Erro na execução:</span>
				<? echo $INFO; ?>
			  </div>
			</div>
<?
}
// ALTER
?>
<?
// DELET
if ( $ALERT=='OK_DELET' ) {
?>
			<div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-danger">EXCLUSÃO<span></strong>
				<small>Executada<strong> com sucesso.</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<? echo $INFO; ?><br />
				<span class="badge badge-pill badge-warning">Excluido com sucesso.<span>
			  </div>
			</div>
<?
}
?>
<?
if ( $ALERT=='NO_DELET' ) {
?>
			<div class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">

				<strong class="mr-auto"><span class="text-danger">EXCLUÃO</span></strong>
				<small>Não<strong> executada!</strong></small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="toast-body text-white">
				<span class="badge badge-pill badge-warning">Erro na execução:<span>
				<? echo $INFO; ?>
			  </div>
			</div>
<?
}
// DELET
?>
		</div>

	</div>



	<script type="text/javascript">
	$(document).ready(function(){

		$(".toast").toast({ delay: 30000 });
		$('.toast').toast('show');

	});
	</script>