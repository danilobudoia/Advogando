<?php
	require_once "header.php";
  require_once "Class/Clientes.php";
  
  $clientes = new Clientes();

  $listaClientes = $clientes->selectAll();
?>
  
	<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-users"></i> Clientes</h1>
            <p>Todos os clientes do banco de dados</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home fa-lg"> </a></i></li>
              <li><a>Clientes</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <div class="row">
                <div class="col-md-6">
                  <div class="card-title">
                    <a href="inserirCliente.php" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Adicionar Novo Cliente</span></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card-title">
                    <a href="listarRepresentantes.php" class="btn btn-warning ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-address-card-o" aria-hidden="true"></i> Listar Representantes</span></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card-title">
                      <a href="listarClientesArquivados.php" class="btn btn-danger delete" data-style="zoom-in"><span class="ladda-label"> <i class="fa fa-archive" aria-hidden="true"></i> Clientes Arquivados</span></a>
                    </div>
                </div>
              </div>
              
              <div class="card-footer">                
                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Nome</th>
                          <th>CPF/CNPJ</th>
                          <th>Email</th>
                          <th>Telefone</th>
                          <th>Celular</th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Nome</th> 
                          <th>CPF/CNPJ</th> 
                          <th>Email</th>
                          <th>Telefone</th>
                          <th>Celular</th>
                          <th>Ação</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php

                      foreach ($listaClientes as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo "<td>".$value['nome']."</td>"; 
                            echo "<td>".$value['documento1']."</td>";               
                            echo "<td>".$value['email']."</td>";     
                            echo "<td>".$value['telefone']."</td>";     
                            echo "<td>".$value['celular']."</td>";                         
                            echo '<td>
                              <button type="button" class="btn btn-primary view" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-search" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-warning edit" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-danger delete" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-archive" aria-hidden="true"></i></button>                              
                            </td>';
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
          "order": [[ 1, "asc" ]],
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

        //Botão visualizar informação
        table.on('click', '.view', function(event) {          
          event.preventDefault();
          //Pega a linha da table
          var dados = table.row( $(this).parents('tr') ).data();          

          var id = dados[0];

          window.location.href = 'visualizarCliente.php?id='+id;
        });

        //Botão editar informação
        table.on('click', '.edit', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table.row( $(this).parents('tr') ).data();          

          var id = dados[0];         

          window.location.href = 'editarCliente.php?id='+id;
        });

        //Botão deletar informação
        table.on('click', '.delete', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table.row( $(this).parents('tr') ).data();          

          var id = dados[0];

          swal({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sim, deletar!",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                url: 'API/clientes.php?id='+id,
                type: 'DELETE',
                dataType: 'json'
              })
              .done(function() {
                console.log("success");
                window.location.reload();
              })
              .fail(function() {
                console.log("error");
              })                            
            } else {
              swal("Cancelado", "Seus dados estão salvos :)", "error");
            }
          });                          
        });
      });
    </script>
  </body>
</html>