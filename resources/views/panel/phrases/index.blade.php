@extends('panel.template')

@section('title', 'Frases Adicionadas')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Frases</h1>
        </div>

        <p class="mb-4">
            Visualize suas frases adicionadas, e pratique! 😃
        </p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Frases</h6>
            </div>

            <div class="card-body">
                @if (count($phrases) > 0)
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="text-center">Idioma</th>
                                            <th>Frase</th>
                                            <th>Tradução</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($phrases as $phrase)
                                            <tr>
                                                <td class="text-center" style="color: {{ $phrase->word->language->theme }}">
                                                    {{ $phrase->word->language->name }}
                                                </td>
                                                <td>{{ $phrase->phrase }}</td>
                                                <td>{{ $phrase->translation }}</td>
                                                <td class="text-center">
                                                    <div
                                                        style="display: flex; align-items: center; justify-content: center">
                                                        <i class="fas fa-pen ml-3 mr-3 text-primary" data-toggle="modal"
                                                            data-target="#updatePhrase{{ $phrase->id }}"
                                                            style="cursor: pointer;"></i>
                                                        <i class="fas fa-trash mr-3 text-danger" data-toggle="modal"
                                                            data-target="#deletePhrase{{ $phrase->id }}"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $phrases->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center mt-3">Nenhuma frase adicionada ainda 😢</p>
                @endif
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Frase</h6>
            </div>

            <form method="POST" action="{{ route('panel.phrase.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <label for="language" class="form-label">Palavras</label>
                                <select class="form-control @error('word_id') is-invalid @enderror" id="word"
                                    name="word_id" required>
                                    <option value="">Selecione uma palavra</option>
                                    @foreach ($words as $word)
                                        <option value="{{ $word->id }}"
                                            {{ old('word_id') == $word->id ? 'selected' : '' }}>
                                            {{ $word->name }}</option>
                                    @endforeach
                                </select>
                                @error('word_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <label for="phrase" class="form-label">Frase</label>
                                <textarea class="form-control @error('phrase') is-invalid @enderror" id="phrase" placeholder="Ex: I like potatos"
                                    name="phrase" required></textarea>
                                @error('phrase')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <label for="translation" class="form-label">Tradução</label>
                                <textarea class="form-control @error('translation') is-invalid @enderror" id="translation"
                                    placeholder="Ex: Eu gosto de batatas" name="translation" required></textarea>
                                @error('translation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm w-100">Adicionar</button>
            </form>
        </div>
    </div>

    {{-- Modals --}}
    @foreach ($phrases as $phrase)
        {{-- Update --}}
        <div class="modal fade" id="updatePhrase{{ $phrase->id }}" tabindex="-1"
            aria-labelledby="updatePhraseLabel{{ $phrase->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePhraseLabel{{ $phrase->id }}">Atualizar Frase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="{{ route('panel.phrase.update', $phrase->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12 mb-1">
                                    <div class="form-group">
                                        <label for="word_id_update" class="form-label">Palavra</label>
                                        <select class="form-control @error('word_id_update') is-invalid @enderror"
                                            id="word_id_update" name="word_id_update" required>
                                            <option value="">Selecione uma palavra</option>
                                            @foreach ($words as $word)
                                                <option value="{{ $word->id }}"
                                                    {{ $phrase->word_id == $word->id ? 'selected' : '' }}>
                                                    {{ $word->name }}
                                                </option>
                                                @error('word_id_update')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <div class="form-group">
                                        <label for="phrase_update" class="form-label">Frase</label>
                                        <textarea class="form-control @error('phrase_update') is-invalid @enderror" id="phrase_update"
                                            placeholder="Ex: I like potatos" name="phrase_update" required>{{ $phrase->phrase }}</textarea>
                                        @error('phrase_update')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <div class="form-group">
                                        <label for="translation_update" class="form-label">Tradução</label>
                                        <textarea class="form-control @error('translation_update') is-invalid @enderror" id="translation_update"
                                            placeholder="Ex: batata" name="translation_update" required>{{ $phrase->translation }}</textarea>
                                        @error('translation_update')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
        </div>

        {{-- Delete --}}
        <div class="modal fade" id="deletePhrase{{ $phrase->id }}" tabindex="-1"
            aria-labelledby="deletePhraseLabel{{ $phrase->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePhraseLabel{{ $phrase->id }}">Excluir Palavra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('panel.phrase.delete', $phrase->id) }}">
                            @csrf
                            @method('DELETE')

                            <p class="text-center font-weight-bold">Deseja realmente excluir essa frase?</p>

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
