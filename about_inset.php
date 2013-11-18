<link href="//fonts.googleapis.com/css?family=Open+Sans:600,300" rel="stylesheet" type="text/css">
<link style="text/css" rel="stylesheet" href="des1style.css" />
<link style="text/css" rel="stylesheet" href="contentstyle.css" />
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="about_script.js"></script>
<style type="text/css">
    body {overflow:hidden};
</style>
<html><body>

        <section>
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
                    <!--<div id="submitDiv">Submit!</div>-->
                </form>
                <div id="formResults"></div>
             </div>
            <p></p>
        </section>
</body>
</html>