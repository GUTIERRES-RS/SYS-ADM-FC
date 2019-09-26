<?

include ('db_config.php');

// CONEXÃO PRINCIPAL
$CONNECT_CLIENTE = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD", "$DB_CLIENTE");

$CONNECT_CLIENTE->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_CLIENTE->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_CLIENTE->connect_errno . ") " . $CONNECT_CLIENTE->connect_error;
}