@extends("supervisor")

@section("contentS")      

          <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Modelos</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/modelo/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="nomeM" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="nomeM" name="nomeM" placeholder="Digite aqui o nome do modelo" value="{{ $modelos->nomeM }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>                 

                    <input type="hidden" name="id" value="{{ $modelos->id }}" />

                    <div class="col-sm-4 row"><!-- Div do botao-->
                        <button onclick="return validar();" type="submit" class="btn btn-primary btn-right">Salvar</button>
                    </div>
                  </div>                
                </form>

          </div>

          @yield("contentM")
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