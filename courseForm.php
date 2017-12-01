<?php
 require('includes/config.php'); 

require('layout/header.php'); 
$title = 'Course Additon';
//include header template

require('layout/footer.php'); 
?>
<form method="post">
<fieldset>
<legend>Please Complete the Details</legend>
<p> &nbsp &nbsp <a href='memberpage.php'>Back</a></p>

     <div class ="form-group">
      <label for="name" class="control-label col-xs-2">Course name</label>
      <div class="col-xs-6">
      <input type="text" name="Coursename" id="Coursename" size="20" class="form-control" autofocus required pattern = "[A-Z]+[1-9]+" title="Please enter a name of the course(for example:epl425)">
	   <hr>
	   <?php
			if(isset($_REQUEST["submit"])){
				$j=true;
				$cname=$_POST['Coursename'];
				$value=$_POST['selected'];
				$memberID=$_SESSION['memberID'];
				$Year=date("Y");
				$stmt = $db->prepare('SELECT dateof FROM Course WHERE cname = :cname');
				$stmt->bindParam(':cname',$cname);
				$stmt->execute();
				 $arr=array();
				 while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					 array_push($arr,$result['dateof']);
				 }
				 
				  				
				$value1=$Year."-09-01";
				$value2=$Year."-01-01"; 
				foreach ($arr as $i){ 
					if($value=="1"){
						if($i==$value1){
							echo '<p class="bg-danger">'."This course already exists on this session".'</p>'; $j=false; break;}}
				else if($value=="2"){
						if($i==$value2){
						echo '<p class="bg-danger">'."This course already exists on this session".'</p>'; $j=false; break;}}
					else if($value=="None"){
					 echo '<p class="bg-danger">'."You didn't enter the session".'</p>'; $j=false; break;}
				}
					
			  if($j){
				   $tempa=$Year."-9-1 00:00:00";
				  $tempb=$Year."-1-1 00:00:00";
				 if($value=="1"){
					 $stmt=$db->prepare('INSERT INTO Course(cname, memberID,dateof) VALUES (:cname,:memberID,:dateof)');
			 $stmt->execute(array(
					':cname' => $cname,
					':memberID' => $memberID,
					':dateof' =>$tempa
				));
			  }
				else{
					 $stmt=$db->prepare('INSERT INTO Course(cname, memberID,dateof) VALUES (:cname,:memberID,:dateof)');
			 $stmt->execute(array(
					':cname' => $cname,
					':memberID' => $memberID,
					':dateof'=> $tempb
				));
				 }
			echo "<script>
             alert('Course was created'); 
             window.location.href='memberpage.php';</script>";
			
		  }
		  }
		?>
	   <select method=post name="selected" >	
	   <option name="none" value="None">Please select the session</option>
		<option name="myselect2"  value="1">Χειμερινό Εξάμηνο</option>
		<option name="myselect3"   value="2">Εαρινό Εξάμηνο</option>				
		</select> 	 
	 </div></div>
<div class="buttonarea">
        <input type="submit" value="submit" name = "submit">
        <input type="reset" value="Clear the Info">
</div>
</fieldset>
</form>