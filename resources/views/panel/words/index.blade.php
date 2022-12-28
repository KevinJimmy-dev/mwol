@extends('panel.template')

@section('title', 'Palavras Adicionadas')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Palavras</h1>
        </div>

        <p class="mb-4">Visualize informações sobre as palavras que você adicionou. Caso deseje adicionar uma nova palavra,
            vá até o final da página e preencha o formulário.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Palavras</h6>
            </div>

            <div class="card-body">
                @if (count($words) > 0)
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="text-center">
                                            <th class="text-center">Idioma</th>
                                            <th>Palavra</th>
                                            <th>Tradução</th>
                                            <th>Adicionada em</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($words as $word)
                                            <tr class="text-center">
                                                <td class="text-center" style="color: {{ $word->language->theme }}">
                                                    {{ $word->language->name }}
                                                </td>
                                                <td>{{ $word->name }}</td>
                                                <td>{{ $word->translation }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($word->created_at)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    <div
                                                        style="display: flex; align-items: center; justify-content: center">
                                                        <i class="fas fa-pen mr-3 text-primary" data-toggle="modal"
                                                            data-target="#updateWord{{ $word->id }}"
                                                            style="cursor: pointer;"></i>
                                                        <i class="fas fa-trash mr-3 text-danger" data-toggle="modal"
                                                        data-target="#deleteWord{{ $word->id }}"
                                                        style="cursor: pointer;"></i>
                                                        <i class="fas fa-clipboard-list"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $words->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center mt-3">Nenhuma palavra adicionada ainda 😢</p>
                @endif
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Palavra</h6>
            </div>

            <form method="POST" action="{{ route('panel.word.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-1">
                            <div class="form-group">
                                <label for="language" class="form-label">Idioma</label>
                                <select class="form-control" id="language" name="language_id" required>
                                    <option value="">Selecione um idioma</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}" style="color: {{ $language->theme }}"
                                            {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4 mb-1">
                            <div class="form-group">
                                <label for="name" class="form-label">Palavra</label>
                                <input type="text" class="form-control" id="name" placeholder="Ex: potato"
                                    name="name" required>
                            </div>
                        </div>
                        <div class="col-4 mb-1">
                            <div class="form-group">
                                <label for="translation" class="form-label">Tradução</label>
                                <input type="text" class="form-control" id="translation" placeholder="Ex: batata"
                                    name="translation" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm w-100">Adicionar</button>
            </form>
        </div>
    </div>

    {{-- Modals --}}
    @foreach ($words as $word)
    {{-- Update --}}
        <div class="modal fade" id="updateWord{{ $word->id }}" tabindex="-1"
            aria-labelledby="updateWordLabel{{ $word->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateWordLabel{{ $word->id }}">Atualizar Palavra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('panel.word.update', $word->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-4 mb-1">
                                    <div class="form-group">
                                        <label for="language" class="form-label">Idioma</label>
                                        <select class="form-control" id="language" name="language_id" required>
                                            <option value="">Selecione um idioma</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}" style="color: {{ $language->theme }}"
                                                    {{ $word->language_id == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 mb-1">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Palavra</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Ex: potato" name="name" required
                                            value="{{ $word->name }}">
                                    </div>
                                </div>
                                <div class="col-4 mb-1">
                                    <div class="form-group">
                                        <label for="translation" class="form-label">Tradução</label>
                                        <input type="text" class="form-control" id="translation"
                                            placeholder="Ex: batata" name="translation" required
                                            value="{{ $word->translation }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm w-100">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete --}}
        <div class="modal fade" id="deleteWord{{ $word->id }}" tabindex="-1"
            aria-labelledby="deleteWordLabel{{ $word->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteWordLabel{{ $word->id }}">Excluir Palavra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('panel.word.delete', $word->id) }}">
                            @csrf
                            @method('DELETE')
                        
                            <p class="text-center font-weight-bold">Deseja realmente excluir essa palavra?</p>

                            @if ($word->phrases->count() > 0)
                                <p class="text-warning">Obs: Verificamos que existem frases vinculadas a ela. A exclusão da palavra, resultará na exclusão das frases em que contém ela!</p>
                            @endif
                            <div class="modal-footer">
                                <button type="submit" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm w-100">
                                    Excluir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
