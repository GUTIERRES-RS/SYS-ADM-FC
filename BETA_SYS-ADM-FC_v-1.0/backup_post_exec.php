<?
if(isset($_POST['START'])) {

$DATA         = $_POST["DATA"];
$NEW_DADOS    = $_POST["NEW_DADOS"];
$FILE_NAME    = $_POST["FILE_NAME"];
$OP_DB_SELECT = $_POST['DB_SELECT'];

if ( $OP_DB_SELECT == '0' ) {

	$DB_SELECT  = "$DB_PRIMARY";
	$BKP_EMP_ID = "$S_EMP_ID";
}

if ( $OP_DB_SELECT != '0' ) {

	$DB_SELECT  = ''.$DB_CL_PREFIX.''.$OP_DB_SELECT.'';
	
	if ($_SESSION['usuario_usr_p_Nivel']=='1') {

		$BKP_EMP_ID = "$OP_DB_SELECT";
		
	} else {

		$BKP_EMP_ID = "$S_EMP_ID";

	}

}

// BACKUP DIR RAIZ
$BACKUP_DIR_RAIZ = "backup_sql";

// BACKUP DIR DB
$BACKUP_DIR_DB = "$DB_SELECT";

	if ($NEW_DADOS != "") {

// INI GRAVA AS INFORMAÇÕES NO ARQUIVO .sql
		// VERIFICA SE EXISTE: BACKUP_DIR_RAIZ, DIRETORIO BACKUP_DIR_DB E TEMPORARIO 
			if(is_dir("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/")) {

				// CRIA O BACKUP_DIR_RAIZ, DIRETORIO BACKUP_DIR_DB E TEMPORARIO
				mkdir("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/sql_temp/", 0755, true);

			} else {

				// CRIA O BACKUP_DIR_RAIZ, DIRETORIO BACKUP_DIR_DB E TEMPORARIO
				mkdir("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/sql_temp/", 0755, true);

				// CRIA O ARQUIVO INDEX.PHP DENTRO DO DIRETORIO BACKUP_DIR_DB 
				$STYLE = "color: red;";
				$INDEX_PHP = "<? echo '<br /><br /><center><span style=".'"'.$STYLE.'"'."><h1>AREA RESTRITA.</h1></span></center>'; ?>";
				$FW_INDEX_PHP = fopen("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/index.php", "w") or die("Could not open file! Error 1");
				$FB_INDEX_PHP = fwrite($FW_INDEX_PHP,stripslashes($INDEX_PHP)) or die("Could not write to file");
				fclose($FW_INDEX_PHP);

			}

		$FW = fopen("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/sql_temp/$FILE_NAME", "w") or die("Could not open file! Error 1");
		$FB = fwrite($FW,stripslashes($NEW_DADOS)) or die("Could not write to file");
		fclose($FW);

// END GRAVA AS INFORMAÇÕES NO ARQUIVO .sql

		// O DIRETÓRIO A SER COMPACTADO
		$ZIP_DIR     = "$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB";
		$source_path = "$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/sql_temp/";

		$URL_DOWN = Compress( $ZIP_DIR, $source_path, $FILE_NAME );

		// APAGA O DIRETORIO TEMPORARIO
		delTree("$BACKUP_DIR_RAIZ/$BACKUP_DIR_DB/sql_temp");

		// INSERI AS INFORMAÇÕES REFENTE AO BACKUP NO DB
		sqlBackupInsert( $BKP_EMP_ID, $FILE_NAME, $DATA, $URL_DOWN );


		include ('backup_modal_success.php');

?>

				<script type="text/javascript">
					$(document).ready(function() {
						$('#Modal_OK').modal('show');
					});
				</script>

<?
	}

}
?>
<?
if(isset($_POST['DELETAR'])) {

	$BKP_ID           = $_POST['BKP_ID'];
	$BKP_DATA         = $_POST['BKP_DATA'];
	$BKP_DB_NAME      = $_POST['BKP_DB_NAME'];
	$BKP_URL_DOWNLOAD = $_POST['BKP_URL_DOWNLOAD'];

	// APAGA O ARUIVO ZIP
	unlink($BKP_URL_DOWNLOAD);

	//SQL deleta informação do BD.
	$query = "DELETE FROM backups WHERE id_backup = '$BKP_ID';";
	// echo "$query";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3");

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_DELET";
	$INFO  = '<strong>BACKUP ID:</strong> '.$BKP_ID.'<br /><strong>ARQUIVO:</strong> '.$BKP_DB_NAME.'<br /><strong>DATA E HORA:</strong> '.$BKP_DATA.'';
} else {
	$ALERT = "NO_DELET";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA


}
?>
<?
if(isset($_POST['RESTAURAR_INI'])) {

	$BKP_ID           = $_POST['BKP_ID'];
	$BKP_EMP_ID       = $_POST['BKP_EMP_ID'];
	$BKP_EMP_N_F      = $_POST['BKP_EMP_N_F'];
	$BKP_DATA         = $_POST['BKP_DATA'];
	$BKP_DB_NAME      = $_POST['BKP_DB_NAME'];
	$BKP_URL_DOWNLOAD = $_POST['BKP_URL_DOWNLOAD'];

include ('backup_modal_restaurar.php');
?>

				<script type="text/javascript">
					$(document).ready(function() {
						$('#Modal_RESTAURAR').modal('show');
					});
				</script>

<?
}
?>
<?
if(isset($_POST['RESTAURAR'])) {

	$BKP_ID           = $_POST['BKP_ID'];
	$BKP_DATA         = $_POST['BKP_DATA'];
	$BKP_DB_NAME      = $_POST['BKP_DB_NAME'];
	$BKP_CONTEUDO_SQL = $_POST['BKP_CONTEUDO_SQL'];

$BKP_DB_NAME_X = explode ('-', $BKP_DB_NAME);

$DB_SELECT = $BKP_DB_NAME_X[1];

$CONNECT_RESTORE = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD", "$DB_SELECT");

$CONNECT_RESTORE->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_RESTORE->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_RESTORE->connect_errno . ") " . $CONNECT_RESTORE->connect_error;
}

	//SQL deleta informação do BD.
	$query = "$BKP_CONTEUDO_SQL";

// INI TOSATS ALERTA

  	$result1 = mysqli_multi_query($CONNECT_RESTORE, $query);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_RESTORE);
	$result3 = mysqli_error($CONNECT_RESTORE);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = '<strong>R4:</strong> <pre style="max-height: 60vh">'.$query.'</pre>';

	//DEBUG
	//print_r("$R1");
	//print_r("$R2");
	//printf ("$R3");
	//printf ("$R4");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>BACKUP RESTAURADO ID:</strong> '.$BKP_ID.'<br /><strong>ARQUIVO:</strong> '.$BKP_DB_NAME.'<br /><strong>DATA E HORA:</strong> '.$BKP_DATA.'';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA


}
?>
<?
if(isset($_POST['QUERY_INI'])) {

	$BKP_ID           = $_POST['BKP_ID'];
	$BKP_EMP_ID       = $_POST['BKP_EMP_ID'];
	$BKP_EMP_N_F      = $_POST['BKP_EMP_N_F'];
	$BKP_DATA         = $_POST['BKP_DATA'];
	$BKP_DB_NAME      = $_POST['BKP_DB_NAME'];

	$BKP_DB_NAME_X = explode ('-', $BKP_DB_NAME);

	$DB_SELECT = $BKP_DB_NAME_X[1];

include ('backup_modal_query.php');
?>

				<script type="text/javascript">
					$(document).ready(function() {
						$('#Modal_QUERY').modal('show');
					});
				</script>

<?
}
?>
<?
if(isset($_POST['QUERY'])) {

	$DB_SELECT        = $_POST['DB_SELECT'];
	$BKP_CONTEUDO_SQL = $_POST['BKP_CONTEUDO_SQL'];

$CONNECT_RESTORE = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD", "$DB_SELECT");

$CONNECT_RESTORE->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_RESTORE->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_RESTORE->connect_errno . ") " . $CONNECT_RESTORE->connect_error;
}

	//SQL deleta informação do BD.
	$query = "$BKP_CONTEUDO_SQL";

// INI TOSATS ALERTA

  	$result1 = mysqli_multi_query($CONNECT_RESTORE, $query);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_RESTORE);
	$result3 = mysqli_error($CONNECT_RESTORE);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = '<strong>R4:</strong> <pre style="max-height: 60vh">'.$query.'</pre>';

	//DEBUG
	//print_r("$R1");
	//print_r("$R2");
	//printf ("$R3");
	//printf ("$R4");

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>QUERY EXUTADO EM:</strong> '.$DB_SELECT.' <br /> <pre style="max-height: 60vh">'.$BKP_CONTEUDO_SQL.'</pre>';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA


}
?>