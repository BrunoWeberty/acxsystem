@extends("aluno")

@section("contentAL")      

          <div class="Container">
              <div class="page-header">
                <CENTER><h3>Cadastro de Certificados</h3></CENTER>        
               </div>
               <br/>
               <br/>
                <div class="col-sm-12"><!-- Container principal-->
                <form id="form" action="/certificado/salvar" method="post" class="valid rsform" enctype="multipart/form-data"><!-- Formulário-->

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" /><!-- Mantem a sessão ativa, gerando um token novo sempre, a cada conexao-->

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                   <label for="nomeC" class="col-sm-3 col-form-label">Nome: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="nomeC" name="nomeC" placeholder="Digite aqui o nome do certificado" value="{{ $certificados->nomeC }}" data-nome="Nome"/>
                    </div>
                  </div>
                  <br/>  

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="instituicao" class="col-sm-3 col-form-label">Instituição: </label>
                    <div class="col-sm-9">
                      
                      <input type="radio" name="instituicao" value="1" id="instituicao" onclick="if(document.getElementById('entidadePromotora').disabled==false){document.getElementById('entidadePromotora').disabled=false;
                      document.getElementById('entidadePromotora').value = '';}"> Externa

                      <input type="radio" name="instituicao" value="2" id="instituicao" onclick="if(document.getElementById('entidadePromotora').disabled==false){document.getElementById('entidadePromotora').disabled=false;
                      document.getElementById('entidadePromotora').value = 'IFTM - Instituto Federal do Triângulo Mineiro Campus Patrocínio';}"> Interna<br>
                    </div>
                  </div>
                  <br/>   

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="entidadePromotora" class="col-sm-3 col-form-label">Entidade Promotora: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="entidadePromotora" name="entidadePromotora" placeholder="Digite aqui a entidade Promotora" value="{{ $certificados->entidadePromotora }}" data-nome="Entidade Promotora"/>
                    </div>
                  </div>
                  <br/>   

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                   <label for="modalidade_id" class="col-sm-3">Modalidade: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="modalidade_id" name="modalidade_id" data-nome="Categoria">
                        <option></option>
                        @foreach($modalidades as $row)
                          @if($row->id == $certificados->modalidade_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->name}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                    <label for="categoria_id" class="col-sm-3">Categoria: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="categoria_id" name="categoria_id" data-nome="Categoria">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <br/> 

                  <div class="form-group row col-sm-9"><!-- Div do Select to tipo-->
                   <label for="semestre_id" class="col-sm-3">Semestre: </label>
                    <div class="col-sm-9">
                      <select style="height: 33px;" class="form-control required" id="semestre_id" name="semestre_id" data-nome="Semestre">
                        <option></option>
                        @foreach($semestres as $row)
                          @if($row->id == $certificados->semestre_id)
                          <option value="{{ $row->id }}" selected="selected">{{ $row->nomeS}}</option>
                        @else
                          <option value="{{ $row->id }}">{{ $row->nomeS }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br/>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="dataConclusao" class="col-sm-3 col-form-label">Data de conclusão: </label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control required" id="dataConclusao" name="dataConclusao" value="{{$certificados->dataConclusao}}" data-nome="Data de conclusão"/>
                    </div>
                  </div>
                  <br/>  

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="cargaHoraria" class="col-sm-3 col-form-label">Carga horária: </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control required" id="cargaHoraria" name="cargaHoraria" placeholder="Digite aqui o numero de horas do certificado" value="{{ $certificados->cargaHoraria }}" data-nome="Carga horária"/>
                    </div>
                  </div>
                  <br/>         

                  <div class="form-group row col-sm-9"><!-- Div do file, enviar arquivo-->
                    <label for="arquivo" class="col-sm-3 col-form-label">Certificado:</label>
                    <div class="col-sm-9">
                      <div class="col-sm-11">
                      <input type="file" class="form-control-file" name="arquivo" id="arquivo" required="" accept="application/pdf" data-nome="Certificado"/></div>
                      <div class="col-sm-1">
                      <img style="height: 40px;" src="https://addons-media.operacdn.com/media/extensions/28/229728/0.1.0-rev2/icons/icon_64x64_c1ad324b06537ea6f58b704fefd0e62f.png"/></div>
                    </div>
                  </div>

                  <div class="form-group row col-sm-9"><!-- Div do input do nome-->
                    <label for="relatorio" class="col-sm-4 col-form-label">Relatório: </label>
                    <div class="col-sm-8">
                      <textarea rows="4" cols="50" class="form-control required" id="relatorio" name="relatorio" value="{{ $certificados->relatorio }}" data-nome="Relatório">
                      
                      </textarea>
                    </div>
                  </div>
                  <br/>  

                    <input type="hidden" name="id" value="{{ $certificados->id }}" />

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
            $(function () {
              var modalidade = $('#modalidade_id');  

              modalidade.change(function () {
                var id = modalidade.val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "GET",
                    url:"{!! URL::to('/busca_modalidade') !!}",
                    data:  {'id': id},
                    beforeSend: function () {
                        //alert("Atualizando select.");
                    },
                    // Se enviado com sucesso
                    success: function (data) {
                        //inserindo options no select
                        //alert(data[0]['id']);
                        $("#categoria_id").empty();
                        data.forEach(function(o, index){
                          console.log(o.id, o.nome);
                          $("#categoria_id").append('<option value="'+o.id+'">' + o.nome + '</option>');
                        });
                        //console.log(data);
                        //$("#categoria_id").append('<option>' + cidades[i] + '</option>');
                    },
                    // Se der algum problema
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
              });
            });

            const icons = {
            'application/pdf': 'https://addons-media.operacdn.com/media/extensions/28/229728/0.1.0-rev2/icons/icon_64x64_c1ad324b06537ea6f58b704fefd0e62f.png'
          }

          const input = document.querySelector('input');
          const image = document.querySelector('img');
          input.addEventListener('change', function() {
            const tipo = this.files[0].type;
            image.src = icons[tipo];
          });

  </script>
 
@stop