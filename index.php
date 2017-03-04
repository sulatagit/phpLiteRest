<?php

/*
 * phpLiteRest is a PHP + SQLite3 RESTful API, developed by Sulata iSoft - www.sulata.com.pk
 * It has been kept as simple as possible to use and supports SQL input.
 * The only thing you need to change in the script is database configurations and API Key below.
 * For a clean JSON output, errors have delierately been suppressed using @ sign.
 * The variables used are $_POST['sql'], $_POST['api_key'], $_POST['debug']
 * Creation date: March 4, 2017.
 */

#############################################
#############################################
/* DATABASE CONFIGURATIONS */
define('DB_PATH', 'DB_PATH'); //Database host, leave unchanged if in doubt
/* API KEY */
define('API_KEY', 'API_KEY'); //API Key, must be at least 32 characters
#############################################
#############################################

/* * * DO NOT EDIT BELOW THIS LINE * * */

/* SET/INCREASE SERVER TIMEOUT TIME */
set_time_limit(0);

/* ERROR REPORTING */
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (isset($_POST['debug'])) {
    $debug = strtolower($_POST['debug']);
    if (($debug == 'true') || (($debug == '1'))) {
        $debug = TRUE;
    } else {
        $debug = FALSE;
    }
} else {
    $debug = FALSE;
}


/* VARIABLES */
//API KEY
if (isset($_POST['api_key'])) {
    $apiKey = $_POST['api_key'];
} else {
    $apiKey = '';
}

//SQL query
if (isset($_POST['sql'])) {
    $sql = $_POST['sql'];
} else {
    $sql = '';
}

//Build action: select, insert, update or delete
$do = trim($sql);
$do = explode(' ', $do);
$do = strtolower($do[0]);

$response = array(); //Error, result, record count, message
$response['connect_error'] = 0;
$response['errno'] = 0;

/* ERROR MESSAGES */
define('INVALID_API_KEY', 'Invalid API Key.');
define('INVALID_API_KEY_LENGTH', 'The API Key must be at least 32 characters.');

/* CHECK AND VALIDATE API KEY */
if (strlen(API_KEY) < 32) {
    exit(INVALID_API_KEY_LENGTH);
}


if (!isset($apiKey) || ($apiKey != API_KEY)) {
    exit(INVALID_API_KEY);
} else {

    /* CONNECTION STRING */
    $cn = new SQLite3(DB_PATH);
    if (!$cn) {
        if ($debug == TRUE) {
            $response['connect_error'] = $cn->lastErrorMsg();
            $response['connect_errorno'] = $cn->lastErrorCode();
        } else {
            $response['connect_errorno'] = $cn->lastErrorCode();
        }
    }
    /* SELECT CODE */
    if ($do == 'select') {
        $result = @$cn->query($sql);
        if (!$result) {
            if ($debug == TRUE) {
                $response['error'] = $cn->lastErrorMsg();
                $response['errno'] = $cn->lastErrorCode();
            } else {
                $response['errno'] = $cn->lastErrorCode();
            }
        } else {
            $response['num_rows'] = @$cn->lastErrorMsg();
            //Return result
            while ($row = @$result->fetchArray()) {
                $response['result'][] = $row;
            }
        }

        /* INSERT CODE */
    } elseif ($do == 'insert') {
        if (!@$cn->exec($sql)) {
            if ($debug == TRUE) {
                $response['error'] = @$cn->lastErrorMsg();
                $response['errno'] = @$cn->lastErrorCode();
            } else {
                $response['errno'] = @$cn->lastErrorCode();
            }
            //Get duplicate errors
            if (@$cn->lastErrorCode() == 19) {
                $response['errno'] = @$cn->lastErrorCode();
            }
        } else {
            //Get insert ID
            $response['insert_id'] = @$cn->lastInsertRowID();
        }
        /* UPDATE CODE */
    } elseif ($do == 'update') {
        if (!@$cn->exec($sql)) {
            if ($debug == TRUE) {
                $response['error'] = @$cn->lastErrorMsg();
                $response['errno'] = @$cn->lastErrorCode();
            } else {
                $response['errno'] = @$cn->lastErrorCode();
            }
            //Get duplicate errors
            if (@$cn->lastErrorCode() == 19) {
                $response['errno'] = @$cn->lastErrorCode();
            }
        } else {
            //Get affected rows
            $response['affected_rows'] = @$cn->changes();
        }
        /* DELETE CODE */
    } elseif ($do == 'delete') {
        if (!@$cn->exec($sql)) {
            if ($debug == TRUE) {
                $response['error'] = @$cn->lastErrorMsg();
                $response['errno'] = @$cn->lastErrorCode();
            } else {
                $response['errno'] = @$cn->lastErrorCode();
            }
            //Get duplicate errors
            if (@$cn->lastErrorCode() == 19) {
                $response['errno'] = @$cn->lastErrorCode();
            }
        } else {
            //Get affected rows
            $response['affected_rows'] = @$cn->changes();
        }
    } else {
        if ($debug == TRUE) {
            $response['error'] = 'The sql can only be of select, add, update or delete type';
            $response['errno'] = '1000000';
        } else {
            $response['errno'] = '1000000';
        }
    }
    //Close DB
    @$cn->close();
    /* OUTPUT JSON */
    header('Content-Type: application/json');
    echo json_encode($response);
}
    