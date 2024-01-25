@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Contact.update',$contact->id) }}"  method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-1">
                            <label for="name">Nom du Responsable *:</label>
                            <input type="text" name="name" value="{{ $contact->name ?? null }}" required
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="capacite">Email :</label>
                            <input type="email" name="email" value="{{ $contact->email ?? null }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="capacite">Telephone :</label>
                            <input type="tel" name="tel" value="{{ $contact->tel ?? null }}" class="form-control @error('tel') is-invalid @enderror">
                            @error('tel')
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
