<html>
    <body>
    <?php
            $filename = "data.txt";
            $servername = "localhost";
            $username = "id18273343_smartdata";
            $password = "proJect##117";
            $database = "id18273343_nodes";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $s1 = $_POST['New'];
                $s2 = $_POST['Update'];
                $handle = fopen($filename, "w") or die("Unable to open file!");
                fwrite($handle, $s1);
                //fwrite($handle, $s2);
                fclose($handle);
                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                if(!empty($s1))
                {
                    $vals=explode("#",$s1);
                    //Our SQL query that will alter the table and add the new column.
                    $sql = "INSERT INTO Nodes (address64, address16, working, mode, reg_date,type)
                    VALUES ($vals[0], $vals[1],$vals[2] ,$vals[3],$vals[4], $vals[5])";

                    $sql = "INSERT INTO Nodes1 (address64, address16,deviceType,coordinatex,coordinatey, working, mode, )
                    VALUES ($vals[0], $vals[1], $vals[2] , $vals[3], $vals[4], $vals[5], $vals[6])";
                    if ($conn->query($sql) === TRUE) {

                    if ($conn->query($sql) === TRUE) {
                      echo "Table MyGuests created successfully";
                    } else {
                      echo "Error creating table: " . $conn->error;
                    }
                    $conn->close();
                }
                else if(!empty($s2))
                {
                    $vals=explode("#",$s2);
                    $sql = "UPDATE Nodes SET " .$vals[1]. "=".$vals[2]." WHERE address64=".$vals[0];
                    // $sql = "UPDATE Nodes SET mode='Dim' WHERE address64=69696969";
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                    } 
                    else {
                      echo "Error updating record: " . $conn->error;
                    }
                    $conn->close();
                }

            }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $handle = fopen($filename, "r");
                //$contents = fread($handle, filesize($filename));
                $conn = new mysqli($servername, $username, $password, $database);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                //echo $contents;
                $sql2="SELECT * FROM Nodes";
                
                $result = $conn->query($sql2);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                    while($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                        foreach($row as $value){
                            echo $value . " ";
                        }
                        echo "<br>";
                    }
                }
                else {
                    echo "0 results";
                }
            
            $conn->close();
                
                fclose($handle);
            }else{;}   
            
            
            

     ?>
     
    </body>
</html>