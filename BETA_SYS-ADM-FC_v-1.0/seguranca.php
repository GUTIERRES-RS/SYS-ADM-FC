<?
/**
* Sistema de segurança com acesso restrito
*
* Usado para restringir o acesso de certas páginas do seu site
*
* @author Thiago Belem <contato@thiagobelem.net>
* @link http://thiagobelem.net/
* @Editado por josé Gutierres

*
* @version 1.0
* @package SistemaSeguranca
*/
//  Configurações do Script
// ==============================
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
$_SG['paginaLogin'] = "?pag=painel&sec=login"; // Página de login
$_SG['paginaHome'] = "?pag=painel&sec=index&vp"; // Página HOME
$_SG['tabela'] = 'users_painel';       // Nome da tabela onde os usuários são salvos
$_SG['timeoutsession_usr_p'] = '3600';       // Tempo pra expirar a sessão em segundos
// ==============================
// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================
// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true) {
	//session_start();
	$timeout = $_SG['timeoutsession_usr_p']; // Tempo da sessao em segundos
	 
	// Verifica se existe o parametro timeout
	if(isset($_SESSION['timeout_usr_p'])) {
		// Calcula o tempo que ja se passou desde a cricao da sessao
		$duracao = time() - (int) $_SESSION['timeout_usr_p'];
	  
		// Verifica se ja expirou o tempo da sessao
		if($duracao > $timeout) {
			// Destroi a sessao e cria uma nova
			session_destroy();
			session_start();
		}
	}
	}
	
	// Atualiza o timeout.
	$_SESSION['timeout_usr_p'] = time();

/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/

function validaUsuario($usuario, $senha, $ativo) {
  include ('db_primary.php');
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  // Usa a função addslashes para escapar as aspas
  $nusuario = addslashes($usuario);
  $nsenha 	= addslashes($senha);
  $nativo   = addslashes($ativo);
  // Monta uma consulta SQL (query) para procurar um usuário
  $sql = "SELECT `id`, `id_empresa`, `nome`, `nivel` FROM `".$_SG['tabela']."` WHERE ".$cS." `usuario` = '".$nusuario."' AND ".$cS." `senha` = '".md5($nsenha)."' AND ".$cS." `ativo` = '".$nativo."' LIMIT 1";
  $query = mysqli_query($CONNECT_PRIMARY, $sql);
  $resultado = mysqli_fetch_assoc($query);
  // Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
    return false;
  } else {
    // Definimos dois valores na sessão com os dados do usuário
    $_SESSION['usuario_usr_p_ID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
	$_SESSION['usuario_usr_p_Empresa'] = $resultado['id_empresa']; // Pega o valor da coluna 'id_mpresa' do registro encontrado no MySQL
    $_SESSION['usuario_usr_p_Nome'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
	$_SESSION['usuario_usr_p_Nivel'] = $resultado['nivel']; // Pega o valor da coluna 'nivel' do registro encontrado no MySQL
    // Verifica a opção se sempre validar o login
    if ($_SG['validaSempre'] == true) {
      // Definimos dois valores na sessão com os dados do login
      $_SESSION['usuario_usr_p_Login'] = $usuario;
      $_SESSION['usuario_usr_p_Senha'] = $senha;
	  $_SESSION['usuario_usr_p_Ativo'] = $ativo;
    }
    return true;
  }
}
/**
* Função que protege uma página
*/
function protegePagina() {
  global $_SG;
  if (!isset($_SESSION['usuario_usr_p_ID']) OR !isset($_SESSION['usuario_usr_p_Nome'])) {
    // Não há usuário logado, manda pra página de login
    expulsaVisitante();
  } else if (!isset($_SESSION['usuario_usr_p_ID']) OR !isset($_SESSION['usuario_usr_p_Nome'])) {} else {
	// Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validaSempre'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validaUsuario($_SESSION['usuario_usr_p_Login'], $_SESSION['usuario_usr_p_Senha'], $_SESSION['usuario_usr_p_Ativo'])) {
        // Os dados não batem, manda pra tela de login
        expulsaVisitante();
      }
    }
  }
}
/**
* Função que valida login
*/
function validaLogin() {
  global $_SG;
if (isset($_POST['LOGAR'])) {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
  $ativo = '1';
  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($usuario, $senha, $ativo) == true) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    header("Location: ".$_SG['paginaHome']);
  } else {
    // O usuário e/ou a senha são inválidos, manda de volta pro form de login
    // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
    expulsaVisitante();
  }
}
}
/**
* Função para expulsar um visitante
*/
function expulsaVisitante() {
  global $_SG;
  // Remove as variáveis da sessão (caso elas existam)
  unset($_SESSION['usuario_usr_p_ID'], $_SESSION['usuario_usr_p_Empresa'], $_SESSION['usuario_usr_p_Nome'], $_SESSION['usuario_usr_p_Login'], $_SESSION['usuario_usr_p_Senha'], $_SESSION['usuario_usr_p_Ativo'], $_SESSION['usuario_usr_p_Nivel'],$_SESSION['timeout_usr_p']);
  // Manda pra tela de login
  header("Location: ".$_SG['paginaLogin']);
}