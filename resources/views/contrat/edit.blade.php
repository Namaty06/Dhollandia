@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Contrat.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="societe">Sociéte *:</label>
                            <select class="form-select @error('societe') is-invalid @enderror" name="societe" id="societe">
                                <option value="{{ $contrat->societe->id }}">{{ $contrat->societe->societe }}</option>

                                @foreach ($societes as $societe)
                                    @if ($contrat->societe->id != $societe->id)
                                        <option value="{{ $societe->id }}">{{ $societe->societe }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('societe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <label for="vehicule">Vehicule *:</label>
                            <select class="form-select @error('vehicule') is-invalid @enderror" name="vehicule"
                                id="vehicule">
                                <option value="{{ $contrat->vehicule_id }}">{{ $contrat->vehicule->matricule }}</option>
                                @foreach ($vehicules as $vehicule)
                                    @if ($contrat->vehicule_id != $vehicule->id)
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
                        <div class="form-group mb-3">
                            <label for="date_debut">Date Debut *:</label>
                            <input type="date" name="date_debut" value="{{ $contrat->date_debut }}" required
                                class="form-control @error('date_debut') is-invalid @enderror">
                            @error('date_debut')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="date_fin">Date Fin *:</label>
                            <input type="date" name="date_fin" value="{{ $contrat->date_fin }}" required
                                class="form-control @error('date_fin') is-invalid @enderror">
                            @error('date_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="intervention_chaque">Intervention Chaque en mois *:</label>
                            <input type="number" min="1" name="intervention_chaque"
                                value="{{ $contrat->intervention_chaque }}" required
                                class="form-control @error('intervention_chaque') is-invalid @enderror">
                            @error('intervention_chaque')
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
