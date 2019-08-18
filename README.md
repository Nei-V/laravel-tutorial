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

By mistake I deleted the models for users and password reset, so this is what you have to do get them back (customize these afterwards):

https://stackoverflow.com/a/53257402

if you get error that class exists, delete old migration files
___________________________-

if we get error 419 page expired when sending a form, it is a security measure (CSRF) so that only someone authorized can send forms (or enter an endpoint through curl)
to solve this in laravel: 
we add at the beginning of our form this:
@csrf
this creats a long key(a hidden element inside the form) so that it knows we used our server to send the form

-------
if we get this error when submitting a form:  MassAssignmentException   - it means we have to turn of guarding in laravel:
so in the model (for example Post model in this example) we override the protected "guarded" field with an empty array
we can do that because in the Post we validate each filed separately.
----
if we get an error when submitting a form: integrity constraint violation - it means we didn't connect the models (the post to the user in this example)
this happens here because we let people post even if they are not logged in, so there is no user_id, therefore we have to add this
through relationship, so we use the auth() in the controller to do that (in the example in the PostsController). 
----

you have to run the command "php artisan storage:link" once in the life of the project to make the local storage directory public
(can be seen at domain/storage/uploads/filename.jpg)

----
we added this package to resize images
$ composer require intervention/image
and then use it like this:
use Intervention\Image\Facades\Image;
in the controller for example (when we store the images)
can also create thumbnails

There might be an error that GD library is needed for image processing, in win10, in php.ini file, this line should not be commented out:
extension=gd2
afterwards, restart the server

---
when we have  many to many relation (one user can follow multiple users,and multiple users can follow one user) we want to use a pivot table. We don't need a model for that, only a migration. In laravel there is a naming convention for that (the part that comes after the --create modifier):
the names of the tables should be:
-in alphabetical order ("profile" then "user", not "user" then "profile")
-in lowercase
-with underscore between them
we use this command:
php artisan make:migration creates_profile_user_pivot_table --create profile_user

after we add the fields we need in the migration file (in this case
$table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('user_id');
), we run the command
php artisan migrate