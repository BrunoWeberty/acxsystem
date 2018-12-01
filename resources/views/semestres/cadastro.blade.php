@extends("supervisor")

@section("contentS")      

          <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Semestres</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/semestre/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="nomeS" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="nomeS" name="nomeS" placeholder="1° Semestre de 20xx" value="{{ $semestres->nomeS }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>         

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="inicioSemestre" class="col-sm-3 col-form-label">Início do Semestre: </label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control required" id="inicioSemestre" name="inicioSemestre" value="{{$semestres->inicioSemestre}}" data-nome="Início do semestre"/>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="fimSemestre" class="col-sm-3 col-form-label">Fim do Semestre: </label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control required" id="fimSemestre" name="fimSemestre" value="{{$semestres->fimSemestre}}" data-nome="Fim do semestre"/>
                    </div>
                  </div>
                  <br/>       

                    <input type="hidden" name="id" value="{{ $semestres->id }}" />

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