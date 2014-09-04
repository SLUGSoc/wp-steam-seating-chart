<h1>wp-steam-seating-chart<h1> 
<h2>Intro -</h2> 

A plugin for Wordpress to show a LAN style seating chart that Wordpress users can sit down, stand up and move seats on. Integrated with the Steam API via the OneAll social plugin to display the current gaming status of the players.
This requires a user to sync their account to steam or sign up via steam and will indicate a user to login via steam ("to the right" as we assume that you have the login widget there, user prompt editable in line 19 showseating.php)

An example is currently available at: http://beta.slugsoc.co.uk/seating-chart/

<h2>Installation -</h2> 

This plugin is fairly simple to install, drag and drop into the /wp-content/plugins/ folder.

Once installed it will show a seating chart at the Yourwebsite.com/seating-chart/

<h2>Dependencies -</h2> 

Wordpress Obviously
OneAll Social Login Wordpress Plugin with the steam social login configured and enabled.

<h2>Configuration - </h2> 

Edit the config file at /wp-content/plugins/seating-chart/seatingconfig.php

Variables are self explanatory, the datafile is a text file at a location of your choice accessible on the webserver which contains the seating data.
Ensure you create this empty file and set the appropriate path.

Most CSS can be edited in map.css (thank you to LSUCS as I used your CSS file with a few edits) or within the showseatinghead.php file. 
