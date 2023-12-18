@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <h3 class="text-dark"> Vehicule</h3>
                    <form action="{{ route('Vehicule.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="numero_serie">Numero Serie *:</label>
                            <input type="text" name="numero_serie" value="{{ old('numero_serie') }}" required
                                class="form-control @error('numero_serie') is-invalid @enderror">
                            @error('numero_serie')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="matricule">Matricule *:</label>
                            <input type="matricule" name="matricule" value="{{ old('matricule') }}" required
                                class="form-control @error('matricule') is-invalid @enderror">
                            @error('matricule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="marque">Marque *:</label>
                            <input type="marque" name="marque" value="{{ old('marque') }}" required
                                class="form-control @error('marque') is-invalid @enderror">
                            @error('marque')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="dmc">DMC *:</label>
                            <input type="date" name="dmc" value="{{ old('dmc') }}" required
                                class="form-control @error('dmc') is-invalid @enderror">
                            @error('dmc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="capacite">Capacite *:</label>
                            <input type="number" name="capacite" value="{{ old('capacite') }}" required
                                class="form-control @error('capacite') is-invalid @enderror">
                            @error('capacite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="typevehicule">Type *:</label>
                            <select class="form-select @error('typevehicule') is-invalid @enderror" name="typevehicule"
                                id="typevehicule">
                                @foreach ($types as $typevehicule)
                                    <option value="{{ $typevehicule->id }}">{{ $typevehicule->type }}</option>
                                @endforeach
                            </select>
                            @error('typevehicule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="capacite">Image *:</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="capacite">Fichier PDF*:</label>
                            <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror">
                            @error('pdf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
