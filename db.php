<?

$host = $_SERVER['HTTP_HOST'];
//echo "$host";

if ($host=="localhost"){

$host         = "localhost"; # Hosting
$user         = "root";      # Usuario de Base de Datos
$userpw       = "q1w2e3r4";  # Password de Base de Datos
$databasename = "painel";    # Nombre de la Base de Datos

} else {

$host         = "localhost"; # Hosting
$user         = "testes";    # Usuario de Base de Datos
$userpw       = "11111111";  # Password de Base de Datos
$databasename = "painel";    # Nombre de la Base de Datos

}

$connect = new mysqli("$host", "$user", "$userpw", "$databasename");

$connect->set_charset('utf8'); // Seta o Charset de comunicação

if ($connect->connect_errno) {
    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
}
?>