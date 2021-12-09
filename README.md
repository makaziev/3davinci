
## Консольное приложение на PHP

## Установка

Требования:

- [PHP >= 7.4](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)


Склонируйте репозиторий на свою машину


```shell script
git clone https://github.com/makaziev/3davinci
```

Установите зависимости через Composer

```shell script
composer install
```

Установите найстройки БД в классе Boot и выполните команду

```shell script
php vendor/bin/doctrine orm:schema-tool:create
```


## Тестирование

Чтобы протестировать код, из корня проекта введите команду:

```shell script
php console app:run
```
