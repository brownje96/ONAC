<?php

///////////////////////////////////////////////////////////////////
// DATABASE CONFIGURATION					 //
///////////////////////////////////////////////////////////////////

// This is the hostname (if your web server can resolve it) or
// IP address (preferably static...) of your MySQL or MariaDB server.
 $servername = "YOUR_HOST_OR_IP_HERE";

// This is the account on the RDBMS (not the server itself) where you have
// access to the ONAC database. If you used the setup script, then this
// default sane value is correct.
//
// Default: onac
 $username = "onac";

// This is the *password* to the account on the RDBMS.
 $password = "YOUR_DATABASE_USER_PASSWORD";

// This is the specific database where we can save our data to. If you
// used the setup script, the default sane value is correct
//
// Default: onac
 $dbname = "onac";

///////////////////////////////////////////////////////////////////
// LOCALIZATION CONFIGURATION					 //
///////////////////////////////////////////////////////////////////

 $cfg_lang = "en";

///////////////////////////////////////////////////////////////////
// REGISTRATION CONFIGURATION					 //
///////////////////////////////////////////////////////////////////

// This is the minimum length of a password at registration time.
//
// Default: 6.
 $cfg_pw_len = 6;

//TODO password difficulty settings
?>
