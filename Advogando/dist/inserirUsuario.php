<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user"></i> Adicionar usuário</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarUsuarios.php">Usuários</a></li>
                <li><a>Adicionar usuário</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarUsuarios.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">usuários</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Adicionar novo usuário</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/usuarios.php"> 
                  <input type="hidden" name="_method" value="POST" />                  
                  <div class="form-group">
                    <label class="control-label">Nome</label>
                    <input class="form-control" type="text" placeholder="Nome" name="nome" id="nome">                  
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text" placeholder="Email" name="email" id="senha">                  
                  </div>

                  <div class="form-group">
                    <label class="control-label">Senha</label>
                    <input class="form-control" type="password" placeholder="Senha" id="senha" name="senha">                    
                  </div>

                  <div class="form-group">
                    <label class="control-label">Confirmar senha</label>
                    <input class="form-control" type="password" placeholder="Confirmar senha" id="confirma_senha" name="confirma_senha">                    
                  </div>

                  <div class="card-footer">
                      <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cadastrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" href="listarUsuarios.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>                  
              
            </div>
          </div>
        </div>		

		<!-- Javascripts-->
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/main.js"></script>
    <script src="js/plugins/bootstrapValidator.min.js"></script>
    <script>      
      $("#form").bootstrapValidator({
        fields: {          
          nome: {
              validators: {
                  notEmpty: {
                      message: 'O campo nome é obrigatório'
                  },
                  stringLength:{
                    min: 3,
                    max: 30,
                    message: 'O nome deve ter mais que 3 e menos que 30 caracteres'
                  }
              }              
          },
          email: {
            validators:{
              notEmpty:{
                message: 'O campo email é obrigatório'
              },
              stringLength:{
                min: 3,
                max: 30,
                message: 'O email deve ter mais que 3 e menos que 30 caracteres'
              },
              remote:{
                message: 'O email está indisponível',
                url: 'API/usuarios.php',
                type: 'GET'
              }
            }
          },
          senha: {
            validators:{
              notEmpty:{
                message: 'O campo senha é obrigatório'
              },
              stringLength:{
                min: 5,
                max: 30,
                message: 'A senha deve ter mais que 5 e menos que 30 caracteres'
              }              
            },            
          },
          confirma_senha: {
            validators:{
              notEmpty:{
                message: 'O campo confirmar_senha é obrigatório'
              },
              identical:{
                field: 'senha',
                message: 'As senhas não são iguais'
              }
            },            
          }
        }
      });
    </script> 		
	</body>
</html>