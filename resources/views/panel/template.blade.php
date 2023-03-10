<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - M.W.O.L</title>

    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="shortcut icon" href="/imgs/favicon.png" type="image/x-icon">

    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('panel.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-globe"></i>
                </div>
                <div class="sidebar-brand-text mx-3">M.W.O.L</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'panel.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'panel.word.index' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="{{ route('panel.word.index') }}">
                    <i class="fas fa-file-word"></i>
                    <span>Palavras</span>
                </a>
            </li>

            <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'panel.phrase.index' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="{{ route('panel.phrase.index') }}">
                    <i class="fas fa-quote-left"></i>
                    <span>Frases</span>
                </a>
            </li>

            @if (!is_null(Auth::user()->admin_id))
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    <i class="fas fa-fw fa-globe"></i>
                    Global
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                        <i class="fas fa-quote-left"></i>
                        <span>Palavras pelo mundo</span>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">A????es:</h6>
                            <a class="collapse-item" href="cards.html"><i class="fas fa-book mr-2"></i> Ver</a>
                        </div>
                    </div>
                </li>
            @endif

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                <i class="fas fa-language"></i>
                L??nguas
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fas fa-receipt"></i>
                    <span>Ingl??s</span>
                </a>
            </li>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-4 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nickname }}</span>
                                <img class="img-profile rounded-circle" src="/imgs/undraw_profile.svg">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configura????es
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('auth.logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                @if (session('success'))
                    <div class="alert alert-success ml-3 mr-3 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning ml-3 mr-3 text-center">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger ml-3 mr-3 text-center">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; M.W.O.L {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Voc?? realmente deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>

                <div class="modal-body">Selecione "Logout" se deseja encerrar sua sess??o atual.</div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>

                    <form method="GET" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="/js/sb-admin-2.min.js"></script>

    @yield('scripts')
</body>

</html>
