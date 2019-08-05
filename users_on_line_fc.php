<?
function user_online() {
include ('db.php');

$USR_ID      = $_SESSION['usuario_usr_p_ID'];
$USR_NOME    = $_SESSION['usuario_usr_p_Nome'];

$USR_IP	     = $_SERVER["REMOTE_ADDR"];
$USR_ON_ATV  = '1';
$USR_OFF_ATV = '0';

date_default_timezone_set('America/Sao_Paulo');
$DATA_HORA   =  date("Y-m-d H:i:s");  // formato data time BD: 1000-01-01 00:00:00

$sql_USR_ON = "SELECT * FROM users_painel_on ORDER BY id_users_painel_on DESC;";
$result_USR_ON  = mysqli_query($connect, $sql_USR_ON);

while ($row_USR_ON  = mysqli_fetch_assoc($result_USR_ON )) {

	$VW_USR_ON_ID    = $row_USR_ON ['id_users_painel_on'];
	$VW_USR_ON_P_ID  = $row_USR_ON ['users_painel_id'];
	$VW_USR_ON_IP    = $row_USR_ON ['users_painel_ip'];
	$VW_USR_ON_TEMP  = $row_USR_ON ['users_painel_temp'];
	$VW_USR_ON_ATIVO = $row_USR_ON ['users_painel_ativo'];


if ( $USR_ID==$VW_USR_ON_P_ID ) {

	//SQL Alterar informações para o BD.
	$query = "UPDATE users_painel_on SET users_painel_ip='$USR_IP', users_painel_temp='$DATA_HORA', users_painel_ativo='$USR_ON_ATV' WHERE users_painel_id='$VW_USR_ON_P_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";

} else {

    $ENTRADA = strtotime("$VW_USR_ON_TEMP");
    $NOW     = strtotime("$DATA_HORA");
    $DIFERENCA = $NOW - $ENTRADA;
 
    //echo "$DIFERENCA";

if ( $DIFERENCA>'900' ) {

	//SQL Alterar informações para o BD.
	$query = "UPDATE users_painel_on SET users_painel_ativo='$USR_OFF_ATV' WHERE users_painel_id='$VW_USR_ON_P_ID';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";

}

}

}

$sql_USR_ON_EXIST = "SELECT * FROM users_painel_on WHERE users_painel_id='$USR_ID';";
$result_USR_ON_EXIST = mysqli_query($connect, $sql_USR_ON_EXIST);
$NUM_ROWS = mysqli_num_rows($result_USR_ON_EXIST);

if ( $NUM_ROWS<'1' ) {
	
if ( $USR_ID=='0' || $USR_ID==' ' || $USR_ID=='' ) { } else {

	//SQL Alterar informações para o BD.
	$query = "INSERT INTO users_painel_on (id_users_painel_on, users_painel_id, users_painel_ip, users_painel_temp, users_painel_ativo) VALUES ('0','$USR_ID','$USR_IP','$DATA_HORA','$USR_ON_ATV');";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";
}

}

}

function user_offline() {
include ('db.php');

$USR_ID_OFF  = $_SESSION['usuario_usr_p_ID'];
$USR_OFF = '0';

	//SQL Alterar informações para o BD.
	$query = "UPDATE users_painel_on SET users_painel_ativo='$USR_OFF' WHERE users_painel_id='$USR_ID_OFF';";

  	mysqli_query($connect, $query);// envia a query
	//echo "$query<BR>";

}
?>