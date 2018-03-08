<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-gavel"></i> Adicionar processo</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarProcessos.php">Processos</a></li>
                <li><a>Adicionar processo</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

          <div  class="col-md-8 col-lg-offset-2">
            <a href="listarProcessos.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">processos</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Adicionar novo processo</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/processos.php" enctype="multipart/form-data"> 
                  <input type="hidden" name="_method" value="POST" />

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Numero do processo</label>
                        <input class="form-control" type="text" placeholder="Numero do processo" name="numero" id="numero" ng-model="numero" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Data de início</label>
                        <input class="form-control" type="date" placeholder="Data de início" name="data_inicio" id="data_inicio" ng-model="data_inicio" required>                  
                      </div>
                    </div> 
                  </div>  

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Nome do processo</label>
                        <input class="form-control" type="text" placeholder="Nome do processo" name="nome" id="nome" value="" ng-model="nome" required>                  
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Natureza</label>
                        <select class="form-control" name="natureza" id="natureza">
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
                    <input class="form-control" type="text" placeholder="Situação atual" name="situacao" id="situacao" value="" ng-model="situacao" required>                  
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Clientes</label>
                    <select id="cliente_id" name="cliente_id[]" style="width: 100%" multiple>
                    </select>                  
                  </div>

                  
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Documentos</label>
                        <div id="destino_documento"></div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- <div id="origem_documento" align="center">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Documento</label>
                          <input class="form-control" type="file" name="documentos[]" id="documentos">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Tipo</label>
                          <input class="form-control" type="text" placeholder="Tipo" name="doc_tipo[]" id="doc_tipo">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Descrição</label>
                          <input class="form-control" type="text" placeholder="Descrição" name="doc_observacao[]" id="doc_observacao">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label class="control-label"><br/></label><br/>
                        <img src="images/bt_mais.png" style="cursor: pointer;" onclick="duplicarCampos();">
                        <img src="images/bt_menos.png"  style="cursor: pointer;" onclick="removerCampos(this);">
                      </div>
                    </div>
                  </div> -->

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao"></textarea>
                  </div>

                  <div class="card-footer">
                      <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cadastrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" href="listarProcessos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>
            </div>
          </div>
        </div>	

      <!-- MODAL DE ADICIONAR -->
      <div class="modal fade" id="bt_modal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="card">
              <h3 class="card-title">Enviar documento</h3>

                <form id="form" method="POST" action="API/documentos.php" enctype="multipart/form-data"> 
                  <input type="hidden" name="_method" value="POST" />

                  <div class="form-group">
                    <label class="control-label">Documento</label>
                    <input class="form-control" type="file" name="documento" id="documento" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tipo do documento</label>
                    <input class="form-control" type="text" placeholder="Tipo do documento" name="tipo" id="tipo" required>
                  </div>

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao"></textarea>
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
    <script src="js/jquery-ui.js"></script>
    <script>
      $("#form").bootstrapValidator({
        fields: {        
          numero: {
              validators: {
                  notEmpty: {
                      message: 'O campo numero do processo é obrigatório'
                  },
                  stringLength:{
                    min: 3,
                    max: 30,
                    message: 'O numero do processo deve ser válido, fornecido pelo site do PJE'
                  }
              }              
          },          
          nome: {
              validators: {
                  notEmpty: {
                      message: 'O campo nome do processo é obrigatório'
                  },
                  stringLength:{
                    min: 3,
                    max: 30,
                    message: 'O nome do processo deve ser válido, e conter mais que 3 e menos que 30 caracteres'
                  }
              }              
          },
          data: {
              validators: {
                  notEmpty: {
                      message: 'O campo data é obrigatório'
                  }
              }              
          },    
          situacao: {
              validators: {
                  notEmpty: {
                      message: 'O campo de situação é obrigatório'
                  },
                  stringLength:{
                    min: 3,
                    max: 30,
                    message: 'A situação deve ter mais que 3 e menos que 30 caracteres'
                  }
              }              
          }
        }
      });
    </script>
    <script>
      $( function() {
        var availableTags = [
          "Aguardando documentos",
          "Aguardando despacho",
          "Aguardando execução",
          "Aguardando resposta das partes",
          "Aguardando resposta do juiz",
          "Aguardando resultado perícia",
          "Aguardando sentença",
          "Aguardando pagamento",
          "Aguardando perícia",
          "Aguardando peticionamento",
          "Aguardando protocolo",
          "Cancelado",
          "Concluido",
          "Em espera",
          "Em execução",
          "Em andamento",
          "Fase de conclusão",
          "Fase de julgamento",
          "Fase final",
          "Fase inicial",
          "Finalizado", 
          "Peticionar"
        ];
        $( "#situacao" ).autocomplete({
          source: availableTags
        });
      } );
    </script>
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
      });
    </script> 
	</body>
</html>