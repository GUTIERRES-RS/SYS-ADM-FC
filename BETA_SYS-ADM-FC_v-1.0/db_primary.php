<?

include ('db_config.php');

// CONEXÃO PRINCIPAL
$CONNECT_PRIMARY = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD", "$DB_PRIMARY");

$CONNECT_PRIMARY->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_PRIMARY->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_PRIMARY->connect_errno . ") " . $CONNECT_PRIMARY->connect_error;
}

// CONEXÃO CREATE
$CONNECT_CREATE = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD");

$CONNECT_CREATE->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_CREATE->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_CREATE->connect_errno . ") " . $CONNECT_CREATE->connect_error;
}