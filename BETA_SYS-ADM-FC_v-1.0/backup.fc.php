<?
// FUNÇÃO BCAKUP ---------------------------------------------------------------------
function backup_tables( $DB_HOST, $DB_USER_NAME, $DB_USER_PWRD, $DB_SELECT )
{

$CONNECT_BACKUP = new mysqli("$DB_HOST", "$DB_USER_NAME", "$DB_USER_PWRD", "$DB_SELECT");

$CONNECT_BACKUP->set_charset('utf8'); // Seta o Charset de comunicação

if ($CONNECT_BACKUP->connect_errno) {
    echo "Failed to connect to MySQL: (" . $CONNECT_BACKUP->connect_errno . ") " . $CONNECT_BACKUP->connect_error;
}

    mysqli_select_db($CONNECT_BACKUP, $DB_SELECT);
        $tables = array();
        $result = mysqli_query($CONNECT_BACKUP, 'SHOW TABLES');
        $i=0;
        while($row = mysqli_fetch_row($result))
        {
            $tables[$i] = $row[0];
            $i++;
        }
    $SQL_SCRIPT = "";

    foreach($tables as $table)
    {
        $result = mysqli_query($CONNECT_BACKUP, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $SQL_SCRIPT .= 'DROP TABLE IF EXISTS '.'`'.$table.'`'.';';
        $row2 = mysqli_fetch_row(mysqli_query($CONNECT_BACKUP, 'SHOW CREATE TABLE '.$table));
        $SQL_SCRIPT.= "\n\n".$row2[1].";\n\n";
        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysqli_fetch_row($result))
            {
                $SQL_SCRIPT.= 'INSERT INTO '.$table.' VALUES (';
                for($j=0; $j < $num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) { $SQL_SCRIPT.= "'".$row[$j]."'" ; } else { $SQL_SCRIPT.= "''"; }
                    if ($j < ($num_fields-1)) { $SQL_SCRIPT.= ','; }
                }
                $SQL_SCRIPT.= ");"."\n";
            }
        }
        $SQL_SCRIPT.="\n";
    }

// RETORNA O SRCIPT SQL
return $SQL_SCRIPT;

}

// FUNÇÃO DELTREE ---------------------------------------------------------------------
function delTree($dir) { 
	$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
			(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
		} 
	return rmdir($dir); 
}

// FUNÇÃO ZIP -------------------------------------------------------------------------
function Compress( $ZIP_DIR, $source_path, $FILE_NAME )
{
    // Normaliza o caminho do diretório a ser compactado
    $source_path = realpath($source_path);

    // Caminho com nome completo do arquivo compactado
    // Nesse exemplo, será criado no mesmo diretório de onde está executando o script
	$FILE_N = rtrim($FILE_NAME ,'.sql');
	
    $zip_file = "$ZIP_DIR/".basename($FILE_N).'.zip';

    // Inicializa o objeto ZipArchive
    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Iterador de diretório recursivo
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source_path),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Pula os diretórios. O motivo é que serão inclusos automaticamente
        if (!$file->isDir()) {
            // Obtém o caminho normalizado da iteração corrente
            $file_path = $file->getRealPath();

            // Obtém o caminho relativo do mesmo.
            $relative_path = substr($file_path, strlen($source_path) + 1);

            // Adiciona-o ao objeto para compressão
            $zip->addFile($file_path, $relative_path);
        }
    }

    // Fecha o objeto. Necessário para gerar o arquivo zip final.
    $zip->close();

    // Retorna o caminho completo do arquivo gerado
    return $zip_file;
}

// FUNÇÃO ZIP SIZE -----------------------------------------------------------------------
function get_zip_size($filename) {
	
	$INFO = "(" . filesize($filename) . " bytes)";
	
    return $INFO;
}

// FUNÇÃO ZIP SIZE ORIGINAL --------------------------------------------------------------
function get_zip_originalsize($filename) {
    $size = 0;
    $resource = zip_open($filename);
    while ($dir_resource = zip_read($resource)) {
        $size += zip_entry_filesize($dir_resource);
    }
    zip_close($resource);

	$size_descompat = "(" .$size. " bytes)";

    return $size_descompat;
}

// FUNÇÃO SQL INSERT URL DOWN
function sqlBackupInsert( $EMP_ID, $BACKUP_DB_NAME, $DATATIME, $URL_DOWN )
{
include ('db_primary.php');

//Formata a Data para BD: ex: 13_09_2019-16_29_15 para 2010-12-15 14:20:59
$DATA_TIME = dataTime( $DATATIME, 'DB' );

	//SQL Alterar informações para o BD.
	$query = "INSERT INTO backups (id_backup, id_empresa, bkp_db_name, data_hora, url_download) VALUES ('0','$EMP_ID','$BACKUP_DB_NAME','$DATA_TIME','$URL_DOWN');";
	//echo "$query<BR>";

// INI TOSATS ALERTA

  	$result1 = mysqli_query($CONNECT_PRIMARY, $query, MYSQLI_USE_RESULT);// envia a query
	$result2 = mysqli_affected_rows($CONNECT_PRIMARY);
	$result3 = mysqli_error($CONNECT_PRIMARY);

	$R1 = "<strong>R1:</strong> $result1<br />";
	$R2 = "<strong>R2:</strong> $result2<br />";
	$R3 = "<strong>R3:</strong> $result3<br />";
	$R4 = "<strong>R4:</strong> $query";
	
	//DEBUG
	//print_r("R1: $result1<br />");
	//print_r("R2: $result2<br />");
	//printf ("R3: $result3<br />");
	//printf ("R4: $query");
	

if ( $result2=='0' | $result2=='1' ) {
	$ALERT = "OK_INSERT";
	$INFO  = '<strong>NOVO BACKUP GERADO</strong><br /><strong>BASE de DADOS:</strong><br />'.$BACKUP_DB_NAME.'';
} else {
	$ALERT = "NO_INSERT";
	$INFO  = "<br />$R1 $R2 $R3 $R4";
}

include ('alert_toasts.php');

// FIM TOSATS ALERTA

    return $ALERT;
}

function dataTime( $DATATIME, $MODE )
{
	if ( $MODE=='DB' ) {
		// 13_09_2019-16_29_15
		//Formata a Data para BD: ex: 02/01/2019 para 2010-12-15 14:20:59
		$DATA_X_D_T = explode("-", $DATATIME);

		// DATA
		$D_X_DATA = $DATA_X_D_T[0];

		$DATA_X_D = explode("_", $D_X_DATA);

		$D_X_D = $DATA_X_D[0];
		$D_X_M = $DATA_X_D[1];
		$D_X_A = $DATA_X_D[2];

		$DATA = "$D_X_A-$D_X_M-$D_X_D";

		// TIME
		$D_X_TIME = $DATA_X_D_T[1];

		$DATA_X_T = explode("_", $D_X_TIME);

		$T_X_H = $DATA_X_T[0];
		$T_X_M = $DATA_X_T[1];
		$T_X_S = $DATA_X_T[2];

		$TIME = "$T_X_H:$T_X_M:$T_X_S";
		
		$DATA_TIME = "$DATA $TIME";
	}

	if ( $MODE=='VW' ) {
		// 2019-12-09 16:29:15
		//Formata a Data para BD: ex: 02/01/2019 para 2010-12-15 14:20:59
		$DATA_X_D_T = explode(" ", $DATATIME);

		// DATA
		$D_X_DATA = $DATA_X_D_T[0];

		$DATA_X_D = explode("-", $D_X_DATA);

		$D_X_D = $DATA_X_D[2];
		$D_X_M = $DATA_X_D[1];
		$D_X_A = $DATA_X_D[0];

		$DATA = "$D_X_D/$D_X_M/$D_X_A";

		// TIME
		$TIME = $DATA_X_D_T[1];
		
		$DATA_TIME = "$DATA $TIME";

	}
	
return ( $DATA_TIME );

}
?>