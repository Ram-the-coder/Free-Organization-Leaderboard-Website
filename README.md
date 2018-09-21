# Free-Organization-Leaderboard-Website
## Webstacks-Task2

This website works with PHP and MySQL only. JavaScript is also needed to show windows alerts.

**Features of this website:**
- Standard Users and Admins:
  > The first user account created will automatically be an administrator account with admin rights. Users registering after that by default are standard users.
  > Only standard users are ranked in the leaderboard.
  > Admins have permission to modify a user's points, delete a user, change a standard user to admin and to upload tasks.
- All pages are secured:
  > Only registered users can view them. 
  > Currently there are no conditions set on registering and anyone can register and access all the pages that a standard user can access.
- A description of the users can be viewed by clicking on their name in the leaderboard page.
- The database and the tables will be created automatically on the first user registration, provided the connection with that database has been established properly. Check the connection_info.php if you face any problems with connection, connection authentication errors, etc.

- **Check the screenshots to get an idea on how the website looks**

### The files and their functions:
- admin.php - This is the page where administrators can manage other users and view the list of admins. Here the admin can modify the points of a user, promote a user to an admin and delete a user.
- connection_info.php - This contains information to connect PHP to database
- del.php - This contains php code to delete users when an admin wants to delete one
- leaderboard.php - This page shows the leaderboard ranking the users according to the points awarded by the admin.
- login.php - The page where users can login into their account.
- modify.php - This contains php code to modify the users' points when an admin wants to modify it.
- signup.php - This is the page through which new users need to register.
- tasklist.php - This is the page where admins can view the existing tasks and can upload new tasks for the organization to be viewed/completed by the standard users.
- toggle.php - This contains php code to make a standard user to admin.
- utask.php - This is a page that standard users can view. Here the tasks uploaded by the admins are displayed.

*Website created by: Ramvardhan, Vashanth*
*We worked very well as a team and both of us did at least something with everything*
