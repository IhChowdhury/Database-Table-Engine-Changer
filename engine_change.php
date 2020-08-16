<h1>MyISAM to Innodb Changer</h1>

<?php

$DBHOST = 'localhost';
$DBPORT = '3306';
$DBUSERNAME = 'root';
$DBPASSWORD = '';
$DBNAME = 'mysheba-dev';

$mysqliConn = new mysqli($DBHOST . ':' . $DBPORT, $DBUSERNAME, $DBPASSWORD, $DBNAME);

if ($mysqliConn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $mysqliConn->query("SELECT TABLE_NAME,ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA='".$DBNAME."'");
// ALTER TABLE agent_message ENGINE=InnoDB
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {   
      echo "TABLE_NAME: " . $row["TABLE_NAME"]. " - ENGINE: " . $row["ENGINE"]. "<br>";
      
        if($row["ENGINE"] == 'MyISAM'){
            $changeEngineQuery = "ALTER TABLE ".$row["TABLE_NAME"]." ENGINE = INNODB;";
            $mysqliConn->query($changeEngineQuery);

            echo $row["TABLE_NAME"]." has chabged to InnoDB";
        }
    }
} else {
    echo "0 results";
}

die(0);