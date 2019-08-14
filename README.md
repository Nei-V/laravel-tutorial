following this php laravel tutorial on youtube:
https://youtu.be/ImtZ5yENzgE

problems in installation:
(on win 10 64 bit)

php artisan command didn't work -> do "compose install" in the root directory of the project
"compose install" didn't work -> edit php.ini file - remove "  ;" before the line "extension=fileinfo" in order for it not to be commented out.
php artisan  -> works
running php artisan serve (to run server) but getting error 500 --> did 2 things :
1. renamed .env.example file to .env    (removed .example)
2. run php artisan key:generate (maybe this wasn't needed, i did both commands before trying to see if the server works)
-> server works when running php artisan serve command


php artisan migrate command - didn't find the database file.
-> the vim command created a file with the name "    .database.sqlite.swt"  ->rename it to "database.sqlite"  (without the period at the beginning and the second extension)

-> do php artisan migrate command again  -->  error (could not find driver)  -> what I did:

1. installed SQlite and added that directory to PATH-user variables (environment variables in windows)
2. deleted file created with vim command before
3. edited php.ini file:
a. edited this line after [sqlite] :
sqlite3.extension_dir = "C:\php\ext"
 (the dir was empty)

b.enabled:
extension=pdo_sqlite
extension=sqlite3

4. used this command in powershell terminal to recreate the database file (instead of vim)
new-item -ItemType File -Name database/database.sqlite

--> run php artisan migrate ---> works

error when adding when registering new user ---> because we edited the file .env (to use sqlite) the php server ahs to be restarted

in order to apply changes in front end we have to run "npm run dev" (if we make changes in other folders than public I think, or if we make changes to sass files)