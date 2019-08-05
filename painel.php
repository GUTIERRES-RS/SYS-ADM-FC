<!DOCTYPE html>

<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PAINEL DE CONTROLE SG</title>

  <link rel="shortcut icon" href="../site/vendor/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="../site/vendor/images/favicon.ico" type="image/x-icon">
  
  <!-- Bootstrap core CSS-->
  <link type="text/css" href="vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Custom fonts for this template-->
  <link type="text/css" href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link type="text/css" href="css/sb-admin.css" rel="stylesheet" />
 
  <!-- Latest compiled and minified CSS -->
  <link type="text/css" href="vendor/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet">
  
  <!-- jQuery v3.3.1 -->
  <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>

 </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

	<!-- Navigation-->	
<?include ('nav_bar.php');?>

  <div class="content-wrapper">
  
    <!-- /.container-fluid-->
<?
// Meu código de query string
//INICIO _GET

$VAR_GET['url'] = "vp";
$URL_ERRO['url_erro'] = "administracao";

if ($_GET[$VAR_GET['url']] == "") {$pag = $URL_ERRO['url_erro'];} else {$pag = $_GET[$VAR_GET['url']];}

if (file_exists("$pag.php")){
	include("$pag.php");
	} else {
	include($URL_ERRO['url_erro'].".php");
	}
//FIM _GET
?>
    <!-- /.container-fluid-->
<? $today = date("Y");?>	
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © SG Suporte a T.I. <? echo "$today";?></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Você quer realmente sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Logout" se você realmente quer finalizar o acesso.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="?pag=painel&sec=sair">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="vendor/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>

	<!-- (Optional) Latest compiled and minified JavaScript translation files -->
	<script type="text/javascript" src="vendor/bootstrap-select-1.13.9/dist/js/i18n/defaults-pt_BR.min.js"></script>

  </div>
  <!-- /.content-wrapper-->
  <!--script src="js/custom-file-input.js"></script-->
</body>

</html>