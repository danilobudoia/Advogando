<?php
  session_start();
  require 'Class/Usuarios.php';

  if(isset($_SESSION['login'])){
    header("Location: index.php");
  }


  $usuarios = new Usuarios();
  
  if (isset($_POST['email'])){
    $dados = $usuarios->login($_POST['email'], $_POST['senha']); 
    if (!empty($dados)){
      $_SESSION['id'] = $dados['id'];
      $_SESSION['nome'] = $dados['nome'];
      $_SESSION['email'] = $dados['email'];

      header("Location: index.php");
    }else{
    unset($_SESSION);
?>
      <script type="text/javascript">
        alert("Login ou senha inválido!");
      </script>
<?php      
    }
  }
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sistema</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Advogando!</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="POST">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>ENTRAR</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" name="email" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">SENHA</label>
            <input class="form-control" type="password" name="senha" placeholder="Senha">
          </div>          
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>ENTRAR</button>
          </div>
        </form>        
      </div>
    </section>
  </body>
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins/pace.min.js"></script>
  <script src="js/main.js"></script>
</html>