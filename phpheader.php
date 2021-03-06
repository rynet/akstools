<?
// PHP related header items.  Executes before HTTP header is sent.
session_start(); // start a session

// already being called in the page string
// include('settings.php'); // include the settings file

// start up a database connection
$db = new mysqli($database_host, $database_user, $database_pass, $database_name);
// confirm database connected
if($db->connect_errno){ 
	$site_message = 'The site appears to be having database issues.  It is likely there will be problems loading some content, try refreshing the site';
	die('Connection to database server failed.  Please contact ' . $contactemail . ' Error number: ' . $db->connect_error); 
}

// include('functions.php'); // include default functions

// include classes
include('c_userSession.php');

// DEBUG: Turn on PHP error handling
if($mode='debug'){
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}elseif($mode='maint'){
	die('Site is down for maintenance');
}

// initialize user

$user = new userSession(); // start up a user session
$user->initUser(); // initialize the userSession class

// functions

// Function userIDtoname
// takes a userID, returns a username
function userIDtoName($userID){
	global $db;

	$dbR = 	$db->query("SELECT username FROM users WHERE userID = '$userID'");

	if ($dbR->num_rows > 0){
		$row = $dbR->fetch_assoc();
		return $row['username'];
	} else {
		return false; 
	}
}

// Function gameIDtoSN
// takes a $gameID, returns a short name for that game
function gameIDtoSN($gameID){
	global $db;

	$dbR = 	$db->query("SELECT nameShort FROM games WHERE gameID = '$gameID'");

	if ($dbR->num_rows > 0){
		$row = $dbR->fetch_assoc();
		return $row['nameShort'];
	} else {
		return false; 
	}
}
?>

