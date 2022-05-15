<?php
    $add= $_POST["address"];
    $lat=$_POST["latitude"];
    $lon=$_POST["longitude"];
    $grp=$_POST["group"];
    $change= $_POST["change"];
    if(empty($lon) && empty($lat) && empty($grp)&& empty($change))
        die("Empty data fields");
    $data=array('address64'=> $add);        
    if(!empty($lat))
        $data['coordinatex']= $lat;
    if(!empty($lon))
        $data['coordinatey']= $lon;
    if(!empty($grp))
        $data['`group`']= $grp;
    if(!empty($change))
        $data['change']= $change;
    echo $lat;
    // echo $data['address']." ";
    // echo $data['latitude']." ";
    // echo $data['longitude']." ";
    // echo $data['group']." ";
    $url = 'http://212.33.118.240:12345/';
    // $data = array('group'=> $_POST['group'],'latitude'=>$_POST['latitude'], 'longitude' => $_POST['longitude']);
    
    // // use key 'http' even if you send the request to https://...
    // $options = array(
    //     'http' => array(
    //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    //         'method'  => 'POST',
    //         'content' => http_build_query($data)
    //     )
    // );
    // $context  = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // if ($result === FALSE) { die("Couldn't reach the coordinator") }
    // var_dump($result);

    $keys=array_keys($data);
    $updateVals="";
    foreach($keys as $key){
        if($key!='address64')
            $updateVals=$updateVals.$key." = '".$data[$key]."' , ";
    }
    $updateVals=trim($updateVals,", ");
    echo $updateVals;
    if(!empty($change))
    {
        echo "Ligh Status changed sucessfully... Redirecting";
        echo "<script type=\"text/javascript\"> window.location.replace(\"Map.php\"); </script>";
    }
    $servername = "localhost";  
    $username = "id18273343_smartdata";
    $password = "proJect##117";
    $database = "id18273343_nodes";
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE Nodes2 SET $updateVals WHERE address64=".$data["address64"];
    // $sql = "UPDATE Nodes SET mode='Dim' WHERE address64=69696969";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully... Redirecting";
        echo "<script type=\"text/javascript\"> window.location.replace(\"Map.php\"); </script>";
    } 
    else {
      echo "Error updating record: " . $conn->error;
    }
    $conn->close();
?>