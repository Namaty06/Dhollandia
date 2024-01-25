@extends('dashboard.app')
@section('content')
    <div class="row">
        <h2 class="text-dark my-2 mx-2">Reclamation</h2>

        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Reclamation.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="societe">Sociéte *:</label>
                            <select class="form-select @error('societe_id') is-invalid @enderror" name="societe_id"
                                id="societe">
                                @foreach ($societes as $societe)
                                    <option value="{{ $societe->id }}">{{ $societe->societe }}</option>
                                @endforeach
                            </select>
                            @error('societe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="vehicule">Vehicules *:</label>
                            <select class="form-select @error('vehicule_id') is-invalid @enderror" name="vehicule_id"
                                id="vehicule">
                                {{-- @foreach ($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">{{ $vehicule->matricule ?? null }}</option>
                                @endforeach --}}
                            </select>
                            @error('vehicule_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="form-group mb-1">
                            <label for="user">Technicien *:</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-1">
                            <label for="type_panne_id">Type de Panne *:</label>
                            <select class="form-select @error('type_panne_id') is-invalid @enderror" name="type_panne_id" id="type_panne_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id ?? null }}">{{ $type->type ?? null }}</option>
                                @endforeach
                            </select>
                            @error('type_panne_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="type">Bon Travail :</label>
                            <input type="text" name="bontravail" value="{{ old('bontravail') }}"
                                class="form-control @error('bontravail') is-invalid @enderror">
                            @error('bontravail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="transport_id">Vehicule Transport *:</label>
                            <select class="form-select @error('transport_id') is-invalid @enderror" name="transport_id" id="transport_id">
                                @foreach ($nosvehicule as $v)
                                    <option value="{{ $v->id }}">{{ $v->matricule ?? null }}</option>
                                @endforeach
                            </select>
                            @error('transport_id')
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
@section('script')
<script>
        $(document).ready(function () {
        $('#societe').change(function () {
            var selectedSociete = $(this).val();

            // Make an AJAX request to get vehicles based on the selected company
            $.ajax({
                url: '/GetVehicule/' + selectedSociete,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $('#vehicule').empty();
                    console.log(data);
                    // Add new options based on the response
                    $.each(data, function (key, value) {
                        $('#vehicule').append('<option value="' + value.id + '">' + value.matricule + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching vehicles:', error);
                }
            });
        });
    });
</script>

@endsection
