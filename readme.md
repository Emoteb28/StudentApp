 composer require logger

#Squellette d’application Symfony 4 
composer create-project symfony/skeleton hello-sf4

#Serveur Web embarqué de Symfony  
`composer require server --dev`

`Annotations` 
 composer require annotation

#Utiliser des templates Twig dans sf4 
composer require "twig/twig:^2.0"

#Memo twig 
php bin/console debug:twig

#ORM composer req orm
 composer require symfony/orm-pack

#symfony maker-bundle 
composer require --dev symfony/maker-bundle

php bin/console doctrine:database:create

**Fixtures**
`composer req --dev make doctrine/doctrine-fixtures-bundle`

`Faker` 
`https://blog.dev-web.io/2018/01/20/symfony-4-creation-de-fixtures-aleatoires-faker/`
**composer req --dev fzaninotto/faker**


#easy_admin 
composer req admin

#profiler 
composer require --dev symfony/profiler-pack

#sécurité 
 composer require sensiolabs/security-checker


php bin/console config:dump-reference security
