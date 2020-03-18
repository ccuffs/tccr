<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TCCr') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('js/3rdparty/jquery.dsmorse-gridster.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/gridster.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="screen">
</head>

<body>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-dark bg-dark">
                <div class="col-sm-2 brand">
                    <img src="{{ asset('img/logo/grintex-logo-white-transparent.png') }}" title="Grintex" />
                </div>
                <div class="col-sm-3 text-left">
                    <span class="navbar-text"></span>
                </div>
                <div class="col-sm-6 text-right">
                    <span class="navbar-text user-info">
                        <strong>{{ ucwords(trim(strtolower($user->name))) }}</strong><br />
                        <span>{{ $user->username }}</span>
                    </span>
                </div>
                <div class="col-sm-1">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="https://colorlib.com/polygon/sufee/images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="https://id.uffs.cc"><i class="icon ion-md-contact"></i>Meu perfil</a>
                            <a class="nav-link" href="{{ route('logout') }}"><i class="icon ion-md-log-out"></i> Sair</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="row meta-block">
            <div class="col-lg-6">
                <div class="card text-white bg-dark border-secondary">
                    <div class="card-header">
                        Curso
                    </div>
                    <div class="card-body">
                        <div class="dropdown" id="programSelector">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="buttonProgramSelector" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="buttonProgramSelector" id="dropdownMenuProgramSelector"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card text-white bg-dark border-secondary">
                    <div class="card-header">
                        Período
                    </div>
                    <div class="card-body">
                        <div class="dropdown" id="periodSelector">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="buttonPeriodSelector" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">2020.1</button>
                            <div class="dropdown-menu" aria-labelledby="buttonPeriodSelector" id="dropdownMenuPeriodSelector"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-white bg-dark border-secondary">
                    <div class="card-header">
                        Revisão
                    </div>
                    <div class="card-body">
                        <div class="dropdown" id="revisionSelector">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="buttonRevisionSelector" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">REV002 - 13/11/2019 16:07</button>
                            <div class="dropdown-menu" aria-labelledby="buttonRevisionSelector" id="dropdownMenuRevisionSelector"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Atenção</h4>
                    <p>Esse horário é preliminar. Ele foi decidido e homologado pelo Colegiado do Curso, então há baixas chances que ele seja alterado. Entretanto, ele pode sofrer alterações conforme demandas da Coordenação Acadêmica em virtude de alocações fora do controle da Coordenação do Curso.</p>
                    <hr>
                    <p class="mb-0">Dúvidas? Escreva para <a href="mailto:computacao.ch@uffs.edu.br">computacao.ch@uffs.edu.br</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="groups" class="container-fluid">
        <div class="row" id="groups-header"></div>
        <div id="groups-content"></div>

        <div id="groups-footer" style="display: none;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-group">group</button>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modal-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-course-form">
                        <input type="hidden" id="modal-course-id" value="">

                        <div class="form-group">
                            <label for="modal-course-name">CCR</label>
                            <input type="text" class="form-control" id="modal-course-name" placeholder="1234 Main St">
                        </div>

                        <div class="form-group">
                            <label>Docentes responsáveis</label>
                        </div>

                        <div class="form-group" style="height: 200px; overflow: scroll;">
                            <div class="form-check" id="modal-course-members">
                                Loading...
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-group-form">
                        <input type="hidden" id="modal-group-id" value="">
                        <div class="form-group">
                            <label for="modal-group-name">Nome</label>
                            <input type="text" class="form-control" id="modal-group-name" placeholder="1234 Main St">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="" style="display: none;">
        <div class="container">
            <div class="row align-items-top text-center text-md-left">
                <div class="col-4 text-md-left">
                    <h3>Sobre</h3>
                    <p class="small">Esse site foi criado pelo <a href="https://grintex.uffs.cc">Grupo de Inovação Tecnológica Experimental (GRINTEX)</a> da <a href="http://uffs.edu.br" target="_blank">Universidade Federal da Fronteira Sul</a>, campus Chapecó/SC. Ele é coordenado por membros do curso de <a href="https://cc.uffs.edu.br">Ciência da Computação</a> com participação de várias entidades, como a Secretaria Especial de Tecnologia da Informação (SETI).</p>
                </div>

                <div class="col-2"></div>

                <div class="col-3">
                    <h3>Country B</h3>
                    <p>Street Address 100<br>Contact Name</p>
                    <p>+13 827 312 5002</p>
                    <p><a href="https://www.froala.com">countryb@amazing.com</a></p>
                </div>

                <div class="col-3">
                    <h3>Country B</h3>
                    <p>Street Address 100<br>Contact Name</p>
                    <p>+13 827 312 5002</p>
                    <p><a href="https://www.froala.com">countryb@amazing.com</a></p>
                    <p><a href="https://www.froala.com">countryb@amazing.com</a></p>
                    <p><a href="https://www.froala.com">countryb@amazing.com</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('/js/3rdparty/jquery.min.js') }}"></script>
    <script src="{{ asset('js/3rdparty/jquery.dsmorse-gridster.with-extras.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/3rdparty/bootstrap.bundle.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/3rdparty/store.everything.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8"></script>
</body>
</html>