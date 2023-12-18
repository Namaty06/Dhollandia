@extends('dashboard.app')
@section('content')
    <div class="row">
        <h2 class="text-dark mx-2 my-2"> Sociéte </h2>

        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Societe.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="societe">Societe *:</label>
                            <input type="text" name="societe" value="{{ old('societe') }}" required
                                class="form-control @error('societe') is-invalid @enderror">
                            @error('societe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="responsable">Responsable *:</label>
                            <input type="text" name="responsable" value="{{ old('responsable') }}" required
                                class="form-control @error('responsable') is-invalid @enderror">
                            @error('responsable')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">email *:</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" value="{{ old('adresse') }}"
                                class="form-control @error('adresse') is-invalid @enderror">
                            @error('adresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="tel">Telephone :</label>
                            <input type="tel" name="tel" value="{{ old('tel') }}"
                                class="form-control @error('tel') is-invalid @enderror">
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="fix">Fix :</label>
                            <input type="fix" name="fix" value="{{ old('fix') }}"
                                class="form-control @error('fix') is-invalid @enderror">
                            @error('fix')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="capacite">Logo *:</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
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
