<html>
    <body>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
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
        ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="​Online music education, ​Music Education, What We Do, ​Performances &amp;amp; Activities, Music School, Music psychology and conducting pedagogy, Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Data Analysis</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Home.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.2.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/c3eeba117a87fc8896a1651687b5dae4e03ab9bac7390bdb09f2b620bb9aed7ac0c74310ac98c44e151b0d757514f907f9cad02aea89cc3d5f519b_1280.png"
}</script>
    <meta name="theme-color" content="#3e588b">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-8c91"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Home.html" class="u-image u-logo u-image-1" data-image-width="1244" data-image-height="1280">
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
      </div></header> 
<form action="analytics.php" method="POST" class="u-clearfix u-form-custom-backend u-form-spacing-30 u-form-vertical u-inner-form" source="custom" name="form-3" style="padding: 10px;">
                          
                          <div class="u-form-group u-form-password">
                            <label for="password-5b0a" class="u-form-control-hidden u-label"></label>
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
                                    $sql2="SELECT * FROM Nodes2";
                                    $result = $conn->query($sql2);
                                    if ($result->num_rows > 0) {
                                        echo"<select name='street' id = 'myList' >";                                        
                                    /*
                                        * Whenever an option from the drop down s selected, go to relocate()
                                        */
                                        $streets=array();
                                        while($row = $result->fetch_assoc()) {                                                    
                                        /*put value in div and accompany it with a spacerino*/
                                            if(!in_array($row['streetName'], $streets))
                                            {
                                                echo "<option>".$row['streetName']."</option>";  
                                                array_push($streets,$row['streetName']);
                                            }
                                        } 
                                        echo "</select>";                                                                             
                                    }
                                    /*If there are no results*/
                                    else {
                                        echo "0 results";
                                    }
                                    
                            ?>

                            <!--<select name="period" id = "myList1" ><option> ---Show Results for last--- </option>-->
                            <!--    <option> DAY </option>-->
                            <!--    <option> WEEK </option>-->
                            <!--    <option> MONTH </option>-->
                            <!--    <option> YEAR </option>-->
                            <!--</select>-->
                            <label for="start">Start date:</label>
                            <input type="date" id="start" name="start"
                               value="2022-01-01"
                               min="2022-01-01" max="2030-12-31">
                           <label for="start">End date:</label>
                            <input type="date" id="end" name="end"
                               value="2040-12-31"
                               min="2022-01-01" max="2040-12-31">
                               <input type="submit" value="submit">
                          </div>

                          <input type="hidden" value="" name="recaptchaResponse">
                        </form>
    <div id="myPlot"></div>
    <script type="text/javascript" src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
        //var mysql = require('mysql');            
        puss=`    <?php
                
                $conn = new mysqli($servername, $username, $password, $database);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
            $street=$_POST["street"];
            $street=str_replace(' ', '', $street); //Remove spaces.
            $period=$_POST["period"];
            $start="'".$_POST["start"]."'";
            $end="'".$_POST["end"]."'";
            // $sql2="SELECT * FROM $street WHERE rep_date BETWEEN SUBDATE(CURDATE(), INTERVAL 1 $period) AND NOW()";
            $sql2="SELECT * FROM $street WHERE rep_date BETWEEN  $start and $end";
             $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
                
            /*
             * Whenever an option from the drop down s selected, go to relocate()
             */
                $allresults="";
                while($row = $result->fetch_assoc()) {
                            
                /*put value in div and accompany it with a spacerino*/
                $allresults=$allresults.$row["traffic"]." ".$row["rep_date"]."#"; 
                
                }
                echo $allresults;
                    
            
            }
        /*If there are no results*/
        else {
            echo "0 results";
        }
                
 
     ?>`;
    puss = puss.slice(0, -1);
    splitted=puss.split("#");
    const keys = splitted.keys();
    console.log(splitted[0]);
    
    let text = "";
    xarr=[];
    yarr=[];
    last=-1;
    for (let i of keys) {
        // if(i==0)
        //     continue;
        splitAgain=splitted[i].trim().split(" ");
        splitx=String(splitAgain[2]).split(":");
        //addone= parseInt(splitx[0])
        time=parseInt(splitx[0])+2;
        index=xarr.indexOf(time)//returns -1 if not found
        if(index!=-1)
        {
            yarr[index]=(parseInt(splitAgain[0])+yarr[index])/2
            continue;
        }
        last=time;
        xarr.push(time);
        yarr.push(parseInt(splitAgain[0]));
        console.log("splitagain:"+splitAgain[1]);
      
    }
    console.log(yarr[0]);
     

        var xArray = [50,60,70,80,90,100,110,120,130,140,150];
        var yArray = [7,8,8,9,9,9,10,11,14,14,15];
        console.log(yArray[0]);
        
        // Define Data
        var data = [{
          x: xarr,
          y: yarr,
        //   mode:"lines",
          type:"bar"
        }];
        
        // Define Layout
        var layout = {
          xaxis: {range: [0, 23], title: "Hour"},
          yaxis: {range: [0, 50], title: "Traffic"},
          title: "Traffic density each hour between the dates <?php echo $_POST['start']." and ".$_POST['end'];?> "
        };
        
        Plotly.newPlot("myPlot", data, layout);
    </script>
    
  <a href="https://smartifymystreets.000webhostapp.com/Map.php" class="u-border-2 u-border-hover-palette-1-base u-border-palette-1-base u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1" onclick="const d = new Date(); d.setTime(d.getTime() + (30*1000)); let expires = 'expires='+ d.toUTCString();document.cookie = 'us=0;' + expires + ';path=/';">Log out</a>
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-3e8e"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Created By:<br>Ahmad Mansour<br>Saeed Abdulraheem<br>Waseem Hueih
        </p>
        <p class="u-text u-text-2">Supervised By:<br>Dr. Iyad Tumar
        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>Website Templates</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/website-builder" target="_blank">
        <span>Best Website Builder</span>
      </a>. 
    </section>
  </body>
</html>