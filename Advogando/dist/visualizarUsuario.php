<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user"></i> Visualizar usuário</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarUsuarios.php">Usuários</a></li>
                <li><a>Visualizar usuário</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarUsuarios.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">usuários</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Visualizar usuário</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/usuarios.php" ng-app="myApp" ng-controller="myCtrl">                   
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />               
                  <div class="form-group">
                    <label class="control-label">Nome</label>
                    <input class="form-control" disabled="true" type="text" placeholder="Nome" name="nome" id="nome" value="" ng-model="nome">                  
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" disabled="true" type="text" placeholder="Email" name="email" id="email" ng-model="email">                  
                  </div> 

                  <hr>
                  <a class="btn btn-default icon-btn voltar" href="listarUsuarios.php"><i class="fa fa-angle-double-left"></i> Voltar</a>
            </div>
          </div>
        </div>		

		<!-- Javascripts-->
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/main.js"></script>

		<script type="text/javascript">					
			var app = angular.module('myApp', []);
			app.controller('myCtrl', function($scope, $http) {					
				$scope.nome = "";
				$scope.email = "";

				$http({
			        method : "GET",
			        url : "API/usuarios.php",
			        params: {
			        	id : $("#id").val()
			        }
			    }).then(function mySuccess(response) {
              $("#nome").val(response.data.nome);
              $("#email").val(response.data.email);   	        
			    }, function myError(response) {
			    	
			    });
			});
			
		</script>
	</body>
</html>