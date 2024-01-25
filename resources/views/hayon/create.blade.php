@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <h3 class="text-dark"> Hayon </h3>
                    <form action="{{ route('Hayon.store') }}" enctype="multipart/form-data"  method="post">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="vehicule">Vehicules *:</label>
                            <select class="form-select @error('vehicule') is-invalid @enderror" name="vehicule"
                                id="vehicule">
                                @foreach ($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">{{ $vehicule->matricule }}</option>
                                @endforeach
                            </select>
                            @error('vehicule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="type">Type Hayon *:</label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type"
                                id="type">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
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
                            <label for="capacite">Capacité en KG*:</label>
                            <input type="number" min="1" name="capacite" value="{{ old('capacite') }}" required
                                class="form-control @error('capacite') is-invalid @enderror">
                            @error('capacite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="capacite">Fichier PDF *:</label>
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
