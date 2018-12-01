@extends("admin")

@section("contentA")      

          <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Instituições</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/instituicao/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="nome" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="nome" name="nome" placeholder="Digite aqui o nome da instituicao" value="{{ $instituicoes->nome }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>   

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="localidade" class="col-sm-3 col-form-label">Localidade: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="localidade" name="localidade" placeholder="Digite aqui a localidade da instituicao" value="{{ $instituicoes->localidade }}" data-nome="Localidade"/>
                    </div>
                  </div>
                  <br/>               

                    <input type="hidden" name="id" value="{{ $instituicoes->id }}" />

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