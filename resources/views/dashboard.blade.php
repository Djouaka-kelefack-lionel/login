<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Tableau de bord</h2>
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </div>

    <div class="user-info">
        @php
            $user = \App\Models\User::find(Session::get('user_id'));
        @endphp
        <p>Bienvenue, {{ $user->name }}!</p>
        <p>Nom d'utilisateur : {{ $user->username }}</p>
        <p>Email : {{ $user->email }}</p>
    </div>

    <div class="content">
        <h3>Contenu du tableau de bord</h3>
        <p>Vous êtes maintenant connecté à votre compte.</p>
    </div>
</body>
</html> 