@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('TypeDocument.store') }}"  method="post">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="type">Type de Document *:</label>
                            <input type="text" name="type" value="{{ old('type') }}" required
                                class="form-control @error('type') is-invalid @enderror">
                            @error('type')
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
