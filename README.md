# 🚀 Système d'Authentification Laravel Personnalisé

Un système d'authentification construit sur Laravel, sans recourir aux packages d'authentification intégrés. Idéal pour un apprentissage approfondi ou pour des projets nécessitant des solutions personnalisées.

## 📖 Table des Matières

- [Fonctionnalités](#✨-fonctionnalités)
- [Prérequis](#🔧-prérequis)
- [Installation](#📥-installation)
- [Structure du Projet](#🏗-structure-du-projet)
- [Points Essentiels](#🎯-points-essentiels)
- [Guide d'Utilisation](#👨‍💻-guide-dutilisation)
- [Personnalisation du Style](#🎨-personnalisation-du-style)
- [Cycle de Session](#🔄-cycle-de-session)

---

## ✨ Fonctionnalités

- **Inscription et Connexion** : Gestion des utilisateurs avec un système sécurisé.
- **Sessions** : Connexion persistante avec gestion sécurisée des sessions.
- **Protection des Routes** : Middleware personnalisé pour protéger les ressources.
- **Validation Avancée** : Données utilisateur soigneusement validées.
- **Interface Utilisateur Moderne** : Design responsive, clair et intuitif.
- **Gestion des Erreurs** : Feedback utilisateur détaillé et adapté.
- **Déconnexion Sécurisée** : Terminer une session en toute sécurité.

---

## 🔧 Prérequis

- **PHP** : Version >= 8.0
- **Laravel** : Version >= 9.0
- **MySQL** : Version >= 5.7
- **Composer** : Pour la gestion des dépendances PHP

---

## 📥 Installation

1. **Cloner le projet** :
   ```bash
   git clone [url-du-projet]
   cd [nom-du-dossier]
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configurer l’environnement** :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données** dans le fichier `.env` :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=login
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Exécuter les migrations** :
   ```bash
   php artisan migrate
   ```

6. **Lancer le serveur local** :
   ```bash
   php artisan serve
   ```

---

## 🏗 Structure du Projet

### 📂 Models
- **`User.php`** : Modèle utilisateur avec gestion des attributs et relations nécessaires.

### 📂 Controllers
- **`AuthController.php`** :
  - Inscription
  - Connexion
  - Déconnexion

### 📂 Middleware
- **`CustomAuth.php`** : Vérifie les sessions actives pour protéger les routes.

### 📂 Migrations
- **`create_users_table.php`** :
  - `username` (unique)
  - `name`
  - `email` (unique)
  - `password`
  - `timestamps`

### 📂 Views
- **`auth/login.blade.php`** : Page de connexion.
- **`auth/register.blade.php`** : Page d’inscription.
- **`dashboard.blade.php`** : Tableau de bord utilisateur.

### 📂 Routes
```php
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
```

---

## 🎯 Points Essentiels

### Sécurité
- Hashage des mots de passe avec **Bcrypt**.
- Protection CSRF sur tous les formulaires.
- Validation stricte des données utilisateur.
- Middleware pour garantir des sessions sécurisées.

### Interface Utilisateur
- Design responsive et moderne.
- Feedback utilisateur clair et interactif.
- Navigation intuitive avec animations fluides.

### Validation des Données
#### Exemple : Inscription
```php
'username' => 'required|string|max:255|unique:users',
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8|confirmed',
```
#### Exemple : Connexion
```php
'username' => 'required|string',
'password' => 'required|string',
```

---

## 👨‍💻 Guide d’Utilisation

### Inscription
1. Accéder à `/register`.
2. Remplir le formulaire avec :
   - Nom d’utilisateur (unique)
   - Nom complet
   - Email
   - Mot de passe (et confirmation)
3. Soumettre le formulaire pour être redirigé vers le tableau de bord.

### Connexion
1. Accéder à `/login`.
2. Saisir le **nom d’utilisateur** et le **mot de passe**.
3. Une fois connecté, accéder au tableau de bord.

### Déconnexion
1. Utiliser l'option "Déconnexion" pour terminer la session en toute sécurité.

---

## 🎨 Personnalisation du Style

Le projet utilise une approche design moderne avec :
- **Palette de couleurs** : cohérente et attrayante.
- **Typographie** : lisible et professionnelle.
- **Espacement** : harmonieux pour un affichage clair.
- **Feedback visuel** : transitions et animations subtiles.
- **Formulaires** : adaptatifs et responsifs.

---

## 🔄 Cycle de Session

1. **Création lors de la connexion/inscription** :
   ```php
   Session::put('user_id', $user->id);
   ```

2. **Vérification dans le middleware** :
   ```php
   if (!Session::has('user_id')) {
       return redirect('/login');
   }
   ```

3. **Suppression lors de la déconnexion** :
   ```php
   Session::forget('user_id');
   ```

