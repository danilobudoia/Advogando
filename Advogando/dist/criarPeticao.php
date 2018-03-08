<?php
	require_once "header.php";
?>
  
     <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-file-text-o"></i> Criar Petição</h1>
            <p>Sistema para criação automática de petições</p>
          </div>
        </div>

        <div class="row">

            <div  class="col-md-10 col-lg-offset-1">
            <div class="card">

              <div class="row">
                <div class="col-md-9">
                  <h3 class="card-title">Criar Petição</h3>
                </div>
                <div class="col-md-3">
                  <a href="listarPeticoes.php" class="btn btn-warning" data-style="zoom-in"><span class="ladda-label"> <i class="fa fa-files-o" aria-hidden="true"></i> Listar petições</span></a>
                </div>
              </div>

              <div class="card-body">
                <form id="form" method="POST" data-toggle="validator" action="API/criarPeticao.php">

                  <hr>
                  <div class="row">
                    <div class="col-md-7">
                      <div class="form-group">
                        <label class="control-label">Nome da Petição</label>
                        <input class="form-control" type="text" placeholder="Nome da Petição" name="nomePeticao" id="nomePeticao" required>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label">Tipo de Petição</label>
                        <select class="form-control" name="tipoPeticao" id="tipoPeticao" required>
                          <option value="">-</option>
                          <optgroup label="Civil">
                            <option value="Civil/Ação de Divórcio">Ação de Divorcio</option>
                            <option value="Civil/Ação Popular">Ação Popular</option>
                            <option value="Civil/Adjudicação Compulsória">Adjudicação Compulsória</option>
                            <option value="Civil/Agravo de Instrumento">Agravo de Instrumento</option>
                            <option value="Civil/Alimentos">Alimentos</option>
                            <option value="Civil/Direitos Autorais">Direitos Autorais</option>
                            <option value="Civil/Indenização (Acidente de Trânsito)">Indenização (Acidente de Trânsito)</option>
                            <option value="Civil/Inventário">Inventário</option>
                          </optgroup>
                          <optgroup label="Penal">
                            <option value="Penal/Apelação Criminal">Apelação Criminal</option>
                            <option value="Penal/Crime de Ameaça">Crime de Ameaça</option>
                            <option value="Penal/Liberdade provisória">Liberdade provisória</option>
                          </optgroup>
                          <optgroup label="Trabalhista">
                            <option value="Trabalhista/Adicional de Insalubridade">Adicional de Insalubridade</option>
                            <option value="Trabalhista/Adicional de Periculosidade">Adicional de Periculosidade</option>
                            <option value="Trabalhista/Adicional Noturno">Adicional Noturno</option>
                            <option value="Trabalhista/Contestação (Empregada Doméstica)">Contestação (Empregada Doméstica)</option>
                            <option value="Trabalhista/Despedida Sem Justa Causa">Despedida Sem Justa Causa</option>
                            <option value="Trabalhista/Horas extras">Horas extras</option>
                          </optgroup>
                        </select>
                      </div> 
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">Processo</label>
                        <select id="processo_id" name="processo_id" style="width: 100%" required>
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
                        <select id="cliente_id" name="cliente_id" style="width: 100%" required>
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
                    <label class="control-label">QUADRO FÁTICO</label>
                    <textarea class="form-control" type="text" rows="10" placeholder="QUADRO FÁTICO (deixe em banco caso queira adicionar posteriormente)" name="conteudo_pt1" id="conteudo_pt1"></textarea>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">PEDIDOS E REQUERIMENTOS</label>
                    <textarea class="form-control" type="text" rows="10" placeholder="PEDIDOS E REQUERIMENTOS (deixe em banco caso queira adicionar posteriormente)" name="conteudo_pt2" id="conteudo_pt2"></textarea>
                  </div>

                  <hr>
                  <div>
                    <button class="btn btn-success icon-btn" id="report" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Criar Petição</button>
                  </div>
                </form>                  
              
            </div>
          </div>
        </div>
                
    <!-- Java Script-->            
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/validator.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script> 
    <script src="js/plugins/select2.min.js"></script>
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