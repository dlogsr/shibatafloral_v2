<link style="text/css" rel="stylesheet" href="des1style.css" />
<link style="text/css" rel="stylesheet" href="contentstyle.css" />
<script type="text/javascript" src="specials_script.js"></script>
<div id="maincontent" class="main">
    <div id="side" class="data"><h2 id="dateTitle">Specials</h2></div>
    <div id="content" class="data">
        <section>
        <div class="locTop locTopSpecials">
            <nav>
                <ul>
                    <li id="sfo" class="specialsSelector locCat locSelected"><a href="#!">San Francisco</a></li>
                    <li id="lax" class="specialsSelector locCat"><a href="#!">Los Angeles</a></li>
                    <li id="pdx" class="specialsSelector locCat"><a href="#!">Portland</a></li>
                </ul>
            </nav>
        </div>
        <div class="specialsContent">
            <?php
                mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
                $check = mysql_select_db("sfclax_dumb_specials_dev") or die(mysql_error());

                $sql = "SELECT * FROM specials";
                //$sql_lax = "SELECT * FROM specials WHERE spc_location = 'lax'";
                //$result = mysql_query($sql_lax);
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
                        $location = $row['spc_location'];
                        /*switch($row['spc_location']){
                            case 'lax':
                                $location =  'Los Angeles';
                                break;
                            case 'sfo':
                                $location =  'San Francisco';
                                break;
                            case 'pdx':
                                $location =  'Portland';
                                break;
                            default:
                                $location =  'GENERAL';
                                break;
                        };*/
                        $image = $row['spc_imageurl'];

                        if($price=="END")
                        {
                            $date = $row['spc_name'];
                            echo "<script>document.getElementById('dateTitle').innerHTML='Specials for <br/>Week of ".$date."';</script>";
                        }
                        else
                        {
                            echo "<div class='flyerSpecial flyerFrom$location'><a href='/specials/$image' target='_blank'><img src='specials/thumbs/th_$image' /></a></div>\n";
                        }
                        
                    }
                    
                }
                

            ?>
        </div>
        </section>
        </p>
        <section id="footer">
            © SHIBATA FLORAL COMPANY 2013  All Rights Reserved
        </section>
    </div>
</div>
