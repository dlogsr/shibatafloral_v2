<link style="text/css" rel="stylesheet" href="des1style.css" />
<link style="text/css" rel="stylesheet" href="contentstyle.css" />
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="about_script.js"></script>
<!--<script>
    $(document).ready(function(){
        $("#commentForm").validate({
                debug: false,
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    name: "Please let us know who you are.",
                    email: "A valid email will help us get in touch with you.",
                    comments:"Please ask us questions or tell us comments!"
                },
                submitHandler: function(form) {
                    // do other stuff for a valid form
                    $.post('send_email.php', $("#commentForm").serialize(), function(data) {
                        $('#formResults').html(data);
                    });
                }
            });
    });
    </script>-->
<body>
<div id="maincontent" class="main">
    <div id="side" class="data"><h2>About</h2></div>
    <div id="content" class="data">
        <section>
            <p>
                About Our Company
            </p>
            <p>
                With origins tracing back to 1921, Shibata Floral Company is now in its fourth generation of family ownership.  Beginning as rose growers the company expanded into carnation growing, chrysanthemum propagation and floral supplies. Shibata Floral now has evolved into a multifaceted distribution business offering thousands of floral related products from all over the world through its locations in the San Francisco,  Los Angeles and Portland flower markets.
            </p>
        </section>
        <iframe src="about_inset.php" seamless='seamless' width="800" height="550" frameborder="0"></iframe>
        <!--<section>
            <p>
                If you'd like to contact us by e-mail, please fill out this form. We will respond to you as quickly as possible!
            </p>
            <div id="formBox">

                <form method="POST" id="commentForm" action="" name="commentForm">
                    Name: <input type="text" name="name" size=40><br />
                    E-Mail: <input type="email" name="email" size=40>
                    <p></p>
                    Questions, comments, etc:<br/>
                    <textarea name="comments" rows=8 cols=50></textarea><br />
                    <input id="submitDiv" type="submit" name="Submit" value="Send">
                </form>
                <div id="formResults"></div>
             </div>
            <p></p>
        </section>-->
        </p>
        <section id="footer">
            © SHIBATA FLORAL COMPANY 2013  All Rights Reserved
        </section>
    </div>
        
</div>
</div>
</body>