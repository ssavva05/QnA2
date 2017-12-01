<?php require "includes/config.php";?>
<?php 
$lid=$_GET['var'];
$ltitle=$_GET['var1'];
$i=1;
$question=$_GET['question'];
$totalans=$_GET['totalans'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>My Questions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
	<script src="functionQuestion.js"></script>
  </head>
  <body>
		<h1>My Questions</h1>
		<h2>Lecture <?php echo $lid;?> : <?php echo $ltitle;?> </h2>
		<br>
		<br>
		<form action="" method=post>
		<?php while($i<=$question){ ?>
			<input type="radio" id="radioQuestion" name="radioQuestion" value="<?php echo $i;?>">
			<label for = "radioQuestion">Question <?php echo $i?></label><br>
			<?php $i++;?>
		<?php } ?>
		<br>
		<input type="button" onclick="addQuestion(<?php echo $lid;?>,<?php echo $ltitle;?>,<?php echo $question;?>,<?php echo $totalans;?>)" value="Add Question">
		<!--<input type="button" onclick="editQuestion(<?php echo $question; ?>,<?php echo $totalans;?>)" value="Edit Question">-->
		<input type="submit" name="submit" value="Edit Question">
		<input type="submit" name="delete" value="Delete Question">
		</form>
  </body>
</html>

<?php 
if(isset($_POST['submit'])){
			if(isset($_POST['radioQuestion'])){ ?>
			<script> editQuestion(<?php echo $lid;?>,<?php echo $ltitle;?>,<?php echo $_POST['radioQuestion'];?>,<?php echo $totalans;?>);</script>
			<?php }else 
						echo "<script>alert(\"Attention: you have to select question first !\");</script>";
			
}
if(isset($_POST['delete'])){
	$stmt = $db->prepare('DELETE FROM question WHERE qid =:qid');
	$stmt->bindParam(':qid',$_POST['radioQuestion']);
	$stmt->execute();
	?>
	<script>deleteQuestion(<?php echo $question;?>,<?php echo $totalans;?>);</script>
	
<?php
	
}
?>

