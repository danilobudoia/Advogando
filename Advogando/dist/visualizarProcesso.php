<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-gavel"></i> Visualizar processo</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarProcessos.php">Processos</a></li>
                <li><a>Visualizar processo</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarProcessos.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">processos</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Visualizar processo</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/processos.php" ng-app="myApp" ng-controller="myCtrl">                   
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />      

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Numero do processo</label>
                        <input class="form-control" type="text" placeholder="Numero do processo" name="numero" id="numero" ng-model="numero" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Data de início</label>
                        <input class="form-control" type="date" placeholder="Data de início" name="data_inicio" id="data_inicio" ng-model="data_inicio" disabled="true">                  
                      </div>
                    </div> 
                  </div>  

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Nome do processo</label>
                        <input class="form-control" type="text" placeholder="Nome do processo" name="nome" id="nome" value="" ng-model="nome" disabled="true">                  
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Natureza</label>
                        <select class="form-control" name="natureza" id="natureza" disabled="true">
                          <option value="Direito Administrativo">Direito Administrativo</option>
                          <option value="Direito Ambiental">Direito Ambiental</option>
                          <option value="Direito Civil">Direito Civil</option>
                          <option value="Direito Coletivo do Trabalho">Direito Coletivo do Trabalho</option>
                          <option value="Direito Contratual">Direito Contratual</option>
                          <option value="Direito das Sucessões">Direito das Sucessões</option>
                          <option value="Direito de Família">Direito de Família</option>
                          <option value="Direito de Trânsito">Direito de Trânsito</option>
                          <option value="Direito do Consumidor">Direito do Consumidor</option>
                          <option value="Direito do Trabalho">Direito do Trabalho</option>
                          <option value="Direito Eleitoral">Direito Eleitoral</option>
                          <option value="Direito Empresarial">Direito Empresarial</option>
                          <option value="Direito Falimentar">Direito Falimentar</option>
                          <option value="Direito Humanos">Direito Humanos</option>
                          <option value="Direito Imobiliário">Direito Imobiliário</option>
                          <option value="Direito Militar">Direito Militar</option>
                          <option value="Direito Penal">Direito Penal</option>
                          <option value="Direito Político">Direito Político</option>
                          <option value="Direito Previdenciário">Direito Previdenciário</option>
                          <option value="Direito Tributário">Direito Tributário</option>
                        </select>
                      </div> 
                    </div> 
                  </div>  

                  <div class="form-group">
                    <label class="control-label">Situação atual</label>
                    <input class="form-control" type="text" placeholder="Situação atual" name="situacao" id="situacao" value="" ng-model="situacao" disabled="true">                  
                  </div>
                  
                  <hr>
                  <div class="form-group">
                    <label class="control-label">Clientes</label>
                    <select id="cliente_id" name="cliente_id[]" style="width: 100%" multiple disabled="true">
                    </select>                  
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Documentos</label>
                    <select id="documento_id" name="documento_id[]" style="width: 100%" multiple disabled="true">
                    </select>                  
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao" disabled="true"></textarea>
                  </div>
                  
                  <hr>
                  <a class="btn btn-default icon-btn voltar" href="listarProcessos.php"><i class="fa fa-angle-double-left"></i> Voltar</a>
            </div>
          </div>
        </div>		

		<!-- Javascripts-->
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/main.js"></script>
    <script src="js/plugins/select2.min.js"></script>
    <script>
      $(document).ready(function() {

        //Clientes        
        $("#cliente_id").select2({        
          placeholder: "Clientes",
          minimumInputLength: 1,                             
          ajax: {
              url: 'API/clientes.php',
              dataType: 'json',
              type: "GET",
              cache: true,
              data: function (params) {               
                  return {
                      term: $.trim(params.term),                        
                  };
              },
              processResults: function (data) {
                  var result = {
                      results: $.map(data, function (item) {
                          textField = "nome";
                          return {
                              text: item[textField],
                              id: item["id"]
                          }
                      }),
                      more: data.current_page < data.last_page
                  };
                  return result;
              }
          },
          "language": {
            "noResults": function(){
                return "Não foram encontrado restultados";
            },
            inputTooShort: function () {
            return "Por favor, entre com 1 ou mais caracteres";
            }
          }              
        });

        //Documentos        
        $("#documento_id").select2({ placeholder: "Documentos" });
      });
    </script> 
		<script type="text/javascript">					
			var app = angular.module('myApp', []);
			app.controller('myCtrl', function($scope, $http) {	    
        $scope.numero = "";
        $scope.nome = "";
        $scope.natureza = "";
        $scope.data_inicio = "";
        $scope.situacao = "";
        $scope.observacao = "";

				$http({
			        method : "GET",
			        url : "API/processos.php",
			        params: {
			        	id : $("#id").val()
			        }
			    }).then(function mySuccess(response) {
              //Exibe os clientes
              if (response.data.lista_cliente == null){
                $("#cliente_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                var lista_cliente = response.data.lista_cliente;
                var lista_cliente = lista_cliente.split(",");
                var lista_nome = response.data.lista_nome;
                var lista_nome = lista_nome.split(",");
                for (var i = 0; i < lista_cliente.length; i++){              
                  $("#cliente_id").append('<option value="'+lista_cliente[i]+'" selected="selected">'+lista_nome[i]+'</option>').trigger('change');
                }
              }

              //Exibe os documentos
              if (response.data.lista_documento == null){
                $("#documento_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                var lista_documento = response.data.lista_documento;
                var lista_documento = lista_documento.split(",");
                var lista_doc_obs = response.data.lista_doc_obs;
                var lista_doc_obs = lista_doc_obs.split(",");
                for (var i = 0; i < lista_documento.length; i++){              
                  $("#documento_id").append('<option value="'+lista_documento[i]+'" selected="selected">'+lista_doc_obs[i]+'</option>').trigger('change');
                }
              }

              $("#numero").val(response.data.numero);
              $("#nome").val(response.data.nome);
              $("#natureza").val(response.data.natureza);
              $("#data_inicio").val(response.data.data_inicio);
              $("#situacao").val(response.data.situacao);
              $("#observacao").val(response.data.observacao);
			    }, function myError(response) {
			    	
			    });
			});
			
		</script>
	</body>
</html>