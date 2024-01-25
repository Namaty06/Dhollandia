@extends('dashboard.app')
@section('content')
    <div class="row">
        <h2 class="text-dark"> Sociéte </h2>

        <div class="col-12">
            <div class="card">
                <div class="card-body mt-1">
                    <form action="{{ route('Societe.update', $societe->id) }}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-1">
                            <label for="societe">Societe *:</label>
                            <input type="text" name="societe" value="{{ $societe->societe ?? null }}" required
                                class="form-control @error('societe') is-invalid @enderror">
                            @error('societe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <label for="responsable">Responsable *:</label>
                            <input type="text" name="responsable" value="{{ $societe->responsable ?? null }}" required
                                class="form-control @error('responsable') is-invalid @enderror">
                            @error('responsable')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">email *:</label>
                            <input type="email" name="email" value="{{ $societe->email ?? null }}" required
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" value="{{ $societe->adresse ?? null }}"
                                class="form-control @error('adresse') is-invalid @enderror">
                            @error('adresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="tel">Telephone :</label>
                            <input type="tel" name="tel" value="{{ $societe->tel ?? null }}"
                                class="form-control @error('tel') is-invalid @enderror">
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="fix">Fix :</label>
                            <input type="tel" name="fix" value="{{ $societe->fix ?? null }}"
                                class="form-control @error('fix') is-invalid @enderror">
                            @error('fix')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-1">
                            <div class="col-6"> <img src="{{ asset('storage/' . $societe->logo) }}" class="img-fluid"
                                    alt=""></div>
                            <div class="col-6 mt-1"><label for="capacite">Logo *:</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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
