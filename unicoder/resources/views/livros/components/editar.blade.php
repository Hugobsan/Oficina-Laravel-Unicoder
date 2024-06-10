<div class="modal fade" id="EditarLivro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="EditarLivro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edição de Livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('livros.update', $livro->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" required maxlength="255" class="form-control" placeholder="Título do livro"
                        name="titulo" value="{{ old('titulo', $livro->titulo) }}">
                    @error('titulo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" class="form-control"
                                placeholder="Nome do autor" name="autor" id="autor" autocomplete="off"
                                value="{{ old('autor', $livro->autor) }}">
                            @error('autor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" class="form-control" placeholder="Gênero"
                                name="genero" id="genero" autocomplete="off"
                                value="{{ old('genero', $livro->genero) }}">
                            @error('genero')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" class="form-control" placeholder="Editora"
                                name="editora" value={{ old('editora', $livro->editora) }}>
                            @error('editora')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Edição" name="edicao"
                                value={{ old('edicao', $livro->edicao) }}>
                            @error('edicao')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Volume" name="volume"
                                value={{ old('volume', $livro->volume) }}>
                            @error('volume')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Nº de páginas"
                                name="paginas" value={{ old('paginas', $livro->paginas) }}>
                            @error('paginas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="Quant. de Exemplates"
                                name="quantidade" value={{ old('quantidade', $livro->quantidade) }} required>
                            @error('quantidade')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="ISBN" name="isbn"
                                value={{ old('isbn', $livro->isbn) }} required>
                            @error('isbn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
            </form>
        </div>
    </div>
</div>
