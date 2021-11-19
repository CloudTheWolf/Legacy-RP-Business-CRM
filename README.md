# Harmony CRM

To get started you need to rename `.env.example` to `.env` then make change the following to match your needs:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
API_BASE_URI=
DISCORD_TIMESHEET_WEBHOOK=
DISCORD_TOW_WEBHOOK=
COMPANY_NAME=
```

Then change `public/assets/images/logo-icon2.png` and `public/assets/images/logo-img2.png` with images to match your branding

Now run the following command to install all required packages:

`php .\composer.phar install`

Next you need to setup the DB Schema

To do this run
`php artisan migrate`

This will create your DB structure. 

Finally you will need to create your Admin user.

To do this you first need to get a password hash using the following command
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
