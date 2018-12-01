@extends("supervisor")

@section("contentS")      
          
            <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Categorias</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/categoria/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="nome" class="col-sm-4 col-form-label">Nome: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control required" id="nome" name="nome" placeholder="Digite aqui o seu nome" value="{{ $categorias->nome }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="modalidade_id" class="col-sm-4">Modalidade: </label>
                    <div class="col-sm-8">
                      <select style="height: 33px;" class="form-control required" id="modalidade_id" name="modalidade_id" data-nome="Modalidade">
                        <option></option>
                        @foreach($modalidades as $row)
                          @if($row->id == $categorias->modalidade_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->name}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="descricao" class="col-sm-4 col-form-label">Descrição: </label>
                    <div class="col-sm-8">
                      <textarea rows="4" cols="50" class="form-control required" id="descricao" name="descricao" placeholder="Digite aqui a Descrição" value="{{ $categorias->descricao }}" data-nome="Descrição">
                      
                      </textarea>
                    </div>
                  </div>
                  <br/>    

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="limiteChs" class="col-sm-4 col-form-label">Limite de carga Horária semestral(%): </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control required" id="limiteChs" name="limiteChs" placeholder="Digite aqui a carga horária semestral" value="{{ $categorias->limiteChs }}" data-nome="Limite de carga horária semestral"/>
                    </div>
                  </div>
                  <br/>   

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="limiteCertificados" class="col-sm-4 col-form-label">Limite de Certificados por Semestre: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="limiteCertificados" name="limiteCertificados" placeholder="Digite aqui o limite de certificados por semestre" value="{{ $categorias->limiteCertificados }}" data-nome="Limite de certificados por semestre"/>
                    </div>
                  </div>
                  <br/>        

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="observacoes" class="col-sm-4 col-form-label">Observações: </label>
                    <div class="col-sm-8">
                      <textarea rows="4" cols="50" class="form-control required" id="observacoes" name="observacoes" placeholder="Digite aqui as Observações" value="{{ $categorias->observacoes }}" data-nome="Observações">
                      
                      </textarea>
                    </div>
                  </div>
                  <br/> 

                  

                    <input type="hidden" name="id" value="{{ $categorias->id }}" />

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