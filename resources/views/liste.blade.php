<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans("list.$tittle") }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    @include('details.nav')

    @if ($var == 'tache')
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <h1>{{ trans("list.$titre") }}</h1>
                <br>

                @if (isset($recherche) && count($taches) > 0)
                    <form action="/RechercheTache" method="POST">
                        @csrf
                        <div class="form-wrapper">
                            <input type="text" name="search" placeholder="{{ trans('list.search-tittle') }}">
                            <select name="statut">
                                <option value="0">{{ trans('list.choose-status') }}</option>
                                @foreach ($statuts as $statut)
                                    <option value="{{ $statut->id }}"> - {{ trans('Statut.' . $statut->nom) }}</option>
                                @endforeach
                            </select>
                            <button type="submit"><i class='bx bx-search-alt-2'></i> {{ trans('list.search') }}</button>
                        </div>
                    </form>
                    <br>
                    <br><br>
                @endif

                <table style="background-color: beige;">
                    @if (count($taches) > 0)
                        <thead>
                            <tr>
                                <th>{{ trans('list.task') }}</th>
                                <th>{{ trans('list.due-date') }}</th>
                                <th>{{ trans('list.status') }}</th>
                                <th>{{ trans('list.priority') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taches as $tache)
                                <tr onclick="navigateToPage({{ $tache->id }})"
                                    style="background-color: {{ $tache->color->color }};">
                                    <td class="colored-column">{{ $tache->tache }} <br><br><br></td>
                                    <td class="colored-column">{{ $tache->datelimite }}</td>
                                    <td class="colored-column">{{ trans('Statut.' . $tache->stat->nom) }}</td>
                                    <td class="colored-column">{{ trans('Priority.' . $tache->priority->nom) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>

                @if (isset($recherche) && count($taches) == 0)
                    <div style="text-align: center;">
                        <p class="changement-couleur" onclick="AjoutTache()">{{ trans('list.addatask') }}</p>
                    </div>
                @elseif(count($taches) == 0)
                    <div style="text-align: center;">
                        <p style="color: gray; font-size: 20px;">{{ trans('list.nothingtask') }}</p>
                    </div>
                @endif

            </div>
        </div>
    @endif

    @if ($var == 'detailstache')
        <div class="container" id="container" style="background-color: {{ $tache->color->color }}">
            <div class="form-container sign-up-container">
                <h3 style="float: left; margin-top: 20px; margin-left: 50px;"><a href="/Tache"><i class='bx bx-left-arrow-alt'></i>{{ trans('list.goback') }}</a>
                </h3>
                <br>
                <br>
                <h2>
                    <button id="toggleFormButton"><i class='bx bx-edit'></i> {{ trans('list.modifytask') }}</button></h2>
                <h1>
                    <form action="/ModifierTache" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $tache->id }}">
                        <div class="custom-form-wrapper hidden" id="formDiv">
                            <p>{{ trans('list.task') }} : <input type="text" name="tache" value="{{ $tache->tache }}"></p>
                            <p>{{ trans('list.status') }} :<select name="statut">
                                    <option disabled selected>{{ trans('list.choose-status') }}</option>
                                    @foreach ($statuts as $statut)
                                        <option value="{{ $statut->id }}"
                                            {{ $statut->id == $tache->statut ? 'selected' : '' }}>
                                            - {{ trans('Statut.' . $statut->nom) }}
                                        </option>
                                    @endforeach
                                </select>
                            </p>
                            <p>{{ trans('list.color') }} : <select name="color" id="colorSelect" onchange="changeSelectColor(this)">
                                    <option disabled selected>{{ trans('list.choose-color') }}</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ $color->id == $tache->idcolor ? 'selected' : '' }}
                                            style="background-color: {{ $color->color }}"> - {{ $color->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </p>
                            <p>{{ trans('list.priority') }} :<select name="priority">
                                    <option disabled selected>{{ trans('list.choose-priority') }}</option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            {{ $priority->id == $tache->idpriority ? 'selected' : '' }}> -
                                            {{ trans('Priority.' . $priority->nom) }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p>{{ trans('list.due-date') }} : <input type="date" name="datelimite"
                                    value="{{ date('Y-m-d', strtotime($tache->datelimite)) }}"></p>
                            <button type="submit"><i class='bx bxs-edit'></i> {{ trans('list.update') }}</button>
                    </form>
                    <a href="/DeleteTask/{{ $tache->id }}" class="delete-button"><i class='bx bxs-trash'></i>
                        {{ trans('list.deletetask') }}</a>
            </div>
                </h1>
            <br>

            <table style="background-color: beige;">
                <thead>
                    <tr>
                        <th>{{ trans('list.subtask') }} </th>
                        <th>{{ trans('list.due-date') }}</th>
                        <th>{{ trans('list.status') }}</th>
                        <th style="background-color: antiquewhite; cursor: pointer;"
                            onclick="AddSubTask({{ $tache->id }})"><i class='bx bx-list-plus'></i> {{ trans('list.add') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($soustaches as $soustache)
                        <tr>
                            <td style="background-color : {{ $tache->color->color }}">{{ $soustache->soustache }}</td>
                            <td style="background-color : {{ $tache->color->color }}">{{ $soustache->datelimite }}
                            </td>
                            <td style="background-color : {{ $tache->color->color }}">{{ trans('Statut.' . $soustache->stat->nom) }}</td>
                            <td style="background-color : {{ $tache->color->color }}"> <a
                                    href="/PageModifierSousTache/{{ $soustache->id }}"><i class='bx bxs-edit'></i></a>
                                / <a href="/DeleteSubTask/{{ $soustache->id }}"><i class='bx bx-trash-alt'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

    @if ($var == 'corbeille')
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <h1>{{ trans('list.recycle') }}</h1>
                <br>
                
                @if (count($taches) > 0)
                    <br>
                    <div style="margin-left: 50px;" class="nav-link">
                        <button style="cursor: pointer;" onclick="DeleteAll()"><i class='bx bxs-trash-alt'></i>{{ trans('list.empty-recycle') }}</button>
                        <button style="cursor: pointer;" onclick="RestoreAll()"><i class='bx bx-redo'></i> {{ trans('list.restore-recycle') }}</button>
                    </div>
                    <br>
                @endif

                <table style="background-color: beige;">
                    @if (count($taches) > 0)
                        <thead>
                            <tr>
                                <th>{{ trans('list.task') }}</th>
                                <th>{{ trans('list.status') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taches as $tache)
                                <tr style="background-color: white">
                                    <td>{{ $tache->tache }}</td>
                                    <td>{{ $tache->stat->nom }}</td>
                                    <td><a href="/RestoreTask/{{ $tache->id }}"> <i class='bx bx-reset'></i>
                                        {{ trans('list.restore') }}</a> / <a href="/DeleteTaskDefinitive/{{ $tache->id }}"> <i
                                                class='bx bxs-trash'></i> {{ trans('list.delete') }}</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>

                @if (count($taches) == 0)
                    <div style="text-align: center;">
                        <p style="color: gray; font-size: 20px;">{{ trans('list.empty') }}</p>
                    </div>
                @endif

            </div>
        </div>
    @endif

    @if ($var == 'parametre')
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <h1>{{ trans('Setting.settings')}}</h1>
            <br><hr>
            <br>
            <button class="transparent-button" onclick="AfficherMasquer('profileForm')"><i class='bx bx-user-circle' ></i> {{ trans('Setting.modif')}}</button>
            <br>      
            <form action="/ModifierUtilisateur" method="POST" id="profileForm" style="display: none;">
                @csrf
                <div style="margin-left: 40px;">
                    <label for="nom">{{ trans('Setting.name')}} : </label>
                    <input type="text" name="nom" id="nom" value="{{$user->nom}}" style="font-size: 12px; width: 75%;">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <br>
                    <label for="mail">{{ trans('Setting.mail')}} : </label>
                    <input type="text" name="mail" id="email" value="{{$user->email}}" style="font-size: 12px; width: 75%;">
                    <br>
                    <span id="email-error" style="color: red;"></span>
                    <br>
                    <button type="submit" id="buttonBe">{{ trans('Setting.edit')}}</button>
                    <br>
                </div>
                <br>
            </form>
            <hr>
            <br>
            <button class="transparent-button" onclick="AfficherMasquer('passwordForm')"><i class='bx bx-key' ></i> {{ trans('Setting.modifpass')}}</button>
            <br>
            <form action="/ModifierUtilisateurMDP" method="POST" id="passwordForm" style="display: none;">
                @csrf
                <div style="margin-left: 40px;">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <label>{{ trans('Setting.lastpass')}} :</label>
                    <input type="password" style="font-size: 12px; width: 50%;" name="mdp" id="mdp" required>
                    <span id="goodmdp"></span>
                    <br>
                    <label> {{ trans('Setting.newpass')}} :</label>
                    <input type="password" style="font-size: 12px; width: 50%;" name="nouveau" id="password" minlength="6" required>
                    <span id="newmdpError"></span>
                    <br>
                    <label> {{ trans('Setting.confpass')}} :</label>
                    <input type="password" style="font-size: 12px; width: 50%;" name="confirmer" id="confirmPassword" minlength="6" required>
                    <br>
                    <span id="passwordError" style="color: red;"></span>
                    <br>
                    <button type="submit" id="buttonBemdp">{{ trans('Setting.butpass')}}</button>
                </div>
                <br>
            </form>
            <hr>
            <br>
            <button class="transparent-button" onclick="AfficherMasquer('languageForm')"><i class='bx bx-text' ></i> {{ trans('Setting.language')}}</button>
            <br>
            <form action="/ChangeLanguage" method="GET" id="languageForm" style="display: none;">
                @csrf
                <div style="margin-left: 40px;">
                <select name="language" id="language" onchange="this.form.submit()" style="font-size: 12px; width: 50%;">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                </select>
                </div>
            </form>
            <hr>
            <table style="background-color: beige;">  
            </table>
        </div>
    </div>
@endif

</body>

</html>
<script src="{{ asset('assets/script/Settings.js') }}"></script>
<script src="{{ asset('assets/script/particles.js') }}"></script>
<script src="{{ asset('assets/script/app.js') }}"></script>
<script src="{{ asset('assets/script/redirection.js') }}"></script>
<script src="{{ asset('assets/script/detailsliste.js') }}"></script>
