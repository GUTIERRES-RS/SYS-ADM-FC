<?
$ID_S_EP = $_SESSION['usuario_usr_p_Empresa'];
$sql_EP = "SELECT * FROM empresas WHERE id_empresa='$ID_S_EP';";
$result_EMP  = mysqli_query($CONNECT_PRIMARY, $sql_EP);

while ($row_EMP  = mysqli_fetch_assoc($result_EMP )) {

	$VW_EP_ID   = $row_EMP ['id_empresa'];
	$VW_EP_N_F  = $row_EMP ['nome_fantasia'];
	$VW_EP_CNPJ = $row_EMP ['cnpj'];
	$VW_EP_FONE = $row_EMP ['fone'];

?>
<?
}
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top d-print-none" id="mainNav">

    <span class="navbar-brand"><? echo "$VW_EP_N_F"; ?></span>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse overflow-hidden" id="navbarResponsive">

      <ul class="navbar-nav navbar-sidenav overflow-hidden" id="exampleAccordion">

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Administração">
          <a class="nav-link" href="?pag=painel&sec=index&vp=administracao">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">Administração</span>
          </a>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Graficos">
          <a class="nav-link" href="?pag=painel&sec=index&vp=graficos">
            <i class="fa fa-fw fa-bar-chart"></i>
            <span class="nav-link-text">Graficos</span>
          </a>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Relatorios">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=relatorios">
			<i class="fa fa-fw fa-file-text"></i>
			<span class="nav-link-text">Relatorios</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Lançamentos Diarios">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=lancamentos&md=diario">
			<i class="fa fa-fw fa-list-ol"></i>
			<span class="nav-link-text">Lançamentos Diarios</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contas A Pagar">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=lancamentos&md=pagar">
			<i class="fa fa-fw fa-book"></i>
			<span class="nav-link-text">Contas A Pagar</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contas A Receber">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=lancamentos&md=receber">
			<i class="fa fa-fw fa-book"></i>
			<span class="nav-link-text">Contas A Receber</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Grupos">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=grupos">
		  <i class="fa fa-fw fa-indent"></i>
			<span class="nav-link-text">Grupos</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sub Grupos">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=grupos_sub">
		  <i class="fa fa-fw fa-outdent"></i>
			<span class="nav-link-text">Sub Grupos</span>
		  </a>
		</li>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { ?>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tipos">
		  <a class="nav-link" href="?pag=painel&sec=index&vp=tipos">
		  <i class="fa fa-fw fa-list-ul"></i>
			<span class="nav-link-text">Tipos</span>
		  </a>
		</li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Empresas">
          <a class="nav-link" href="?pag=painel&sec=index&vp=empresas">
            <i class="fa fa-fw fa-industry"></i>
            <span class="nav-link-text">Empresas</span>
          </a>
        </li>
<?}?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuario">
          <a class="nav-link" href="?pag=painel&sec=index&vp=usuarios">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="nav-link-text">Usuario</span>
          </a>
        </li>

<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { ?>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios On-Line">
          <a class="nav-link" href="?pag=painel&sec=index&vp=users_on_line_vw">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Usuarios On-Line</span>
          </a>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="WebMaster">
          <a class="nav-link" href="?pag=painel&sec=index&vp=webmaster">
            <i class="fa fa-fw fa-folder"></i>
            <span class="nav-link-text">WebMaster</span>
          </a>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Page Blank">
          <a class="nav-link" href="?pag=painel&sec=index&vp=page_blank">
            <i class="fa fa-fw fa-folder"></i>
            <span class="nav-link-text">Page Blank</span>
          </a>
        </li>
<?}?>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Backup">
          <a class="nav-link" href="?pag=painel&sec=index&vp=backup">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Backup</span>
          </a>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Suporte">
          <a class="nav-link" href="?pag=painel&sec=index&vp=suporte">
            <i class="fa fa-fw fa-question-circle"></i>
            <span class="nav-link-text">Suporte</span>
          </a>
        </li>

      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
<? if ($_SESSION['usuario_usr_p_Nivel']=='1') { // Nivel 1 WebMaster

$sql_USR_ON_NOW = "SELECT * FROM users_painel_on WHERE users_painel_ativo='1';";
$result_USR_ON_NOW = mysqli_query($CONNECT_PRIMARY, $sql_USR_ON_NOW);
$NUM_USR_ON_NOW = mysqli_num_rows($result_USR_ON_NOW);

// Plural
if($NUM_USR_ON_NOW=="1"){ $S_PLR = ""; } else { $S_PLR = "s"; }
?>
		<li class="nav-item">
			<a class="nav-link" href="?pag=painel&sec=index&vp=users_on_line_vw">
				<i class="fa fa-fw fa-users"></i> Usuario<? echo "$S_PLR";?> On-Line: <span class="badge badge-success"><? echo "$NUM_USR_ON_NOW";?></span>
			</a>
		</li>
<?}?>

		<li class="nav-item">
			<a class="nav-link" href="?pag=painel&sec=index&vp=usuarios">
				<i class="fa fa-fw fa-user"></i> Bem Vindo: <span class="text-success"><? echo $_SESSION['usuario_usr_p_Nome'];?></span>
			</a>
		</li>

        <li class="nav-item">
			<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
				<i class="fa fa-fw fa-sign-out"></i>Logout
			</a>
        </li>

      </ul>

    </div>

  </nav>