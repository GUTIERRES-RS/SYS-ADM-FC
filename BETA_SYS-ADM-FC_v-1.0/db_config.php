<?
$HOST_CONECT = $_SERVER['HTTP_HOST'];
//echo "$HOST_CONECT";

if ($HOST_CONECT=="localhost:82"){

$DB_HOST      = "localhost";                      # Hosting
$DB_USER_NAME = "root";                           # Usuario da Base de Dados
$DB_USER_PWRD = "q1w2e3r4";                       # Password da Base de Dados
$DB_PRIMARY   = "painel_dev";                     # Nome da Base de Dados Primaria
$DB_CL_PREFIX = "painel_cl_";                     # Prefixo da tabela cliente
$DB_CLIENTE   = ''.$DB_CL_PREFIX.''.$S_EMP_ID.''; # Nome da Base de Dados Cliente

} else {

$DB_HOST      = "localhost";                      # Hosting
$DB_USER_NAME = "root";                           # Usuario da Base de Dados
$DB_USER_PWRD = "q1w2e3r4";                       # Password da Base de Dados
$DB_PRIMARY   = "painel_dev";                     # Nome da Base de Dados Primaria
$DB_CL_PREFIX = "painel_cl_";                     # Prefixo da tabela cliente
$DB_CLIENTE   = ''.$DB_CL_PREFIX.''.$S_EMP_ID.''; # Nome da Base de Dados Cliente

}