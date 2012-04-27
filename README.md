hms
===

A web based hotel management

How to run it from apache?
* Download YII from http://www.yiiframework.com/download/
* extract it to www folder 
* clone code of hms to www in the same level with YII 

Where's the db scripts?
/www/hms/protected/doc/db/hms.sql

Where's the db design?
/www/hms/protected/doc/design/design.mwb

Note: this model chart can be opened by MySQLWorkbench

Where can I change the connection string?
	DB connection is configured at:
/www/hms/protected/config/main.php, line 56 ~ 62

About the /www/hms/assets folder
	Yii generates scripts files dynamically to this folder, 
so there will be an error if there's no such a folder, but 
keep in mind, any file in this folder should not be checked in.