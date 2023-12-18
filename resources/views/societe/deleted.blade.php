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

                                        <th>Logo</th>
                                        <th>Sociéte</th>
                                        <th>Responsable</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Tel</th>
                                        <th>Fix</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($societes as $societe)
                                        <tr>
                                            <td><img src="{{ asset('storage/'.$societe->logo) }}" style="width: 50%" class="img-fluid"
                                                    alt=""></td>
                                            <td>{{ $societe->societe ?? null }}</td>
                                            <td>{{ $societe->responsable ?? null }}</td>
                                            <td>{{ $societe->email ?? null }}</td>
                                            <td>{{ $societe->adresse ?? null }}</td>
                                            <td>{{ $societe->telephone ?? null }}</td>
                                            <td>{{ $societe->fix ?? null }}</td>

                                            @can('restore', App\Models\Societe::class)
                                                <td>
                                                    <form action="{{ route('Societe.restore', [$societe->id]) }}"
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
