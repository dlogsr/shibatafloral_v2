        <?php
            $name = $email = $comments = "";
            $error = "";

            $name = test_input($_POST["name"]);
            if(empty($_POST["email"])){
                $error = "Your email is missing for your submission.";
            }
            else{
                $email = test_input($_POST["email"]);
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
                    $error = "Invalid email format"; 
                }    
            }
            
            $comments = test_input($_POST["comments"]);
            $comments = "Name: " . $name . "<p> E-Mail Address: " . $email . "<p> Comments: ".$comments;
            $comments = "<html>".$comments."</html>";

            $subject = "Website comments from " . $name;
            $headers = "From:" . $email . "\r\n";
            $headers .= "Content-type: text/html\r\n";
            mail("david@shibatafloral.com",$subject,$comments,$headers);


            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            echo "Thank you for your comments or questions! We will take a look at them as soon as possible and get back to you.";
            echo "<script>";
            echo "document.getElementById('submitDiv').disabled = 'disabled';";
            echo "</script>";
        ?>