<!DOCTYPE html>

<html lang="br" class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PAINEL DE CONTROLE STA</title>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function(){
		$("#texto-1").keyup(function(e){
			$("#msg").html($(this).val());
		});
	});
  </script>

</head>

<body>

<div id="msg"></div>

<br />
<br />

<input type="text" name="texto" id="texto-1" value="">

<script src="vendor/jquery/jquery.min.js"></script>
</body>

</html>