<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Restaurante Doña Ternera</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="background: linear-gradient( #ffffffff, #ffffffff); min-height;">
            <a href="index.html" class="brand-logo">
                <img class="w-50" src="{{ asset('images/logo.png') }}" alt="" >
                <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="" width="300" height="70">
                <img class="brand-title" src="{{ asset('images/logo-text.png') }}" alt="" width="300" height="70">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="background: linear-gradient( #231961ff, #111111ff); min-height;">
            <div class="header-content">
                
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown show">
                                
                                
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link dz-fullscreen primary" href="#">
                                    <svg id="Capa_1" enable-background="new 0 0 482.239 482.239" height="22"
                                        viewBox="0 0 482.239 482.239" width="22" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m0 17.223v120.56h34.446v-103.337h103.337v-34.446h-120.56c-9.52 0-17.223 7.703-17.223 17.223z"
                                            fill="" />
                                        <path
                                            d="m465.016 0h-120.56v34.446h103.337v103.337h34.446v-120.56c0-9.52-7.703-17.223-17.223-17.223z"
                                            fill="" />
                                        <path
                                            d="m447.793 447.793h-103.337v34.446h120.56c9.52 0 17.223-7.703 17.223-17.223v-120.56h-34.446z"
                                            fill="" />
                                        <path
                                            d="m34.446 344.456h-34.446v120.56c0 9.52 7.703 17.223 17.223 17.223h120.56v-34.446h-103.337z"
                                            fill="" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link  ai-icon warning" href="#" role="button" data-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.75 14.8385V12.0463C21.7471 9.88552 20.9385 7.80353 19.4821 6.20735C18.0258 4.61116 16.0264 3.61555 13.875 3.41516V1.625C13.875 1.39294 13.7828 1.17038 13.6187 1.00628C13.4546 0.842187 13.2321 0.75 13 0.75C12.7679 0.75 12.5454 0.842187 12.3813 1.00628C12.2172 1.17038 12.125 1.39294 12.125 1.625V3.41534C9.97361 3.61572 7.97429 4.61131 6.51794 6.20746C5.06159 7.80361 4.25291 9.88555 4.25 12.0463V14.8383C3.26257 15.0412 2.37529 15.5784 1.73774 16.3593C1.10019 17.1401 0.751339 18.1169 0.75 19.125C0.750764 19.821 1.02757 20.4882 1.51969 20.9803C2.01181 21.4724 2.67904 21.7492 3.375 21.75H8.71346C8.91521 22.738 9.45205 23.6259 10.2331 24.2636C11.0142 24.9013 11.9916 25.2497 13 25.2497C14.0084 25.2497 14.9858 24.9013 15.7669 24.2636C16.548 23.6259 17.0848 22.738 17.2865 21.75H22.625C23.321 21.7492 23.9882 21.4724 24.4803 20.9803C24.9724 20.4882 25.2492 19.821 25.25 19.125C25.2486 18.117 24.8998 17.1402 24.2622 16.3594C23.6247 15.5786 22.7374 15.0414 21.75 14.8385ZM6 12.0463C6.00232 10.2113 6.73226 8.45223 8.02974 7.15474C9.32723 5.85726 11.0863 5.12732 12.9212 5.125H13.0788C14.9137 5.12732 16.6728 5.85726 17.9703 7.15474C19.2677 8.45223 19.9977 10.2113 20 12.0463V14.75H6V12.0463ZM13 23.5C12.4589 23.4983 11.9316 23.3292 11.4905 23.0159C11.0493 22.7026 10.716 22.2604 10.5363 21.75H15.4637C15.284 22.2604 14.9507 22.7026 14.5095 23.0159C14.0684 23.3292 13.5411 23.4983 13 23.5ZM22.625 20H3.375C3.14298 19.9999 2.9205 19.9076 2.75644 19.7436C2.59237 19.5795 2.50014 19.357 2.5 19.125C2.50076 18.429 2.77757 17.7618 3.26969 17.2697C3.76181 16.7776 4.42904 16.5008 5.125 16.5H20.875C21.571 16.5008 22.2382 16.7776 22.7303 17.2697C23.2224 17.7618 23.4992 18.429 23.5 19.125C23.4999 19.357 23.4076 19.5795 23.2436 19.7436C23.0795 19.9076 22.857 19.9999 22.625 20Z"
                                            fill="#000" />
                                    </svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3"
                                        style="height:380px;">
                                        <ul class="timeline">
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2">
                                                        <img alt="image" width="50"
                                                            src="{{ asset('images/avatar/1.jpg') }}">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2 media-info">
                                                        KG
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Resport created successfully</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2 media-success">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2">
                                                        <img alt="image" width="50"
                                                            src="{{ asset('images/avatar/1.jpg') }}">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2 media-danger">
                                                        KG
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Resport created successfully</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2 media-primary">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span><strong>{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</strong></span>
                                    </div>
                                    <img src="{{ asset('images/profile/pic1.jpg') }}" width="20" alt="" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">{{ __(key: 'Profile') }} </span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="#" class="dropdown-item ai-icon"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                                width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="ml-2">{{ __('Logout') }}</span>
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav" style="background: linear-gradient(135deg, #ffffffff, #ffffffff); min-height: 100vh;">
    <div class="deznav-scroll">
        <ul class="metismenu px-2 pt-3" id="menu" style="list-style: none;">

            {{-- ADMINISTRADOR --}}
            @if(auth()->user()->rol?->nombre === 'Administrador')
                

                <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <i class="flaticon-381-user-7 menu-icon text-primary"></i>
                        <span class="">Usuarios</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <i class="flaticon-381-lock-3 menu-icon text-primary"></i>
                        <span class="">Roles</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('platos.*') ? 'active' : '' }}">
                    <a href="{{ route('platos.index') }}" class="menu-link">
                        <i class="flaticon-381-notepad menu-icon text-primary"></i>
                        <span class="">Platos</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.reportes') }}" class="menu-link">
                        <i class="flaticon-381-list menu-icon text-primary"></i>
                        <span class="">Reportes</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.configuracion') }}" class="menu-link">
                        <i class="flaticon-381-settings-2 menu-icon text-primary"></i>
                        <span class="">Configuración</span>
                    </a>
                </li>

            {{-- COCINERO --}}
            @elseif(auth()->user()->rol?->nombre === 'Cocinero')
                

                <li class="menu-item {{ request()->routeIs('pedidos.index') ? 'active' : '' }}">
                    <a href="{{ route('pedidos.index') }}" class="menu-link">
                        <i class="flaticon-381-list menu-icon text-primary"></i>
                        <span>Pedidos Pendientes</span>
                    </a>
                </li>
                <li class="menu-item"><a href="{{ route('cajero.historial') }}" class="menu-link"><i class="flaticon-381-archive menu-icon text-primary"></i>
                <span class="">Historial</span></a></li>
                
                

                

            {{-- CAJERO --}}
            @elseif(auth()->user()->rol?->nombre === 'Cajero')
                
                <li class="menu-item"><a href="{{ route('cajero.facturas') }}" class="menu-link"><i class="flaticon-381-file menu-icon text-primary"></i>
                <span class="">Ficha de pedidos</span></a></li>

                <li class="menu-item"><a href="{{ route('cajero.historial') }}" class="menu-link"><i class="flaticon-381-archive menu-icon text-primary"></i>
                <span class="">Historial</span></a></li>
                
            {{-- MESERO --}}
            @elseif(auth()->user()->rol?->nombre === 'Mesero')
                

                <li class="menu-item"><a href="{{ route('pedidos.index') }}" class="menu-link"><i class="flaticon-381-edit menu-icon text-primary"></i>
                <span>Tomar Pedido</span></a></li>
                <li class="menu-item {{ request()->routeIs('mesas.*') ? 'active' : '' }}"><a href="{{ route('mesas.index') }}" class="menu-link"><i class="flaticon-381-presentation menu-icon text-primary"></i>
                <span>Mesas</span></a></li>
                
                

            {{-- CLIENTE --}}
            @elseif(auth()->user()->rol?->nombre === 'Cliente')
                <li class="menu-section-title text-center mb-3 text-uppercase fw-bold text-secondary">
                    <i class="fa fa-utensil-spoon me-2"></i> Menú del Día
                </li>
                <li class="menu-item"><a href="{{ route('clientes.index') }}" class="menu-link"><i class="flaticon-381-edit menu-icon text-primary"></i>
                <span>Menú</span></a></li>
            @endif
        </ul>
    </div>
</div>
{{-- 🎨 Estilos personalizados --}}
<style>
    .menu-item {
        background: #111111ff;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 12px;
        transition: all 0.25s ease-in-out;
        overflow: hidden;
    }

    .menu-item:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    }

    .menu-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #d1d5db;
    text-decoration: none;
    padding: 12px 16px;
    border-radius: 10px;
    transition: all 0.2s ease;
    font-weight: 500;
    white-space: nowrap;      /* 🔹 Evita que el texto salte de línea */
    overflow: hidden;         /* 🔹 Oculta si se pasa del ancho */
    text-overflow: ellipsis;  /* 🔹 (Opcional) agrega "..." si se recorta */
}


    .menu-link:hover {
        background-color: #1f2937;   
        color: #ffffff;
        transform: scale(1.02);
    }

    .menu-link .menu-icon {
        font-size: 1.3rem;           
        color: #2563eb;              
        transition: transform 0.2s;
    }

    .menu-link:hover .menu-icon {
        transform: rotate(-10deg) scale(1.1);
    }

    /* 🔹 MENÚ ACTIVO: color de fondo y borde más visibles */
    .menu-item.active {
        background-color: #2563eb !important; /* Azul intenso */
        border: 2px solid #1d4ed8;
    }

    .menu-section-title {
        font-size: 0.85rem;
        letter-spacing: 1px;
        color: #6b7280;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.6);
    }

    .deznav-scroll {
        padding-bottom: 30px;
    }
</style>

        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Desarrollado por <a href="#">Leonardo Ayaviri</a> 2025</p>
            </div>
            <!--<div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://dexignzone.com/"
                        target="_blank">DexignZone</a> 2020</p>
            </div>-->
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.datatable').DataTable({
                language: {
                    url: "{{ asset('json/es-ES.json') }}"
                },
                responsive: true,

                pageLength: 10
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: @json(session('success')),
                //timer: 3000,
                //showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                //timer: 3000,
                //showConfirmButton: false
            });
        </script>
    @endif

    <!-- Script general de eliminación -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const itemName = this.getAttribute('data-name');
                    const deleteUrl = this.getAttribute('data-url');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        html: `Vas a eliminar <strong>${itemName}</strong>. Esta acción no se puede deshacer.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = deleteUrl;

                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            form.innerHTML = `
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                            `;

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    @yield('script')
</body>

</html>