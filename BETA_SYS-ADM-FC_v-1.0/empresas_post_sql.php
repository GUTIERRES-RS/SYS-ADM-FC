<!-- INSERIR -->
<?

if(isset($_POST['INSERT']))

{

	$EMP_ID     = $_POST['EMP_ID'];
	$EMP_N_FANT = $_POST['EMP_N_FANT'];
	$EMP_CNPJ   = $_POST['EMP_CNPJ'];
	$EMP_FONE   = $_POST['EMP_FONE'];

	//SQL Alterar informações para o BD.
	$query = "INSERT INTO empresas (id_empresa, nome_fantasia, cnpj, fone) VALUES ('$EMP_ID','$EMP_N_FANT','$EMP_CNPJ','$EMP_FONE');";
	//echo "$query<BR>";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	
	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");
	

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>NOVA EMPRESA</strong><br /><strong>NOME FANTASIA:</strong> '.$EMP_N_FANT.'';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- INSERIR -->

<!-- ALTERAR -->
<?

if(isset($_POST['ALTERAR']))

{

	$EMP_ID     = $_POST['EMP_ID'];
	$EMP_N_FANT = $_POST['EMP_N_FANT'];
	$EMP_CNPJ   = $_POST['EMP_CNPJ'];
	$EMP_FONE   = $_POST['EMP_FONE'];

	//SQL Alterar informações para o BD.
	$query = "UPDATE empresas SET nome_fantasia='$EMP_N_FANT', cnpj='$EMP_CNPJ', fone='$EMP_FONE' WHERE id_empresa='$EMP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	
	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_ALTER";
	$INFO  = '<strong>EMPRESA ID:</strong> '.$EMP_ID.'<br /><strong>NOME FANTASIA:</strong> '.$EMP_N_FANT.'';
} else {
	$ALERT = "NO_ALTER";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- ALTERAR -->

<!-- DELETAR -->
<?

if(isset($_POST['DELETAR']))

{

	$EMP_ID     = $_POST['EMP_ID'];
	$EMP_N_FANT = $_POST['EMP_N_FANT'];
	$EMP_CNPJ   = $_POST['EMP_CNPJ'];
	$EMP_FONE   = $_POST['EMP_FONE'];

	//SQL deleta informação do BD.
	$query = "DELETE FROM empresas WHERE id_empresa='$EMP_ID';";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_DELET";
	$INFO  = '<strong>EMPRESA ID:</strong> '.$EMP_ID.'<br /><strong>NOME FANTASIA:</strong> '.$EMP_N_FANT.'<br /><strong>CNPJ:</strong> '.$EMP_CNPJ.'<br /><strong>FONE:</strong> '.$EMP_FONE.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- DELETAR -->

<!-- CRIAR DATA BASE -->
<?

if(isset($_POST['CREATE_DATABASE']))

{

$EMP_ID = $_POST['EMP_ID'];

$DB_NAME_CLIENTE = ''.$DB_CL_PREFIX.''.$EMP_ID.'';

// Local host
// CREATE SCHEMA `'.$DB_NAME_CLIENTE.'` DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
$query  = '

USE `'.$DB_NAME_CLIENTE.'`;

CREATE TABLE `lancamentos_diarios` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `id_lanc_tipo` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `modo` varchar(2) NOT NULL DEFAULT '."'LD'".',
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `lancamentos_pagar` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `id_lanc_tipo` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `modo` varchar(2) NOT NULL DEFAULT '."'LP'".',
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `lancamentos_receber` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `id_lanc_tipo` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `modo` varchar(2) NOT NULL DEFAULT '."'LR'".',
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `lanc_grupos` (
  `id_lanc_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_lanc_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lanc_grupos` 
(`id_lanc_grupo`, `id_empresa`, `descricao`, `ativo`) 
VALUES 
("1", "'.$EMP_ID.'", "GENERIC", "1");

CREATE TABLE `sub_grupos` (
  `id_sub_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_sub_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
';

/* execute multi query */

// INI TOSATS ALERTA

  	$result1 = mysqli_multi_query($CONNECT_CREATE, $query);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_CREATE);
	$result3 = mysqli_error($CONNECT_CREATE);
	mysqli_close($CONNECT_CREATE);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	
	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>NOVA DB</strong> <strong>'.$DB_NAME_CLIENTE.':</strong><br />';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA
}
?>

<!-- CRIAR DATA BASE -->