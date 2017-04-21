<?php
	$hostname='localhost';
	$username='root';
	$password='';
	$databaseName='cse_ku_result';

	$connect = mysqli_connect($hostname,$username,$password,$databaseName);

	//$query1 = "SELECT  DISTINCT `CourseID` FROM `tbl_course_student_registration` ORDER BY `CourseID` ASC";
	$query2 = "SELECT DISTINCT  `SessionID` FROM `tbl_course_student_registration`ORDER BY `SessionID` ASC";
	$query3 = "SELECT  DISTINCT `TermID` FROM `tbl_course_student_registration` ORDER BY `TermID` ASC";
	$query4 = "SELECT  DISTINCT `StudentID` FROM `tbl_course_student_registration` ORDER BY `StudentID` ASC";



	//$result1 = mysqli_query($connect,$query1);
	$result2 = mysqli_query($connect,$query2);
	$result3 = mysqli_query($connect,$query3);
	$result4 = mysqli_query($connect,$query4);


	$studentID='';
	$sessionID='';
if(!empty($_POST)){
	    $studentID = $_POST['studentID'];
	
		$sessionID = $_POST['sessionID'];
	
	    $termID = $_POST['termID'];
	}
/*	if(!empty($_POST)){
		$studentID2=$_POST['newstudentID'];
		$sessionID2=$_POST['newsessionID'];
		$termID2=$_POST['newtermID'];
	}*/
	
$epr='';
$result5='';
$cid[]='';
	$mt[]='';
	$mg[]='';
	$gpa[]='';
	$num1='';	
	$x='';
	$values1='';
	$values='';
	?>




<html>
	<head>

				<style>
div.relative {
    position: relative;
    width: 400px;
    height: 200px;
    border: 3px solid #73AD21;
} 

div.absolute {
    position: absolute;
    top: 0px;
    right: 500;
    width: 600px;
    height: 100px;
 
}

a:link {
    color: blue;
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
		
		<font color="#2F4F4F"><h1>Result View</h1></font>
			<ul>
  <li><a href="courseview.php"><h4>Course Wise</h4></a></li><br>
  <li><a href="home.php"><h4>Home</h4></a></li>
  <li><a href="inputmarks.php"><h4>Input Result</h4></a></li>
</ul>
		
 <div class="absolute">   
<font color="#5F9EA0"><h2>Student Wise Result</h2></font>
        <form name="form" method="post">
		<p> Student ID &nbsp
	<select name='studentID' class="mySelect" id='studentID'>
		<option>Select One</option>
			<?php while ($row1 =mysqli_fetch_array($result4)):;
	    ?>
			<option value="<?php echo $row1['StudentID'];?>"><?php echo $row1['StudentID'];?></option>
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
		
<input type= "submit" value="load" name="load" onclick="form.action='studentview.php?epr=save'"/><br>
	
	<?php 
	if(isset($_GET['epr']))
			$epr=$_GET['epr'];

		if($epr == 'save')
		{	
		echo "<p><h4>Student ID:  ".$studentID." &nbsp &nbsp &nbsp &nbsp &nbsp Session: ".$sessionID." &nbsp &nbsp &nbsp &nbsp &nbspTerm: ".$termID."</h4></p>";
		//echo "ok1";
		
		}?><br><br> 
		<h3>Result Table</h3>
	<table border="1" cellspacing="0" cellpadding="0">
	<thead>
	<th bgcolor= "#808080">Course ID</th>
	<th bgcolor= "#808080">Total Marks</th>
	<th bgcolor= "#808080">Grade</th>
	<th bgcolor= "#808080">GPA</th>
	</thead>
	<?php

	//if(isset($_GET['epr']))
	//		$epr1=$_GET['epr'];

		if($epr == 'save')
		{	
		$connect = mysqli_connect($hostname,$username,$password,$databaseName);
		//$sql7=("SELECT count(`CourseID`) AS total FROM tbl_course_marks_result_publish WHERE tbl_course_marks_result_publish.`StudentID`= '$studentID' AND tbl_course_marks_result_publish.`SessionID`= '$sessionID' AND tbl_course_marks_result_publish.`TermID`= '$termID'");
		$sql5 = ("SELECT `CourseID` ,`MarksTotal`,`MarksGrade` ,`GPA` FROM tbl_course_marks_result_publish WHERE tbl_course_marks_result_publish.`StudentID`= '$studentID' AND tbl_course_marks_result_publish.`SessionID`= '$sessionID' AND tbl_course_marks_result_publish.`TermID`= '$termID'");
		$result5= mysqli_query($connect,$sql5);
		
			//echo "ok2";
		
	while ($row2 = mysqli_fetch_array($result5)){

		echo "<tr><td>".$row2['CourseID']."</td>
		<td>".$row2['MarksTotal']."</td>
		<td>".$row2['MarksGrade']."</td>
		<td>".$row2['GPA']."</td></tr>";
	
	}
}
	//echo $cid[0];
	?>

     </form>
     	
	 </div>  
	</body>
	</html>
