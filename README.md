# SmartWallet 

SmartWallet est une application web simple et élégante permettant de gérer les revenus et les dépenses d'un utilisateur. L'interface adopte un style girly/pink moderne et responsive.

## 🚀 Fonctionnalités

* Création de compte (inscription)
* Authentification sécurisée (login/logout)
* Ajout de revenus
* Ajout de dépenses
* Affichage des données sous forme de listes ou de graphiques
* Tableau de bord personnalisé avec session utilisateur
* Protection des pages (accès interdit sans authentification)

## 🛠️ Technologies utilisées

* **PHP** (PDO pour la connexion à la base de données)
* **MySQL** (base de données)
* **HTML / CSS / TailwindCSS**
* **Chart.js** (optionnel pour les graphiques)
* **Sessions PHP** pour l'authentification

## 📁 Structure du projet



```
project/
│── config.php
│── login.php
│── loginAction.php
│── signUp.php
│── signUpAction.php
│── logout.php
│── index.php
│
│── 
│   addIncome.php
│
│── 
│   └── addExpense.php
│

└── README.md
```



## 🗄️ Base de données (MySQL)

### Table `users`

```
id INT AUTO_INCREMENT PRIMARY KEY
username VARCHAR(255)
email VARCHAR(255) UNIQUE
password VARCHAR(255)
```

### Table `incomes`

```
id INT AUTO_INCREMENT PRIMARY KEY
amount FLOAT
user_id INT
```

### Table `expenses`

```
id INT AUTO_INCREMENT PRIMARY KEY
amount FLOAT
user_id INT
```

## 🔐 Authentification

L'application utilise `password_hash()` et `password_verify()` pour sécuriser les mots de passe.

Chaque page protégée doit contenir au début :

```php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
```


## 🚪 Déconnexion

```php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
```

## 💅 Style

Le design est basé sur TailwindCSS avec un thème moderne et neutre
