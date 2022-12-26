<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css\welcome.css">

    <link rel="shortcut icon" href="imgs\favicon.png" type="image/x-icon">

    <title>M.W.O.L - My Words in Other Language</title>
</head>

<body>

    <header>
        <h1>M.W.O.L</h1>

        <p><strong>M</strong>y <strong>W</strong>ords in <strong>O</strong>ther <strong>L</strong>anguage</p>
    </header>

    <main>
        <section>
            <p>Um sistema desenvolvido para registrar seu aprendizado em outras linguas.</p>

            <p>É fácil utiliza-lo, basta fazer login ou se registrar, e cadastrar uma palavra, o seu significado e 3 exemplos de frases que contém ela.</p>
        </section>
    </main>

    <footer>
        <p>Vamos lá?</p>

        <div>
            <a href="{{ route('register') }}"><button class="btn btn-primary">Login</button></a>

            <div class="spacing"></div>

            <a href="{{ route('register') }}"><button class="btn btn-primary">Registre-se</button></a>
        </div>
    </footer>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
