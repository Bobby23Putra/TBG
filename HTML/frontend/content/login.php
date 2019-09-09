<?php
//check session    
if(!empty($_SESSION['uname'])){
	header("location:frontend/content/main.php?page_id=dashboard&pack_id=1"); 
	exit();
}
if($_POST['submit']){
	$pass = md5($_POST['pass']);
	$query ="SELECT * FROM user WHERE username='".$_POST['nama']."' AND password='".$pass."'";
	$res=myQueryDb($query);
	$num=myNumDb($res);
	//echo $num.'<br>'.$query;
	if ($num>0){
		$_SESSION['uname'] = $_POST['nama'];
		header("location: frontend/content/main.php?page_id=dashboard&pack_id=1");
		exit();
	}else{
		echo '<script>alert("Login Failed. Wrong Username or Password");</script>';
	}
}    
?>
<style>
body
{
    background: url('images/bgs-01.jpg') fixed;
    background-size: cover;
    padding: 0;
    margin: 0;
}

.wrap
{
    width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 99;
}

p.form-title
{
    font-family: 'Open Sans' , sans-serif;
    font-size: 20px;
    font-weight: 600;
    text-align: center;
    color: #FFFFFF;
     /*-webkit-text-stroke: 0.5px #bdbdbd;*/
    margin-top: 5%;
    text-transform: uppercase;
    letter-spacing: 4px;
}

form
{
    width: 250px;
    margin: 0 auto;
}

form.login input[type="text"], form.login input[type="password"]
{
    width: 100%;
    margin: 0;
    padding: 5px 10px;
    background: 0;
    border: 0;
    border-bottom: 1px solid #FFFFFF;
    outline: 0;
    font-style: italic;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
    margin-bottom: 5px;
    color: #FFFFFF;
    outline: 0;
}

form.login input[type="submit"]
{
    width: 100%;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 16px;
    outline: 0;
    cursor: pointer;
    letter-spacing: 1px;
}

form.login input[type="submit"]:hover
{
    transition: background-color 0.5s ease;
}

form.login .remember-forgot
{
    float: left;
    width: 100%;
    margin: 10px 0 0 0;
}
form.login .forgot-pass-content
{
    min-height: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
}
form.login label, form.login a
{
    font-size: 12px;
    font-weight: 400;
    color: #FFFFFF;
}

form.login a
{
    transition: color 0.5s ease;
}

form.login a:hover
{
    color: #2ecc71;
}

.pr-wrap
{
    width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    display: none;
}

.show-pass-reset
{
    display: block !important;
}

.pass-reset
{
    margin: 0 auto;
    width: 250px;
    position: relative;
    margin-top: 22%;
    z-index: 999;
    background: #FFFFFF;
    padding: 20px 15px;
}

.pass-reset label
{
    font-size: 12px;
    font-weight: 400;
    margin-bottom: 15px;
}

.pass-reset input[type="email"]
{
    width: 100%;
    margin: 5px 0 0 0;
    padding: 5px 10px;
    background: 0;
    border: 0;
    border-bottom: 1px solid #000000;
    outline: 0;
    font-style: italic;
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 5px;
    color: #000000;
    outline: 0;
}

.pass-reset input[type="submit"]
{
    width: 100%;
    border: 0;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 10px;
    outline: 0;
    cursor: pointer;
    letter-spacing: 1px;
}

.pass-reset input[type="submit"]:hover
{
    transition: background-color 0.5s ease;
}
.posted-by
{
    position: absolute;
    bottom: 26px;
    margin: 0 auto;
    color: #FFF;
    background-color: rgba(0, 0, 0, 0.66);
    padding: 10px;
    left: 45%;
}
</style>
<script>
    $(function() {
    //console.log( "ready!" );
    $( "#username" ).focus();
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center>
               
            </center>
        </div>
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    
                </p>
                <p>&nbsp;</p>
                <form class="login" action="index.php" method="POST">
                    <input type="text" placeholder="Username" name="nama" id="username"/>
                    <input type="password" placeholder="Password" name="pass"/>
                    <input type="submit" value="Sign In" name="submit"class="btn btn-primary btn-sm" style="background-color: #1a237e" />
                </form>
            </div>
        </div>
    </div>
</div>
