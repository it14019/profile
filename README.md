**Instructions**

**Description**

A simple application with following functionality:
- Register;
- Login;
- Edit Profile;

All methods uses one Controller - `ApplicationController`.
Some Controller methods uses `User` Model.

When application is started, `GET` route's `/` method `show()` returns view `index.php`. 

![Alt text](images/index.gif?raw=true "Home page picture")

When clicked on button 'SIGN UP', a Sign Up form is showed with fields Name, Email and Password.
If all fields are correctly filled (e.g. email should contain `@` sign, dot `.` and at least 2 characters after `.`; 
password should be at least 8 characters long, contain at least one lowercase letter, uppercase letter and number),
and submitted, data is sent to `POST` route `/`, which uses method `store()`. It stores data in table `users`. 
Password is hashed with `password_hash()`.

When user log's in (if email and password matches with database data), user is redirected to `POST` route `/profile`, 
which uses method `showProfile()`. It returns view `profile.html`. Also, the session is started with `session_start()`.

![Alt text](images/profile-page.png?raw=true "Profile page picture")

When clicked on button 'Edit Profile' user is redirected to `GET` route `profile/edit`, which uses `showEditProfile()`.
It returns view `edit-profile.html`.

![Alt text](images/edit-profile-page.gif?raw=true "Profile page picture")

When user submits data, data is sent to `POST` route `/profile/update`, which uses `update()` method. It updates data
in table `users_information` or inserts if there are not any. Then user is redirected back to view `edit-profile.html`.

When user logs out, user is sent to `POST` route `/profile/logout`, which uses `logout()` method. It destroys session
and redirects to view `index.html`.

**Used Libraries:**
- FastRoute;
- Medoo;

*Still need to do some work with responsivity and field validation.