CallFile-Dialer
==============

This is a tool to send automated calls to deliver messages. It consist in a HTLML GUI, an AGI files and the asterisk dialplan.


##Features:##

* Login page.
* Easy Creation of Campaigns.
* Upload of 2 Audios usually a Gretting(audio1) and the message to deliver(audio2).
* Simple Campaign Status. Showing the number dialed, the contact attempts the last call status, the SIPCAUSE(Asterisk 1.8) and if was deliver or not the message(audio2).
* Selection between dial only to see if the number is in service or deliver the message.
* Maximum Calls allowed.
* Maximum Retries
* Retry Time.
* Add Admin Users.


##Installation:##

1. Database Installation:
  * Enter in the mysql cli and run:

      `create database dialerdb`
      `grant all privileges on dialerdb.* to 'dialeruser'@'localhost' indentified by 'dialerpass'`

  * Exit of mysql cli and dump the structure:

      `mysqldump dialerd < MYSQL/struct_dialerddb.sql`

  * Add an admin via mysql cli:

      `USE dialerdb`
      `INSERT INTO login_admin(user_name,user_pass) VALUES('admin',SHA1('admin'));`   

2. HTML GUI Installation:
  * Create a directory in your APACHE root folder:

      `mkdir /var/www/html/dialer`

  * Copy the files:

      `cp -r HTML/* /var/www/html/dialer`

3. Add the dialplan to your Asterisk:

      `cat ASTERISK/extensions.conf >> /etc/asterisk/extensions.conf`

4. Copy the AGI scripts:
  
      `cp -r AGI/* /var/lib/asterisk/agi-bin/` 



##ScreenShots##

*Login page*
![alt text](http://dl.dropbox.com/u/1277237/dialer1.png)

*Create Campaign*
![alt text](http://dl.dropbox.com/u/1277237/dialer2.png)

*Details*
![alt text](http://dl.dropbox.com/u/1277237/dialer3.png)

*Start Campaign*
![alt text](http://dl.dropbox.com/u/1277237/dialer4.png)

*Add Users*
![alt text](http://dl.dropbox.com/u/1277237/dialer5.png)




by navaismo@gmail.com
