@extends("layouts.app")

@section("content")      
          <div class="container">
            <div class="page-header">
                <CENTER><h3>Cadastro de Usuários</h3></CENTER>        
               </div>
               <br/>
               <br/>
            <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/user/salvar" method="post" class="valid rsform"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="name" class="col-sm-1 col-form-label">Nome: </label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control required" id="name" name="name" placeholder="Digite aqui seu nome" value="{{ $users->name }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="email" class="col-sm-1 col-form-label">Email: </label>
                    <div class="col-sm-11">
                      <input type="email" class="form-control required" id="email" name="email" placeholder="Digite aqui seu email" value="{{ $users->email }}" data-nome="Email"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="password" class="col-sm-1 col-form-label">Senha: </label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control required" id="password" name="password" placeholder="Digite aqui sua senha" value="" data-nome="Senha"/>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="remember_token" class="col-sm-1 col-form-label">Pergunta: </label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control required" id="remember_token" name="remember_token" placeholder="Nome de um bicho de estimação" value="" data-nome="Resposta"/>
                    </div>
                  </div>
                  <br/>

                  <input type="hidden" name="id" value="{{ $users->id }}" />

                  <div class="col-sm-1"><!-- Div do botao-->
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