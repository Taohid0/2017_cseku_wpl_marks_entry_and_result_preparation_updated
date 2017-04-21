	<?php
	$hostname='localhost';
	$username='root';
	$password='';
	$databaseName='cse_ku_result';

	$connect = mysqli_connect($hostname,$username,$password,$databaseName);

	$query1 = "SELECT  DISTINCT `CourseID` FROM `tbl_course_student_registration` ORDER BY `CourseID` ASC";
	$query2 = "SELECT DISTINCT  `SessionID` FROM `tbl_course_student_registration`ORDER BY `SessionID` ASC";
	$query3 = "SELECT  DISTINCT `TermID` FROM `tbl_course_student_registration` ORDER BY `TermID` ASC";


	$result1 = mysqli_query($connect,$query1);
	$result2 = mysqli_query($connect,$query2);
	$result3 = mysqli_query($connect,$query3);

if(!empty($_POST)){
		if (isset($_POST['newcourseID'])){
			$courseID = $_POST['newcourseID'];
			$courseID2 = $_POST['newcourseID'];
		}
		else
			$courseID = $_POST['courseID'];
		if (isset($_POST['newsessionID'])){
			$sessionID = $_POST['newsessionID'];
			$sessionID2 = $_POST['newsessionID'];
		}
		else
			$sessionID = $_POST['sessionID'];
		if (isset($_POST['newtermID'])){
				$termID2 = $_POST['newtermID'];
				$termID = $_POST['newtermID'];
			}
		else 
			$termID = $_POST['termID'];
	}
		//$courseID2=$_GET['newcourseID'];
		//$sessionID2=$_GET['newsessionID'];
		//$termID2=$_GET['newtermID'];
		$epr='';
		$eps='';
	$x='';
	$n='';
	$y='';
	$msg='';
	$num= '0';
	$marks='';
	$ID[]='';
	$result4='';
	$result5='';
	$result11='';
	$result12='';
	$studentID[]='';
	$id[]='';
	$count='0';
	$c='0';
	$d='0';
	$countt='0';
	$min[]='';
	$max[]='';
	$grade[]='';
	$gpa[]='';
	$minw='';	
	$m='';
	$g='';
	$h='';
	$num12='';
	$row11='';
	$k='';
	$u='';
	//$b='';
	$e='';
	$mm='';
	?>

	<html>
	<head>
		<style type="text/css">

		div.absolute {
    position: absolute;
    top: 50px;
    right: 350;
    width: 600px;
    height: 100px;
 
}

			a:link {
    color:CadetBlue;
    background-color: transparent;
    text-decoration: none;
}
/*a:visited {
    color: yellow;
    background-color: transparent;
    text-decoration: none;
}*/
a:hover {
    color: yellow;
    background-color: transparent;
    text-decoration: none;

}
		</style>
	</head>
	<body>
		<!..............option bar creation......................>
		<h1 align="center"><font color="#2F4F4F">Marks Input</font></h1>
		<ul>
  <li><a href="home.php"><h4>Home</h4></a></li>
  <li><a href="view.php"><h4>View Result</h4></a></li>
  <li><a href="marksetup.php"><h4>Marks Setup</h4></a></li>
</ul>

		 <div class="absolute">
		

		 	<form name="form" method="post">
			<p> Course ID &nbsp
	<select name='courseID' class="mySelect" id='courseID'>
		<option>Select One</option>
			<?php while ($row1 =mysqli_fetch_array($result1)):;
	    ?> 
			<option value="<?php echo $row1['CourseID'];?>"><?php echo $row1['CourseID'];?></option>
	<?php endwhile; ?>
	</select>
	&nbsp &nbsp &nbsp &nbsp &nbsp
	    Session ID &nbsp 
	<select name='sessionID' id='sessionID'>
		<option>Select One</option>
	<?php while ($row2 =mysqli_fetch_array($result2)):;?>
			<option value="<?php echo $row2['SessionID'];?>" ><?php echo $row2['SessionID'];?></option>
		<?php endwhile; ?>
	</select>&nbsp &nbsp &nbsp &nbsp &nbsp
	Term ID &nbsp
	<select name='termID' id='termID'>
		<option>Select One</option>
	<?php while ($row3 =mysqli_fetch_array($result3)):;?>
			<option value="<?php echo $row3['TermID'];?>" ><?php echo $row3['TermID'];?></option>
		<?php endwhile; ?>
	</select></p>



	<input type= "submit" value="Table load" name="load" onclick="form.action='inputmarks.php?epr=save'"/><br>
	

	<?php $epr='';
	if(isset($_GET['epr']))
			$epr=$_GET['epr'];

		if($epr == 'save')
		{	
		echo "<p><input name='newcourseID' id='newcourseID'  value='$courseID'>&nbsp &nbsp &nbsp &nbsp &nbsp<input name='newsessionID' value='$sessionID'>&nbsp &nbsp &nbsp &nbsp &nbsp<input name='newtermID' value='$termID'></p>";
		echo "<h3>Marks Input Table</h3>
	<table border='1' cellspacing='0' cellpadding='0'>
	<thead>
	<th bgcolor='#808080'>Student ID</th>";
		
		}?><br>

	<!......................Header Creation...............>
	
	<?php

	//if(isset($_GET['epr']))
	//		$epr1=$_GET['epr'];

		if($epr == 'save')
		{	
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		$sql2 = ("SELECT `MarksHeader`,`MarksMax` FROM tbl_course_marks_setup WHERE tbl_course_marks_setup.`CourseID`= '$courseID' AND tbl_course_marks_setup.`SessionID`= '$sessionID' AND tbl_course_marks_setup.`TermID`= '$termID'");
		$result5= mysqli_query($connect,$sql2);
			/*if ($result5)
				$msg="save succecc!!";
			else
				$msg="ERROR";*/
			//echo "ok2";
		
	while ($row1 = mysqli_fetch_array($result5)){
		echo "
		<th bgcolor= '#808080'>".$row1['MarksHeader']."(".$row1['MarksMax'].")</th>";
	}
}
	?>

	</thead>
	<!.....................Column creation + Row creation......>
	<?php

	//if(isset($_GET['epr']))
			//$epr=$_GET['epr'];

		if($epr == 'save')
		{	
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		$sql1 = ("SELECT `StudentID`FROM tbl_course_student_registration WHERE tbl_course_student_registration.`CourseID`= '$courseID' AND tbl_course_student_registration.`SessionID`= '$sessionID' AND tbl_course_student_registration.`TermID`= '$termID'");
		$sql8 = ("SELECT `MarksID` FROM tbl_course_marks_setup WHERE tbl_course_marks_setup.`CourseID`= '$courseID' AND tbl_course_marks_setup.`SessionID`= '$sessionID' AND tbl_course_marks_setup.`TermID`= '$termID'");
		$result4= mysqli_query($connect,$sql1);
		//echo "ok3";
		//$marksID=$_GET['MarksID'];
		//$studentID=$_GET['StudentID'];
	
	$student='0';
	while ($row = mysqli_fetch_array($result4)){
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		$sql7 = ("SELECT count(`MarksID`) AS total FROM tbl_course_marks_setup WHERE tbl_course_marks_setup.`CourseID`= '$courseID' AND tbl_course_marks_setup.`SessionID`= '$sessionID' AND tbl_course_marks_setup.`TermID`= '$termID'");
		//var_dump($result4);
		$result7= mysqli_query($connect,$sql7);

		$values = mysqli_fetch_assoc($result7);
		$num = $values['total'];
		$k = $row['StudentID'];
		//var_dump($k);
		//echo $k;
		 echo "<tr>
		<td>".$row['StudentID']."</td> " ?>
		<?php
		
		$result8= mysqli_query($connect,$sql8);	
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		$sql14 = ("SELECT count(`MarksID`) AS `all` FROM tbl_course_marks_result WHERE tbl_course_marks_result.`StudentID` = '$k' AND tbl_course_marks_result.`CourseID`='$courseID'  AND tbl_course_marks_result.`SessionID`='$sessionID' AND tbl_course_marks_result.`TermID`='$termID' ");
		$result14 = mysqli_query($connect,$sql14);
		if($result14 === FALSE) { 
        die(mysqli_error($connect)); // better error handling
    }

	    $row14=mysqli_fetch_assoc($result14);
		$num14 = $row14['all'];

	          
		 for ($x = 1; $x <= $num; $x++) {
		 	$count++;
		 	$row8= mysqli_fetch_array($result8);
	          

	    $marksID[$x]=$row8['MarksID'];
	    $h=$row8['MarksID'];
	    
	 
	   
	    $u='0';

	    
		if($num14 > 0) {
			//echo "HI!";
			$mm='1';
     		$result13="SELECT `MarksValue` FROM tbl_course_marks_result WHERE StudentID = '$k' AND CourseID='$courseID' AND SessionID='$sessionID' AND TermID='$termID' AND MarksID='$h'";
			$result12= mysqli_query($connect,$result13);
		//	for($z=0;$z<3;$z++){
			$values12 = mysqli_fetch_assoc($result12);
		    $num12 = $values12['MarksValue'];
		  //  var_dump($num12);
			echo "<td><input id=".$row['StudentID'].$row8['MarksID']." name=".$row['StudentID']. $row8['MarksID']." type='text' value='$num12'></td>";		
			 
		//}
		}
		 else {
		 //	echo"NO";
		 	$mm='0';
    	echo "<td><input id=".$row['StudentID']. $row8['MarksID']." name=".$row['StudentID']. $row8['MarksID']." type='text' value= '$u'></td>";
		// $ID[$count]= $_POST[$row['StudentID'].$row8['MarksID']];
		 
		}
		if ( ! isset($_POST[$row['StudentID'].$row8['MarksID']])) {
        $_POST[$row['StudentID'].$row8['MarksID']] = null;
    }



		$ID[$count]= $_POST[$row['StudentID'].$row8['MarksID']];
		//var_dump($ID[$count]);
		}
	     $studentID[$student]=$row['StudentID'];
	          $student++;
		"
		</tr>";
		
	}
}
	/*for ($y = 0; $y < $student; $y++) {
		
		
		for ($x = 1; $x <= $num; $x++){
			echo $studentID[$y];
			echo $marksID[$x];
		}
	}*/
	?>

	</table><br>

	<input type="submit" value="Marks submit" name="submit" id="submit" onclick="form.action='inputmarks.php?epr=save&new=go'">
	<?php 

	    if(isset($_GET['new']))
			$n=$_GET['new'];

		if($n =='go')
		{	
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		for ($y = 0; $y < $student; $y++) {
			$c='0';
			$d=$studentID[$y];
			for ($x = 1; $x <= $num; $x++){
				$countt++;
				$a=$studentID[$y];
				$b=$marksID[$x];
				$c=$c+$ID[$countt];
				$e=$ID[$countt];
		if($mm==0)
		{	
	//	echo "=0";	
		$sql9 =" INSERT INTO tbl_course_marks_result(CourseID,SessionID,TermID,StudentID,MarksID,MarksValue) VALUES ('$courseID2','$sessionID2','$termID2','$a','$b','$e') ";
		$result9= mysqli_query($connect,$sql9);
	    }
	    else if($mm==1)
		{
	//	echo $e;		
		$sql20 =" UPDATE tbl_course_marks_result SET `MarksValue`= '$e' WHERE StudentID = '$a' AND `CourseID`='$courseID' AND `SessionID`='$sessionID' AND `TermID`='$termID' AND `MarksID`='$b' ";
		$result20= mysqli_query($connect,$sql20);
	    }

		//echo "submit";
		//echo ;
		
	}
	$sql11="SELECT count(`MarksMin`) AS minw FROM tbl_marks_grade";
	$result11= mysqli_query($connect,$sql11);
	$values11 = mysqli_fetch_assoc($result11);
	$minw = $values11['minw'];
	
	$sql10="SELECT `MarksMin` AS min,`MarksMax` AS max, `MarksGrade` AS grade,`GPA`  AS gpa FROM tbl_marks_grade";
		$result10= mysqli_query($connect,$sql10);
		
for($w=0;$w<$minw;$w++){
		$values10 = mysqli_fetch_assoc($result10);
		

		
		$min[$w] = $values10['min'];
		$max[$w] = $values10['max'];
		$grade[$w] = $values10['grade'];
		$gpa[$w] = $values10['gpa'];
		if ($c>=$min[$w] && $c<=$max[$w]) {

			$m=$grade[$w];
			$g=$gpa[$w];
		}
}
	if($mm==0)
		{	
	$query4="INSERT INTO tbl_course_marks_result_publish (CourseID,SessionID,TermID,StudentID,MarksTotal,MarksGrade,GPA) VALUES ('$courseID2','$sessionID2','$termID2','$d','$c','$m','$g')";
	$result4 = mysqli_query($connect,$query4);
	}
	if($mm==1)
		{
			$query30="UPDATE tbl_course_marks_result_publish SET `MarksTotal`='$c' , `MarksGrade`=' $m' ,`GPA`='$g' WHERE `StudentID` = '$d' AND `CourseID`='$courseID' AND `SessionID`='$sessionID' AND `TermID`='$termID'";
	        $result30 = mysqli_query($connect,$query30);
		}
	}
	//echo $min[2];
	}
		//else
		//echo "good";
	?>
	</form></div>


	</body>
	</html