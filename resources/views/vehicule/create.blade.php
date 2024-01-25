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
                            <label for="typevehicule">Client *:</label>
                            <select class="form-select @error('societe') is-invalid @enderror" name="societe"
                                id="societe">
                                @foreach ($societes as $societe)
                                    <option value="{{ $societe->id }}">{{ $societe->societe }}</option>
                                @endforeach
                            </select>
                            @error('societe')
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
                            <label for="typevehicule">Ville *:</label>
                            <select class="form-select @error('ville') is-invalid @enderror" name="ville" id="ville">
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                                @endforeach
                            </select>
                            @error('ville')
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
