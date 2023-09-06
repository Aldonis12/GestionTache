<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ trans("add.$titre") }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    @include('details.nav')

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="/@php echo($url) @endphp" method="post" id="myForm">
                @csrf

                @if ($titre == 'subtask')
                <h3 style="float: left; margin-top: -30px; margin-left: -250%;"><a href="/DetailsTache/{{ $soustache->idtache }}"><i class='bx bx-left-arrow-alt'></i>{{ trans('list.goback') }}</a>
                </h3>
                    <h1>{{ trans('add.modifysubtask') }}</h1>
                    <br>
                    <input type="hidden" name="idtache" class="form-control" value="{{ $soustache->id }}">
                    <input type="text" name="soustache" placeholder="{{ trans("add.$titre") }}" value="{{ $soustache->soustache }}">
                    <p>{{ trans('add.before') }} :</p>
                    <input type="datetime-local" name="datelimite" value="{{ $soustache->datelimite }}">
                    <p>{{ trans('add.priority') }} :</p>
                    <select name="priority">
                        <option>{{ trans('add.choose') }}</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->nom }}</option>
                        @endforeach
                    </select>
                    <p>{{ trans('add.status') }} :</p>
                    <select name="statut">
                        <option>{{ trans('add.choose') }}</option>
                        @foreach ($statuts as $statut)
                            <option value="{{ $statut->id }}">{{ $statut->id }} {{ $statut->nom }}</option>
                        @endforeach
                    </select>
                    <br>
                @endif
                <button type="submit">{{ trans('add.update') }}</button>
            </form>
        </div>
    </div>
</body>

</html>

<script src="{{ asset('assets/script/particles.js') }}"></script>
<script src="{{ asset('assets/script/app.js') }}"></script>
