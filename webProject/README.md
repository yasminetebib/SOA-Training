# Portail Universitaire — Version Procédurale (PHP natif)

> **But pédagogique :** fournir une base *monolithique, procédurale* (sans POO) à analyser et critiquer (architecture logique/physique), puis proposer une refonte moderne.

## Prérequis
- PHP 8.x
- MySQL/MariaDB (XAMPP/WAMP/MAMP conviennent)
- Navigateur Web

## Installation rapide
1. Copiez ce dossier dans votre serveur web (ex. `htdocs/php_portal_procedural`).
2. Ouvrez `db.php` et ajustez les paramètres MySQL si nécessaire (login/mot de passe).
3. Dans le navigateur, lancez `http://localhost/php_portal_procedural/setup.php` pour créer la base, les tables et des données d’exemple.
4. Connectez-vous via `http://localhost/php_portal_procedural/login.php`  
   - **Email :** admin@example.com  
   - **Mot de passe :** admin
5. Explorez les pages : modules, UEs, notes, messagerie, emploi du temps.

## Notes importantes (pour l'étude critique)
- Code **procédural**, mélange **PHP/HTML/SQL** sur les mêmes pages.
- Pas de **couches** séparées (présentation/métier/données).
- **Validation** faible, **sécurité** minimale (ex. authentification simple).
- **SQL** construit par concaténation (malgré `mysqli_real_escape_string`), pour encourager la discussion sur les risques.
- Pas de tests, pas de logging structuré, pas de configuration par environnement.

> Ces *imperfections* sont intentionnelles pour servir de base à une **étude critique** et à une proposition d’architecture plus modulaire.
