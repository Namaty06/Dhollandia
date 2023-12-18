
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">
                <!-- item-->
                <div class="dropdown-item noti-title px-3">
                    <h5 class="m-0 text-dark">
                        <span class="float-end">
                            <a href="javascript: void(0);" class="text-dark">
                                <small></small>
                            </a>
                        </span>Notification
                    </h5>
                </div>
                <div class="px-3" style="max-height: 300px;" data-simplebar>

                    <h5 class="text-success ted font-13 fw-normal mt-0">Today</h5>
                    <!-- item-->
                    {{-- @forelse  ($notifications as $notification)
                        <a href="{{ route('Dossier.show', $notification->dossier_id) }}"
                            class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 text-truncate text-primary ms-2">
                                        <h5 class="noti-item-title fw-semibold font-14">{{ $notification->user->name }}
                                            <small
                                                class="fw-normal text-info ms-1">{{ $notification->created_at->diffForHumans(Carbon\Carbon::now()) }}</small>
                                        </h5>
                                        <small class="noti-item-subtitle text-black">{{ $notification->body }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                    @empty
                    @endforelse --}}

                    <div class="text-center">
                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                    </div>
                </div>

                <!-- All-->
                {{-- <a href="{{ route('notification.index') }}"
                    class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    View All
                </a> --}}

            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="rounded-circle">
                </span>
                <span>

                    <span class="account-user-name">{{ auth()->user()->name }}</span>
                    <span class="account-position">{{ auth()->user()->role->role }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="d-none d-lg-block py-2">
        <div class="site-search">
            <div class="product_search">
                {{-- <form class="search_form_2" action="" method="POST">

                    <div class="select_mate">
                        <select name="type" id="">
                            <option value="1">Matricule</option>
                            <option value="2">Nom</option>
                            <option value="3">Réference</option>
                            <option value="4">N Sinistre</option>
                        </select>
                        <div class="cont_list_select_mate">
                            <ul class="cont_select_int"> </ul>
                        </div>
                    </div>
                    <div class="outer">
                        <div class="inner"></div>
                    </div>
                    <input type="search" placeholder="Chercher" name="search" value="">
                    <button type="submit" value=""> <i class="uil uil-search"
                            style="position: relative; left: -10px;color: #fff;font-size: 27px;"></i></button>

                </form> --}}
            </div>
        </div>
    </div>
</div>
