<?php
$hostname='localhost';
$username='root';
$password='';
$databaseName='cse_ku_result';

$connect = mysqli_connect($hostname,$username,$password,$databaseName);
$msg='';
$epr='';
$result40='';
$result50='';
$result45='';
/*$query1 = "SELECT  DISTINCT `CourseID` FROM `tbl_course_teacher` ORDER BY `CourseID` ASC";
$query2 = "SELECT DISTINCT  `SessionID` FROM `tbl_course_teacher`ORDER BY `SessionID` ASC";
$query3 = "SELECT  DISTINCT `TermID` FROM `tbl_course_teacher` ORDER BY `TermID` ASC";

$result1 = mysqli_query($connect,$query1);
$result2 = mysqli_query($connect,$query2);
$result3 = mysqli_query($connect,$query3);*/
if(!empty($_POST)){
$connect = mysqli_connect($hostname,$username,$password,$databaseName);

$epr='';
$msg='';
if(isset($_GET['epr']))
		$epr=$_GET['epr'];

	if($epr = 'save')
	{	//echo "OKKK!!";
		$max = $_POST['max'];
		$min = $_POST['min'];
		$grade = $_POST['grade'];
		$gpa = $_POST['gpa'];
$sql40 = "INSERT INTO tbl_marks_grade(MarksMin,MarksMax,MarksGrade,GPA) VALUES ('$min','$max','$grade','$gpa') ";
		//$insert = $connect->query($sql);
		$result40= mysqli_query($connect,$sql40);
		

		//$sql1="INSERT INTO tbl_course_marks_setup (`TeacherID`) VALUES (SELECT (`TeacherID`) FROM tbl_course_teacher
//WHERE `CourseID` = $courseID AND 
//`SessionID` = $sessionID AND `TermID` = $termID)";
//$insertt = mysqli_query($connect,$sql1);
	
		
	}
}
	if($epr ='delete'){
		
		$id=$_GET['id'];

		$sql50 = "DELETE FROM tbl_marks_grade WHERE tbl_marks_grade.`ID` = '$id'";
		$result50 = mysqli_query($connect,$sql50);
		if($result40 === FALSE) { 
        die(mysqli_error($connect)); // better error handling
    }
	}


/*$sql1="INSERT INTO tbl_course_marks_setup (`TeacherID`) SELECT (`TeacherID`) FROM tbl_course_teacher
WHERE `CourseID` = tbl_course_marks_setup.`CourseID` AND 
`SessionID` = tbl_course_marks_setup.`SessionID` AND `TermID` = tbl_course_marks_setup.`TermID`";
$insertt = mysqli_query($connect,$sql1);
if($insertt)
{
	$msg = "succ";
}
else
$msg="err";*/
//$connect->close();

?>

<html><head>
<style>
div.relative {
    position: relative;
    width: 400px;
    height: 200px;
    border: 3px solid #73AD21;
} 

div.absolute {
    position: absolute;
    top: 40px;
    right: 500;
    width: 200px;
    height: 100px;
 
}

a:link {
    color: CadetBlue;
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

<!...................option bar & entry................>

	<h1><font color="#2F4F4F">Grade Setup</font></h1>
	<form name="gradesetup" method="post" action='gradesetup.php?epr=save'>

<br>
<p>Maximum Marks &nbsp &nbsp &nbsp &nbsp<input type="text" name='max' id='max'></p>
<p>Minimum Marks &nbsp &nbsp &nbsp &nbsp <input type="text" name='min' id='min' ></p>
<p>Grade &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name='grade' id='grade'></p>
<p>GPA  &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp   &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp<input type="text" name='gpa' id='gpa'></p><br>
<input name="submit" id="submit" type="submit" value="submit"><br><br>

<ul>
  <li><a href="home.php"><h4>Home</h4></a></li>
</ul>


</form>





<!...........table header...............>
<div class="absolute"><h2><font color="#2F4F4F">Marks list</font></h2>
<table border="1" cellspacing="0" cellpadding="0">
<thead>
<th bgcolor= "#808080">MAX</th>
<th bgcolor= "#808080">MIN</th>
<th bgcolor= "#808080">GRADE</th>
<th bgcolor= "#808080">GPA</th>
<th bgcolor= "#808080">Action</th>
</thead></div>





<!....................column value...........>
<?php
$connect = mysqli_connect($hostname,$username,$password,$databaseName);
$sql45 = ("SELECT `ID`,`MarksMin`,`MarksMax`,`MarksGrade`,`GPA` FROM tbl_marks_grade");
$result45= mysqli_query($connect,$sql45);
while ($row45 = mysqli_fetch_array($result45)){
	echo "<tr>
	<td>".$row45['MarksMax']."</td>
	<td>".$row45['MarksMin']."</td>
	<td>".$row45['MarksGrade']."</td>
	<td>".$row45['GPA']."</td>
	<td align='center' size='2'>
	<a href='gradesetup.php?epr=delete&id=".$row45['ID']."'>DELETE</a>
	
	</td>
	</tr>";
}
?>
</table>
<?php echo $msg; ?>




	 
</body>
</html>