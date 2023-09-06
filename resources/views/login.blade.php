<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Se connecter</title>
</head>
<style>
    #particles-js {
        width: 100%;
        height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
    }
</style>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="/signin" method="POST">
                @csrf
                <h1>{{ trans('login.create')}}</h1>
                <br>
                <br>
                <input required type="text" placeholder="{{ trans('login.name')}}" name="nom" />
                <input required type="email" placeholder="Email" id="email" name="mail" />
                <span id="email-error" style="color: red;"></span>
                <input required type="password" id="password" placeholder="{{ trans('login.mdp')}}" name="mdp"
                    minlength="6" />
                <input required type="password" id="confirmPassword" placeholder="{{ trans('login.confmdp')}}"
                    name="confirmemdp" minlength="6" />
                <span id="passwordError" style="color: red;"></span>
                <br>
                <button type="submit" id="buttonBe">{{ trans('login.register')}}</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="/login" method="POST">
                @csrf
                @if ($errors->any())
                    <span style="color: red;"><strong>{{ trans('login.errorReg')}}</strong></span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session('validate'))
                    <span style="color: rgb(22, 110, 27);"><strong>{{ trans('login.succesReg')}}</strong></span>
                @endif
                <h1>{{ trans('login.log')}}</h1>
                <br>
                <br>
                <input required type="email" placeholder="Email" name="mail" />
                <input required type="password" placeholder="{{ trans('login.mdp')}}" name="mdp" />
                <br>
                <button type="submit">{{ trans('login.seco')}}</button>
                @if (session('error'))
                    <br>
                    <p>{{ trans('login.error')}}</p>
                @endif
                <br>
                <p>©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> - Aldonis <br>
                    <a href="/ChangeLanguage?language=fr">FR</a> / <a href="/ChangeLanguage?language=en">EN</a>
                </p>
            </form>
        </div>
        <div class="overlay-container" style="background-color: black;">
            <div class="overlay">
                <div id="particles-js"></div>
                <div class="overlay-panel overlay-left">
                    <h1>{{ trans('login.return')}}</h1>
                    <p>{{ trans('login.text')}}</p>
                    <button class="ghost" id="signIn">{{ trans('login.seco')}}</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>{{ trans('login.welcome')}}</h1>
                    <p>{{ trans('login.othertext')}}</p>
                    <button class="ghost" id="signUp">{{ trans('login.register')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/script/particles.js') }}"></script>
    <script src="{{ asset('assets/script/app.js') }}"></script>
    <script src="{{ asset('assets/script/login.js') }}"></script>

</body>

</html>
