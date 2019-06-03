#  Home work 6

<div align = "center">
<img src="/screens/hw06.png" width="100%">  
<br>
</div>

<p align="center">
<img src="https://img.shields.io/badge/PHP-7.3.3-orange.svg" alt="PHP-7.3"/>
<img src="https://img.shields.io/badge/Symfony-4.2.9-blue.svg">
<img src="https://img.shields.io/badge/licence-MIT-lightgray.svg" alt="Licence MIT"/>
</p>

## Информация для проверяющего
* выбран фреймворк `Symfony 4`
* решения задач №1.1 - 1.3 находятся [здесь](src/Controller/PutUserToQueueController.php)
* код консольной команды из задачи №1.4 для запуска рассылки находится [здесь](src/Command/TaskEmailSendCommand.php)
* для решения задачи №1.4 необходимо установить файл `crontab` при помощи команды, запущенной из папки проекта:
  ```
  crontab build/production/cron.txt
  ```
  сам файл находится [здесь](build/production/cron.txt)
* решение задачи №2. Интерфейс для проверки номера занания в очереди находится [здесь](src/Controller/GetCurrentTaskController.php). Интерфейс проверки статуса задания по его номеру находится [здесь](src/Controller/GetTaskStatusByIdController.php)
* скрипт сборки проекта находится [здесь](build/production/build.xml)
* **главное приложение** для микросервиса находится [здесь](https://github.com/eryshkov/php-3HW06)
* [код консольной команды](https://github.com/eryshkov/php-3HW06/blob/master/src/Command/UserSendEmailCommand.php) для постановки заданий в очередь
* [код интерфейса](https://github.com/eryshkov/php-3HW06/blob/master/src/Controller/GetUserEmailController.php) отдающего email по ID пользователя
* URL до главного приложения должен быть указан [здесь](config/packages/mainAppConfig.yaml)
* применена дополнительная настройка web-сервера nginx:
 <img src="/screens/nginx.png" width="50%">

## Main functionality
* PSR-standards
* Composer


## Credits
* thanks to **Albert Stepantsev** and to his [awesome school](https://pr-of-it.ru/courses/php-3.html)

## License

This project is licensed under the MIT License.
