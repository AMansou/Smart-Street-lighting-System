<html>
    <body>
    <?php
            $filename = "data.txt";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $s1 = 'New Node: '.$_POST['NEW']."\r\n";
                $handle = fopen($filename, "w") or die("Unable to open file!");
                fwrite($handle, $s1);
                fclose($handle);
            }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                echo $contents;
                fclose($handle);
            }else{;}           
            $servername = "localhost";
            $username = "id18273343_smartdata";
            $password = "proJect##117";
            $database = "id18273343_nodes";

            // Create connection
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS Nodes1 (
address64 BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
address16 INT UNSIGNED NOT NULL,
deviceType VARCHAR(30),
coordinatex DOUBLE(10,7),
coordinatey DOUBLE(10,7),
working BOOLEAN NOT NULL,
mode VARCHAR(30),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Nodes1 created successfully";
} else {
  echo "Error creating Nodes1 table: " . $conn->error;
}

$conn->close();
     ?>
     
    </body>
</html>