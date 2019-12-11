<?php
include('forum_functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ask a Question</title>
<script src = "../js/jquery.js"></script>
<script type = "text/javascript" src = "../js/script.js"></script>
<link rel="stylesheet" href="../style.css">
<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
    
    
        <div class = header>
            
            <button class="btn" style="background: none; font-weight: light;font-family: 'Great Vibes', cursive;font-size: 36px;"><a>MentorYou</a></button>

            

            <div class = dropdown> 
                <button class="btn" ><a><?php echo display_header_username();?></a></button>
                <div class="content">
                    <a href="profile.php">Profile</a>
                    <a href="../login.php?logout='1'">Logout</a>
                </div>
            </div>

            <div class="dropdown">
                
                <button class="btn"><a class="btn">notif</a></button>

                <div class="content">
                    <?php echo display_notification();?>
                </div>

            </div>

        </div>
    


    <div class = tags>
        <a href="forum.php?tag=1">Find Trending</a><br>
        <a href="forum.php?tag=2">IOT</a><br>
        <a href="forum.php?tag=3">Cyber Security</a><br>
        <a href="forum.php?tag=4">Data Science</a><br>
    </div>

    <div class="main">
    <?php //echo display_error();?>
    <form action="ask_question.php" method="post" id=q-form>
    <div class = q-title>
        <h2>Title of your Question:</h2>
        <textarea  id="q-title-content" cols="30" rows="10"></textarea>
        <span id="empty-title"></span>
    </div>

    <div class=q-content>
        <h2>Body of you Question must contain:-</h2>
        <ol>
            <li>Ensure that you explain why you are facing the problem.</li>
            <li>Explain what led to the problem.</li>
            <li>Give required information.</li>
        </ol>
        <h2>Explain you problem here in detail:-</h2>
        <textarea id="q-content" cols="30" rows="10"></textarea>
        <span id="empty-content"></span>
        
    </div>
    <div class="tag-box" style="background: white;" id="tag-box">

        <div class="tag" id="i-o-t">
            <a href="#tag-box" onclick="hideIOT();" id="close-i-o-t">&times;</a>
            <span class="tag-content" id="IOT-content">IOT</span>
        </div>

        <div class="tag" id="cyber-security">
            <a href="#tag-box" onclick ="hideCS();" id="close-cyber-security">&times;</a>
            <span class="tag-content" id="cyber-security-content">Cyber Security</span>
        </div>

        <div class="tag" id="data-science">
            <a href="#tag-box" onclick="hideDS();" id="close-data-science">&times;</a>
            <span class="tag-content" id="data-science-content">Data Science</span>
        </div>
    </div>
    <span id="empty-tag"></span>
    

    <div class = choose-tags>
        <button class="choose-tags-dropdown">Choose one or many relevant tags</button>
        <div class=choose-tags-dropdown-content>
            <a href="#tag-box" onclick="addIOT();">IOT</a>
            <a href="#tag-box" onclick="addCS();">Cyber Security</a>
            <a href="#tag-box" onclick="addDS();">Data Science</a>
        </div>
    </div>

    <button type="button" name=post_q_btn class=q-post-btn id="post-btn">POST QUESTION</button>
    
    </form>
</div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="fill"></p>
        </div>
    </div>
    
<script>
            
            
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("post-btn");
    var span = document.getElementsByClassName("close")[0];
    
    var iot=document.getElementById("i-o-t");
    var cs=document.getElementById("cyber-security");
    var ds=document.getElementById("data-science");

    var isDS=false;
    var isCS=false;
    var isIOT=false;
    
    function hideIOT(){
        iot.style.display="none";
        isIOT=false;
        console.log("iot"+isIOT);
    }
    function hideDS(){
        ds.style.display="none";
        isDS=false;
        console.log("ds"+isDS);
    }
    function hideCS(){
        cs.style.display="none";
        isCS=false;
        console.log("cs"+isCS);
    }

        function addIOT(){
        iot.style.display="block";                
        if(!isIOT){
            isIOT=true;
            console.log("iot"+isIOT);
        }
        
    }

    function addCS(){
        cs.style.display="block";
        if(!isCS){
            isCS=true;
            console.log("cs"+isCS);
        }
    }

    function addDS(){
        ds.style.display="block";
        if(!isDS){
            isDS=true;
            console.log("ds"+isDS);
        }
    }

    $(document).ready(function(){
        $("#post-btn").click(function(){
            var title = $("#q-title-content").val();
            title=title.trim();
            var content = $("#q-content").val();
            content=content.trim();

            //var dataString = 'name1='+ name + '&email1='+ email + '&password1='+ password + '&contact1='+ contact;
            if($.trim(title)==''||$.trim(content)==''|| (!isIOT && !isCS && !isDS))
            {
                alert("Please Fill All Fields");
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "forum_functions.php",
                    data: {my_question_title: title, 
                            my_question_content: content,
                            post_q_btn: true,
                            iot: isIOT,
                            cs: isCS,
                            ds: isDS
                            },
                    cache: false,
                    success: function(data){
                        
                        alert(data);
                        $("#q-title-content").val("");
                        $("#q-content").val("");
                        //window.location.href = "../forum/my_question.php";
                        
                    }
                });
            }
        });
            return false;
    });


    /*function remove(array,value){
        var index=array.indexOf(value);
        array.splice(index,1);
    }*/

    
    btn.onclick = function() {
        
        if(document.getElementById("q-title-content").value == "")
        {
            document.getElementById("empty-title").innerHTML="REQUIRED";
        }
        if(document.getElementById("q-content").value =="")
        {
            document.getElementById("empty-content").innerHTML="REQUIRED";
        }
        if(!(isCS ||isDS ||isIOT))
        {
            document.getElementById("empty-tag").innerHTML="* REQUIRED";
        }
        if(document.getElementById("q-title-content").value.trim() != "" 
            && document.getElementById("q-content").value.trim() !="" 
            && (isCS||isDS||isIOT)){

                modal.style.display = "block";
                document.getElementById("fill").innerHTML="posted successfully";
                document.getElementById("empty-title").innerHTML="";
                document.getElementById("empty-content").innerHTML="";
                
            }
        
    
        
    }


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    
</script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementsByClassName("header")[0];
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>
</html>