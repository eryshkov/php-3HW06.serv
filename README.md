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
* для решения задачи №1.1 написан собственный [класс](src/Services/Mailer.php)
* тест, как решение задачи №1.3 находится [здесь](tests/MailerTests.php)
* решение задачи №2.4 находится [здесь](src/Entity/User.php)
* скрипт сборки проекта находится [здесь](build/production/build.xml)
* Скрипт сборки проекта должен запускаться из папки с проектом примерно так:
    ```
  php ./vendor/phing/phing/bin/phing -f ./build/production/build.xml -Dapp.destination.path=/Users/eugem/Developer/PHP/php-3HW03.prod -Dapp.domain=test.com -Dapp.db_driver=mysql -Dapp.db_user=eug -Dapp.db_password=123 -Dapp.db_host=php-3HW03.mac -Dapp.db_port=8889 -Dapp.db_name=php3hw03
  ```
  Следующие параметры должны быть обязательно указаны:
  * `-Dapp.destination.path`
  * `-Dapp.db_driver`
  * `-Dapp.db_user`
  * `-Dapp.db_password`
  * `-Dapp.db_host`
  * `-Dapp.db_port`
  * `-Dapp.db_name`
* применена дополнительная настройка web-сервера nginx:
 <img src="/screens/nginx.png" width="50%">

## Main functionality
* PSR-standards
* Composer


## Credits
* thanks to **Albert Stepantsev** and to his [awesome school](https://pr-of-it.ru/courses/php-3.html)

## License

This project is licensed under the MIT License.
