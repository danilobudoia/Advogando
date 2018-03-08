<?php
	require_once "header.php";
  require_once "Class/Agenda.php";
  require_once "Class/Processos.php";

  $agenda = new Agenda();

  $listaAgenda_hoje = $agenda->selectHoje();
  $listaAgenda_atrasados = $agenda->selectAtrasados();
  $listaAgenda_futuros = $agenda->selectFuturos();

  $agendaConcluidos = $agenda->contarConcluidos();
  $agendaAtrasados = $agenda->contarAtrasados();
  $agendaHoje = $agenda->contarHoje();
  $agendaProximos = $agenda->contarProximos();
  $agendaDistantes = $agenda->contarDistantes();

  $processos = new Processos();

  $listaProcessos_situacao = $processos->selectAll();

  $processosConcluidos = $processos->contarConcluidos();
  $processosEmAndamento = $processos->contarEmAndamento();
?>
  
     <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-balance-scale" aria-hidden="true"></i> Advogando!</h1>
            <p>Seja bem vindo ao Sistema Advogando!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <h3 align="center"><i class="fa fa-calendar" aria-hidden="true"></i> Programação de eventos e compromissos</h3>
              <div class="card-footer">

                <h4>Eventos de hoje</h4>
                <table id="table_hoje" class="table table-striped table-condensed" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Evento</th>
                          <th>Data</th>
                          <th>Hora</th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($listaAgenda_hoje as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo "<td>".$value['evento']."</td>";
                            echo "<td>".date("d/m/Y",strtotime($value['data']))."</td>";
                            echo "<td>".$value['hora']."</td>";
                            echo '<td>
                              <button type="button" class="btn btn-success finalize" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-check" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-primary view" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </td>';
                        echo "</tr>";
                      }                      
                    ?>                      
                  </tbody>
                </table>

                <hr>
                <h4>Eventos atrasados</h4>
                <table id="table_atrasados" class="table table-striped table-condensed" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Evento</th>
                          <th>Data</th>
                          <th><i class="fa fa-calendar-times-o" aria-hidden="true"></i></th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($listaAgenda_atrasados as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo "<td>".$value['evento']."</td>";
                            echo "<td>".date("d/m/Y",strtotime($value['data']))."</td>";
                            echo "<td>".$value['d_atrasado']."</td>";
                            echo '<td>
                              <button type="button" class="btn btn-success finalize" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-check" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-primary view" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </td>';
                        echo "</tr>";
                      }                      
                    ?>                      
                  </tbody>
                </table>     

                <hr>
                <h4>Eventos futuros (10 dias)</h4>
                <table id="table_futuros" class="table table-striped table-condensed" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Evento</th>
                          <th>Data</th>
                          <th><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></i></th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($listaAgenda_futuros as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo "<td>".$value['evento']."</td>";
                            echo "<td>".date("d/m/Y",strtotime($value['data']))."</td>";
                            echo "<td>".$value['d_adiantado']."</td>";
                            echo '<td>
                              <button type="button" class="btn btn-success finalize" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-check" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-primary view" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </td>';
                        echo "</tr>";
                      }                      
                    ?>                      
                  </tbody>
                </table>     

                <hr>
                <div class="card-title">
                  <a href="inserirAgenda.php" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Novo evento/compromisso</span></a>
                </div>

              </div>              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <h3 align="center"><i class="fa fa-line-chart" aria-hidden="true"></i> Situação</h3>
              <div class="card-footer">

                <h4>Agenda</h4>
                <div id="grafico_agenda" style="height: 250px"></div>

                <!--
                <hr>
                <h4>Processos</h4>
                <div id="grafico_processos" style="height: 280px"></div>

                <hr>
                <h4>Situação dos processos</h4>
                <div id="grafico_situacao" style="height: 280px"></div>

                <hr>
                <h4>Natureza dos processos</h4>
                <div id="grafico_situacao" style="height: 280px"></div>

                <hr>
                <h4>Tipos de clientes</h4>
                <div id="grafico_situacao" style="height: 280px"></div>
                -->


                <hr>
                <h4>Processos</h4>
                <table id="table_situacao" class="table table-striped table-condensed" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th>Processo</th>
                          <th>Situação</th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($listaProcessos_situacao as $value) {
                        echo "<tr>";
                            echo "<td class='hidden'>".$value['id']."</td>";
                            echo "<td>".$value['numero']."</td>";
                            echo "<td>".$value['situacao']."</td>";
                            echo '<td>
                              <button type="button" class="btn btn-primary view" style="height: 30px; width: 30px; padding: 2px 2px"><i class="fa fa-search" aria-hidden="true"></i></button>
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
    <script src="js/plugins/moment.min.js"></script>   
    <script src="js/plugins/datetime-moment.js"></script>       
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <script src="js/loader.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $.fn.dataTable.moment('HH:mm:ss');

        //Habilita o dataTable
        var table_hoje = $('#table_hoje').DataTable({
          "searching": false,
          "paging": false,
          "scrollY": "200px",
          "bInfo": false,
          "scrollCollapse": true,
          "order": [[ 3, "asc" ]],
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
            },
          }
        });

        //Botão visualizar informação
        table_hoje.on('click', '.view', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_hoje.row( $(this).parents('tr') ).data();          

          var id = dados[0];
          window.location.href = 'visualizarAgenda.php?id='+id;
        });

        //Botão encerrar serviço
        table_hoje.on('click', '.finalize', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_hoje.row( $(this).parents('tr') ).data();          

          var id = dados[0];

          swal({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sim, finalizar!",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                url: 'API/agenda.php?id='+id+'&status=fim',
                type: 'FINALIZE',
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
    <script type="text/javascript">
      $(document).ready(function() {
        $.fn.dataTable.moment('DD/MM/YYYY');

        //Habilita o dataTable
        var table_atrasados = $('#table_atrasados').DataTable({
          "searching": false,
          "paging": false,
          "scrollY": "200px",
          "bInfo": false,
          "scrollCollapse": true,
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
            },
          }
        });

        //Botão visualizar informação
        table_atrasados.on('click', '.view', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_atrasados.row( $(this).parents('tr') ).data();          

          var id = dados[0];
          window.location.href = 'visualizarAgenda.php?id='+id;
        });

        //Botão encerrar serviço
        table_atrasados.on('click', '.finalize', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_atrasados.row( $(this).parents('tr') ).data();          

          var id = dados[0];

          swal({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sim, finalizar!",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                url: 'API/agenda.php?id='+id+'&status=fim',
                type: 'FINALIZE',
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
    <script type="text/javascript">
      $(document).ready(function() {
        $.fn.dataTable.moment('DD/MM/YYYY');

        //Habilita o dataTable
        var table_futuros = $('#table_futuros').DataTable({
          "searching": false,
          "paging": false,
          "scrollY": "200px",
          "bInfo": false,
          "scrollCollapse": true,
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
            },
          }
        });

        //Botão visualizar informação
        table_futuros.on('click', '.view', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_futuros.row( $(this).parents('tr') ).data();          

          var id = dados[0];
          window.location.href = 'visualizarAgenda.php?id='+id;
        });

        //Botão encerrar serviço
        table_futuros.on('click', '.finalize', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_futuros.row( $(this).parents('tr') ).data();          

          var id = dados[0];

          swal({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sim, finalizar!",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                url: 'API/agenda.php?id='+id+'&status=fim',
                type: 'FINALIZE',
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
    <script type="text/javascript">
      $(document).ready(function() {

        //Habilita o dataTable
        var table_situacao = $('#table_situacao').DataTable({
          "searching": false,
          "paging": false,
          "scrollY": "400px",
          "bInfo": false,
          "scrollCollapse": true,
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
            },
          }
        });

        //Botão visualizar informação
        table_situacao.on('click', '.view', function(event) {
          event.preventDefault();
          //Pega a linha da table
          var dados = table_situacao.row( $(this).parents('tr') ).data();          

          var id = dados[0];
          window.location.href = 'visualizarProcesso.php?id='+id;
        });
      });
    </script>
    <script type="text/javascript">
      //AGENDA
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(grafico_agenda);
      function grafico_agenda() {
        var data = google.visualization.arrayToDataTable([
          ['Agenda', 'Quantidade'],
          ['Concluidos', <?php echo $agendaConcluidos[0] ?>],
          ['Atrasados', <?php echo $agendaAtrasados[0] ?>],
          ['Prazo para hoje', <?php echo $agendaHoje[0] ?>],
          ['Próximos 10 dias', <?php echo $agendaProximos[0] ?>],
          ['Mais de 10 dias', <?php echo $agendaDistantes[0] ?>]
        ]);
        var options = {
          is3D: true,
          legend: 'none'
        };
        var chart = new google.visualization.PieChart(document.getElementById('grafico_agenda'));
        chart.draw(data, options);
      }

      //PROCESSO
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(grafico_processos);
      function grafico_processos() {
        var data = google.visualization.arrayToDataTable([
          ['Processos', 'Quantidade'],
          ['Concluidos', <?php echo $processosConcluidos[0] ?>],
          ['Em andamento', <?php echo $processosEmAndamento[0] ?>]
        ]);
        var options = {
          is3D: true,
          legend: 'none'
        };
        var chart = new google.visualization.PieChart(document.getElementById('grafico_processos'));
        chart.draw(data, options);
      }
    </script>
	</body>
</html>