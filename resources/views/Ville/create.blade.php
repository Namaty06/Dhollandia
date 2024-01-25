@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Ville.store') }}"  method="post">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="type">Ville *:</label>
                            <input type="text" name="ville" value="{{ old('ville') }}" required
                                class="form-control @error('ville') is-invalid @enderror">
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
