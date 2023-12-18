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
                                        <th>Icon</th>
                                        <th>Examen</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examens as $examen)
                                        <tr>
                                            <td>{{ $examen->id ?? null }}</td>
                                            <td><img style="max-width: 40px" src="{{ asset('storage/' . $examen->icon) }}" class="img-fluid"
                                                    alt=""></td>
                                            <td>{{ $examen->examen ?? null }}</td>

                                            @can('delete', App\Models\Examen::class)
                                                <td>
                                                    <form action="{{ route('Examen.restore', [$examen->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-sm btn-warning rounded-pill" type="submit">
                                                            Restaurer
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
