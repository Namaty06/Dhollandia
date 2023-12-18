@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Examen.update',$examen->id) }}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-1">
                            <label for="examen">Type Vehicule *:</label>
                            <input type="text" name="examen" value="{{ $examen->examen ?? null }}" required
                                class="form-control @error('examen') is-invalid @enderror">
                            @error('examen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="capacite">Icon :</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
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
