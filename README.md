Как использовать готовый проект:

1. Запуск mysql в докер
`docker run -p 3306:3306 --rm --name skill-mysql -e MYSQL_ROOT_PASSWORD=skillpwd -d mysql:5.7`

2. (ждем 10 секунд пока сервер запустится)
Создаем базу 
`php bin/console doctrine:database:create`

3. Запускаем миграцию
`php bin/console doctrine:migrations:migrate`
