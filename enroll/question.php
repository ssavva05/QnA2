<?php require "queries.php";?>
<?php 
$qid=$_GET['var'];
$qnum=$_GET['var1'];

$stmt = $db->prepare('SELECT * FROM question WHERE qid = :qid');
$stmt->bindParam(':qid',$qid);
$stmt->execute();
$result1 = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM answer WHERE qid = :qid');
$stmt->bindParam(':qid',$qid);
$stmt->execute();
$arr=array();
while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($arr, $row['textofanswer']);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="container">
      <div class="form-signin">
		<h1>Welcome to	Question <?php echo $qnum; ?>!</h1>
		<p> <?=$result1['textofquestion']?></p>
		<form action="" method=post>
			<?php foreach($arr as $i){?>
				<input type="radio" name="radio" value="<?php echo $i ?>"><?php echo $i ?><br>
			<?php } ?>
			<input type="submit" name="submit">
		</form>
      </div>
    </div>
	<p> 
	<?php
		if (isset($_POST['submit'])) {
			if(isset($_POST['radio'])){
				echo "You have selected :".$_POST['radio'];  //  Displaying Selected Value
				if(strcmp($_POST['radio'],$result1['textofanswer'])==0){
					echo "\nAnd your answer is TRUE!!";
				}else{
					echo "\nAnd your answer is FALSE!!";
				}
			}
		} 
	?>
	</p>
  </body>
</html>