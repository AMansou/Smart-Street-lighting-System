
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_611AsjGNv3Sg9biUOv7g8wD-U_w8D14"></script>
    <?php
        error_reporting(E_ALL ^ E_NOTICE);
         if (($_POST["username"]!="user" || $_POST["password"]!="pass"))
        {
                echo "<script type=\"text/javascript\">
                let x = document.cookie;
                if(!x.includes(\"us=1\"))
                    window.location.replace(\"Login.html\"); 
                </script>";
        }
        else
        {
            echo "<script type=\"text/javascript\">
            const d = new Date();
            d.setTime(d.getTime() + (3600*1000));
            let expires = \"expires=\"+ d.toUTCString();
            document.cookie = \"us=1;\" + expires + \";path=/\";
            
            console.log(document.cookie);
            </script>";
        }
        /****************************************************************************
         * First enter the database info, then connect to it and report any errors
         ****************************************************************************/
        $servername = "localhost";
        $username = "id18273343_smartdata";
        $password = "proJect##117";
        $database = "id18273343_nodes";
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        /***************************************************************************************************
         * Now, fetch all the nodes from "Nodes" table and store them in different (hidden) divs with 
         * different ids so you can retrieve them later using JS
         * **************************************************************************************************/
        $sql2="SELECT * FROM Nodes2";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
          // output data of each row
            $handle = fopen("entries.txt", "w") or die("Unable to open file!");
            $cnt=0;
            /*Loop through each entry in the table*/
            while($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                /*make the id of each div equal to current value of counter and make the div hidden*/
                echo "<div id=".$cnt." hidden>";
                $cnt+=1;
                /* for each value of a given entry*/
                foreach($row as $value){ 
                            
                fwrite($handle, $value." ");//Never mind this, will remove later
                /*put value in div and accompany it with a spacerino*/
                echo $value."#"; 
                
                }
                fwrite($handle, "\n");
                /*Close the div and move on to the next node*/
                echo "</div>";
            }
            /*Create a div that contains the string "stop" after being done with all the nodes
             * to know when to stop when retrieving the divs
             */
            echo "<div hidden id=".$cnt.">stop</div>";
    ?>
       
            <script type="text/javascript">

        var num=0;
        var t = document.getElementById(num.toString()).textContent;
        /*
         * Give the link for the icons to be used as markers, then resize them
         */
        var broken = {
            url: "broken.png", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
        };
        var bulb = {
            url: "bulb.png", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
        };
        /********************************************************************************************
         * This is run when page loads. centers the map, puts a marker in the location of each node
         * and creates an information box whenever a marker is selected
         *********************************************************************************************/ 
        function InitMap() {
            var i=0;
            //https://maps.googleapis.com/maps/api/geocode/json?latlng=31.9009880,35.1995810&key=AIzaSyA_611AsjGNv3Sg9biUOv7g8wD-U_w8D14
            
            /*select the first node whose information is stored in the div whith id=i=0*/
            var t = document.getElementById(i.toString()).textContent;
            /*Create a map object and center it around the first node's location*/
            var map = new google.maps.Map(document.getElementById('map'), {
                //mapId: "8e0a97af9386fef",
                zoom: 18,
                center: new google.maps.LatLng( t.split("#")[3], t.split("#")[4]),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infowindow = new google.maps.InfoWindow();
            var marker;
            /*Iterate through the nodes and create a marker in the loation for each*/
            while(true) {
                var t = document.getElementById(i.toString()).textContent;
                /*If you found the last node, break*/
                if(t==="stop"){
                    i+=1;
                    break;
                }
                splitted=t.split("#");
                /*
                 * The 5th element of the node information is the "working" attribute. If the node isn't working,
                 * give it the broken marker
                 */
                if(splitted[1]=="0") 
                {    marker = new google.maps.Marker({
                        position: new google.maps.LatLng( splitted[3], splitted[4]),
                        map: map,
                        icon: broken
                    });
                }
                /*Else, give it the regular bulb marker*/
                else
                {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng( splitted[3], splitted[4]),
                    map: map,
                    icon: bulb
                });
                }
                /*if the marker is clicked, display the node's information*/
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        // infowindow.setContent("Type: Router<br/>16-bit address:ab-cd<br/>64-bit address:ab-cd-ef-ab-cd-ef-12-34<br/>State: Dim mode<br/>Traffic Frequency: 13 cars every hour");
                        var t = document.getElementById(i.toString()).textContent;
                        splitted=t.split("#");
                        if(splitted[1]=='0')
                            working="Warning: LED is down";
                        else
                            working="LED is working properly";
                        if (splitted[2]=='0')
                            available="Warning: This node can't be reached by the network";
                        else
                            available="This node is reachable by the rest of the network";
                        infowindow.setContent("64-bit Address: "+ splitted[0]+"<br>" +working
                        +"<br>" + available + "<br>Street: "
                        +splitted[5]+ "<br>Device Added On: " + splitted[9]+`<br> 
                        <form style="display: inline" action="send.php" method="post">
                        group: <input type="text" name="group" Value="`+splitted[6]+`"><br>
                        Latitude: <input type="text" name="latitude" Value="`+splitted[3]+`"><br>
                        Longitude: <input type="text" name="longitude" Value="`+splitted[4]+`"><br>
                        <input type="hidden" name="address" Value="`+splitted[0]+`"><br>
                        <input type="submit" Value="Save changes">
                        </form> <form style="display: inline" action="send.php" method="post"><input type="hidden" name="change" Value="turnOn"><input type="submit" Value="Turn it on"></form><form style="display: inline" action="send.php" method="post"><input type="hidden" name="change" Value="turnOff"><input type="submit" Value="Turn it off"></form> `);
                        
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                i+=1;
            }
        }
        /*********************************************************************************************
         * This is run when the user chooses one of the broken nodes, it relocates him to the marker
         * of the selected node
         *********************************************************************************************/
        function relocate(coordx,coordy)
        {
            c='a';
            cnt=0;
            if(coordx==""){
                var mylist = document.getElementById("myList");  
                coord=mylist.options[mylist.selectedIndex].text.split("(")[1].split(")")[0];
                coordx=coord.split(",")[0];
                coordy=coord.split(",")[1];
            }
            //console.log(coord);
            //console.log(c);
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: new google.maps.LatLng( coordx, coordy),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var i=0;
            var infowindow = new google.maps.InfoWindow();
            var marker;
            while(true) {
                var t = document.getElementById(i.toString()).textContent;
                if(t==="stop"){
                    i+=1;
                    break;
                }
                splitted=t.split("#");
                if(splitted[1]=="0")
                {    marker = new google.maps.Marker({
                        position: new google.maps.LatLng( splitted[3], splitted[4]),
                        map: map,
                        icon: broken
                    });
                }
                else
                {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng( splitted[3], splitted[4]),
                        map: map,
                        icon: bulb
                    });
                }
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        // infowindow.setContent("Type: Router<br/>16-bit address:ab-cd<br/>64-bit address:ab-cd-ef-ab-cd-ef-12-34<br/>State: Dim mode<br/>Traffic Frequency: 13 cars every hour");
                        var t = document.getElementById(i.toString()).textContent;
                        splitted=t.split("#");
                        if(splitted[1]=='0')
                            working="Warning: LED is down";
                        else
                            working="LED is working properly";
                        if (splitted[2]=='0')
                            available="Warning: This node can't be reached by the network";
                        else
                            available="This node is reachable by the rest of the network";
                        infowindow.setContent("64-bit Address: "+ splitted[0]+"<br>" +working
                        +"<br>" + available + "<br>Street: "
                        +splitted[5]+ "<br>Device Added On: " + splitted[9]+`<br> 
                        <form style="display: inline" action="send.php" method="post">
                        group: <input type="text" name="group" Value="`+splitted[6]+`"><br>
                        Latitude: <input type="text" name="latitude" Value="`+splitted[3]+`"><br>
                        Longitude: <input type="text" name="longitude" Value="`+splitted[4]+`"><br>
                        <input type="hidden" name="address" Value="`+splitted[0]+`"><br>
                        <input type="submit" Value="Save changes">
                        </form> <form style="display: inline" action="send.php" method="post"><input type="hidden" name="change" Value="turnOn"><input type="submit" Value="Turn it on"></form><form style="display: inline" action="send.php" method="post"><input type="hidden" name="change" Value="turnOff"><input type="submit" Value="Turn it off"></form> `);
                        
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                i+=1;
            }
            
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Map Of Smart Lighting Nodes, Please select&nbsp; a node from below to locate it:">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Map</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Map.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.2.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400|Roboto+Condensed:300,300i,400,400i,700,700i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/c3eeba117a87fc8896a1651687b5dae4e03ab9bac7390bdb09f2b620bb9aed7ac0c74310ac98c44e151b0d757514f907f9cad02aea89cc3d5f519b_1280.png"
}</script>
    <meta name="theme-color" content="#3e588b">
    <meta property="og:title" content="Map">
    <meta property="og:type" content="website">
  </head>
  <body onload="InitMap();" class="u-body"><header class="u-clearfix u-header u-header" id="sec-8c91"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://smartifymystreets.000webhostapp.com/" class="u-image u-logo u-image-1" data-image-width="1244" data-image-height="1280">
          <img src="images/c3eeba117a87fc8896a1651687b5dae4e03ab9bac7390bdb09f2b620bb9aed7ac0c74310ac98c44e151b0d757514f907f9cad02aea89cc3d5f519b_1280.png" class="u-logo-image u-logo-image-1">
        </a>
        
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1" data-responsive-from="XL">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 500;">
            <a class="u-button-style u-custom-active-color u-custom-border u-custom-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-file-icon u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base u-file-icon-1" href="#">
              <img src="images/3388837.png" alt="">
            </a>
          </div>
          <div class="u-nav-container">
            <ul class="u-nav u-spacing-2 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-active-grey-5 u-button-style u-hover-grey-10 u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-active-grey-5 u-button-style u-hover-grey-10 u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="Map.php" style="padding: 10px 20px;">Map</a>
</li><li class="u-nav-item"><a class="u-active-grey-5 u-button-style u-hover-grey-10 u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="analytics.php" style="padding: 10px 20px;">Data Analysis</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Map.php" style="padding: 10px 20px;">Map</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="analytics.php" style="padding: 10px 20px;">Data Analysis</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
          
        </nav>
        
      </div>
      
      </header>
                  <?php
                        /*******************************************************************************************
             * Retrieving the nodes that don't work in order to display them in a dropdown menu for
             * the user to select. Once the user selects a node, the map should be recentered around
             * that node
             *******************************************************************************************/
            $sql2="SELECT * FROM Nodes2 WHERE working=0";
            $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
            /*
             * Whenever an option from the drop down s selected, go to relocate()
             */
            echo "<select id = \"myList\" onchange = \"relocate('','')\" ><option> ---Nodes that are currently down--- </option> ";
            $cnt=0;
            /*Again, iterate through all entries returned by the query*/
            while($row = $result->fetch_assoc()) {
                /*enter an option for each entry. ids are useless here. Will remove later*/
                echo "<option id=a".$cnt.">64-bit address: ".$row["address64"]." (". $row["coordinatex"].",".$row["coordinatey"].") </option>";
                $cnt+=1;
                

            }
            echo"<option hidden id=a".$cnt.">stop</option>";
            /*End select*/
            echo "</select>";
                
            }
            fclose($handle);
        }
        /*If there are no results*/
        else {
            echo "0 results";
        }
        /*Close connection*/
        $conn->close();
            ?>
    <section class="u-clearfix u-section-1" id="carousel_a822">
        
      <div class="u-absolute-hcenter u-expanded u-grey-10 u-map">
          
        <div class="embed-responsive">

            <div id="map" style="height: 800px; width: auto;">
    </div>
        </div>
      </div>
      <h2 class="u-custom-font u-font-lobster u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-1">Map Of Smart Lighting Nodes</h2>
 

    </section>
    <style>
.centr {
  border-collapse: collapse;
  border: 1px solid black;
  	text-align: center;
	vertical-align: middle;
    margin-left: auto;
    margin-right: auto;
}

th, td {
  padding: 8px;
}
    .cell-highlight {
  background-color: gold;
  font-weight: bold;
}

tbody tr:nth-child(odd) {
  background-color: #fff;
}

tbody tr:nth-child(even) {
  background-color: #eee;
}
caption {
  font-weight: bold;
  font-size: 24px;
  text-align: center;
  color: #333;
}
th {
  background-color: #333;
  color: white;
  	font-size: 0.875rem;
	text-transform: uppercase;
	letter-spacing: 2%;
}
    </style>
        <table class=centr id="myTable" >
        <caption>   Table of Smart Lighting Nodes</caption>
          <tr>
            <th>64-bit Address</th>
            <th>Coordinates</th>
            <th>Street</th>
            <th>Group</th>
            <th>LED Status</th>
            <th>Network Status</th>
          </tr>
        </table>
        <!--<div style="text-align:center;">-->
        
        <!--</div>-->
        <script>
        i=0;
        while(true) {
                var t = document.getElementById(i.toString()).textContent;
                /*If you found the last node, break*/
                if(t==="stop"){
                    i+=1;
                    break;
                }
                splitted=t.split("#");
                console.log(t);
                var table = document.getElementById("myTable");
                var row = table.insertRow(i+1);
                var address = row.insertCell(0);
                var coordinates = row.insertCell(1);
                var street = row.insertCell(2);
                var group = row.insertCell(3);
                var led = row.insertCell(4);
                var network = row.insertCell(5);
                address.innerHTML = "<a href='#' onclick='relocate("+splitted[3]+","+splitted[4]+")'>"+splitted[0]+"</a>";
                coordinates.innerHTML = "<form action=\"send.php\" method=\"post\"> <input type=\"text\" name=\"latitude\" Value=\""+splitted[3]+"\" size='8'> , <input size='8' type=\"text\" name=\"longitude\" Value=\""+splitted[4]+"\"><input type=\"hidden\" name=\"address\" Value=\""+splitted[0]+"\"> <input type=\"submit\" Value=\"Save\"></form>";
                street.innerHTML =splitted[5];
                group.innerHTML = "<form action=\"send.php\" method=\"post\"><input size='8' type=\"text\" name=\"group\" Value=\""+ splitted[6]+"\"><input type=\"hidden\" name=\"address\" Value=\""+splitted[0]+"\"> <input type=\"submit\" Value=\"Save\"></form>";
                led.innerHTML = splitted[1];
                network.innerHTML = splitted[2];
                i+=1;
        }
        </script>
          <a href="https://smartifymystreets.000webhostapp.com/Map.php" class="u-border-2 u-border-hover-palette-1-base u-border-palette-1-base u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1" onclick="const d = new Date(); d.setTime(d.getTime() + (30*1000)); let expires = 'expires='+ d.toUTCString();document.cookie = 'us=0;' + expires + ';path=/';">Log out</a>
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-3e8e"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Created By:<br>Ahmad Mansour<br>Saeed Abdulraheem<br>Waseem Hueih
        </p>
        <p class="u-text u-text-2">Supervised By:<br>Dr. Iyad Tumar
        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-design" target="_blank">
        <span>Free Website Design</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.dev" target="_blank">
        <span>Best Free Website Builder</span>
      </a>. 
    </section>

  </body>
</html>