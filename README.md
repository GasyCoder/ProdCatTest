# ProductCat

Petite application Laravel pour gérer des produits et des catégories.

## Fonctionnalités

- Authentification (inscription, connexion, déconnexion)
- CRUD des catégories
- CRUD des produits
- Gestion des utilisateurs avec un champ `type` (admin / utilisateur)

## Installation

1. Cloner le projet :
```bash
git clone https://github.com/GasyCoder/ProdCatTest
cd ProdCatTest

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve