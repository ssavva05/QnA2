<?php require "queries.php";?>
<?php 
			$arr=array();
			$arr1=array();
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($arr, $row['qid']); array_push($arr1, $row['seen']);
			}
			$j=1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="container">
      <div class="form-signin">
		<h1>Welcome to <?php echo $result['cname']; ?>!</h1>
		<ul>
			<?php foreach($arr as $i){?>
			<li> question <?php echo $j; $j++; ?>  <button onclick="check(<?php echo $j;?>,<?php echo json_encode($arr1);?>)">GO</button></li>
			<?php } ?>
        <div class="alert alert-success">You have been <strong> enrolled </strong>.</div>
        <a href="enroll/logout.php" class="btn btn-default btn-lg btn-block">Exit</a>
      </div>
    </div>
  </body>
</html>
<script>
function check(j,arr1){
	var k=j-2;
	alert(k+1);
	if(!arr1[k]){
		alert("Question is not Active!");
	}else{
		window.location.href='question.php?var=<?php echo $i ?>&var1=<?php echo $j-1 ?>';
	}
};		
</script>


