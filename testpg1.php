<?php

// database access parameters
// alter this as per your configuration
$host = "localhost";
$user = "dba";
$pass = "sql";
$db = "Lider";

// open a connection to the database server
$connection = pg_connect("host=$host dbname=$db user=$user password=$pass");
if (!$connection) {
    die("Could not open connection to database server");
}

// generate and execute a query
//$query = "SELECT * FROM doc";

// this query returns somehow (using cursor) number of rows in the table VARY FAST!
// read more here https://habrahabr.ru/post/30046/
$query = "DECLARE curs CURSOR FOR select id from Doc ;
        MOVE FORWARD 180000 IN curs;
        FETCH 20 FROM curs;
        MOVE FORWARD ALL IN curs;";

//$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

// get the number of rows in the resultset
//$rows = pg_num_rows($result);

//a special command that returns number of rows in $result
$rows = pg_cmdtuples($result);

echo "There are currently $rows records in the database.";
$row2 = pg_fetch_row($result, $i);

// close database connection
pg_close($connection);

function pg_rows_number($connection, $table)
{
    $query = "DECLARE curs CURSOR FOR select id from $table;
        MOVE FORWARD 180000 IN curs;
        FETCH 20 FROM curs;
        MOVE FORWARD ALL IN curs;";

    $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

    //a special command that returns number of rows in $result
    $rows = pg_cmdtuples($result);
    $result = $rows;
}

;

?>