@extends("Aluno")

@section("contentAL")
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
                @foreach($totalHoras as $row)
                    <td align="center">{{ $row->totalHoras }}</td>
                @endforeach
                @foreach($totalHorasAtingir as $row)
                    <td align="center">{{ $row->totalHorasAtingir}}</td>
                @endforeach
               </tr>
               
             </tbody>

           </table>

           
         </div>

     </div> 

@stop
