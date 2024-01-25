@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($types as $type)
                                        <tr>
                                            <td>{{ $type->id ?? null }}</td>
                                            <td>{{ $type->type ?? null }}</td>

                                            @can('restore', App\Models\Configuration::class) @endcan
                                                <td>
                                                    <form action="{{ route('TypeHayon.restore', [$type->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-sm btn-warning rounded-pill" type="submit">
                                                            Restaurer
                                                        </button>
                                                    </form>
                                                </td>


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
