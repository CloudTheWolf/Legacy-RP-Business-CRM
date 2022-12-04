# Harmony CRM

First you need to install the pre-req packages.

Run the command `composer install` or `php composer.phar install` to download and install the vendor packages

Next you need to rename `.env.example` to `.env` then make change the following to match your needs:

```env
APP_NAME=Laravel # <-- Name of you Site
APP_ENV=local
APP_KEY=
APP_DEBUG=false # <- Set to false to show error pages instead of Debug pages
APP_URL=http://localhost # <- Set this to your site URL

LOG_CHANNEL=stack
LOG_LEVEL=debug

# Set the below to your MySQL Details

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

COMPANY_NAME= # <- Company Name 
BRANDING_DIR= # <- Name of the directory in /public/assets/images/branding/

# LegacyRP API URL (We are using a cached feed instead of the Offical API to get arround issues being blocked for to many requests, there is a 15 Min delay between this and the live API)

# This is used for seeing who is in city (Auto-Clock Out) as well as live Tow Logs
API_BASE_URI=

# Read Only REST API - Request API Key at https://discord.gg/opfw
OP_FW_REST_URI=https://rest.opfw.net/c3
OP_FW_API_KEY=

# Discord Settings

POST_JOB_APP_TO_DISCORD=true
BOOL_POST_REPAIR=true
# If above are true, set webhook URLs here
DISCORD_TIMESHEET_WEBHOOK=
DISCORD_TOW_WEBHOOK=
DISCORD_JOB_WEBHOOK=
DISCORD_REPAIR_WEBHOOK=

# Mechanic Price Settings (Set Buying and Selling values)

SCRAP_BUY=
SCRAP_SELL=

ALUNINIUM_BUY=
ALUNINIUM_SELL=

STEEL_BUY=
STEEL_SELL=

GLASS_BUY=
GLASS_SELL=

RUBBER_BUY=
RUBBER_SELL=

PRICE_ADV_REPAIR_KIT=

# UI Elements

ENABLE_WAREHOUSE=false

# Steam API key: https://steamcommunity.com/dev/apikey (Needed for login and Job Applications)
STEAM_API_KEY=

SITE_MODE="Mechanic" #
```

Save the file, then run the following command

`php artisan key:generate`

This will set you `APP_KEY` value

Next you need to setup the DB Schema

To do this run
`php artisan migrate`

This will create your DB structure. 

Finally you will need to create your Admin user.

To do this you first need to get a password hash using the following command (change password with what you want your password to be)
```php
C:\htdocs\harmonycrm> php artisan tinker;
>>> echo Hash::make('password');
$2y$10$pPbZ6SkVvlvUGRimAincTet7LunTW/aDQA849gZrG5yAtBop7c5w2⏎
>>> 
```

Once you have the hash you can press `Ctrl` + `C` to exit Artisan Tinker.

Now run the following SQL Insert Command (Replacing the values with your values)

```sql
INSERT INTO `users`(`name`, `email`, `cell`, `towID`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `onDuty`, `cid`, `steamId`, `IsAdmin`, `disabled`)
VALUES ('Firstname Lastname','Firstname.Lastnane','123-4567','Tow Licence Plate',CURRENT_TIMESTAMP(),'$2y$10$pPbZ6SkVvlvUGRimAincTet7LunTW/aDQA849gZrG5yAtBop7c5w2',NULL,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),0,'Your CID','Your Steam FiveM ID',1,0)
```

With that you will be able to log into the control panel and should see the Admin section where you can add new users!
