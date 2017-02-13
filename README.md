This is a framework that was created for testing, do not use it in production environment.
It is using a front controller pattern, all the request has a unique entry point at index.php
All the Urls are in the form of /controller/action/params

Basic Usage
-----------
1. Unzip the installation folder into project directory
2. Create a database, and use the SQL in the sample folder to load basic input data to get the project ready
3. modify the config php file in lib folder to suit your server settings. (there you can configure option for environment)
4. Done, visit the webpage

Folder Structure
----------------
- app / this folder has the controller, views and layout of the specific app project
- lib / it has all the framework core files, in here it is the config php file where you can configure speficic values like the DB connection, default paths...
- vendor / reserved for third party libraries
- webroot / public files, like css, js, imgs

Music Ranking Example
---------------------
As i couldnt find an API that shows the ranking of top songs worldwide i did a script to obtain the data from billboard.com website, so you must run this url to
mantain the ranking update. ex: http://yourdomain/music/getmusicfromsource

TO DO
------
- As this is an exercise to create a framework from scratch, you may note that there is a lot of things that need to polish, for example we can create a class
to automate form creation, or polish methods to bring more security to the site (like XSS or CSRF) and a lot more things i may add in the near future.

- As for the design i based the layout and views on the bootstrap basic styles

License
-------

This code is released under the MIT Open Source License. Feel free to do whatever you want with it.