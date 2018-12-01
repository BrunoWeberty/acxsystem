@extends("supervisor")

@section("contentS")      

          <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Modalidades</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/modalidade/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="modelo_id" class="col-sm-3">Modelo: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="modelo_id" name="modelo_id" data-nome="Modalidade">
                        <option></option>
                        @foreach($modelos as $row)
                          @if($row->id == $modalidades->modelo_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->nomeM}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->nomeM }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="name" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="name" name="name" placeholder="Digite aqui o nome da modalidade" value="{{ $modalidades->name }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>                 

                  

                    <input type="hidden" name="id" value="{{ $modalidades->id }}" />

                    <div class="col-sm-4 row"><!-- Div do botao-->
                        <button onclick="return validar();" type="submit" class="btn btn-primary btn-right">Salvar</button>
                    </div>
                  </div>                
                </form>

          </div>

  <script type="text/javascript">
    
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