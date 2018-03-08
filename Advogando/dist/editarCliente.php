<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Editar Cliente</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarClientes.php">Clientes</a></li>
                <li><a>Editar clientes</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-10 col-lg-offset-1">
            <a href="listarClientes.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">clientes</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Editar cliente</h3>

              <div class="card-body">
                <form id="form" method="POST" action="API/clientes.php" ng-app="myApp" ng-controller="myCtrl">

                  <input type="hidden" name="_method" value="PUT" />
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />

                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input class="form-control" type="text" placeholder="Nome" name="nome" id="nome" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
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
                        <input class="form-control" type="text" placeholder="CPF / CNPJ" id="documento1" name="documento1" required onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='mascaraMutuario(this,cpfCnpj)'>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">RG / Inscrição</label>
                        <input class="form-control" type="text" placeholder="RG / Inscrição" id="documento2" name="documento2" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select class="form-control" name="sexo" id="sexo">
                          <option value="">-</option>
                          <option value="M">Masculino</option>
                          <option value="F">Feminino</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Data de nascimento</label>
                        <input class="form-control" type="date" name="data_nasc" id="data_nasc">                  
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">Representante</label>
                        <select id="repres_id" name="repres_id" style="width: 100%" >
                            <option selected="selected"></option>
                        </select> 
                      </div>       
                    </div>           
                  </div>

                  <button type="button" class="btn btn-danger" id="bt_apagar" onclick="click_apagar()">Apagar</button>
                  <button type="button" class="btn btn-success" id="bt_novo" data-toggle="modal" data-target="#bt_novo_Modal">Adicionar Novo</button>

                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input class="form-control" type="tel" placeholder="Telefone" id="telefone" name="telefone">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input class="form-control" type="tel" placeholder="Celular" id="celular" name="celular"> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" placeholder="Email" id="email" name="email"> 
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Endereço</label>
                        <input class="form-control" type="text" placeholder="Endereço" name="endereco" id="endereco">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Numero</label>
                        <input class="form-control" type="text" placeholder="Numero" name="numero" id="numero"> 
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input class="form-control" type="text" placeholder="Complemento" name="complemento" id="complemento">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input class="form-control" type="text" placeholder="Cidade" name="cidade" id="cidade"> 
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select class="form-control" name="estado" id="estado">
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
                        <input class="form-control" type="text" placeholder="CEP" name="cep" id="cep">                  
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Processos</label>
                    <select id="processo_id" name="processo_id[]" style="width: 100%" multiple>
                    </select>                  
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao"></textarea>
                  </div>

                  <div class="card-footer">
                    <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Atualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" href="listarClientes.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                  </div>
                </form>
            </div>
          </div>
        </div>		

        
      <!-- MODAL DE ADICIONAR -->
      <div class="modal fade" id="bt_novo_Modal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="card">
              <h3 class="card-title">Adicionar representante</h3>

                <form id="form" method="POST" action="API/representantes.php"> 
                  <input type="hidden" name="_method" value="POST" />

                  <div class="form-group">
                    <label class="control-label">Representante</label>
                    <input class="form-control" type="text" placeholder="Representante" name="nome" id="nome" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">CPF / RG</label>
                    <input class="form-control" type="text" placeholder="CPF / CNPJ" id="documento" name="documento" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Telefone</label>
                    <input class="form-control" type="tel" placeholder="Telefone" id="telefone" name="telefone">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Celular</label>
                      <input class="form-control" type="tel" placeholder="Celular" id="celular" name="celular"> 
                  </div>

                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" placeholder="Email" id="email" name="email"> 
                  </div>

                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <input class="form-control" type="text" placeholder="Observações" name="observacao" id="observacao">
                  </div>

                  <div class="card-footer">
                    <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Adicionar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
    <script src="js/plugins/jquery.mask.min.js"></script>
    <script src="js/plugins/bootstrapValidator.min.js"></script>
    <script src="js/plugins/select2.min.js"></script>
    <script>      
      $('#telefone').mask('(99) 9999-9999', {        
        placeholder: "(__) ____-____",
        clearIfNotMatch: true,
      });

      $('#celular').mask('(99) 99999-9999', {        
        placeholder: "(__) _____-____",
        clearIfNotMatch: true,
      });

      $('#cep').mask('99999-999', {        
        placeholder: "_____-___",
        clearIfNotMatch: true,
      });

      $("#form").bootstrapValidator({
        fields: {
          nome:{
            validators:{
              notEmpty:{
                message: "O campo nome é obrigatório"
              },
              stringLength:{
                min: 3,
                max: 100,
                message: "O nome deve ter mais que 3 e menos que 100 caracteres"
              }
            }
          },
        }
      });
    </script>
    <script>
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
              }
              else {
                $("#repres_id").append('<option value="'+response.data.repres_id+'" selected="selected">'+response.data.r_nome+'</option>').trigger('change');
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
			    }, function myError(response) {
			    	
			    });
			});
		</script>
    <script>
      function click_apagar() { 
        $("#repres_id").append('<option value="" selected="selected"></option>').trigger('change');
      }
    </script>
    <script>
      function mascaraMutuario(o,f){
          v_obj=o
          v_fun=f
          setTimeout('execmascara()',1)
      }
       
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }
       
      function cpfCnpj(v){
          //Remove tudo o que não é dígito
          v=v.replace(/\D/g,"")
          if (v.length < 14) { //CPF
              //Coloca um ponto entre o terceiro e o quarto dígitos
              v=v.replace(/(\d{3})(\d)/,"$1.$2")
              //Coloca um ponto entre o terceiro e o quarto dígitos
              v=v.replace(/(\d{3})(\d)/,"$1.$2")
              //Coloca um hífen entre o terceiro e o quarto dígitos
              v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
       
          } else { //CNPJ=
              //Coloca ponto entre o segundo e o terceiro dígitos
              v=v.replace(/^(\d{2})(\d)/,"$1.$2")
              //Coloca ponto entre o quinto e o sexto dígitos
              v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
              //Coloca uma barra entre o oitavo e o nono dígitos
              v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
              //Coloca um hífen depois do bloco de quatro dígitos
              v=v.replace(/(\d{4})(\d)/,"$1-$2")
          }
          return v
      }
    </script>
	</body>
</html>