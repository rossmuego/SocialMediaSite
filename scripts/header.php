<?php
    
    include_once('db_conx.php');
    
    $user = $_SESSION['user_id'];
    
   $sql = "SELECT profile_pic FROM users WHERE user_id='$user'";
    $query = mysqli_query($conn, $sql);

    
   while($userDetails = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$profilePic = $userDetails['profile_pic'];
   }
?>

<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
     $("#search_input").keyup(function(){
         var search_input = $(this).val();
         var dataString = 'keyword='+ search_input;
		 
         if(search_input.length>0){
			
            //AJAX POST
            $.ajax({
                 type: "POST",
                 url: "searchbar.php",
                 data: dataString,
                success: function(response){
                     $('#searchresultdata').html(response).show();
                 }
             });
         } else {
			$("#searchresultdata").hide();
	 }
     });
});
</script>
<style type="text/css">
	
</style>

<div class="header">
    <div class="logo">
        <a href="homepage.php"><img src="../images/logo.png" alt="Logo" style="width:30px;height:30px;"></a>
    </div>
		            <div class="searchBox">
						<input name="query" type="text" id="search_input" placeholder="Search Users">
					
					<div id="searchResults">
						<div id="searchresultdata" class="srch-results"></div>
					</div>
					</div>
		        
		    

	
    <div class="navigationText">
        <a href="submit.php">Submit |</a>
		<a href="logout.php">Log Out |</a>
        <a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>">Profile</a>
        <a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"><img src="../images/profiles/<?php echo $profilePic; ?>" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;"></a>
    </div>
</div>