<?php
	require_once "header.php";
?>

		<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Adicionar representante</h1>
            <!-- <p>Sample forms</p> -->
          </div>
          <div>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a  href="listarRepresentantes.php">Representantes</a></li>
                <li><a>Adicionar representante</a></li>
            </ul>
          </div>
        </div>
                
        <div class="row">

            <div  class="col-md-8 col-lg-offset-2">
            <a href="listarRepresentantes.php" class="voltar"><i class="fa fa-angle-double-left"></i> Voltar para todos <span class="text-lowercase">representantes</span></a><br><br>
            <div class="card">
              <h3 class="card-title">Novo representante</h3>
              
              <div class="card-body">              

                <form id="form" method="POST" action="API/representantes.php"> 
                  <input type="hidden" name="_method" value="POST" />

                  <div class="form-group">
                    <label class="control-label">Representante</label>
                    <input class="form-control" type="text" placeholder="Representante" name="nome" id="nome" required="">
                  </div>

                  <div class="form-group">
                    <label class="control-label">CPF / RG</label>
                    <input class="form-control" type="text" placeholder="CPF / CNPJ" id="documento" name="documento" required="">
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

                  <hr>
                  <div class="form-group">
                    <label class="control-label">Observações</label>
                    <textarea class="form-control" type="text" rows="4" style="resize: none" placeholder="Observações" name="observacao" id="observacao"></textarea>
                  </div>

                  <div class="card-footer">
                      <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cadastrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn voltar" href="listarRepresentantes.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
    <script src="js/plugins/jquery.mask.min.js"></script>
    <script src="js/plugins/bootstrapValidator.min.js"></script>
    <script>      
      $('#telefone').mask('(99) 9999-9999', {        
        placeholder: "(__) ____-____",
        clearIfNotMatch: true,
      });

      $('#celular').mask('(99) 99999-9999', {        
        placeholder: "(__) _____-____",
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
                max: 30,
                message: "O nome deve ter mais que 3 e menos que 30 caracteres"
              }
            }
          },
          documento:{
            validators:{
              notEmpty:{
                message: "O campo documento é obrigatório"
              },
              stringLength:{
                min: 3,
                max: 30,
                message: "O nome deve ter mais que 3 e menos que 30 caracteres"
              }
            }
          }
        }
      });
    </script>
	</body>
</html>