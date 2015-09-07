<?php

// Constant encryption key
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');

//api key word
define('API_KEY_WORD', 'mrsuave');

//libs
define('LIBS', 'libs/');

//models
define('MODELS', 'models/');

//profiling
define('ALLOW_PROFILE', false);

//response
define('SUCCESS', 200);
define('UNPROCESSIBLE_ENTITY', 422);
define('INTERNAL_SERVER_ERROR', 500);
define('USER_ALREADY_REGISTERED', 701);
define('FILE_NOT_UPLOADED', 702);
define('INVALID_USERNAMEPASSWORD', 703);
define('ACCOUNT_DOESNOT_EXISTS', 704);
define('USER_DOESNOTHAVE_COHORTS', 705);
define('INVALID_GL_CODE', 706);
define('INVALID_SESSION_TOKEN', 716);
define('EVENT_DOESNOT_EXISTS', 708);
define('BOOKING_NOT_AVAILABLE', 709);
define('BOOKING_EXPIRED', 710);
define('NOT_ENOUGH_PARTYPOINTS', 711);
define('USER_ALREADY_GUESTLISTED', 712);
define('INVALID_SIGNATURE', 713);
define('GUESTLIST_FULL', 714);
define('GUESTLIST_DOESNOT_EXITS', 715);
define('MISSING_REQUEST_HEADERS', 716);
define('CLASS_FILE_NOTFOUND', 717);
define('INVALID_FROM_VALUE', 718);
define('ALREADY_BOOOKED', 719);
define('BOOKING_DOESNOT_EXISTS', 720);
define('INVALID_REFERRAL_CODE', 721);
define('NOT_ELIGIBLE_FOR_REDEEM', 722);
define('DATE_ISO', date("Y-m-d\TH:i:sO", time()));

//arbitrary
define('ARBITRARY_ALPHABET', '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ');

//db config
define('URL', 'http://'.$_SERVER['SERVER_NAME'].'/yodaphp/');
define('IMG_URL', 'http://'.$_SERVER['SERVER_NAME'].'/yodaphp/public/images/');
define('IMG_ABSOLUTE_URL', $_SERVER['DOCUMENT_ROOT'].'/yodaphp/public/images/');

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'db_name');
define('DB_USER', 'db_user');
define('DB_PASS', 'db_pass');