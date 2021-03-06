@extends("admin")

@section("contentA")      
          <div class="Container">
            <div class="page-header">
                <CENTER><h3>Cadastro de Alunos</h3></CENTER>        
               </div>
               <br/>
               <br/>
            <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/alunoG/salvar" method="post" class="valid rsform"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="name" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="name" name="name" placeholder="Digite aqui seu nome" value="{{ $alunos->name }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="instituicao_id" class="col-sm-3">Instituição que estuda: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="instituicao_id" name="instituicao_id" data-nome="Nome da Instituição">
                        <option></option>
                        @foreach($instituicoes as $row)
                          @if($row->id == $alunos->instituicao_id)
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
                    <label for="turma_id" class="col-sm-3 col-form-label">Turma: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="turma_id" name="turma_id" data-nome="Turma">
                        <option></option>
                        @foreach($turmas as $row)
                          @if($row->id == $alunos->turma_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->nomeA }}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->nameT }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="matricula" class="col-sm-3 col-form-label">Matricula: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="matricula" name="matricula" placeholder="Digite aqui a sua matricula" value="{{ $alunos->matricula }}" data-nome="Matricula"/>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="email" class="col-sm-3 col-form-label">Email: </label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control required" id="email" name="email" placeholder="Digite aqui seu email" value="{{ $alunos->email }}" data-nome="Email"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="inicioSemestre" class="col-sm-3 col-form-label">Ingresso em: </label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control required" id="inicioSemestre" name="inicioSemestre" value="{{$alunos->inicioSemestre}}" data-nome="Data de ingresso na faculdade"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="password" class="col-sm-3 col-form-label">Senha: </label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control required" id="password" name="password" placeholder="Digite aqui sua senha" value="" data-nome="Senha"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="remember_token" class="col-sm-3 col-form-label">Pergunta: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="remember_token" name="remember_token" placeholder="Nome de um bicho de estimação" value="" data-nome="Resposta"/>
                    </div>
                  </div>
                  <br/>

                  

                  <input type="hidden" name="id" value="{{ $alunos->id }}" />

                  <div class="col-sm-4 row"><!-- Div do botao-->
                        <button onclick="return validar();" type="submit" class="btn btn-primary btn-right">Salvar</button>
                  </div>                              

                </form>
            </div>

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