# mysqlogin

A simple login and log up application written in PHP. That uses MySQL queries and server connection.

..Note: Flutter side is not actually worked in some situations. It needs a localhost database connection without any password security (neither native_sql_connection nor chipher_sha2_secure). So I rewrite them up in PHP as well.

## Installation

I use my own server to develop this project. You can preview it on [with clicking.](http://68.183.106.165)

I developed it onto phpstorm, served using LAMP and phpmyadmin.
If you dont know how to install LAMP server look at my post about it on dev.to [from here](https://dev.to/zaryob/lamp-server-kurulumu-3na2)

Put all files with `*.php` extension and `css/` directory on `/var/www/html` directory.

Open the phpadmin.
![step1](screenshots/Screenshot_20210502_125532.png) 
Add new database from left side of the page
![step2](screenshots/Screenshot_20210502_125830.png)  
Put name as new database `users` then click `Create`
![step3](screenshots/Screenshot_20210502_125850.png)  
Select `users` database name left of the databases. An then click `Import` from tab
![step4](screenshots/Screenshot_20210502_130137.png)
In this page you will import database with sql file provided with this project
Click to browse
![step5](screenshots/Screenshot_20210502_130150.png) 
Find sql file fith explorer.
![step6](screenshots/Screenshot_20210502_130206.png)  
Scroll down and click to go.
![step7](screenshots/Screenshot_20210502_130217.png) 
It will open a page and this page give lots of successfull output.
![step8](screenshots/Screenshot_20210502_130227.png)

