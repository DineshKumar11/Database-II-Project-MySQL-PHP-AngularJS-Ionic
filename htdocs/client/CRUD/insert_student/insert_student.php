<?php
/*
    Author: Son Nguyen && Vivien Chow
    Description: This file insert new student.
    Last Working Date: April-07-2016
    File: insert_json.php
*/



$postData = file_get_contents("php://input");
$dataObject = json_decode($postData);

$servername = "localhost";
$username = "Thomas";
$password = "123456";
$dbname = "DB_II";

// Create connection
$conn = mysql_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $conn);

// Escape user inputs for security
$SID = mysql_real_escape_string($dataObject->SID);
$name = mysql_real_escape_string($dataObject->name);
$IID = mysql_real_escape_string($dataObject->IID);
$major = mysql_real_escape_string($dataObject->major);
$degreeHeld = mysql_real_escape_string($dataObject->degreeHeld);
$career = mysql_real_escape_string($dataObject->career);

$myfile = fopen("testfile.txt", "w") or die("Unable to open file!");
$txt = $SID . " " . $name . " " . $IID . " " . $major . " " . $degreeHeld . " " . $career . "\n";
fwrite($myfile, $txt);


$sql = "INSERT INTO `students` (`SID`, `name`, `IID`, `major`, `degreeHeld`, `career`) VALUES
        (" . $SID . ", '" .$name. "'," .$IID. ", '" .$major. "', '" . $degreeHeld . "', '" . $career. "')";


fwrite($myfile, $sql);

mysql_query($sql);

fclose($myfile);
mysql_close($conn);
?>
