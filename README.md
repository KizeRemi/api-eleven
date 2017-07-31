api-eleven
==========

**Réalisé par Mavillaz Rémi**

Github KizeRemi: https://github.com/KizeRemi  

API permettant de visualiser et créer des Pokemon.

## Installation

Pré-requis : Composer

Ouvrez le terminal de votre ordinateur, allez dans le dossier d'installation du projet et cloner le dépot

```
git clone https://github.com/KizeRemi/eleven-api.git

```

Puis
```
composer install
php bin/console d:s:u --force
php bin/console doctrine:fixtures:load
```

Suivre la procédure de configuration pour la base de données. 

Pour lancer les tests unitaires
```
vendor/bin/phpunit

```