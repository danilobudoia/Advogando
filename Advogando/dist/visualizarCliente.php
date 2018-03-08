<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Visualizar cliente</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarClientes.php">Clientes</a></li>
                <li><a>Visualizar cliente</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">
          <div  class="col-md-10 col-lg-offset-1">
            <a href="listarClientes.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">clientes</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Visualizar cliente</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/clientes.php" ng-app="myApp" ng-controller="myCtrl">                   
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input class="form-control" type="text" placeholder="Nome" name="nome" id="nome" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <select class="form-control" name="tipo" id="tipo" disabled="true">
                          <option value="F">Pessoa Física</option>
                          <option value="J">Pessoa Jurídica</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">CPF / CNPJ</label>
                        <input class="form-control" type="text" placeholder="CPF / CNPJ" id="documento1" name="documento1" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">RG / Inscrição</label>
                        <input class="form-control" type="text" placeholder="RG / Inscrição" id="documento2" name="documento2" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select class="form-control" name="sexo" id="sexo" disabled="true">
                          <option value="">-</option>
                          <option value="M">Masculino</option>
                          <option value="F">Feminino</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Data de nascimento</label>
                        <input class="form-control" type="date" name="data_nasc" id="data_nasc" disabled="true">                  
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">Representante</label>
                        <select id="repres_id" name="repres_id" style="width: 100%" disabled="true">
                            <option selected="selected"></option>
                        </select> 
                      </div>       
                    </div>       
                  </div>

                  <button type="button" class="btn btn-success" id="bt_visu" data-toggle="modal" data-target="#bt_Modal">Visualizar representante</button>    

                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input class="form-control" type="tel" placeholder="Telefone" id="telefone" name="telefone" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input class="form-control" type="tel" placeholder="Celular" id="celular" name="celular" disabled="true"> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" placeholder="Email" id="email" name="email" disabled="true"> 
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Endereço</label>
                        <input class="form-control" type="text" placeholder="Endereço" name="endereco" id="endereco" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Numero</label>
                        <input class="form-control" type="text" placeholder="Numero" name="numero" id="numero" disabled="true"> 
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input class="form-control" type="text" placeholder="Complemento" name="complemento" id="complemento" disabled="true">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input class="form-control" type="text" placeholder="Cidade" name="cidade" id="cidade" disabled="true"> 
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select class="form-control" name="estado" id="estado" disabled="true">
                          <option value="">-</option>
                          <option value="AC">Acre</option>
                          <option value="AL">Alagoas</option>
                          <option value="AP">Amapá</option>
                          <option value="AM">Amazonas</option>
                          <option value="BA">Bahia</option>
                          <option value="CE">Ceará</option>
                          <option value="DF">Distrito Federal</option>
                          <option value="ES">Espírito Santo</option>
                          <option value="GO">Goiás</option>
                          <option value="MA">Maranhão</option>
                          <option value="MT">Mato Grosso</option>
                          <option value="MS">Mato Grosso do Sul</option>
                          <option value="MG">Minas Gerais</option>
                          <option value="PA">Pará</option>
                          <option value="PB">Paraíba</option>
                          <option value="PR">Paraná</option>
                          <option value="PE">Pernambuco</option>
                          <option value="PI">Piauí</option>
                          <option value="RJ">Rio de Janeiro</option>
                          <option value="RN">Rio Grande do Norte</option>
                          <option value="RS">Rio Grande do Sul</option>
                          <option value="RO">Rondônia</option>
                          <option value="RR">Roraima</option>
                          <option value="SC">Santa Catarina</option>
                          <option value="SP">São Paulo</option>
                          <option value="SE">Sergipe</option>
                          <option value="TO">Tocantins</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input class="form-control" type="text" placeholder="CEP" name="cep" id="cep" disabled="true">
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Processos</label>
                    <select id="processo_id" name="processo_id[]" style="width: 100%" multiple disabled="true">
                    </select>                  
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao" disabled="true"></textarea>
                  </div>
                  
                  <hr>
                  <a class="btn btn-default icon-btn voltar" href="listarClientes.php"><i class="fa fa-angle-double-left"></i> Voltar</a>
                </form>
            </div>
          </div>
        </div>
    </div>

      <!-- MODAL DE VISUALIZAR -->
      <div class="modal fade" id="bt_Modal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="card">
              <h3 class="card-title">Visualizar representante</h3>

                  <div class="form-group">
                    <label class="control-label">Representante</label>
                    <input class="form-control" type="text" placeholder="Representante" name="r_nome" id="r_nome" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">CPF / RG</label>
                    <input class="form-control" type="text" placeholder="CPF / CNPJ" id="r_documento" name="r_documento" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Telefone</label>
                    <input class="form-control" type="tel" placeholder="Telefone" id="r_telefone" name="r_telefone" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Celular</label>
                      <input class="form-control" type="tel" placeholder="Celular" id="r_celular" name="r_celular" disabled="true"> 
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" placeholder="Email" id="r_email" name="r_email" disabled="true"> 
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <input class="form-control" type="text" placeholder="Observações" name="r_observacao" id="r_observacao" disabled="true">
                  </div>
                  <div class="card-footer">
                    <a class="btn btn-default icon-btn voltar" data-dismiss="modal">Fechar</a>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>  

		<!-- Javascripts-->
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/main.js"></script>
    <script src="js/plugins/select2.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function($) {
        
        //Representante        
        $("#repres_id").select2({        
          placeholder: "Representante",
          minimumInputLength: 1,                             
          ajax: {
              url: 'API/representantes.php',
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

        //Processos        
        $("#processo_id").select2({        
          placeholder: "Processos",
          minimumInputLength: 1,                             
          ajax: {
              url: 'API/processos.php',
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
                          textField = "numero";
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
      });
    </script>    
		<script type="text/javascript">					
			var app = angular.module('myApp', []);
			app.controller('myCtrl', function($scope, $http) {		
        $scope.repres_id = "";			  
        $scope.tipo = "";   
        $scope.nome = "";
        $scope.documento1 = "";
        $scope.documento2 = "";
        $scope.data_nasc = "";
        $scope.sexo = "";
        $scope.telefone = "";
        $scope.celular = "";
        $scope.email = "";
        $scope.endereco = "";
        $scope.numero = "";
        $scope.complemento = "";
        $scope.cidade = "";
        $scope.estado = "";
        $scope.cep = "";
        $scope.observacao = "";
        $scope.r_nome = "";

				$http({
			        method : "GET",
			        url : "API/clientes.php",
			        params: {
			        	id : $("#id").val()
			        }
			    }).then(function mySuccess(response) {
              //Exibe o representante
              if (response.data.repres_id == null){
                $("#repres_id").append('<option value="" selected="selected"></option>').trigger('change');
                document.getElementById('bt_visu').disabled=true;
              }
              else {
                $("#repres_id").append('<option value="'+response.data.repres_id+'" selected="selected">'+response.data.r_nome+'</option>').trigger('change');
                document.getElementById('bt_visu').disabled=false;
              }

              //Exibe os processos
              if (response.data.lista_processo == null){
                $("#processo_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                var lista_processo = response.data.lista_processo;
                var lista_processo = lista_processo.split(",");
                var lista_numero = response.data.lista_numero;
                var lista_numero = lista_numero.split(",");
                for (var i = 0; i < lista_processo.length; i++){              
                  $("#processo_id").append('<option value="'+lista_processo[i]+'" selected="selected">'+lista_numero[i]+'</option>').trigger('change');
                }
              }

              $("#tipo").val(response.data.tipo);
              $("#nome").val(response.data.nome);
              $("#documento1").val(response.data.documento1);
              $("#documento2").val(response.data.documento2);
              $("#data_nasc").val(response.data.data_nasc);
              $("#sexo").val(response.data.sexo);
              $("#telefone").val(response.data.telefone);
              $("#celular").val(response.data.celular);
              $("#email").val(response.data.email);
              $("#endereco").val(response.data.endereco);
              $("#numero").val(response.data.numero);
              $("#complemento").val(response.data.complemento);
              $("#cidade").val(response.data.cidade);
              $("#estado").val(response.data.estado);
              $("#cep").val(response.data.cep);
              $("#observacao").val(response.data.observacao);

              $("#r_nome").val(response.data.r_nome);
              $("#r_documento").val(response.data.r_documento);
              $("#r_telefone").val(response.data.r_telefone);
              $("#r_celular").val(response.data.r_celular);
              $("#r_email").val(response.data.r_email);
              $("#r_observacao").val(response.data.r_observacao);
              console.log(response);
			    }, function myError(response) {
			    	
			   });
			});
		</script>
	</body>
</html>