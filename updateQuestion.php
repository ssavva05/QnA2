<?php require "includes/config.php"; ?>
<?php 
$qid=$_GET['var'];
$qtitle=$_GET['var1'];
$question=$_GET['question'];
$answer=$_GET['answer'];
$action=$_GET['action'];
$totalans=$_GET['totalans'];
$changes=$GET['changes'];
$i=1;
$answerValue="none";

//retrieve number of answers if action is edit
if($answer==-1){
	$stmt = $db->prepare('SELECT acounter FROM question WHERE qid=:qid;');
	$stmt->bindParam(':qid',$question);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	$answer=$result['acounter'];
	echo $answer;
}
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
<?php
	$stmt = $db->prepare('SELECT textofanswer FROM answer WHERE qid=:qid;');
	$stmt->bindParam(':qid',$question);
	$stmt->execute();
	while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
		if($i==1){?>
			<input type="text" name="<?php echo $i; ?>" id="ansr<?php echo $i; ?>" value="<?php echo $result['textofanswer']; ?>">
			<input type="button" class="w3-button w3-xlarge w3-circle w3-green w3-card-4" onclick="addAnswer(<?php echo $question;?>,<?php echo $answer;?>,<?php echo $totalans;?>,<?php echo $action;?>)" name="plus<?php echo $i; ?>" value="+">
			<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i;?>"><br>	
		<?php
		}else if($i<=$answer){?>
			<input type="text" name="<?php echo $i+1; ?>" id="ansr<?php echo $i+1; ?>" value="<?php echo $result['textofanswer'];?>">
			<input type="button" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" name="minus<?php echo $i+1; ?>" onclick="deleteAnswer(<?php echo $question;?>,<?php echo $totalans;?>,<?php echo $answer;?>,<?php echo $action;?>)" value="-">				
			<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i+1;?>"><br>
	<?php
		}
		$i++;
	}
	$j=i-1;
	while($j<=$answer){?>
			<input type="text" name="<?php echo $i+1; ?>" id="ansr<?php echo $i+1; ?>" value="<?php echo $result['textofanswer'];?>">
			<input type="button" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" name="minus<?php echo $i+1; ?>" onclick="deleteAnswer(<?php echo $question;?>,<?php echo $totalans;?>,<?php echo $answer;?>,<?php echo $action;?>)" value="-">
			<input type="radio" id="radioAnswer <?php echo $answer;?>" name="radioAnswer" value="<?php echo $i+1;?>"><br>
	<?php
		}
	?>
	<body>
</html>
<?php
//retrieve documents
		
		
		
		
		
		//update documents
		if(isset($_POST['submit'])){
			if(isset($_POST['radioAnswer'])){
				$answerValue=$_POST[$_POST['radioAnswer']];
				$stmt = $db->prepare('UPDATE question SET textofquestion=:tq, textofanswer=:ta WHERE qid=:qid;');
				$stmt->bindParam(':qid',$question);
				$stmt->bindParam(':tq',$_POST['questionbody']);
				$stmt->bindParam(':ta',$answerValue);
				$stmt->execute();
				for($j=1; $j<=$answer; $j++){
					$stmt = $db->prepare('UPDATE answer SET textofanswer=:ta WHERE qid=:qid AND aid=:aid;');
					$stmt->bindParam(':aid',$j);
					$stmt->bindParam(':qid',$question);
					$stmt->bindParam(':ta',$_POST[$j]);
					$stmt->execute();
			}
			}else
				echo "<script>alert(\"Attention: you have to select the correct answer first !\");</script>";
			
		
		}
?>