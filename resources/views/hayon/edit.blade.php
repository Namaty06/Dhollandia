@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <h3 class="text-dark"> Hayon </h3>
                    <form action="{{ route('Hayon.update', $hayon->id) }}" enctype="multipart/form-data" method="post"  >
                        @method('PUT')
                        @csrf


                        <div class="form-group mb-1">
                            <label for="vehicule">Vehicules *:</label>
                            <select class="form-select @error('vehicule') is-invalid @enderror" name="vehicule"
                                id="vehicule">
                                <option selected value="{{ $hayon->vehicule->id }}">{{ $hayon->vehicule->matricule }}
                                </option>
                                @foreach ($vehicules as $vehicule)
                                    @if ($vehicule->id != $hayon->vehicule->id)
                                        <option value="{{ $vehicule->id }}">{{ $vehicule->matricule }}</option>
                                    @endif
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
                            <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                                <option selected value="{{ $hayon->typehayon->id }}">{{ $hayon->typehayon->type }}
                                    @foreach ($types as $type)
                                        @if ($type->id != $hayon->type_hayon_id)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endif
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
                            <input type="text" name="numero_serie" value="{{ $hayon->serie ?? null }}" required
                                class="form-control @error('numero_serie') is-invalid @enderror">
                            @error('numero_serie')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="capacite"> Capacité *:</label>
                            <input type="text" name="capacite" value="{{ $hayon->capacite ?? null }}" required
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
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
