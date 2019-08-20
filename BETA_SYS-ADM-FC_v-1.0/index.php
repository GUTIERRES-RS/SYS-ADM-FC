<? include ('conexao.php');?>

<? if ($_GET['sec'] == "index") {?>

<? include ('painel.php');?>

<?} else {?>

<? include ('login.php');?>

<?}?>