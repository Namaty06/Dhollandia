@extends('dashboard.app')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" class="display nowrap"  id="myTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        {{-- <th>Afficher</th> --}}
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name ?? null}}</td>
                                            <td>{{ $user->email ?? null}}</td>
                                            <td><span class="badge bg-info">{{ $user->role->role?? null }}</span></td>
                                            {{-- @can('view', App\Models\User::class)
                                            <td> <a class="btn btn-sm btn-info rounded-pill"
                                                    href="{{ route('user.show', [$user->id]) }}">
                                                    <i class="uil uil-eye fs-5"></i>
                                                </a>
                                            </td>
                                            @endcan --}}

                                            @can('update', App\Models\User::class)
                                            <td> <a class="btn btn-sm btn-primary rounded-pill"
                                                    href="{{ route('User.edit', [$user->id]) }}">
                                                    <i class="uil uil-pen fs-5"></i>
                                                </a>
                                            </td>
                                            @endcan
                                            @can('delete', App\Models\User::class)

                                            <td>
                                                @if (Auth::user()->id != $user->id)
                                                    <form action="{{ route('User.destroy', [$user->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill" type="submit">
                                                            <i class="uil uil-trash fs-5"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
