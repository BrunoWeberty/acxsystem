@extends("supervisor")

@section("contentS")
  <div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Categorias</h3></CENTER>        
       </div>


         <div>
           <table class="table table-striped table-bordered table-hover table-bordered">
            <!--1-Coloca cores alternadas de linhas-->
            <!--2-Coloca bordas envolta da tabela-->
            <!--3-Coloca efeito hover nas linhas-->
            <!--4-Condensa os espacos dentro da tabela-->
             <thead>
               <tr>
                 <th>Nome</th>
                 <th>Modalidade</th>
                 <th>Descrição</th>
                 <th>Limite carga horária semestral</th>
                 <th>Limite de Certificados por Semestre</th>
                 <th>Observações</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($categorias as $row)
                  <tr>
                    <td  style="width: 10%">{{ $row->nome }}</td>
                    <td align='justify'>{{ $row->name }}</td>
                    <td align='justify'>{{ $row->descricao }}</td>
                    <td align='justify'>{{ $row->limiteChs }}</td>
                    <td align='justify'>{{ $row->limiteCertificados }}</td>
                    <td align='justify'>{{ $row->observacoes }}</td>
                    
                    <td>
                      <a href="/categoria?id={{$row->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/categoria/excluir?id={{ $row->id }}"><span class="glyphicon glyphicon-remove-sign">Excluir</span></a>
                    </td>
                  </tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop