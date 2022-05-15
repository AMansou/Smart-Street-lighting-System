<html>
    <body>
    <?php
            $filename = "website.php";
            $servername = "localhost";
            $username = "id18273343_smartdata";
            $password = "proJect##117";
            $database = "id18273343_nodes";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo $_POST['Testing'];
                $s1 = $_POST['New'];//new node
                $s2 = $_POST['Update'];//A node wants to update one of it's values in the database
                $s3=  $_POST['Report'];//traffic report
                //$s4=  $_POST['Current'];
                $s4=  $_POST['Next']; //The node is requesting which addresses to turn on when a car passes it by
                //$handle = fopen($filename, "w") or die("Unable to open file!");
                //fwrite($handle, $s1);
                //fwrite($handle, $s2);
                //fclose($handle);
                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                $sql = "CREATE TABLE IF NOT EXISTS Nodes2 (
                address64 BIGINT UNSIGNED NOT NULL PRIMARY KEY,
                working BOOLEAN Default 1,
                reachable BOOLEAN Default 1,
                coordinatex DOUBLE(10,7) NOT NULL,
                coordinatey DOUBLE(10,7) NOT NULL,
                streetName VARCHAR(30),
                address16 INT UNSIGNED,
                deviceType VARCHAR(10),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                if ($conn->query($sql) === TRUE) {
                  echo "Table Nodes2 created successfully";
                } else {
                  echo "Error creating Nodes2 table: " . $conn->error;
                }
                if(!empty($s1)) //Insert New node, and create a table for the street it's in (If not created yet)
                {
                    $vals=explode("#",$s1);
                    foreach($vals as $value){
                        echo $value . " ";}
                    /* Get the street name and store it in $street */
                    //trim the quotation marks
                    $lat = trim($vals[1],"\"");
                    $lng = trim($vals[2],"\"");
                
                    $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&key=AIzaSyA_611AsjGNv3Sg9biUOv7g8wD-U_w8D14';
                    $json = @file_get_contents($url);
                    $data = json_decode($json);
                    $status = $data->status;
                    if($status=="OK") {
                        //Get address from json data
                        for ($j=0;$j<count($data->results[0]->address_components);$j++) {
                            $cn=array($data->results[0]->address_components[$j]->types[0]);
                            if(in_array("route", $cn)) {
                                $street= $data->results[0]->address_components[$j]->long_name;
                            }
                        }
                      } else{
                        echo 'Location Not Found';
                        $street="Not found";
                      }
                      //Print street
                      echo $street;
                      $streetIns="\"".$street."\"";
                    /* Insert Values along with the street's name*/
                    $sql = "INSERT INTO Nodes2 (address64,coordinatex,coordinatey, deviceType,streetName )
                    VALUES ($vals[0], $vals[1], $vals[2] , $vals[3],$streetIns)";
                    if ($conn->query($sql) === TRUE) {
                      echo "Table Nodes2 inserted into successfully";
                      /*
                       * After making sure the insertion was completed successfully,
                       * Create a table (IF NOT EXISTS) for the node's street.
                       * The street table should contain entries for how much traffic and current
                       * have passed through/was consumed since the last entry
                       */
                      $street=str_replace(' ', '', $street); 
                      $sql = "CREATE TABLE IF NOT EXISTS $street (
                        traffic INT UNSIGNED,
                        current DOUBLE(6,3),
                        rep_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP PRIMARY KEY
                        )";
                        if ($conn->query($sql) === TRUE) {
                          echo "Table $street created successfully";
                        } else {
                          echo "Error creating $street table: " . $conn->error;
                        }
                    } 
                    else {
                      echo "Error inserting to table: " . $conn->error;
                      // $sql="UPDATE Nodes2 SET reachable='1', coordinatex=".$vals[1]." coordinatey=".$vals[2]." group=".$val[3]." WHERE address64=".$vals[0];
                      // if ($conn->query($sql) === TRUE) {
                      //   echo "Record updated successfully";
                      // } 
                      // else {
                      //   echo "Error updating record: " . $conn->error;
                      // }
                    }
                    $conn->close();
                }
                //update a node value
                else if(!empty($s2))
                {
                    $vals=explode("#",$s2);
                    $sql = "UPDATE Nodes2 SET " .$vals[1]. "=".$vals[2]." WHERE address64=".$vals[0];
                    // $sql = "UPDATE Nodes SET mode='Dim' WHERE address64=69696969";
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                    } 
                    else {
                      echo "Error updating record: " . $conn->error;
                    }
                    $conn->close();
                }
                /*
                 * If a node wants to report some stats, it should format the request as 
                 * add64#traffic#current#speed#direction
                 * Where add64 is the 64-bit address of the reporting node.
                 * As of now, only 'traffic' is implemented.
                 */
                else if(!empty($s3))//
                {
                    // $sql = "UPDATE Nodes2 SET reachable='0' ;
                    // if ($conn->query($sql) === TRUE) {
                    //   echo "Record updated successfully";
                    // } 
                    // else {
                    //   echo "Error updating record: " . $conn->error;
                    // }
                    /* First, find the street correseponding to that 64-bit address */
                    $vals=explode("#",$s3);
                    $street="";
                    // $vals[0]=(float)$vals[0];
                    $sql="SELECT * FROM Nodes2 WHERE address64=$vals[0]";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        
                      while($row = $result->fetch_assoc()) {
                        $street=$row["streetName"];
                      }
                    }
                    /* Now that the street was found, insert the report into its table */
                    $street=str_replace(' ', '', $street); //Remove spaces.
                    $sql = "INSERT INTO $street (traffic)
                    VALUES ($vals[1])";
                    if ($conn->query($sql) === TRUE) {
                      echo "Table $street inserted into successfully";
                    } 
                    else {
                      echo "Error inserting to $street: " . $conn->error;
                    }
                $conn->close();            
               }   
               /* 
                * Next-nodes request:
                * A request to know which nodes to signal to turn on after a node senses motion.
                * Just send a POST request with Next=add64
                */
               else if (!empty($s4))
               {
                 $adds="";
                 $s4=str_replace(' ', '', $s4);
                 /* Find the node that matches the 64-bit address, and store its coordinates and street name */
                 $sql="SELECT * FROM Nodes2 WHERE address64=$s4";
                 $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        $x=$row["coordinatex"];
                        $y=$row["coordinatey"];
                        $street=$row["streetName"];
                      }
                    }
                    //$street=str_replace(' ', '', $street); //Remove spaces.
                    $street="'".$street."'";
                    /* Find the nodes that are on the same street */
                    echo trim($street," ")." AAAAAAA"; 
                    $sql="SELECT * FROM Nodes2 WHERE streetName=$street";
                    $result = $conn->query($sql);
                    $closeNodes=array();
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        $x1=$row["coordinatex"];
                        $y1=$row["coordinatey"];
                        /* Find the distance from the requesting node*/
                        $distance=sqrt(($x-$x1)**2+($y-$y1)**2);
                        //echo $distance;
                        /*
                         * Keep adding to the array of close nodes if it's size is still less than
                         * the number of next-to-light nodes required.
                         * Once the size is full (10 in this case, i.e 200m), find the element
                         * of the array with the longest distance to the requesting node
                         * and replace it with the new distance (only if it's closer).
                         */
                         
                        if(count($closeNodes)<10 && $distance>0)
                          $closeNodes[$row["address64"]]=$distance;
                        else if($distance>0)
                        {
                          $value = max($closeNodes);
                          if($distance<$value){
                            $key = array_search($value, $closeNodes);
                            unset($closeNodes[$key]);
                            $closeNodes[$row["address64"]]=$distance; 
                          }
                        }
                       
                      }
                    }
                    else
                        echo "0 results";
                    //echo $closeNodes[1113231231230]."*";
                    foreach($closeNodes as $value){
                        $adds=$adds.array_search($value, $closeNodes)."#";
                    }
                    echo $adds;
                    $conn->close();  
                  }
                          
            }else{;}   
     ?>
    </body>
</html>