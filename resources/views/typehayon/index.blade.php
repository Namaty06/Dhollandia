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
                                    @can('create', App\Models\Configuration::class)

                                    <a href="{{ route('TypeHayon.create') }}" class="btn btn-primary">Créer</a>
                                    @endcan
                                </div>
                                <div class="col-6">
                                    <h3 style=" text-align: center">Type Hayon</h3>
                                </div>
                                <div class="col-3">
                                    @can('restore', App\Models\Configuration::class)

                                    <a style="float: right" href="{{ route('TypeHayon.deleted') }}"
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
                                        <th>Type</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($types as $type)
                                        <tr>

                                            <td>{{ $type->id ?? null }}</td>
                                            <td>{{ $type->type ?? null }}</td>

                                            @can('update', App\Models\Configuration::class)
                                                <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                        href="{{ route('TypeHayon.edit', [$type->id]) }}">
                                                        <i class="uil uil-pen fs-5"></i>
                                                    </a>
                                                </td>
                                            @endcan

                                            @can('delete', App\Models\Configuration::class)
                                                <td>


                                                    <form action="{{ route('TypeHayon.destroy', [$type->id]) }}" method="post">
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
