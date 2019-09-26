<!-- Modal -->
<?
if(isset($_POST['BACKUP_INI'])) {

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

// INI CRIA O NOME DO ARQUIVO nome-$DB_SELECT-$DATE_TIME_FILE.sql
date_default_timezone_set('America/Sao_Paulo');

$TO_D_D = date("d");
$TO_D_M = date("m");
$TO_D_A = date("Y");

$TO_T_H = date("H");
$TO_T_M = date("i");
$TO_T_S = date("s");

$ext = '.sql';
$FILENAME = 'backup_sql-'.$DB_SELECT.'';

$DATE_TIME_FILE = ''.$TO_D_D.'_'.$TO_D_M.'_'.$TO_D_A.'-'.$TO_T_H.'_'.$TO_T_M.'_'.$TO_T_S.'';

$NEW_FILE_NAME = $FILENAME.'-'.$DATE_TIME_FILE.$ext;

// GERA SCRIPT SQL
$SQL_BACKUP = backup_tables( $DB_HOST, $DB_USER_NAME, $DB_USER_PWRD, $DB_SELECT );//don't forget to fill with your own database access informations

?>


<? include ('backup_modal.php');?>

					<script type="text/javascript">
						$(document).ready(function() {
							$('#Modal_BACKUP').modal('show');
						});
					</script>

<?
}
?>
<!-- Modal -->