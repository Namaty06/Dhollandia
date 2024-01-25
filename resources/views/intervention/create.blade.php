@extends('dashboard.app')
@section('content')
    <div class="row">
        <h2 class="text-dark my-2 mx-2">Intervention</h2>

        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Intervention.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="contrat">Contrat *:</label>
                            <select class="form-select @error('contrat') is-invalid @enderror" name="contrat"
                                id="contrat">
                                @foreach ($contrats as $contrat)
                                    <option value="{{ $contrat->id }}">{{ $contrat->ref }}</option>
                                @endforeach
                            </select>
                            @error('contrat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="hayon">Hayon *:</label>
                            <select class="form-select @error('hayon') is-invalid @enderror" name="hayon"
                                id="hayon">
                                {{-- @foreach ($hayons as $hayon)
                                    <option value="{{ $hayon->id }}">{{ $hayon->matricule ?? null }}</option>
                                @endforeach --}}
                            </select>
                            @error('hayon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="form-group mb-1">
                            <label for="user">Technicien *:</label>
                            <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user')
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
                            <label for="type">Date Intervention :</label>
                            <input type="date" name="date_intervention" value="{{ old('date_intervention') }}"
                                class="form-control @error('date_intervention') is-invalid @enderror">
                            @error('date_intervention')
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
        $('#contrat').change(function () {
            var selectedContrat = $(this).val();

            // Make an AJAX request to get vehicles based on the selected company
            $.ajax({
                url: '/GetHayon/' + selectedContrat,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $('#hayon').empty();
                    console.log(data);
                    // Add new options based on the response
                    $.each(data, function (key, value) {
                        if(value.hayon){
                            $('#hayon').append('<option value="' + value.hayon.id + '">' + value.hayon.serie + '</option>');
                        }
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
