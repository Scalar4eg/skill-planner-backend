Как использовать готовый проект:

1. Установка symfony

 Linux/MacOs:
 
    curl -sS https://get.symfony.com/cli/installer | bash
    
 Windows:
 
  Скачиваем https://get.symfony.com/cli/setup.exe
  
  
  
2. Запускаем `composer install`

3. Запуск mysql в докер

`docker run -p 3306:3306 --rm --name skill-mysql -e MYSQL_ROOT_PASSWORD=skillpwd -d mysql:5.7`

4. (ждем 10 секунд пока сервер запустится)

Создаем базу 

`php bin/console doctrine:database:create`

5. Запускаем миграцию

`php bin/console doctrine:migrations:migrate`

6. Запускаем веб-сервер symfony

`symfony server:start`
