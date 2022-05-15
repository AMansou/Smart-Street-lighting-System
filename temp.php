<!-- <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=31.901644, 35.200804+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/sport-gps/">gps watches</a></iframe></div> -->
<!DOCTYPE html>
<html>
<head>
    <title>Smaritfy My Streets</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_611AsjGNv3Sg9biUOv7g8wD-U_w8D14"></script>
        <?php
        $servername = "localhost";
        $username = "id18273343_smartdata";
        $password = "proJect##117";
        $database = "id18273343_nodes";
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        //echo $contents;
        $sql2="SELECT * FROM Nodes1";
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
        ?>
        <script type="text/javascript">
        var locations = [
            ['Raj Ghat', <?php echo 31.900988?>, 35.199581, 1],
            ['Purana Qila', 31.901080, 35.199731, 2],
 
        ];
        function InitMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: new google.maps.LatLng( 31.901080, 35.199731),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        // infowindow.setContent("Type: Router<br/>16-bit address:ab-cd<br/>64-bit address:ab-cd-ef-ab-cd-ef-12-34<br/>State: Dim mode<br/>Traffic Frequency: 13 cars every hour");
                        infowindow.setContent(`
                        <?php echo 'ooga';
                        ?>`);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>
</head>
<body onload="InitMap();">
    <h1>Smartify My Streets</h1>
    <div id="map" style="height: 500px; width: auto;">
    </div>
    <div> <?php echo "I was a gentlmen livin in tentements, now I'm swimming in all thw omen that be tens" ?></div>
</body>
</html>