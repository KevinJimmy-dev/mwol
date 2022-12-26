<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recuperar senha - M.W.O.L</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="shortcut icon" href="imgs\favicon.png" type="image/x-icon">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .pass_show {
            position: relative
        }

        .pass_show .ptxt {

            position: absolute;

            top: 50%;

            right: 10px;

            z-index: 1;

            color: #f36c01;

            margin-top: -10px;

            cursor: pointer;

            transition: .3s ease all;

        }

        .pass_show .ptxt:hover {
            color: #333333;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Recuperar senha</h3>

        <p>Olá {{ $name }}! Informe sua nova senha nos campos abaixo</p>

        @if (session('message'))
            <div class="alert alert-success ml-3 mr-3">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row">
            <div class="col">

                <form action="{{ route('recovery-password.recovery') }}" method="POST">
                    @csrf

                    <input type="hidden" value="{{ $remember_token }}" name="remember_token">

                    <label>Nova senha</label>
                    <div class="form-group pass_show">
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                    </div>

                    <label>Confirmar senha</label>
                    <div class="form-group pass_show">
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                            class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Alterar senha</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Mostrar</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Mostrar" ? "Esconder" : "Mostrar");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>

</body>

</html>
