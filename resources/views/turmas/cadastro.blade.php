@extends("supervisor")

@section("contentS")      
            <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Turma</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/turma/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-12"><!-- Div do input do nome-->
                    <label for="nameT" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="nameT" name="nameT" placeholder="Digite aqui o seu nome" value="{{ $turmas->nameT }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-12"><!-- Div do input do nome-->
                    <label for="curso" class="col-sm-3 col-form-label">Curso: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="curso" name="curso" placeholder="Digite aqui o seu curso" value="{{ $turmas->curso }}" data-nome="Curso"/>
                    </div>
                  </div>
                  <br/>     

                  <div class="form-group row col-sm-12"><!-- Div do input do nome-->
                    <label for="codigo" class="col-sm-3 col-form-label">Código: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="codigo" name="codigo" placeholder="Digite aqui o código de acesso da turma" value="{{ $turmas->codigo }}" data-nome="codigo"/>
                    </div>
                  </div>
                  <br/>  

                  <div class="form-group row col-sm-12"><!-- Div do input do nome-->
                    <label for="totalHora" class="col-sm-3 col-form-label">Total de horas: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="totalHora" name="totalHora" placeholder="Digite aqui o total das horas complementares do curso" value="{{ $turmas->totalHora }}" data-nome="Total das horas"/>
                    </div>
                  </div>
                  <br/>        

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="instituicao_id" class="col-sm-4">Nome da Instituição: </label>
                    <div class="col-sm-8">
                      <select style="height: 33px;" class="form-control required" id="instituicao_id" name="instituicao_id" data-nome="Nome da Instituição">
                        <option></option>
                        @foreach($instituicoes as $row)
                          @if($row->id == $turmas->instituicao_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->nome}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->nome }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="modelo_id" class="col-sm-4">Modelo das Atividades Complementares: </label>
                    <div class="col-sm-8">
                      <select style="height: 33px;" class="form-control required" id="modelo_id" name="modelo_id" data-nome="Modelo das Atividades Complementares">
                        <option></option>
                        @foreach($modelos as $row)
                          @if($row->id == $turmas->modelo_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->nomeM}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->nomeM }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/> 
                  
                    <input type="hidden" name="id" value="{{ $turmas->id }}" />
                    <!--Arrumar uma forma de cadastra o id do professor logado-->
                    <div class="col-sm-4 row"><!-- Div do botao-->
                        <button onclick="return validar();" type="submit" class="btn btn-primary btn-right">Salvar</button>
                    </div>
                  </div>                
                </form>

          </div>

          <script>
            
            function validar(){

              var sucesso = true;//cria campo para o each validar

              $(".required").each(function() {
                if($(this).val() == ""){
                  var nome_campo = $(this).data("nome");
                  alert("Campo " +nome_campo +" obrigatório!");
                  sucesso = false;
                }
              });

              return sucesso;
            }

          </script>
@stop