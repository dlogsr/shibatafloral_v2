<!--<link style="text/css" rel="stylesheet" href="des1style.css" />-->
<link style="text/css" rel="stylesheet" href="contentstyle.css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:600,300" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<div id="maincontent" class="main">
	<?php 

		/* THIS FORM HAS BEEN MODIFIED to account for dumbing-down of the specials section */
		/* to a single-image upload only, per the client's request. 12/16/13 */
		/* Database has not been optimized and simple modifications to existing system were done */

		$submitted=false;
		if($_POST[prodName] != NULL) // check if there's data to submit from the form (not finalize)
		{
			$submitted=true;
			echo "<p>Data Submitted. Adding to MySQL Database.</p>";
		}
		elseif($_POST[clearSpec] == true){
			$cleared = true;
			mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
			mysql_select_db("sfclax_dumb_specials") or die(mysql_error());
			mysql_query("DROP TABLE IF EXISTS specials");
			mysql_query("DROP TABLE IF EXISTS specials_temp");
			echo "<p><strong>DATABASE CLEARED!</strong></p>";
			mysql_query("CREATE TABLE IF NOT EXISTS  specials_temp(
				spc_id int not null auto_increment primary key,
				spc_name varchar(355) not null,
				spc_price varchar(255) not null,
				spc_origprice varchar(255) not null,
				spc_location varchar(255) not null,
				spc_imageurl varchar(355) not null
			) ENGINE = InnoDB");
		}
		elseif($_POST[spcDate] != NULL) // check if we are finalizing the data (there is a date)
		{
			mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
			mysql_select_db("sfclax_dumb_specials") or die(mysql_error());
			mysql_query("DROP TABLE IF EXISTS specials");
			mysql_query("CREATE TABLE specials LIKE specials_temp");
			mysql_query("INSERT INTO specials SELECT * FROM specials_temp");
			mysql_query("INSERT INTO specials(spc_name,spc_price) VALUES('$_POST[spcDate]','END')");
			echo "<p>Specials finalized. Migrating temp data to current database.</p>";
		}
		else //no new data, no finalizing. create the temp database for adding items
		{
			echo "<p>No data to add.</p>";
			mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
			mysql_select_db("sfclax_dumb_specials") or die(mysql_error());
			mysql_query("CREATE TABLE IF NOT EXISTS  specials_temp(
				spc_id int not null auto_increment primary key,
				spc_name varchar(355) not null,
				spc_price varchar(255) not null,
				spc_origprice varchar(255) not null,
				spc_location varchar(255) not null,
				spc_imageurl varchar(355) not null
			) ENGINE = InnoDB");
		}
	?>
		
    <!--PHP to submit the item to MySQL database -->
    <?php
		if($submitted)
		{
			mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
			mysql_select_db("sfclax_dumb_specials") or die(mysql_error());

			//make sure we know what to save the file name as in the DB
			$filename = $_FILES['uploadedfile']['name'];
				$tempfilename = $_FILES['uploadedfile']['tmp_name'];
			
			$sql= "INSERT INTO specials_temp(spc_name,spc_origprice,spc_price,spc_location,spc_imageurl) 
						VALUES('$_POST[prodName]','$_POST[prodRegPrice]','$_POST[prodPrice]','$_POST[prodLocation]','$filename')";
			$result = mysql_query($sql)or die(mysql_error());
			//this ends the MySQL data storage.
			
			//now to store the uploaded image
			$img = imagecreatefromjpeg($tempfilename);
			$target_path = "specials/";
			$target_path = $target_path . basename($filename);
			
			if(move_uploaded_file($tempfilename, $target_path)) {
				echo "The file ". basename($filename). " has been uploaded";
			} else{
				echo "Error uploading image file.";
			}
			
			//create thumbnail of that image
			$maxsize = 796;
			
			//if(imagesx($img) >= imagesy($img)) {
				$thumb_x = $maxsize;
				$thumb_y = imagesy($img)*($maxsize/imagesx($img));
			/*} else {
				$thumb_y = $maxsize;
				$thumb_x = imagesx($img)*($maxsize/imagesy($img));
			}*/
			
			$thumb = imagecreatetruecolor($thumb_x,$thumb_y);	
			imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumb_x, $thumb_y, imagesx($img), imagesy($img));
			imagejpeg($thumb, 'specials/thumbs/th_'. basename($filename),60);
			
			echo "<p>Done.</p>";
		}
	?>
	
    

    <p></p>
    <section id="clearProductsForm" class="data">
    	<h2>Step 1: Click this button to CLEAR the current specials listed. This will delete ALL items in "specials".</h2>
    	<form name="clearSpecials" action="db_specials_add.php" method="post" enctype="multipart/form-data">
    		<p><input type="hidden" value="true" name="clearSpec" /></p>
    		<p><input type="submit" value="CLEAR CURRENT SPECIALS" /></p>
    	</form>
    </section>
    <section id="addProductsForm" class="data">
    	<h2>Step 2: Add each special individually here.</h2>
    	<p>Once you hit "submit", the page will refresh and the item will be added to the list at the bottomr of the page. <strong>Repeat until complete.</strong></p>
    	<p><strong>As of right now, you can ONLY upload JPG files.</strong> You can review what's been uploaded so far at the bottom of the page.</p>
    	<p><strong>The files must NOT have the same name (i.e. both CANNOT be named "special_1.jpg")</strong></p>
    	<form name="addProduct" action="db_specials_add.php" method="post" enctype="multipart/form-data" style="text-align:left;width:500px;margin:auto">
            <input type="hidden" name="prodName" value="Name"/>
            <input type="hidden" name="prodRegPrice" value="Price"/>
            <input type="hidden" name="prodPrice" value="Price2" step="any"/>
            <p>Image File: <input name="uploadedfile" type="file" /></p>
            <p>Region for this Special:
            	<select name="prodLocation">
            		<option value="lax">Los Angeles</option>
            		<option value="sfo">San Francisco</option>
            		<option value="pdx">Portland</option>
            	</select>
        	</p>
            <p><input type="submit" value="Submit" /></p>
        </form>
    </section>
    <section id="finalizeForm" class="data">
    	<p><h2>Step 3: CLICK HERE WHEN READY TO SUBMIT FINALIZED SPECIALS FOR THE WEEK.</h2></p>
    	<p>Please note that you MUST enter a date below for this change to go through.</p>
    	<p>Once you hit "Finalize", the current list of items you see above will be sent to the "Specials" page on the main site.</p>
    	<form name="finalizeSpecials" action="db_specials_add.php" method="post" enctype="multipart/form-data">
    		<p><strong>Date for specials: <input type="text" name="spcDate" id="datepicker" /></strong></p>
    		<p><input id="submitDiv" type="submit" value="Finalize" /></p>
    </section>
        

    <div id="side" class="data"><h2>Products Preview</h2></div>    
    <section id="content" class="data">
        <div id="stage" class="data" hidden>
    	Item to submit:<br />
        Name: <?php echo $_POST["prodName"]; ?><br />
        Reg Price: <?php echo $_POST["prodOrigPrice"]; ?><br />
        Special Price: <?php echo $_POST["prodPrice"]; ?><br />
        Image: <?php echo $_FILES['uploadedfile']['name']; ?>
        <p></p>
	    </div>
        <?php
            mysql_connect("localhost","sfclax_mysql","shibata") or die(mysql_error());
            mysql_select_db("sfclax_dumb_specials") or die(mysql_error());
            
            $sql = "SELECT * FROM specials_temp";
            $result = mysql_query($sql)or die(mysql_error());
            
            echo "<table>";
            
            while($row = mysql_fetch_array($result)){
                $prd_id = $row['spc_id'];
                $name    = $row['spc_name'];
                $price     = $row['spc_price'];
                $origprice = $row['spc_origprice'];
                $image = $row['spc_imageurl'];
                $location = $row['spc_location'];
                if($price="END")
                {
                	$name = $date;
                	//echo "DATE IS ".$date."!";
                }
                //else
                //{
	                echo "<tr><td style='width: 100px'>".$prd_id."</td><td style='width:200px;text-align:center'>".$location."</td><td style='width:75px'><a href='specials/".$image."' target='_blank'><img src='specials/thumbs/th_".$image."' width='200'/></a></td></tr>";
	            //}
            }
            //next step is to make this into a grid system, load these values into a smaller enclosed
            //table format and then every 4-5 or so, line break to the next row?
            echo "</table>";
        ?>
    </section>
</div>
