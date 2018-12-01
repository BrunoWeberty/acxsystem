@extends("admin")

@section("contentA")
	<div class="Container">

       <div class="page-header">
        <CENTER><h3>Listagem de Alunos</h3></CENTER>        
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
                 <th>Matricula</th>
                 <th>Email</th>
                 <th>Instituição que estuda</th>
                 <th>Ingresso em</th>
                 <th>Turma</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($alunos as $row)
               		<tr>
               			<td>{{ $row->name }}</td>
                    <td>{{ $row->matricula }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->nome}}</td>
                    <td>{{date('d/m/Y',  strtotime( $row->inicioSemestre ))}}</td>
                    <td>{{ $row->nameT }}</td>
                    <td>
                      <a href="/alunoG?id={{$row->id }}">Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/alunoG/excluir?id={{ $row->id }}">Excluir</a>
                    </td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop