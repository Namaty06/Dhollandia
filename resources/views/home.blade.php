@extends('dashboard.app')
@section('style')
    <style>
        .year-month-selector {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        #currentYear {
            font-size: 20px;
            margin: 0 10px;
        }

        #monthSelector {
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body" style="cursor: pointer" id="collapse1">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-dark-lighten text-dark rounded">
                                    <i class="mdi mdi-file-document-edit font-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1" style="font-family: Cambria !important; font-size:18px">Les Contracts En
                                cours</h5>
                            <p style="font-size: 16px" class="mb-0">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body" style="cursor: pointer" id="collapse2">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-success-lighten text-success rounded">
                                    <i class="mdi mdi-account-group font-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1" style="font-family: Cambria !important; font-size:18px">Intervention du
                                Mois</h5>
                            <p style="font-size: 16px" class="mb-0">{{ $intervnontraiter }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body" style="cursor: pointer" id="collapse3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-primary-lighten text-primary rounded">
                                    <i class="mdi mdi-account-star font-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1" style="font-family: Cambria !important; font-size:18px">Intervention
                                Terminer</h5>
                            <p style="font-size: 16px" class="mb-0">{{ $intervcloturer }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body" style="cursor: pointer" id="collapse4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-danger-lighten text-danger rounded">
                                    <i class="mdi mdi-folder-plus font-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1" style="font-family: Cambria !important; font-size:18px">Intervention
                                Annuler</h5>
                            <p style="font-size: 16px" class="mb-0">{{ $intervannuler }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-flex">
                        <div class="col-4">
                            <h4>Intervention de ce Mois</h4>
                            <canvas id="typeChart"></canvas>
                        </div>
                        <div class="col-8">
                            <h4> Agents Interventant ce Mois
                            </h4>
                            <canvas id="horibarchart">
                            </canvas>
                        </div>
                        {{-- @elseif ($d =='d2') --}}


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="d-flex justify-content-center"> <!-- Added justify-content-center -->
                                <div class="col-4">
                                    <a class="btn" href="{{ route('Intervention.calendar') }}"> Calendar</a>
                                    <input type="month" name="date" id="filter"
                                        value="{{ $currentDate->format('Y-m') }}" class="form-control">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="year-month-selector">
                                <button class="btn btn-primary mx-3" id="prevYear">Previous Year</button>
                                <div style="padding:15px">
                                    <span style="font-size: 30px" class="" id="currentYear">2023</span>
                                </div>
                                <button class="btn btn-primary mx-3" id="nextYear">Next Year</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mx-auto" style="">
                                <select class="form-select " id="monthSelector">
                                    <option value="1">Janvier</option>
                                    <option value="2">Fevrier</option>
                                    <option value="3">Mars</option>
                                    <option value="4">Avril</option>
                                    <option value="5">Mai</option>
                                    <option value="6">Juin</option>
                                    <option value="7">Juillet</option>
                                    <option value="8">Août</option>
                                    <option value="9">Septembre</option>
                                    <option value="10">Octobre</option>
                                    <option value="11">Novembre </option>
                                    <option value="12">Décembre </option>
                                </select>
                            </div>
                        </div>


                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Contrat</th>
                                    <th>Vehicule</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intervs as $item)
                                    <tr>
                                        <td>{{ $item->contrat->societe->societe ?? 'null' }}</td>
                                        <td>{{ $item->contrat->ref ?? 'null' }}</td>
                                        <td>{{ $item->contrat->vehicule->matricule ?? 'null' }}</td>
                                        <td>{{ $item->date_intervention ?? 'null' }}</td>
                                        <td>{{ $item->user->name ?? 'null' }}</td>
                                        <td> <span class="badge bg-{{ $item->status->color }}">
                                                {{ $item->status->status ?? 'null' }}</span></td>
                                        <td>
                                            <a class="rounded-pill text-primary"
                                                href="{{ route('interv.show', $item->id) }}">
                                                <i class="uil uil-eye fs-4"></i>
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


    </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dataTables.js/dataTables.js') }}"></script>

@endsection
