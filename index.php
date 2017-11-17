<?php
	session_start();
	
	if(isset($_SESSION['user_id'])){
		header("Location: scripts/homepage.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
    <!--stylesheet -->
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
     
    <!-- MaterializeCSS -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        
    <!-- fullPage.js -->
        <link rel="stylesheet" type="text/css" href="fullPage.js-master/jquery.fullPage.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="vendors/jquery.easings.min.js"></script>
        <script type="text/javascript" src="fullPage.js-master/vendors/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="fullPage.js-master/jquery.fullPage.js"></script>
		
		<!--TILE SCROLLING-->
	    <script type="text/javascript" lang="javascript">

		$(document).ready(function() {
			$('#fullpage').fullpage({
				verticalCentered: true,
				sectionsColor: ['#1bbc9b', '#2c3e50', '#34495e'],
                anchors: ['homepage', 'Login'],
				afterRender: function(){
					//playing the video
					$('video').get(0).play();
				}
			});
		});
			
$(document).ready(function() {
    $("#register").click(function() {
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
			var username = $("#username").val();
            var cpassword = $("#cpassword").val();
            
            if (name == '' || email == '' || password == '' || cpassword == '' || username == '') {
                alert("Please fill all fields.");
            } else if ((password.length) < 8) {
                alert("Password should atleast 8 character in length");
            } else if (!(password).match(cpassword)) {
                alert("Your passwords don't match. Try again.");
            } else {
                $.ajax({
					type: "POST",
					url: "scripts/register.php",
					data: 'name='+name+'&email='+email+'&username='+username+'&password='+password+'&cpassword='+cpassword,
					success: function(data) {
						if (data.indexOf("This user is already registered, Please try another email/username.") > -1) {
							alert(data);
						} else if(data.indexOf("registerSuccess") > -1) {
							alert("Registration complete, please login above!");
						}
					},
				});
			};
		});
	});

$(document).ready(function(){
	$("#login").click(function(){
		$.ajax({
			type: "POST",
			url: "scripts/login/login_action.php",
			data:'email='+$("#emailLogin").val()+'&password='+$("#passwordLogin").val(),
			success: function(data){
				if(data.indexOf("success") > -1) {
					location.href = "scripts/homepage.php";
				} else  {
					alert(data);
				}
			},
		});
	});
});
	
		</script>
		
    </head>
    <body>
      <div id="fullpage">
        <div class="section " id="section0">
          <video autoplay loop muted id="myVideo">
            <source src="video/homeVideo.mp4" type="video/mp4">
          </video>
			<div class="layer">
				<ul id="menu">
					<li data-menuanchor="Login"><a href="#Login">Login</a></li>
					<li data-menuanchor="Register"><a href="#Login">Register</a></li>
				</ul>
			</div>
			<div class="layer">
				<h1>Title</h1>
			</div>
        </div>
		<div class="section" id="section1">
			<div class="loginCard">
				<form action ="#" method="POST">
					<input type="text" id="emailLogin" name="email" placeholder="Email">
					<input type="password" id="passwordLogin" name="password" placeholder="Password">
					<input type="button" name="login" id="login" value="Login" class="btn waves-effect waves-light">
				</form>
			</div>
			<br>
			<div class="registerCard" id="registerCard">
				<form action="#" method="post">
					<input type="text" name="dname" placeholder="Full Name" id="name" class="validate" >
					<input type="text" name="dusername" placeholder="Username" id="username" class="validate" >
					<input type="email" name="demail" id="email" placeholder="Email">
					<input type="password" name="password" id="password" placeholder="Password">
					<input type="password" name="cpassword" id="cpassword" placeholder="Re-enter Password">
					<input type="button" name="register" id="register" value="Register" class="btn waves-effect waves-light">
                </form>
			</div>
		</div>
		</div>
    </body>
</html>