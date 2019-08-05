<?

$host = $_SERVER['HTTP_HOST'];
//echo "$host";

if ($host=="localhost:82"){

$host         = "localhost"; # Hosting
$user         = "root";      # Usuario de Base de Datos
$userpw       = "q1w2e3r4";  # Password de Base de Datos
$databasename = "painel";     # Nombre de la Base de Datos

} else {

$host         = "localhost"; # Hosting
$user         = "sginfini_sginfin";      # Usuario de Base de Datos
$userpw       = "xCws76GByw";  # Password de Base de Datos
$databasename = "sginfini_painel";     # Nombre de la Base de Datos

}

$connect = new mysqli("$host", "$user", "$userpw", "$databasename");

$connect->set_charset('utf8'); // Seta o Charset de comunicação

if ($connect->connect_errno) {
    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
}
?>