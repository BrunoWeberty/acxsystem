@extends("layouts.app")

@section("content")
	<div class="container">

       <div class="page-header">
        <CENTER><h3>Listagem</h3></CENTER>        
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
                 <th>Email</th>
                 <th>Editar</th>
                 <th>Excluir</th>
               </tr>
             </thead>
             <tbody>
               @foreach($users as $row)
               		<tr>
               			<td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                      <a href="/user?id={{$row->id }}">Editar</a>
                    </td>
                    <td>
                      <a onclick="return confirm('Deseja realmente excluir?');" href="/user/excluir?id={{ $row->id }}">Excluir</a>
                    </td>
               		</tr>
               @endforeach
             </tbody>

           </table>

           
         </div>

     </div> 

@stop