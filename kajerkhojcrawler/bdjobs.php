<?php 
include("simple_html_dom.php");

$con = mysql_connect("localhost","root","");
mysql_select_db('kajerkhoj') or die (mysql_error());
//******These two line are used for Bangla Character *********/
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error());

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$categoryID=1;

while($categoryID<21)
	{

	$pageID=1;
	while($pageID<21)
		{
		// Retrieve the DOM from a given URL
		$html = file_get_html('http://jobs.bdjobs.com/jobsbycategory.asp?cat='.$categoryID.'&jt=EngOn&pg='.$pageID);

	
		$cells = $html->find('td[bgcolor=#EEF1F9]');
		$p=0;
		$linkcount=0;
		$resultcount=0;
	
		$alldata=array("");
		$links=array("");
	
	
		//print_r($cells);
		//echo "<br>";
		
		foreach($cells as $cell) 
			{
			$resultcount++;
			
			if ($cell->find('workshopTitle')) {
				continue;
			}
			
			
			//echo $cell."<br>";
			
			
			$alldata[$p]=$cell->plaintext;//Taking raw data to indexed array
			$alldata[$p]=mysql_real_escape_string($alldata[$p]);//taking care of special character;
	
			
			
			if($alldata[$p]=="No record found."){break 2;} //Checking if the page has any record or not
	
			//Extracting link from job name START
			$tmp = strstr($cell, "JobDetails");
			$tmp2 = str_replace("\" target=\"_blank\">"," ", $tmp);
			$short = substr($tmp2, 0, strpos( $tmp2, ' '));
		
		
		if($short!="")
			{
			$short='http://jobs.bdjobs.com/'.$short;
			$links[$linkcount]=$short;
			
			echo $short."<br>";
			$links[$linkcount]=mysql_real_escape_string($links[$linkcount]);
			$linkcount++;
		}
		//Extracting link from job name END
	

	$p++;
	}
	
	
	if($resultcount<4){break;}
	
	//echo "I'm here";
	
	//Inserting data to MySql Database START
	

	for($p=0;$p<$resultcount;$p=$p+4)
	{
	
	$q=$p+1;
	$r=$p+2;
	$s=$p+3;
	$t=$p/4-1;
	
	
	$tmp=$alldata[$s];
	
	$tmp3=explode('(', $tmp);
	
	$tmp2 = array_shift($tmp3);
	
	$alldata[$s]=$tmp2;

	
	if(empty($alldata[$p])||empty($alldata[$q])|| empty($links[$t]) || empty($alldata[$r]) || empty($alldata[$s])){ continue;}
	
	
	if($categoryID==1){$cid=1;}
	else if($categoryID==2){$cid=12;}
	else if($categoryID==3){$cid=2;}
	else if($categoryID==4){$cid=3;}
	else if($categoryID==5){$cid=4;}
	else if($categoryID==6){$cid=5;}
	else if($categoryID==7){$cid=6;}
	else if($categoryID==8){$cid=7;}	
	else if($categoryID==9){$cid=8;}
	else if($categoryID==10){$cid=12;}
	else if($categoryID==11){$cid=9;}
	else if($categoryID==12){$cid=10;}
	else if($categoryID==13){$cid=12;}
	else if($categoryID==14){$cid=11;}
	else if($categoryID==15){$cid=12;}
	else if($categoryID==16){$cid=12;}
	else if($categoryID==17){$cid=12;}
	else if($categoryID==18){$cid=12;}	
	else if($categoryID==19){$cid=12;}
	else if($categoryID==20){$cid=12;}
	else {$cid=12;}
	
	$result=mysql_query("INSERT INTO posts(postedin, cid,  comname, jobtitle, link, qualification, deadline) VALUES ('bdjobs','{$categoryID}','{$alldata[$p]}','{$alldata[$q]}', '{$links[$t]}', '{$alldata[$r]}' , '{$alldata[$s]}')");
	
	if($result)
		echo "successful";
	else
		echo $con->error;	
		
	} 	//Inserting data to MySql Database END


	//print_r($alldata);
	
	$pageID++;
	}
	$categoryID++;
	}

mysql_close($con);
?>
