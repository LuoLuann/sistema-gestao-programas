@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'pro_reitor', 'gestor'])

        <style>
            pagination {
                display: inline-block;
            }

            .pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color .3s;
                border: 1px solid #ddd;
                margin: 10px 4px;
            }

            .pagination a.active {
                background-color: #3B864F;
                color: white;
                border: 1px solid #3B864F;
            }

            .pagination a:hover:not(.active) {
                background-color: #34A853;
            }
        </style>

        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('falha'))
                <div class="alert alert-danger">
                    {{ session('falha') }}
                </div>
            @endif
            <br>

            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Estágios</strong></h1>
            </div>

            <form class="search-container" action="{{ route('estagio.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
                <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                    onclick="window.location.href = '{{ route('estagio.create') }}'">Cadastrar estágio</button>
                <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                    onclick="window.location.href = '{{ route('estagio.editConfig') }}'">Configurar estágios</button>
                <button class="cadastrar-botao" type="button"
                    onclick="window.location.href = '{{ route('instituicao.index') }}'">Informações da Instituição</button>
            </form>



            <br>
            <br>

            <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                <div class="col-md-9 corpo p-2 px-3">
                    <table class="table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col" class="text-center align-middle">Status</i></th>
                                <th scope="col" class="text-center align-middle">Descrição</th>
                                <th scope="col" class="text-center align-middle">Data de solicitação</th>
                                <th scope="col" class="text-center align-middle">Data de início</th>
                                <th scope="col" class="text-center align-middle">Data de fim</th>
                                <th scope="col" class="text-center align-middle">Professor</th>
                                <th scope="col" class="text-center align-middle">Estudante</th>
                                <th class="text-center">
                                    Ações
                                    <button type="button" class="infobutton align-bottom" data-bs-toggle="modal"
                                        data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                        <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda"
                                            style="height: 20px; width: 20px;">
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estagios as $estagio)
                                <tr>
                                    <td class="align-middle">
                                        @if ($estagio->status == 0)
                                            {{ 'Inativo' }}
                                        @else
                                            {{ 'Ativo' }}
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $estagio->descricao }}</td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->created_at), 'd/m/Y') }}</td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->data_inicio), 'd/m/Y') }}
                                    </td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->data_fim), 'd/m/Y') }}</td>
                                    <td class="align-middle">{{ $estagio->orientador->user->name }}</td>
                                    <td class="align-middle">{{ $estagio->aluno->nome_aluno }}</td>
                                    <td>


                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_show{{ $estagio->id }}">
                                            <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                alt="Info Estagio" style="height: 30px; width: 30px;">
                                        </a>

                                        <a type="button" href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}">

                                            <img src="{{ asset('images/document.svg') }}" title="Documentos"
                                                alt="Visualizar documentos" style="height: 30px; width: 30px;">

                                        </a>

                                        <a type="button" href="{{ route('estagio.edit', ['id' => $estagio->id]) }}">
                                            <img src="{{ asset('images/pencil.svg') }}" title="Editar" alt="Editar Estagio"
                                                style="height: 30px; width: 30px;">
                                        </a>

                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_delete_{{ $estagio->id }}">
                                            <img src="{{ asset('images/delete.svg') }}"title="Remover" alt="Deletar Estagio"
                                                style="height: 30px; width: 30px;">
                                        </a>


                                    </td>
                                </tr>
                                <tr>
                                    {{-- Não apagar esse tr  --}}
                                </tr>
                        </tbody>
                        @include('Estagio.components.modal_legenda')
                        @include('Estagio.components.modal_show', ['estagio' => $estagio])
                        @include('Estagio.components.modal_delete', ['estagio' => $estagio])
                        @endforeach
                    </table>
                </div>

            </div>
            <br>
            <br>
        </div>


        <script type="text/javascript">
            function exibirModalDeletar(id) {
                $('#modal_delete_' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show' + id).modal('show');
            }
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
