<?php
  session_start();
  
  if(!isset($_SESSION['email']) && !isset($_SESSION['nome'])){
    header("Location: login.php");
  }

?>

<!DOCTYPE html>
<html>
  <head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <script src="js/plugins/angular.min.js"></script>   
    <title>Advogando!</title>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="index.php">
        <i class="fa fa-balance-scale" aria-hidden="true"></i> Advogando!</a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">
            <ul class="top-nav">              
              <!-- User Menu-->
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="listarUsuarios.php"><i class="fa fa-user"></i><span>Usuários</span></a></li>
                  <li><a href="editarPerfil.php"><i class="fa fa-cog fa-lg"></i> Perfil</a></li>
                  <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="images/user.png" alt="User Image"></div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nome']?></p>              
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fa fa-home"></i><span>Início</span></a></li>
            <li><a href="listarAgenda.php"><i class="fa fa-calendar"></i><span>Agenda</span></a></li>
            <li><a href="listarProcessos.php"><i class="fa fa-gavel"></i><span>Processos</span></a></li>
            <li><a href="listarClientes.php"><i class="fa fa-users"></i><span>Clientes</span></a></li>
            <!-- <li><a href="listarUsuarios.php"><i class="fa fa-user"></i><span>Usuários</span></a></li> -->
            <li><a href="listarPeticoes.php"><i class="fa fa-files-o"></i></i><span>Petições</span></a></li>     
            <li><a href="criarPeticao.php"><i class="fa fa-file-text-o"></i><span>Criar Petição</span></a></li>                      
          </ul>
        </section>
      </aside>
      