<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Recuperar Senha - M.W.O.L</title>
</head>

<body>
    <header>
        <h1 class="text-center">Recuperar Senha</h1>
    </header>

    <main>
        <section>
            <h3>Olá!</h3>

            <p>Você está recebendo essa mensagem pois solicitou a recuperação de senha em nosso sistema.</p>

            <p>Ao clicar no link abaixo, você será redirecionado para a página onde será possível cadastrar uma nova
                senha.</p>

            <a href="{{ $link }}">
                {{ $link }}
            </a>

            <p>Obs: favor desconsiderar esse email caso você não tenha solicitado recuperação de senha.</p>
        </section>
    </main>
</body>

</html>
