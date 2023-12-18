@extends('dashboard.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('User.store') }}" method="post">
                        @csrf


                        <div class="form-group mb-1">
                            <label for="name">Nom Complet *:</label>
                            <input type="text" name="name" value="{{ $user->name ?? null }}" required
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="email">Email *:</label>
                            <input type="email" name="email" value="{{ $user->email ?? null }}" required
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="password">Mot de Passe *:</label>
                            <input type="password" name="password" required
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="telephone">Telephone *:</label>
                            <input type="text" name="telephone" value="{{ $user->telephone ?? null }}" required
                                class="form-control @error('telephone') is-invalid @enderror">
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="role">Role *:</label>
                            <select class="form-select " name="role_id" id="role">
                                <option value="{{ $user->role->id }}">{{ $user->role->role }}</option>
                                @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
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
