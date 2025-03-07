@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Formulário de Frequência do Residente na Concedente</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.frequencia-residente', ['id' => $estagio->id]) }}"method="post">
            @csrf


            <label for="residente" class="titulopequeno">Residente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="residente" id="residente"
                value="{{ $dados['residente'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $dados['curso'] ?? '' }}"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="unidade" class="titulopequeno">Unidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="unidade" id="unidade" value="{{ $dados['unidade'] ?? '' }}"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="nomeConcedente" class="titulopequeno">Nome da Concedente<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeConcedente" id="nomeConcedente"
                value="{{ $dados['nomeConcedente'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="etapaEducacaoBasica" class="titulopequeno">Etapa da Educação Básica<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="etapaEducacaoBasica" id="etapaEducacaoBasica"
                value="{{ $dados['etapaEducacaoBasica'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="ano" class="titulopequeno">Ano<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano" id="ano" value="{{ $dados['ano'] ?? '' }}"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="nomeProf" class="titulopequeno">Nome Do/a Professor/a Preceptor/a<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeProf" id="nomeProf" value="{{ $dados['nomeProf'] ?? '' }}"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="numMatricula" class="titulopequeno">N° Da Matrícula Do/a Professor/a Preceptor/a<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numMatricula" id="numMatricula"
                value="{{ $dados['numMatricula'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            


        </form>

    </div>
    </div>
@endsection
