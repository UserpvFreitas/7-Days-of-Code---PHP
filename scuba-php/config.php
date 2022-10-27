<?php
define('SLASH',DIRECTORY_SEPARATOR);
define('VIEW_FOLDER',__DIR__.SLASH.'view'.SLASH);
define('DATA_LOCATION',__DIR__.SLASH.'data'.SLASH.'users.json');


define('EMAIL', 'pvAlura@gmail.com');
define('PWD', 'onuxqocuxdoxlxpz');
define('SECRET_IV', pack('a16',PWD));
define('SECRET', pack('a16', PWD));
