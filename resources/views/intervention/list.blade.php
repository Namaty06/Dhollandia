
@extends('dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Vehicule</th>
                            <th>Sociéte</th>
                            <th>Date</th>
                            <th>Technicien</th>
                            <th>Type Panne</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interventions as $item)
                            <tr>
                                <td>{{ $item->interventionable->ref ?? null }}</td>
                                <td>{{ $item->hayon->matricule ?? null }}</td>
                                <td>{{ $item->interventionable->societe->societe ?? null }}</td>
                                <td>{{ $item->date_intervention ?? null }}</td>
                                <td>{{ $item->user->name ?? null }}</td>
                                <td> <span class="badge bg-info">
                                        {{ $item->typepanne->type ?? null }}</span></td>
                                <td> <span class="badge bg-{{ $item->status->color }}">
                                        {{ $item->status->status ?? null }}</span></td>
                                <td>
                                    <a class="rounded-pill text-dark"
                                        href="{{ route('interv.show', $item->id) }}">
                                        <i class="uil uil-eye fs-4"></i>
                                    </a>
                                    <a class="rounded-pill text-primary"
                                        href="{{ route('Intervention.edit', $item->id) }}">
                                        <i class="uil uil-pen fs-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
