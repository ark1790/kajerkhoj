<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>

	
</head>
<body>

<div id="container">
	<h1>This is home</h1>
	<br/>
	<?php 

			foreach($results as $row)
			{
				echo $row->id. "<br/>";
				echo $row->name;
				echo "<br/><br/>";
			}

	 ?>
	<br/>
	<a href="home">home </a> &nbsp;
	<a href="about">about </a>
</div>

</body>
</html>