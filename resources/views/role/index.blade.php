@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex mb-2">
                    <div class="col-3">
                        @can('viewAny', App\Models\Role::class)
                        <a href="{{ route('Role.create') }}" class="btn btn-primary">Créer</a>
                        @endcan
                    </div>
                    <div class="col-6">
                        <h3></h3>
                    </div>
                    <div class="col-3">
                        @can('viewAny', App\Models\Role::class)
                        <a href="{{ route('Role.deleted') }}" class="btn btn-warning">Restaurer</a>
                        @endcan
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap" id="myTable">
                                <thead>
                                    <tr>

                                        <th>Role</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr>

                                            <td>{{ $role->role ?? null }}</td>
                                            @can('viewAny', App\Models\Role::class)
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $role->id }}">
                                                        <i class="uil uil-eye fs-5"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $role->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Permission pour {{ $role->role }}</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('Role.store') }}" method="post">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <input type="hidden" name="role_id"
                                                                                value="{{ $role->id }}">
                                                                            @foreach ($permissions as $permission)
                                                                                @if ($role->hasPermission($permission->permission))
                                                                                    <div class="col-md-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline form-switch">
                                                                                            <input type="checkbox" checked
                                                                                                class="form-check-input"
                                                                                                value="{{ $permission->id }}"
                                                                                                name="permission[]"
                                                                                                id="customSwitch1{{ $permission->id }}">
                                                                                            <label class="form-check-label"
                                                                                                for="customSwitch1{{ $permission->id }}">{{ $permission->permission }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-md-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline form-switch">
                                                                                            <input type="checkbox"
                                                                                                class="form-check-input"
                                                                                                value="{{ $permission->id }}"
                                                                                                name="permission[]"
                                                                                                id="customSwitch1{{ $permission->id }}">
                                                                                            <label class="form-check-label"
                                                                                                for="customSwitch1{{ $permission->id }}">{{ $permission->permission }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer ">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Fermer</button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Enregistrer
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endcan
                                            @can('viewAny', App\Models\Role::class)
                                            <td>
                                                <form  action="{{ route('Role.destroy', $role->id) }}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"> <i
                                                            class="uil uil-trash"></i> </button>
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
