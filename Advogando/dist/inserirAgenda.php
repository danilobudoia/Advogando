<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-calendar"></i> Adicionar evento/compromisso</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarAgenda.php">Agenda</a></li>
                <li><a>Adicionar evento/compromisso</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">
          <div  class="col-md-8 col-lg-offset-2">
            <a href="listarAgenda.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para <span class="text-lowercase">agenda</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Adicionar evento/compromisso</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/agenda.php"> 
                  <input type="hidden" name="_method" value="POST" />
                  
                  <div class="form-group">
                    <label class="control-label">Evento</label>
                    <input class="form-control" type="text" placeholder="Evento" name="evento" id="evento" required>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Data</label>
                        <input class="form-control" type="date" name="data" id="data" required>                  
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Hora</label>
                        <input class="form-control" type="time" name="hora" id="hora" required>                  
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">Processo</label>
                        <select id="processo_id" name="processo_id" style="width: 100%">
                          <option selected="selected"></option>
                        </select>                   
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label"><br/></label><br/>
                      <button type="button" class="btn btn-danger" id="bt_apagar_p" onclick="click_apagar_p()">Apagar</button>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">Cliente</label>
                        <select id="cliente_id" name="cliente_id" style="width: 100%">
                          <option selected="selected"></option>
                        </select>                   
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label"><br/></label><br/>
                      <button type="button" class="btn btn-danger" id="bt_apagar_c" onclick="click_apagar_c()">Apagar</button>
                    </div>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao"></textarea>
                  </div>

                  <div class="card-footer">
                      <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cadastrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" href="listarAgenda.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
    <script src="js/plugins/select2.min.js"></script>
    <script src="js/plugins/bootstrapValidator.min.js"></script>
    <script>      
      $("#form").bootstrapValidator({
        fields: {          
          evento: {
              validators: {
                  notEmpty: {
                      message: 'O campo evento é obrigatório'
                  }
              }              
          },
          data: {
              validators: {
                  notEmpty: {
                      message: 'O campo data é obrigatório'
                  }
              }              
          }
          hora: {
              validators: {
                  notEmpty: {
                      message: 'O campo hora é obrigatório'
                  }
              }              
          }
        }
      });
    </script>
    <script>
      $(document).ready(function($) {
        
        //Processo        
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
        
        //Cliente        
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
      });
    </script>    
    <script>
      function click_apagar_p() { 
        $("#processo_id").append('<option value="" selected="selected"></option>').trigger('change');
      }
      function click_apagar_c() { 
        $("#cliente_id").append('<option value="" selected="selected"></option>').trigger('change');
      }
    </script>
	</body>
</html>