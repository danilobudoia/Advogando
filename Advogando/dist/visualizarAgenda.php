<?php
  require_once "header.php";
?>

    <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-calendar"></i> Visualizar evento/compromisso</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarAgenda.php">Agenda</a></li>
                <li><a>Visualizar evento/compromisso</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarAgenda.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para <span class="text-lowercase">agenda</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Visualizar evento/compromisso</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/agenda.php" ng-app="myApp" ng-controller="myCtrl"> 
                  <input type="hidden" name="_method" value="PUT" />
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />

                  <div class="form-group">
                    <label class="control-label">Evento</label>
                    <input class="form-control" type="text" placeholder="Evento" name="evento" id="evento" disabled="true">
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Data</label>
                        <input class="form-control" type="date" name="data" id="data" disabled="true">                  
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Hora</label>
                        <input class="form-control" type="time" name="hora" id="hora" disabled="true">                  
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Numero do processo</label>
                    <select id="processo_id" name="processo_id" style="width: 100%" disabled="true">
                      <option selected="selected"></option>
                    </select>                   
                  </div>

                  <div class="form-group">
                    <label class="control-label">Nome do processo</label>
                    <input class="form-control" type="text" placeholder="Nome do processo" name="p_nome" id="p_nome" disabled="true">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Situação do processo</label>
                    <input class="form-control" type="text" placeholder="Situação do processo" name="p_situacao" id="p_situacao" disabled="true">
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Cliente</label>
                    <select id="cliente_id" name="cliente_id" style="width: 100%" disabled="true">
                      <option selected="selected"></option>
                    </select>                   
                  </div>

                  <div class="form-group">
                    <label class="control-label">Representante</label>
                    <select id="r_id" name="r_id" style="width: 100%" disabled="true">
                      <option selected="selected"></option>
                    </select>                   
                  </div>
                  
                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao" disabled="true"></textarea>
                  </div>
                  
                  <hr>
                  <a class="btn btn-default icon-btn voltar" href="listarAgenda.php"><i class="fa fa-angle-double-left"></i> Voltar</a>
                </form>                  
              
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
        
        //Processos        
        $("#processo_id").select2({        
          placeholder: "Processo",
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

        //Clientes        
        $("#cliente_id").select2({        
          placeholder: "Cliente",
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

        //Representantes        
        $("#r_id").select2({        
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
      });
    </script>    
    <script type="text/javascript">         
      var app = angular.module('myApp', []);

      app.controller('myCtrl', function($scope, $http) {

        $http({
              method : "GET",
              url : "API/agenda.php",
              params: {
                id : $("#id").val()
              }
          }).then(function mySuccess(response) {

              //Exibe o processo
              if (response.data.processo_id == null){
                $("#processo_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                $("#processo_id").append('<option value="'+response.data.processo_id+'" selected="selected">'+response.data.p_numero+'</option>').trigger('change');
              }
              
              //Exibe o cliente
              if (response.data.cliente_id == null){
                $("#cliente_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                $("#cliente_id").append('<option value="'+response.data.cliente_id+'" selected="selected">'+response.data.c_nome+'</option>').trigger('change');
              }

              //Exibe o representante
              if (response.data.r_id == null){
                $("#r_id").append('<option value="" selected="selected"></option>').trigger('change');
              }
              else {
                $("#r_id").append('<option value="'+response.data.r_id+'" selected="selected">'+response.data.r_nome+'</option>').trigger('change');
              }
              
              $("#evento").val(response.data.evento);
              $("#data").val(response.data.data);
              $("#hora").val(response.data.hora);
              $("#p_nome").val(response.data.p_nome);
              $("#p_situacao").val(response.data.p_situacao);
              $("#observacao").val(response.data.observacao);  
          }, function myError(response) {
            
         });
      });
    </script>    
  </body>
</html>