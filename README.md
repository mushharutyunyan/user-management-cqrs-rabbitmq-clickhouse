## Installation
FOR LINUX

Clone this repository

```bash
composer install
```
- FOR clickhouse
```bash
sudo apt install clickhouse-server clickhouse-client
```
```bash
sudo systemctl start clickhouse-server
```
- FOR Redis
```bash
sudo apt install redis-server
```
- FOR postgreSql
```bash
sudo apt install postgresql postgresql-contrib
```
```bash
sudo -u postgres createdb testtask
```
- For updating Redis cache cron job (Command) \
change "path-to-your-project" to your cloned directory
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
- create .env file in route folder and change PostgreSQL database credentials
-------
- FOR queues
Run this command in your linux (preferred in background)
```bash
php artisan queue:listen
```
```bash
php artisan migrate --seed
```
```bash
php artisan passport:install
```
```bash
php artisan passport:client --password
```
- What should we name the password grant client?
    - any name you want
- Which user provider should this client use to retrieve users? [users]:
      [0] users
      [1] clients
    - press 1 and press enter
- Which user provider should this client use to retrieve users? [users]:
    - press enter
```bash
Password grant client created successfully.
Client ID: 945cbfe9-eb0b-4e59-91d0-d5ce74ac4a33
Client secret: aRX9QxACKr51QyUi0Hjc6kPb5q9CJedexgESVcpc
```
Credentials need to be added in Client application .env file
```bash
Default username password
Username: client@example.com
Password: password
```



