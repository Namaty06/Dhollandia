
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Assigner Une vehicule </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ps-3 pe-3" method="POST" action="{{ route('Vehicule.attach') }}">

                <div class="modal-body">
                    {{-- <div class="text-center text-dark mt-2 mb-4 fs-4"> Créer Une Piéce </div> --}}
                    @csrf
                    <input type="hidden" name="contrat_id" value="{{ $contrat->id }}">
                    <div class="row">
                        <div class="form-group col-8 mb-3">
                            <label for="vehicule_id">Vehicule *:</label>
                            <select name="vehicule_id"
                                class="form-control @error('vehicule_id') is-invalid @enderror">
                                @foreach ($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">
                                        {{ $vehicule->numero_serie ?? null }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicule_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#full-width-modal" data-bs-toggle="modal"
                        data-bs-dismiss="modal" >Fermer</button>
                    <button class="btn btn-primary" type="submit" type="submit">Assinger</button>
                </div>
        </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

