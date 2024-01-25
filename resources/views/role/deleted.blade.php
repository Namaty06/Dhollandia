@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable">
                                <thead>
                                    <tr>

                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr>

                                            <td>{{ $role->role ?? null }}</td>

                                            @can('viewAny', App\Models\Role::class)
                                            <td>
                                                <form  action="{{ route('Role.restore', $role->id) }}" method="POST" >
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning"> Restaurer</button>
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
