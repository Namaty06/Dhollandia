@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <div class="table-responsive mt-1">
                            <table class="table table-striped" class="display nowrap" id="myTable2">
                                <thead>
                                    <tr>

                                        <th>Responsable</th>
                                        <th>Email</th>
                                        <th>tel</th>
                                        <th>Restaurer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name ?? null }} </td>
                                            <td>{{ $contact->email ?? null }} </td>
                                            <td>{{ $contact->tel ?? null }} </td>
                                            {{-- @can('viewAny', App\Models\Vehicule::class)
                                        <td> <a class="btn btn-sm btn-info rounded-pill"
                                                href="{{ route('Vehicule.show', [$vehicule->id]) }}">
                                                <i class="uil uil-eye fs-5"></i>
                                            </a>
                                        </td>
                                    @endcan --}}



                                            @can('restore', App\Models\Contact::class)
                                            @endcan
                                            <td>
                                                <form action="{{ route('Contact.restore', [$contact->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger rounded-pill" type="submit">
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
