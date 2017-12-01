<?php require "includes/config.php"; ?>
<?php 

$qid=$_GET['var'];
$qtitle=$_GET['var1'];
$question=$_GET['question'];
$answer=$_GET['answer'];
$action=$_GET['action'];
$totalans=$_GET['totalans'];
$refresh=$_GET['r'];
$i=1;
$answerValue="none";
//$_SESSION['usertxt']=array($answer);
if($refresh==0)
	$_SESSION['usertxt']=array(30);
	
	
//retrieve number of answers if action is edit
if($answer==-1){
	$stmt = $db->prepare('SELECT acounter FROM question WHERE qid=:qid;');
	$stmt->bindParam(':qid',$question);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	$answer=$result['acounter'];
	
	$stmt = $db->prepare('SELECT qcounter FROM lecture WHERE lid=:lid;');
	$stmt->bindParam(':lid',$qid);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	$qcounter=$result['qcounter'];
}else
	$qcounter=$question;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="functionEditQuestion.js"></script>
  </head>
  <body>
  <form method="post">
  <?php 
  //if action is add question
  if($action==1){
	  if($refresh==0){?>
		Name:  Question <?php if($action==1) echo $question+1; else echo $question; ?> <br>
		Question Body:  <input type="text" name="questionbody" id="qstnd" value="Write the body of the question here" size="35"><br>
		Choose the correct one:<br>
		Possible Answers:
		  <input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="Answer <?php echo $i; ?>">
		  <input type="submit" class="w3-button w3-xlarge w3-circle w3-green w3-card-4" name="plus" value="+">
		  <input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i;?>" onclick="document.getElementById('submit').disabled = false;"><br>
		<?php 
		}else{?>
		
		Name: Question <?php if($action==1) echo $question+1; else echo $question; ?><br>
		Question Body:  <input type="text" name="questionbody" id="qstnd" value="<?php echo $_SESSION['usertxt'][0]?>" size="35"><br>
		Choose the correct one:<br>
		Possible Answers:
		  <input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="<?php echo $_SESSION['usertxt'][$i];?>">
		  <input type="submit" class="w3-button w3-xlarge w3-circle w3-green w3-card-4" name="plus" value="+">
		  <input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i;?>" onclick="document.getElementById('submit').disabled = false;"><br>
			<?php 
			while($i<$answer){ ?>
				<input type="text" name="<?php echo $i+1; ?>" id="ansr<?php echo $i+1; ?>" value="<?php echo $_SESSION['usertxt'][$i+1];?>">
				<input type="submit" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" name="minus"  value="-">
				<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i+1;?>" onclick="document.getElementById('submit').disabled = false;"><br>
			<?php 
				$i++;
			}
			
			
		}
	}
	//if action is edit question, retrieve from db the answers
	else{
		$stmt = $db->prepare('SELECT textofquestion FROM question WHERE qid=:qid;');
		$stmt->bindParam(':qid',$question);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_ASSOC);

		if($refresh==0){?>
			Name: Question <?php if($action==1) echo $question+1; else echo $question; ?><br>
			Question Body:  <input type="text" name="questionbody" id="qstnd" value="<?php echo $result['textofquestion'];?>" size="35"><br>
			Choose the correct one:<br>
			Possible Answers:
			<?php
			$stmt = $db->prepare('SELECT textofanswer FROM answer WHERE qid=:qid;');
			$stmt->bindParam(':qid',$question);
			$stmt->execute();
			while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
				if($i==1){?>
					<input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="<?php echo $result['textofanswer']; ?>">
					<input type="submit" name="plus" class="w3-button w3-xlarge w3-circle w3-green w3-card-4" value="+">
					<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i;?>" onclick="document.getElementById('submit').disabled = false;"><br>	
				<?php
				}else if($i<=$answer){?>
					<input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="<?php echo $result['textofanswer'];?>">
					<input type="submit" name="minus" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" value="-">
					<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i;?>" onclick="document.getElementById('submit').disabled = false;"><br>
			<?php
				}
				$i++;
			}
			$j=$i-1;
		}else{ 
			$j=1; ?>
			Name: Question <?php if($action==1) echo $question+1; else echo $question; ?><br>
			Question Body:  <input type="text" name="questionbody" id="qstnd" value="<?php echo $_SESSION['usertxt'][0]?>" size="35"><br>
			Choose the correct one:<br>
			Possible Answers:
			<input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="<?php echo $_SESSION['usertxt'][$j]; ?>">
			<input type="submit" name="plus" class="w3-button w3-xlarge w3-circle w3-green w3-card-4" value="+">
			<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $j;?>" onclick="document.getElementById('submit').disabled = false;"><br>	
		<?php
		}
		while ($j<$answer){?>
			<input type="text" name="<?php echo $j+1; ?>" id="ansr<?php echo $j+1; ?>" value="<?php echo $_SESSION['usertxt'][$j+1];?>">
			<input type="submit" name="minus" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" value="-">
			<input type="radio" id="radioAnswer <?php echo $j+1;?>" name="radioAnswer" value="<?php echo $j+1;?>" onclick="document.getElementById('submit').disabled = false; "><br>
		<?php
			$j++;
			}
	}?>
	<input type="submit" name="submit" value="Submit" id="submit" disabled>
	<input type="button" onclick="deleteAllAnswers(<?php echo $qcounter;?>,<?php echo $totalans;?>,<?php echo $action;?>)" value="Clear All">
  </form>
  </body>
 </html>
 <?php 
	if($action==1){
		//write documents
		if(isset($_POST['submit'])){
			if(isset($_POST['radioAnswer'])){
				$question++;
				$answerValue=$_POST[$_POST['radioAnswer']];
				$stmt = $db->prepare('INSERT INTO question (qid, textofquestion, textofanswer, acounter) values (:qid,:tq,:ta,:ca);');
				$stmt->bindParam(':qid',$question);
				$stmt->bindParam(':tq',$_POST['questionbody']);
				$stmt->bindParam(':ta',$answerValue);
				$stmt->bindParam(':ca',$i);
				$stmt->execute();
				
				for($j=1; $j<=$answer; $j++){
					$ansid=$j+$totalans;
					$stmt = $db->prepare('INSERT INTO answer (aid,qid,textofanswer) values (:aid,:qid,:ta);');
					$stmt->bindParam(':aid',$ansid);
					$stmt->bindParam(':qid',$question);
					$stmt->bindParam(':ta',$_POST[$j]);
					$stmt->execute();
				}
				
				$stmt= $db->prepare('UPDATE lecture SET qcounter=:qc WHERE lid=:lid;');
				$stmt->bindParam(':lid',$qid);
				$stmt->bindParam(':qc',$question);
				$stmt->execute();
				?>
				
				<script>goBack(<?php echo $qcounter;?>,<?php echo $answer;?>,<?php echo $totalans;?>,<?php echo $action;?>);</script>
			<?php	
			}else 
				echo "<script>alert(\"Attention: you have to select the correct answer first !\");</script>";
		
		}
	}
	if($action==0){
		
			
		
		//update documents
		if(isset($_POST['submit'])){
			if(isset($_POST['radioAnswer'])){
				
				$answerValue=$_POST[$_POST['radioAnswer']];
				$stmt = $db->prepare('UPDATE question SET textofquestion=:tq, textofanswer=:ta, acounter=:ac WHERE qid=:qid;');
				$stmt->bindParam(':qid',$question);
				$stmt->bindParam(':tq',$_POST['questionbody']);
				$stmt->bindParam(':ta',$answerValue);
				$stmt->bindParam(':ac',$answer);
				$stmt->execute();
				
				$stmt = $db->prepare('DELETE FROM answer WHERE qid =:qid');
			    $stmt->bindParam(':qid',$question);
			    $stmt->execute();
				
				for($j=1; $j<=$answer; $j++){
					$ansid=$j+$totalans;
					$stmt = $db->prepare('INSERT INTO answer (aid,qid,textofanswer) values (:aid,:qid,:ta);');
					$stmt->bindParam(':aid',$ansid);
					$stmt->bindParam(':qid',$question);
					$stmt->bindParam(':ta',$_POST[$j]);
					$stmt->execute();
				}
				?>
				<script>goBack(<?php echo $qcounter;?>,<?php echo $answer;?>,<?php echo $totalans;?>,<?php echo $action;?>);</script>
			<?php	
			}else{
				for($u=1; $u<=$answer; $u++){
					$_SESSION['usertxt'][$u]=$_POST[$u]; //echo $_SESSION['usertxt'][$u]." ";	
				}
				echo "<script>alert(\"Attention: you have to select the correct answer first !\");</script>";
				
			}
		
		}
	}
	//save user documents
			if(isset($_POST['plus'])){
				$_SESSION['usertxt'][0]=$_POST['questionbody'];
				for($u=1; $u<=$answer; $u++){
					$_SESSION['usertxt'][$u]=$_POST[$u]; //echo $_SESSION['usertxt'][$u]." ";
				}
				$_SESSION['usertxt'][$u]="Answer ".$u;
				?>
				<script>addAnswer(<?php echo $question;?>,<?php echo $answer;?>,<?php echo $totalans;?>,<?php echo $action;?>);</script>
			<?php
			}else if(isset($_POST['minus'])){
				$_SESSION['usertxt'][0]=$_POST['questionbody'];
				for($u=1; $u<=$answer; $u++){
					$_SESSION['usertxt'][$u]=$_POST[$u]; //echo $_SESSION['usertxt'][$u]." ";	
				}?>
				<script>deleteAnswer(<?php echo $question;?>,<?php echo $answer;?>,<?php echo $totalans;?>,<?php echo $action;?>);</script>
			<?php
			}
	
 ?>