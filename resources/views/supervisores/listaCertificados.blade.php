@extends("supervisor")

@section("contentS")

  <div class="Container">

      <div class="page-header">
                      <CENTER><h3>Quantidade de Horas</h3></CENTER>        
                     </div>


                       <div>
                         <table class="table table-striped table-bordered table-hover table-bordered">
                          <!--1-Coloca cores alternadas de linhas-->
                          <!--2-Coloca bordas envolta da tabela-->
                          <!--3-Coloca efeito hover nas linhas-->
                          <!--4-Condensa os espacos dentro da tabela-->
                           <thead>
                             <tr>
                               <th>Total de horas aprovadas</th>
                               <th>Quantidade de horas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>

                              @if($totalHoras[0]->totalHoras > $totalHorasAtingir[0]->totalHorasAtingir)
                                  <td align="center" style="background: #00FF7F;"><b>{{ $totalHoras[0]->totalHoras }}</b></td>
                              @else
                                  <td align="center" style="background: #FF6347;"><b>{{ $totalHoras[0]->totalHoras }}</b></td>
                              @endif
                                  <td align="center">{{ $totalHorasAtingir[0]->totalHorasAtingir}}</td>

                             </tr>
                           </tbody>
                           <thead>
                             <tr>
                               <th>Total de horas externas aprovadas</th>
                               <th>Quantidade de horas externas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
@if($totalHorasExternas[0]->totalHorasExternas > $totalHorasAtingirExternas[0]->totalHorasAtingirExternas)
                                  <td align="center" style="background: #00FF7F;"><b>{{ $totalHorasExternas[0]->totalHorasExternas }}</b></td>
@else
                                  <td align="center" style="background: #FF6347;"><b>{{ $totalHorasExternas[0]->totalHorasExternas }}</b></td>
@endif
                                  <td align="center">{{ $totalHorasAtingirExternas[0]->totalHorasAtingirExternas}}</td>

                             </tr>
                           </tbody>
                           <thead>
                             <tr>
                               <th>Total de horas internas aprovadas</th>
                               <th>Quantidade de horas internas requeridas</th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
@if($totalHorasInternas[0]->totalHorasInternas > $totalHorasAtingirInternas[0]->totalHorasAtingirInternas)
  <td align="center" style="background: #00FF7F;"><b>{{ $totalHorasInternas[0]->totalHorasInternas }}</b></td>
@else
  <td align="center" style="background: #FF6347;"><b>{{ $totalHorasInternas[0]->totalHorasInternas }}</b></td>
@endif                              

         <td align="center">{{ $totalHorasAtingirInternas[0]->totalHorasAtingirInternas}}</td>

                             </tr>
                           </tbody>

                           <thead>
                             <tr>
                               <th>Aprovar aluno com horas completas</th>
                               <th><center><a onclick="return confirm('Deseja aprovar este aluno?');" href="/alunoG/aprovar"><button class="btn btn-primary btn-right">Aprovar</button></a></center> </th>
                             </tr>
                           </thead>

                           </table>

                           
                         </div>

       <div class="page-header">
        <CENTER><h3>Listagem de Certificados Cadastrados</h3></CENTER>        
       </div>

         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Aluno</th>
                 <th>Certificado</th>
                 <th>Relatório dos dados</th>
                 <th>Download do Certificado</th>
                 <th>Status</th>
                 <th>Validação</th>
               </tr>
             </thead>
             <tbody>
               @foreach($certificados as $row)
               		<tr>
               			<td>{{ $row->name }}</td>
                    <td>{{ $row->nomeC }}</td>
                     <td>
                      <a target="_blank"  href="/certificado/pdf?id={{ $row->certificado_id }}"><span class="glyphicon glyphicon-download-alt">Download Relatorio</span></a>
                    </td>

                    <td>
                      <a target="_blank"  href="/certificado/download?arquivo={{ $row->arquivo }}"><span class="glyphicon glyphicon-download-alt">Download</span></a>
                    </td>
                    <!--Colocar botão-->
                    <td>@if ($row->status == 0)
                        <span style="color:#FFD700">Aguardando Análise</span>
                      @elseif ($row->status == 1)
                        <span style="color:blue">Aprovado</span>
                      @else
                        <span style="color:red">Reprovado</span>
                      @endif
                    </td>
                    <td>
                      <?php
                        echo "<a href='/certificado/validar/?id=".$row->certificado_id."'>Validar</a>";
                      ?>
                      
                      <br>
                      <?php
                        echo "<a href='/certificado/invalidar/?id=".$row->certificado_id."'>Invalidar</a>";
                      ?>
                    </td>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop