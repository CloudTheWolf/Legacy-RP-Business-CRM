# A GTA RP Business CRM By CloudTheWolf

Welcome to the GTA RP Business CRM By CloudTheWolf

This guid is for Version 4 or later.

You will need an AMP based environment that has the following:

 - Apache Webserver or equivalent, such as Litespeed (Note nginx won't work out of the box, and you'll need to edit its config to mirror the `.htaccess` settings)
 - MySQL Server (MariaDB is Suggested)
 - PHP 8.1 Or Newer with Curl, Ctype, BCMath, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer and XML


### Getting Starting
To get started, download the latest release and upload to your server.

Next, need to rename `.env.example` to `.env` then make change the following to match your needs:

```env
APP_NAME="GTA RP Business CRM"
APP_ENV=local
LIVEWIRE_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://mysite.com

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Set to either Fire on Database
SESSION_DRIVER=file
SESSION_LIFETIME=14400

# Live Data API from your FiveM Server (Currently Only Designed For OPFramework Based Servers)
API_BASE_URI=
# OPFW API Key Eg. https://rest.opfw.net/c3
OP_FW_REST_URI=

OP_FW_API_KEY=


# Discord Client ID and OAuth Secret
DISCORD_CLIENT_ID=
DISCORD_SECRET=

# Discord Bot Token
DISCORD_TOKEN=

# Steam API key: https://steamcommunity.com/dev/apikey
STEAM_API_KEY=


# DEV OVERRIDE #
#OAUTH_HTTPS=false
#VERIFY_HTTPS=false
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
php artisan tinker;
>>> echo Hash::make('password');
$2y$10$pPbZ6SkVvlvUGRimBincTet7LunTW/aDQA849gZrG5yAtBop7c5w2⏎
>>> 
```

Once you have the hash you can press `Ctrl` + `C` to exit Artisan Tinker.

Now run the following SQL Insert Command (Replacing the values with your values)

```sql
INSERT INTO `users`(`name`, `email`, `cell`, `towID`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `onDuty`, `cid`, `steamId`, `IsAdmin`, `disabled`)
VALUES ('Firstname Lastname','Firstname.Lastnane','123-4567','Tow Licence Plate',CURRENT_TIMESTAMP(),'$2y$10$pPbZ6SkVvlvUGRimAincTet7LunTW/aDQA849gZrG5yAtBop7c5w2',NULL,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),0,'Your CID','Your Steam FiveM ID',1,0)
```

With that you will be able to log into the control panel and should see the Admin section where you can add new users!

It is also advised to change the session driver from `file` to `database` in the `.env` file
