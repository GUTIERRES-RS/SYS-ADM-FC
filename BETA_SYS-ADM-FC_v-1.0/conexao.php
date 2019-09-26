<? Header('X-XSS-Protection: 0'); ?>
<?
/*-----------------------------------------------------------------------------*
 * Conexão MySql
/*----------------------------------------------------------------------------*/

include ('db_primary.php');

//echo 'BD Conectado. <BR>';
//@mysqli_close($connect);

/*-----------------------------------------------------------------------------*
 * SERGURANÇA HTTP
/*----------------------------------------------------------------------------*/

session_start();

if ($_GET['pag']=="painel" | $_GET['sec']=="index") {
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança

	if ($_GET['sec']=="index") {
	protegePagina(); // Chama a função que protege a página
	include("users_on_line_fc.php");
	user_online(); // Verifica quem esta On-Line
	}
	
	if ($_GET['sec']=="login") {
	validaLogin(); // Chama a função que valida o login
	}

	if ($_GET['sec']=="sair") {
	include("users_on_line_fc.php");
	user_offline(); // Atualiza quem esta Off-Line
	expulsaVisitante(); // Chama a função para sair da página
	}

	if ($_GET['sec']=="") {
	expulsaVisitante(); // Chama a função para sair da página
	}

}

// Variaveis Globais

$S_EMP_ID = $_SESSION['usuario_usr_p_Empresa'];

date_default_timezone_set('America/Sao_Paulo');

$TO_D = date("d");
$TO_M = date("m");
$TO_A = date("Y");

if ( $S_EMP_ID!='' ) {

include ('db_cliente.php');
include ('fc.all.php');

}