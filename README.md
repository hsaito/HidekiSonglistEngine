# About the project
This is snapshot of the code used in [Hideki's Songlist](http://songlist.hclippr.com). 
This is not an identical codes used in Hideki's Songlist, as it lacks page contents as well as authentication information. 

# Requirements
* PHP
* MySQL

# ToDos
* At this time, there is no database initialization code. (Coming soon!) So you will have to manually configure them. Please refer to edit/new.php for database structure.
* This code base is around for quite a while now. Currently, there are some known deprecated function in latest PHP version. (Still functions, but warning would be given.)
* [WebIntent](http://webintents.org/) no longer functions.
* Currently, it relies on BASIC/DIGEST authentications provided by a server.
    * When trying it on a production server, make sure to secure edit/* and auth.php
* It doesn't scale very well at this moment. (No pagination and such.) This probably will get problematic if you can sing more than 1000 songs or so.

# License
See COPYING.