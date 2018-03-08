<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Visualizar representante</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarRepresentantes.php">Representantes</a></li>
                <li><a>Visualizar representante</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarRepresentantes.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">representantes</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Visualizar representante</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/representantes.php" ng-app="myApp" ng-controller="myCtrl">                   
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />      

                  <div class="form-group">
                    <label class="control-label">Representante</label>
                    <input class="form-control" type="text" placeholder="Representante" name="nome" id="nome" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">CPF / RG</label>
                    <input class="form-control" type="text" placeholder="CPF / CNPJ" id="documento" name="documento" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Telefone</label>
                    <input class="form-control" type="tel" placeholder="Telefone" id="telefone" name="telefone" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Celular</label>
                      <input class="form-control" type="tel" placeholder="Celular" id="celular" name="celular" disabled="true"> 
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" placeholder="Email" id="email" name="email" disabled="true"> 
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao" disabled="true"></textarea>
                  </div>
                  
                  <hr>
                  <a class="btn btn-default icon-btn voltar" href="listarRepresentantes.php"><i class="fa fa-angle-double-left"></i> Voltar</a>
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
        $scope.documento = "";
        $scope.telefone = "";
        $scope.celular = "";
        $scope.email = "";
        $scope.observacao = "";

				$http({
			        method : "GET",
			        url : "API/representantes.php",
			        params: {
			        	id : $("#id").val()
			        }
			    }).then(function mySuccess(response) {
              $("#nome").val(response.data.nome);
              $("#documento").val(response.data.documento);
              $("#telefone").val(response.data.telefone);
              $("#celular").val(response.data.celular);
              $("#email").val(response.data.email);
              $("#observacao").val(response.data.observacao);
			    }, function myError(response) {
			    	
			    });
			});
		</script>
	</body>
</html>