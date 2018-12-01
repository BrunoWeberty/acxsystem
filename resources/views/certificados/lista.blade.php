@extends("Aluno")

@section("contentAL")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Certificados</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Certificado</th>
                 <th>Categoria</th>
                 <th>Download</th>
                 <!--<th>Editar</th>-->
                 <th>Excluir</th>
                 <th>Status</th>
               </tr>
             </thead>
             <tbody>
               @foreach($certificados as $row)
               		<tr>
               			<td>{{ $row->nomeC }}</td>
                    <td>{{ $row->nome }}</td>
                    <td>

                      <!--target="_blank" abrea nova janela de visualização-->
                      <a target="_blank" href="/certificado/download?arquivo={{ $row->arquivo }}"><span class="glyphicon glyphicon-download-alt">Download</span></a>
                    </td>
                    
                    <td>
                      @if ($row->status == 0)
                        <a onclick="return confirm('Deseja realmente excluir?');" href="/certificado/excluir?id={{ $row->certificado_id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                      @elseif ($row->status == 1)
                        <span style="color:blue">Aprovado</span>
                      @else
                        <a onclick="return confirm('Deseja realmente excluir?');" href="/certificado/excluir?id={{ $row->certificado_id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                      @endif
                    </td>


                      
                    </td>
                    <td>@if ($row->status == 0)
                        <span style="color:#FF8C00">Aguardando Análise</span>
                      @elseif ($row->status == 1)
                        <span style="color:blue">Aprovado</span>
                      @else
                        <span style="color:red">Reprovado</span>
                      @endif
                    </td>

               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop
