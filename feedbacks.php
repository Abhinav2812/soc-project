<?php
session_start();

include 'connectuser.php';
include 'notification.php';
include 'nav_bar.php';
$tags=array("Mess","Transport","Academics","Sports","Medical","Others");
$category=array('reply','question','feedback');
?>
<html>
	<head>
		<!-- required bootstrap framework -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
	    <title>Feedbacks!!</title>
	    <link href="question_display.css" rel="stylesheet">
	</head>
	<body>
		<!-- header and heading -->
		<div id="jumbotron">
			<div class="container">
				</span><h1 id="header_heading"><span class="glyphicon glyphicon-apple" id="logo"></span>Some Of The Valuables...</h1></span>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<br><br>
<<<<<<< HEAD
						<h3 class="text-info" style="color:#543e21">feeds...<hr></h3> 
						<p class="helpblock">Categories:<hr></p>
						<ul class="panel">
						    <li><a href="questions.php">All feedbacks</a></li>
							<li><a href="feedback_option.php?tag_id=1">Mess</a></li>
							<li><a href="feedback_option.php?tag_id=2">Transport</a></li>
							<li><a href="feedback_option.php?tag_id=3">Medical</a></li>
							<li><a href="feedback_option.php?tag_id=4">Academics</a></li>
							<li><a href="feedback_option.php?tag_id=5">Sports</a></li>
							<li><a href="feedback_option.php?tag_id=6">Others</a></li>
=======
						<h3 class="text-info">feeds...<hr></h3> 
						<p class="helpblock">Categories:<hr></p>
						<ul class="panel">
							<li><a href="">Mess</a></li>
							<li><a href="">Transport</a></li>
							<li><a href="">Medical</a></li>
							<li><a>Academics</a></li>
							<li><a>Sports</a></li>
							<li><a>Others</a></li>
>>>>>>> fc0e0c2043cce101e5a4d0c1993d61642c6a1015
						</ul>
						<br>
						 <br>
						<br>
				</div>


				<div class="col-md-8" bgcolor="#eee">
				    <?php
				    store_score_question();
				    
				    for($i=1;$i<=6;$i++)
				    {
				    	$query="SELECT * FROM feedback 
                         WHERE tags='$i'
						 ORDER BY reg_time DESC
						 ";
				         $result=mysqli_query($conn,$query);
				    	
				    	while($row=mysqli_fetch_array($result))
					{
						 
						?>	
						<div class="container-fluid"><hr id="hr_top">								   <h1><?php echo "<a href='feedback_option.php?tag_id=". 
						    $row[6]."'>".$tags[$i-1]."</a>";?></h1>
					   		<div class="container-fluid"><hr id="hr_top">
					   			<div id="card">
						   			
								   	<h3 id="question_heading"><strong><?php
							       	$name=get_user2($row[1]);
								   	echo "<a href='#	'>$name</a>";
								   	?></strong></h3>
									<p>
						   			<blockquote><?php echo $row[2];?></blockquote>
									</p>
							       	
    							</div>					
					   		</div>
                         </div>
                     
				    
					<?php
					
						$astring1 =  "like-".$row[0];	
						$astring2 = "dislike-".$row[0];					
						if($_SERVER["REQUEST_METHOD"] == "POST") {
							if(isset($_POST[$astring1])) {
								$feedback_id = $row[0];
								$my_id=$_SESSION['user_id'];
								$user_id=$row[1];
								$likess = $row[3];
								$likess++;
								$query3 = "UPDATE feedback SET upvotes='$likess' WHERE feedback_id = '$feedback_id' ";
								if(!mysqli_query($conn, $query3))
								{
									echo "failed to post";
								}
								else
								{
									send_notification_like($my_id,$user_id,$category[2],$feedback_id);
								}
							}
							if(isset($_POST[$astring2])) {
								$feedback_id = $row[0];
								$dislikess = $row[4];
								$dislikess++;
								$query3 = "UPDATE feedback SET downvotes='$dislikess' WHERE feedback_id = '$feedback_id' ";
								if(!mysqli_query($conn, $query3))
									echo "failed to post";
							}
							
						}
					}
				}
						?>
				</div> <!-- end col-md-7 -->
			</div> <!-- end row -->
		</div> <!-- end container --> 
	<!-- Modal Window -->
		<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>	