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
                                        <th>Num Serie</th>
                                        <th>Vehicule</th>
                                        <th>Type Hayon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($hayons as $hayon)
                                        <tr>

                                            <td>{{ $hayon->serie ?? null }}</td>
                                            <td>{{ $hayon->vehicule->matricule ?? null }}</td>
                                            <td>{{ $hayon->typehayon->type ?? null }}</td>
                                            @can('restore', App\Models\Hayon::class)  @endcan
                                                <td>


                                                    <form action="{{ route('Hayon.restore', [$hayon->id]) }}"
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
