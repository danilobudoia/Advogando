<?php
	require_once "header.php";
  require_once "Class/Documentos.php";
  
  $documentos = new Documentos();

  $listaDocumentos = $documentos->selectAll();
?>
  
	<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-files-o"></i> Petições</h1>
            <p>Todos as petições salvas</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home fa-lg"> </a></i></li>
              <li><a>Petições</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <div class="card-title">
                <a href="criarPeticao.php" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Criar nova petição</span></a>
              </div>
              
              <div class="card-footer">                
                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Local</th>
                          <th>Processo</th>
                          <th>Observação</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Local</th>
                          <th>Processo</th>
                          <th>Observação</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php

                      foreach ($listaDocumentos as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo '<td> <a href="visualizarPeticao.php?id='.$value['id'].'"> <i class="fa fa-file-word-o" aria-hidden="true"></i> '.$value['local'].'</a></td>';   
                            echo "<td>".$value['numero']."</td>";  
                            echo "<td>".$value['observacao']."</td>";
                        echo "</tr>";
                      }                      
                    ?>                      
                  </tbody>
                </table>            
              </div>              
            </div>            
          </div>
        </div>
    </div>
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables.bootstrap.min.js"></script>    
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {                    

        //Habilita o dataTable
        var table = $('#table').DataTable({
          "order": [[ 2, "asc" ]],
          "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Exibir _MENU_ por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar", 
            "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
            },
            "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
            }     
          }
        });
      });
    </script>
  </body>
</html>