@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex">
                                <div class="col-3">
                                    @can('create', App\Models\Ville::class)
                                        <a href="{{ route('Ville.create') }}" class="btn btn-primary">Créer</a>
                                    @endcan
                                </div>
                                <div class="col-6">
                                    <h3 style=" text-align: center">Ville</h3>
                                </div>
                                <div class="col-3">
                                    @can('restore', App\Models\Ville::class)
                                        <a style="float: right" href="{{ route('Ville.deleted') }}"
                                            class="btn btn-warning">Restaurer</a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Ville</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($villes as $ville)
                                        <tr>

                                            <td>{{ $ville->id ?? null }}</td>
                                            <td>{{ $ville->ville ?? null }}</td>




                                            @can('update', App\Models\Ville::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('Ville.edit', [$ville->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', App\Models\Ville::class)
                                                <td>


                                                    <form action="{{ route('Ville.destroy', [$ville->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            <i class="uil uil-trash fs-5"></i>
                                                        </button>
                                                    </form>



                                                </td>
                                            @endcan

                                        </tr>
                                    @empty
                                        <h3>Tableau Vide</h3>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
