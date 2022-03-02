<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Application Client
c'est un simple application de detection de changement dans les fichiers appat ( c'est les ficheir qu'on a met sur le serveur de fichiers.)



## Installation d'application
on a utilisé le OS ubuntu pour ce test, vous pouvez utilisé les autre OS linux.
Les étaps pour mettre en place l'application:


## installation de serveur web (apache)
```
sudo apt-get install apache2
sudo systemctl enable apache2
sudo systemctl start apache2

```

## Installation des dependance de base et clonner le projet
```
sudo apt-get install git wget curl
cd /var/www/html
sudo git clone --branch v1.5 https://github.com/naizih/cryptolocker.git
```

Si le ficheir db.sqlite3 n'existe pas crée le, si il existe supprimer et recrée car il y a déja les données dans ce fichier.
verifié si le fichier .env existe, si il n'existe pas créé le, et verifié aussi le chemin de base de données <strong> DB_DATABASE </strong> .
```
ls -la
```



## Installation de php et dépendancies
```
sudo apt install php7.4-cli php7.4-curl phpunit libapache2-mod-php7.4

```

## installation de driver pour sqlite
```
sudo apt-get install php-sqlite3 

```

## Installation composer et passé au Version 2

par défaut le dossier <strong> /var/www/html </strong> n'a pas de permission d'ecriteur, alors soit donner le permission à ce dossier soit aller dans le repértoire /home et finir cette étap.
```
sudo apt install composer
sudo curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
cd /var/www/html/cryptolocker
sudo composer update
```


## Installation de dépendance pour montage de drive 
```
sudo apt-get install cifs-utils 
```


## Configuration de serveur apache2 pour laravel
Aller dans le fichier <strong> /etc/apache2/sites-available/000-default.conf </strong> et modifier la ligne suivant DocumentRoot:
```
DocumentRoot /var/www/html/cryptolocker/public
```

ajouter le code suivant à la fin de fichier <strong> /etc/apache2/apache2.conf </strong>  
```
<Directory /var/www/html/cryptolocker>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

et puis executer les commande suivant.
```
sudo a2enmod rewrite
sudo systemctl restart apache2
```


## Migrate
```
sudo php artisan migrate
```

## Droit
Droit des fichiers de project.
```
sudo chown -R $USER:www-data /var/www/html/cryptolocker
sudo chmod -R 755 /var/www/html/cryptolocker
sudo chmod -R 777 /var/www/html/cryptolocker/storage
sudo chmod -R 775 /var/www/html/cryptolocker/bootstrap
sudo chmod -R g+rw ../cryptolocker/
```



## Montage de Drive

pour monter le partage à partie de apache on a choisir le methode suivant

dans le fichier <strong> sudo nano /etc/apache2/envvars </strong> modifé le nom d'utilisateur et group de serveur apache.
donner le nom d'utilisateur, l'utilisateur courant et le group www-data

```
export APACHE_RUN_USER=user
export APACHE_RUN_GROUP=www-data

```
Et ensuite modifier le mot de pass dans le fichier script <strong> mount.sh </strong> et <strong> umount.sh </strong> que se trouve dans le dossier <strong> /cryptolocker/app/Bash </strong>, donner le mot de pass d'utilisateur que vous avez écrie dans le fichier <strong> /etc/apache2/envers </strong>

```
echo 'user' | sudo -S
```
Ci-dessus le 'user' c'est le mot de passe de utilisateur user vous devez changé celle la.



## Autorisé lancement des Taches Automatique

En tappant la commande <strong> crontab -e </strong> ajouter la ligne suivant à la fin de fichier pour fonctionner les taches automatiques.
```
* * * * * php /var/www/html/cryptolocker/artisan schedule:run 1>> /dev/null 2>&1
```

Et puis lancer la commande suivant dans le repertoire <strong> /var/www/html/cryptolocker </strong>
```
php artisan schedule:run
```

