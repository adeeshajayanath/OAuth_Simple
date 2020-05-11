Guid to deploy and test the package

install any webserver (wamp or xampp)
create folder named "oauth"
in home folder (inside oauth folder) place index.php, login.php and config.php files.
index.php should be in http://127.0.0.1/oauth/ path. othervice google will give redirection URL mismatch error
install composer (https://getcomposer.org/)
open terminal in your home folder
run this command - "composer require google/apiclient:^2.0"
this will install google client API inside your home folder

Include Google Client Library for PHP autoload file
in this example - require_once 'phplib_oauth/vendor/autoload.php'; // I installed google client API inside phplib_oauth folder.

run the web server and go to http://127.0.0.1/oauth/ and login using your SLIIT gmail account.
this example project is only work for SLIIT domain users.
