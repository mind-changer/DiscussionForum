
<?php
include ('../functions.php');


$errors=array();
//$date=date('m/d/Y');
//$time=date('h:i:s a',time());
$user= $_SESSION['user']['PKuser_id'];
$userid=(int)$user;

//$q1="CREATE VIEW `Question_detail`AS SELECT `PKquestion_id`,`question_title`,`question_desc`,`date`,`upvote`,`tag_name`,`user_name` FROM `Question`,`User`,`Tag`,`Question_tag`;";
//if(mysqli_query($db,$q1)){echo "lasdkjflsadkjf";}
/*$q="CREATE VIEW `Question_detail` AS SELECT `user_name` FROM `User`;";
if(mysqli_query($db,$q)){
    echo "HEYYHEYY";
}*/
/*$q="SELECT * FROM `Question_detail`;";
if($res=mysqli_query($db,$q)){echo "lasdkjflsadkjf";}
$take= mysqli_fetch_array($res);
print_r($take);*/

/*$q="create view Question_details as
  select `question_title`,`question_desc`,`date`,`upvote`,`tag_name`,`user_name` ,
         `PKquestion_id`
  from `Question`,`User`,`Tag`,`Question_tag`
  where `FKuser_id`=`PKuser_id` and `PKtag_id`=`FKtag_id` and `PKquestion_id`=`FKquestion_id`;";
if(mysqli_query($db,$q)){echo "lasdkjflsadkjf";}*/

function display_notification(){

    global $db,$userid;

    $q="SELECT `question_title` FROM Question WHERE PKquestion_id IN (SELECT `FKquestion_id`
    FROM notification_receiver
        WHERE FKreceiver_id=$userid)";

    if($res=mysqli_query($db,$q)){

        if(mysqli_num_rows($res) > 0){

            while($notif=mysqli_fetch_array($res)){

                echo "<a>Update in<b> \"".$notif['question_title']."\"</b></a>";
            }
        }
        
    }                            
       
    
}

if(isset($_GET['qid'])){
    if($_GET['qid']!=NULL){
        $qid=$_GET['qid'];
    }
    $query="SELECT * FROM `Question_details` WHERE `PKquestion_id`=$qid";
    $res=mysqli_query($db,$query);
    $arr=mysqli_fetch_assoc($res);

    $q="SELECT `tag_name` FROM `Question_details` WHERE `PKquestion_id`=$qid";
    $r=mysqli_query($db,$q);
    
    
}

function display_question_answer(){
    global $arr,$r,$ar;
    //echo"<br><br>";
                    echo"<div id=qa-box>";
                    //echo"<div id=qa-upvote-count>".$arr['upvote'];
                    //echo"</div>";
                    echo "<div id=qa-title>".$arr['question_title'];
                    echo "</div>";
                    echo "<div id=qa-content>".$arr['question_desc'];
                    echo"</div>";
                    echo "<div id=qa-tags>";

                    while($ar=mysqli_fetch_array($r)){
                        echo "<span class=qa-tag-content>".$ar['tag_name']."</span>";
                    }
                        

                    echo "</div>";
                    echo"<span id=qa-username>".$arr['user_name'];
                    echo"</span>";
                    echo "<span id=qa-timestamp>".$arr['date'];
                    echo"</span>";
                    //echo"<span id=qa-upvote><button type=button id=upvote-q-btn class=upvote-q-btn>UPVOTE";
                    echo"</button>";
                    echo"</span>";
                    echo"</div>";
                    echo"<br>";
                    //echo"<span id=replies>";
                    //echo"</span>";
                    //echo"<br><br>";

    
}
    

function display_my_questions(){
    global $userid,$db;

    $sql = "SELECT * FROM `Question` WHERE `FKuser_id`=".$userid; 
    if ($res = mysqli_query($db, $sql)) { 
        if (mysqli_num_rows($res) > 0) { 
            
            while ($row = mysqli_fetch_array($res)) { 
                
            echo "<br><br>";
            echo "<div class = question-box >";
            //echo "<div class = upvote-count>".$row['upvote']."</div>";
            echo "<a href=question_answer.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
            //echo "<span class = replies>6 replies</span>";
            echo "<span class = question-date>".$row['date']."</span>";
            echo "</div>";
                
            } 
            //echo "</table>"; 
            //mysqli_free_res($res); 
        } 
        else { 
            echo "No matching records are found."; 
        } 
    } 
}

function display_forum_questions(){
    global $userid,$db;

    $sql = "SELECT * FROM `Question_details` ORDER BY `upvote` DESC "; 
if ($res = mysqli_query($db, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        
        while ($row = mysqli_fetch_array($res)) { 
            
        
        echo "<div class = question-box>";
        //echo "<div class = upvote-count>".$row['upvote']."</div>";
        echo "<a href=question_answer.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
        echo "<span class = question-username>".$row['user_name']."</span>";
        //echo "<span class = replies>6 replies</span>";
        echo "<span class = question-date>".$row['date']."</span>";
        echo "</div>";
        echo "<br>" ;    
        } 
        //echo "</table>"; 
        //mysqli_free_res($res); 
    } 
    else { 
        echo "No answers yet."; 
    } 
} 
}



if(isset($_POST['save_bio'])){

    
    $short_bio=htmlspecialchars($_POST['textarea']);
    //echo gettype($userid);
    //echo $_SESSION['user']['PKuser_id'];
    $queryb="UPDATE `User` SET `short_bio`='$short_bio' WHERE `PKuser_id`=".$userid;
    if(mysqli_query($db,$queryb)){
        //echo "DATABASE DONE";
        $_SESSION['user']['short_bio']=$short_bio;
    };

}

function getQuestionById($id){
	global $db;
	$query = "SELECT * FROM `Question` WHERE `PKquestion_id`=" . $id; 
	$result = mysqli_query($db, $query);

	$question = mysqli_fetch_assoc($result);
	return $question;
}

function display_header_username(){
    echo ucfirst($_SESSION['user']['user_name']);
}

function display_shortbio(){
    echo $_SESSION['user']['short_bio'];
}

function post_answer(){
    global $db;
}

function post_question(){
    global $errors,$db,$userid,$current_question;
    $q_title=$_POST['my_question_title'];
    $q_content=$_POST['my_question_content'];

    
        $query ="INSERT INTO Question(`question_title`, `question_desc`, `upvote`, `FKuser_id`) VALUES('$q_title', '$q_content', 0, $userid);";
        mysqli_query($db,$query);
        $current_question=(int)mysqli_insert_id($db);
        
        if(isset($_POST['iot'])){

            if($_POST['iot']=='true'){

            $find_tagid="SELECT `PKtag_id` FROM `Tag` WHERE `tag_name`='iot';";
            $result=mysqli_query($db,$find_tagid);
            $tag_id=(int)mysqli_fetch_assoc($result);
            $query_tags ="INSERT INTO Question_tag(`FKquestion_id`,`FKtag_id`) VALUES($current_question,1);";
            mysqli_query($db,$query_tags);

            }
        }
        if(isset($_POST['cs'])){

            if($_POST['cs']=='true'){

            $find_tagid1="SELECT `PKtag_id` FROM `Tag` WHERE `tag_name`='cyber_security';";
            $result1=mysqli_query($db,$find_tagid1);
            $tag_id1=(int)mysqli_fetch_assoc($result1);
            $query_tags1 ="INSERT INTO Question_tag(`FKquestion_id`,`FKtag_id`) VALUES($current_question,2);";
            mysqli_query($db,$query_tags1);

            }
        }
        if(isset($_POST['ds'])){

            if($_POST['ds']=='true'){

            $find_tagid2="SELECT `PKtag_id` FROM `Tag` WHERE `tag_name`='data_science';";
            $result2=mysqli_query($db,$find_tagid2);
            $tag_id2=(int)mysqli_fetch_assoc($result2);
            $query_tags2 ="INSERT INTO Question_tag(`FKquestion_id`,`FKtag_id`) VALUES($current_question,3);";
            mysqli_query($db,$query_tags2);

            }
            
        }
        
    

    
}

if(isset($_POST['post_q_btn'])){
    
    post_question();
    
}

?>
