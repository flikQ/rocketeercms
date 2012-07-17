# Rocket Fuel

Installation:

*	hg clone https://{your_username}@bitbucket.org/sbioko/rocket-fuel
*	change settings in application/config/database.php
*	setup database
*	navigate in browser to http://{site}/migrate/version/999
*	check your database

## Heavy models, light controllers!

Todo:

* 	Add indexes to tables using DbForge methods
*	Add checks for errors(non-existent data, etc)
*	Extend validation rules for models
*	Add validation for send_to, reply_to in Private_Message model
*	Exception coverage
