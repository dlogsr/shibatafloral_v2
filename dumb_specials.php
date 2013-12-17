<link style="text/css" rel="stylesheet" href="des1style.css" />
<link style="text/css" rel="stylesheet" href="contentstyle.css" />
<div id="maincontent" class="main">
    <div id="side" class="data"><h2 id="dateTitle">Specials</h2></div>
    <div id="content" class="data">
        <section>
        <?php
            mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
            $check = mysql_select_db("sfclax_dumb_specials") or die(mysql_error());

            $sql = "SELECT * FROM specials";
            $result = mysql_query($sql);
            if(!$result){
                echo "There are currently no specials up. Please check back again later!";
            }
            else{
                
                while($row = mysql_fetch_array($result)){
                    $prd_id = $row['spc_id'];
                    $name    = $row['spc_name'];
                    $price     = $row['spc_price'];
                    $origprice = $row['spc_origprice'];
                    $image = $row['spc_imageurl'];

                    if($price=="END")
                    {
                        $date = $row['spc_name'];
                        echo "<script>document.getElementById('dateTitle').innerHTML='Specials for Week of ".$date."';</script>";
                    }
                    else
                    {
                        echo "<div class='flyerSpecial'><a href='/specials/$image' target='_blank'><img src='specials/$image' /></a></div>";
                    }
                    
                }
                
            }
            

        ?>
        </section>
        </p>
        <section id="footer">
            © SHIBATA FLORAL COMPANY 2013  All Rights Reserved
        </section>
    </div>
</div>
