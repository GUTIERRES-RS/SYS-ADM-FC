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
  <link href="vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Acesso ao Painel de Controle</div>
      <div class="card-body">
        <form method="post" action="?pag=painel&sec=login">
          <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input class="form-control" id="exampleInputEmail1" type="text" name="usuario" placeholder="Login">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="senha" placeholder="Senha">
          </div>
          <button class="btn btn-lg btn-success btn-block" type="submit" name="LOGAR">Entrar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>