<div class="leftside-menu menuitem-active">

    <!-- LOGO -->
    <a href="" class="logo text-center logo-light mt-2 mb-2">
        <span class="logo-lg">
            <img src="{{ asset('img/png.png') }}" alt="" height="65">
        </span>

    </a>

    <div class="h-100 mt-3 show" id="leftside-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <!--- Sidemenu -->
                            <ul class="side-nav">

                                <li class="side-nav-title side-nav-item">Navigation</li>

                                <li class="side-nav-item">
                                    <a href="{{ route('home') }}" class="side-nav-link">
                                        <i class="uil-home-alt"></i>
                                        <span> Dashboard </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarUsers"
                                        aria-controls="sidebarUsers" class="side-nav-link">
                                        <i class="uil uil-users-alt"></i>
                                        <span> Utilisateurs </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarUsers">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\User::class)
                                                <li>
                                                    <a href="{{ route('User.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\User::class)
                                                <li>
                                                    <a href="{{ route('User.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\User::class)
                                                <li>
                                                    <a href="{{ route('User.deleted') }}">Desactiver</a>
                                                </li>
                                            @endcan
                                            @can('viewAny', App\Models\Role::class)
                                                <li>
                                                    <a href="{{ route('Role.index') }}">Role et Permission</a>
                                                </li>
                                            @endcan


                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarsociete"
                                        aria-controls="sidebarsociete" class="side-nav-link">
                                        <i class="uil uil-clapper-board"></i>
                                        <span> Clients </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarsociete">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Societe::class)
                                                <li>
                                                    <a href="{{ route('Societe.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Societe::class)
                                                <li>
                                                    <a href="{{ route('Societe.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\Societe::class)
                                                <li>
                                                    <a href="{{ route('Societe.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarvehicules"
                                        aria-controls="sidebarvehicules" class="side-nav-link">
                                        <i class="uil uil-car-sideview"></i>
                                        <span> Vehicule </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarvehicules">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Vehicule::class)
                                                <li>
                                                    <a href="{{ route('Vehicule.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('viewAny', App\Models\Configuration::class)
                                                <li>
                                                    <a href="{{ route('TypeVehicule.index') }}"> Type Vehicule</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Vehicule::class)
                                                <li>
                                                    <a href="{{ route('Vehicule.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\Vehicule::class)
                                                <li>
                                                    <a href="{{ route('Vehicule.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarhayon"
                                        aria-controls="sidebarhayon" class="side-nav-link">
                                        <i class="uil  uil-tachometer-fast"></i>
                                        <span> Hayon </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarhayon">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Hayon::class)
                                                <li>
                                                    <a href="{{ route('Hayon.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Hayon::class)
                                                <li>
                                                    <a href="{{ route('Hayon.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\Hayon::class)
                                                <li>
                                                    <a href="{{ route('Hayon.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarquestion"
                                        aria-controls="sidebarquestion" class="side-nav-link">
                                        <i class="uil uil-notes "></i>
                                        <span> Examen </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarquestion">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Examen::class)
                                                <li>
                                                    <a href="{{ route('Examen.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Examen::class)
                                                <li>
                                                    <a href="{{ route('Examen.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\Examen::class)
                                                <li>
                                                    <a href="{{ route('Examen.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarrec"
                                        aria-controls="sidebarrec" class="side-nav-link">
                                        <i class="uil uil-shield-check"></i>
                                        <span> Reclamation </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarrec">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Reclamation::class)
                                                <li>
                                                    <a href="{{ route('Reclamation.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Reclamation::class)
                                                <li>
                                                    <a href="{{ route('Reclamation.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            {{-- @can('restore', App\Models\Reclamation::class)
                                                <li>
                                                    <a href="{{ route('Reclamation.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan --}}

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarcontrat"
                                        aria-controls="sidebarcontrat" class="side-nav-link">
                                        <i class=" uil-calender"></i>
                                        <span> Contrat </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarcontrat">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Contrat::class)
                                                <li>
                                                    <a href="{{ route('Contrat.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Contrat::class)
                                                <li>
                                                    <a href="{{ route('Contrat.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            {{-- @can('restore', App\Models\Contrat::class)
                                                <li>
                                                    <a href="{{ route('Contrat.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan --}}

                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarintv"
                                        aria-controls="sidebarintv" class="side-nav-link">
                                        <i class=" uil-calender"></i>
                                        <span> Intervention </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarintv">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Intervention::class)
                                                <li>
                                                    <a href="{{ route('Intervention.list') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Intervention::class)
                                                <li>
                                                    <a href="{{ route('Intervention.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            {{-- @can('restore', App\Models\Contrat::class)
                                                <li>
                                                    <a href="{{ route('Contrat.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan --}}

                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarpanne"
                                        aria-controls="sidebarpanne" class="side-nav-link">
                                        <i class="uil uil-list-ul"></i>
                                        <span> Types  </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarpanne">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Configuration::class)
                                                <li>
                                                    <a href="{{ route('TypePanne.index') }}"> Type de Panne</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('TypeHayon.index') }}"> Type des Hayon</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('TypeDocument.index') }}">Type des Document</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" aria-expanded="false" href="#sidebarville"
                                        aria-controls="sidebarville" class="side-nav-link">
                                        <i class="uil  uil-archway"></i>
                                        <span> Ville </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarville">
                                        <ul class="side-nav-second-level">
                                            @can('viewAny', App\Models\Ville::class)
                                                <li>
                                                    <a href="{{ route('Ville.index') }}"> Liste</a>
                                                </li>
                                            @endcan
                                            @can('create', App\Models\Ville::class)
                                                <li>
                                                    <a href="{{ route('Ville.create') }}">Créer</a>
                                                </li>
                                            @endcan
                                            @can('restore', App\Models\Ville::class)
                                                <li>
                                                    <a href="{{ route('Ville.deleted') }}">Restaurer</a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </li>


                            </ul>
                            <!-- End Sidebar -->

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1518px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 114px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
    <!-- Sidebar -left -->

</div>
