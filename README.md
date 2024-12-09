# Système d'Authentification Laravel Personnalisé

Un système d'authentification personnalisé construit avec Laravel, sans utiliser les packages d'authentification intégrés.

## 📋 Table des Matières

- [Fonctionnalités](#fonctionnalités)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Structure du Projet](#structure-du-projet)
- [Points Essentiels](#points-essentiels)
- [Guide d'Utilisation](#guide-dutilisation)

## ✨ Fonctionnalités

- Inscription des utilisateurs
- Connexion par nom d'utilisateur
- Gestion des sessions
- Protection des routes
- Validation des données
- Interface utilisateur moderne et responsive
- Gestion des erreurs
- Déconnexion sécurisée

## 🔧 Prérequis

- PHP >= 8.0
- Laravel >= 9.0
- MySQL >= 5.7
- Composer

## 📥 Installation

1. Cloner le projet


bash
git clone [url-du-projet]

2. Installer les dépendances
bash
composer install

3. Configurer le fichier .env
bash
cp .env.example .env
php artisan key:generate

4. Configurer la base de données dans .env
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=login
DB_USERNAME=root
DB_PASSWORD=

5. Exécuter les migrations
bash
php artisan migrate

## 🏗 Structure du Projet

### Models
- `User.php` : Modèle utilisateur simplifié

### Controllers
- `AuthController.php` : Gère l'authentification
  - Inscription
  - Connexion
  - Déconnexion

### Middleware
- `CustomAuth.php` : Protection des routes authentifiées

### Migrations
- `create_users_table.php` : Structure de la table utilisateurs
  - username (unique)
  - name
  - email (unique)
  - password
  - timestamps

### Views
- `auth/login.blade.php` : Page de connexion
- `auth/register.blade.php` : Page d'inscription
- `dashboard.blade.php` : Page tableau de bord

### Routes
php
// Routes publiques
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
// Routes protégées
Route::middleware(['custom.auth'])->group(function () {
Route::get('/dashboard', function () {
return view('dashboard');
});
});

## 🎯 Points Essentiels

### Sécurité
- Mots de passe hashés avec Bcrypt
- Protection CSRF sur les formulaires
- Validation des données
- Sessions sécurisées
- Middleware personnalisé

### Interface Utilisateur
- Design responsive
- Feedback utilisateur
- Messages d'erreur clairs
- Transitions et animations
- Navigation intuitive

### Validation
php
// Inscription
'username' => 'required|string|max:255|unique:users',
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8|confirmed'
// Connexion
'username' => 'required|string',
'password' => 'required|string'

## 👨‍💻 Guide d'Utilisation

### Inscription
1. Accéder à `/register`
2. Remplir le formulaire :
   - Nom d'utilisateur (unique)
   - Nom complet
   - Email
   - Mot de passe
   - Confirmation du mot de passe
3. Soumission et redirection vers le tableau de bord

### Connexion
1. Accéder à `/login`
2. Entrer :
   - Nom d'utilisateur
   - Mot de passe
3. Redirection vers le tableau de bord

### Protection des Routes
php
// Middleware personnalisé
public function handle(Request $request, Closure $next)
{
if (!Session::has('user_id')) {
return redirect('/login');
}
return $next($request);
}

## 🎨 Personnalisation du Style

Le système utilise un design moderne avec :
- Palette de couleurs cohérente
- Typographie optimisée
- Espacements harmonieux
- Animations subtiles
- Messages d'erreur stylisés
- Formulaires responsifs

## 🔄 Cycle de Session

1. Création lors de la connexion/inscription
php
Session::put('user_id', $user->id);

2. Vérification dans le middleware
php
if (!Session::has('user_id')) {
return redirect('/login');
}

3. Suppression à la déconnexion
php
Session::forget('user_id');
