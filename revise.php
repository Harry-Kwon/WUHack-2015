<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="revise.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    
    <body>
        <div class="nav">
            <div class="logo"> 
                <a href="index.html"> Reviser</a>
            </div>
            <div class="container">
                
                <ul>
                    <li> <a href="write.html"> Write </a></li>
                    <li> <a href="revise.html"> Revise </a></li>
                    <li> <a href="#"> Prompts </a></li>
                </ul>
                
                <ul>
                    <li> <a href="#"> Sign In </a></li>
                    <li> <a href="#"> Profile </a></li>
                </ul>
            </div>
        </div>
        
        <div id="list">
            <ul>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = file_get_contents("SQLPwKey.txt");
                $password = substr($password, 0, strlen($password)-1);
                $dbname = "essaysDB";

                //create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                //Check connection
                if(!$conn) {
                    die("Connection failed: " . mysqli_connect_error($conn));
                }

                $sql = "SELECT * FROM Essays";
                $table = mysqli_query($conn, $sql);
                $text ="";
                if(mysqli_num_rows($table)>0) {
                    while($row = mysqli_fetch_array($table)) {
                        $text .= "<li><a href=\"readfile.html?id=".$row["hash"]."\">".$row["email"]." : ".$row["hash"]."</li>";
                    }
                }

                echo $text;

                mysqli_close($conn);
                ?>
            </ul>
        </div>
        
    </body>
    <!--
    <script>
        var x = $.post("getEssayTable.php");
        console.log(x);
        var entries = x.split(".");
        var text = "<h1>hello world</h1><ul>";

        //<li><a href="readFile.html/?id=HASH"> EMAIL, HASH </a></li>
        for(i=0;i<entries.length/2;i++) {
            text+="<li>";
            text+='<a href="readFile.html?id=';
            text+=entries[i*2+1];
            text+='">';
            text+=entries[i*2]+','+entries[i*2+1];
            text+='</li>';
        }
        text+="</ul>";
        
        document.getElementById("list").innerHTML=text;
    </script>
    -->
</html>