<?php
 require('includes/config.php'); 
require('layout/header.php'); 
$title = 'Lecture Additon';
//include header template

?>
<form role="form" method="post" action="" autocomplete="off">
<h4>Please Complete the Details</h4>
<p><a href='lectures.php'>Back</a></p>

<?php  
	if(isset($_POST['submit'])){
		$j=true;
   if ($_POST['lname']==NULL) {
   echo '<p class="bg-danger">'."Please fill out all fields".'</p>'; $j=false;}
   else if ($_POST['enrollmentkey']==NULL) {
   echo '<p class="bg-danger">'."Please fill out all fields".'</p>'; $j=false;}
   if($_POST['lname']!=NULL){
		if(strlen($_POST['lname'])<5){
			echo '<p class="bg-danger">'."The lecture name has to be at least 5 characters".'</p>'; $j=false;}}

	if($_POST['enrollmentkey']!=NULL){
			if(strlen($_POST['enrollmentkey'])<8){
								echo '<p class="bg-danger">'."The enrollment key has to be at least 8 characters".'</p>'; $j=false;}
			else {
				$stmt = $db->prepare('SELECT * FROM Lecture');
			      $stmt->execute();			
					$arr=array();
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					array_push($arr,$result['enroll_key']);
				}
				foreach($arr as $i){
					if($i==$_POST['enrollmentkey']){
					  echo '<p class="bg-danger">'."The enrollment key is already in use.Choose another one!".'</p>'; 
					  $j=false;
					  break;
					}
				}
			}
	}

			if($j){
			 $cname=$_SESSION['cname'];
			 $dateof=$_SESSION['dateof'];
			$lname=$_POST['lname'];
			$enroll_key =$_POST['enrollmentkey'];
		    $stmt = $db->prepare('INSERT INTO Lecture(lname,cname,dateof,enroll_key) VALUES (:lname,:cname,:dateof,:enroll_key)');
				$stmt->execute(array(
					':lname' => $lname,
					':cname' => $cname,
					':dateof' => $dateof,
					':enroll_key' => $enroll_key ));
				$id = $db->lastInsertId('lid');
			echo "<script>
             alert('Lecture was created'); 
             window.location.href='lectures.php';</script>";
			}		
   }
		?>
   <div class="form-group">
	 <input type="text" name="lname" id="lname" class="form-control input-lg" placeholder="Lecture Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['lname'], ENT_QUOTES); } ?>" tabindex="1" >
		</div>
	<div class="form-group">
		<input type="text" name="enrollmentkey" id="enrollmentkey" class="form-control input-lg" placeholder="Enrollment key"value="<?php if(isset($error)){ echo htmlspecialchars($_POST['enrollmentkey'], ENT_QUOTES); } ?>" tabindex="2" >
	</div>
<div class="buttonarea">
        <input type="submit" value="submit" name = "submit">
        <input type="reset" value="Clear the Info">
</div>
</form>
	
   
<?php
require('layout/footer.php'); 
?>