@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Ville.update',$ville->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-1">
                            <label for="type">Ville *:</label>
                            <input type="text" name="ville" value="{{ $ville->ville ?? null }}" required
                                class="form-control @error('ville') is-invalid @enderror">
                            @error('ville')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @endsection
