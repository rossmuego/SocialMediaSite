<?php
    include('db_conx.php');

    if(isset($_POST['keyword'])){
        $keyword = trim($_POST['keyword']);
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $query = "SELECT user_id, username FROM users WHERE username LIKE '%$keyword%' LIMIT 5"; //MUST BEGIN WITH $KEYWORD

        //echo $query;
        $result = mysqli_query($conn,$query);
        
        if($result){
            if(mysqli_affected_rows($conn)!=0){
                
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    
                    $userID = $row['user_id'];
                    
                    $sql = "SELECT profile_pic FROM users WHERE user_id = $userID";
                    $result1 = mysqli_query($conn,$sql);
                    
                    if($result1){
                        if(mysqli_affected_rows($conn)!=0){
                            while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                                $profilePicSearch = $row1['profile_pic'];
                            }
                    }
                    }
                    
                    $usernameDisplay = $row['username'];
                    
                    echo '<a href="profile.php?id='.$userID.'"><div class="userSearchDisplay"><img src="../images/profiles/'.$profilePicSearch.'" alt="Profile Pic" class="profilePic" style="width: 50px; height: 50px;">'.$usernameDisplay.'</div></a></br>';
                }
            }else {
                echo '<div class="userSearchDisplay">No Results for :"'.$_POST['keyword'].'"</div>';
            }
        }
    }else {
        echo 'Parameter Missing';
    }
?>


