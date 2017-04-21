<?php
$hostname='localhost';
$username='root';
$password='';
$databaseName='cse_ku_result';

$connect = mysqli_connect($hostname,$username,$password,$databaseName);
$msg='';
$epr='';
$query1 = "SELECT  DISTINCT `CourseID` FROM `tbl_course_teacher` ORDER BY `CourseID` ASC";
$query2 = "SELECT DISTINCT  `SessionID` FROM `tbl_course_teacher`ORDER BY `SessionID` ASC";
$query3 = "SELECT  DISTINCT `TermID` FROM `tbl_course_teacher` ORDER BY `TermID` ASC";

$result1 = mysqli_query($connect,$query1);
$result2 = mysqli_query($connect,$query2);
$result3 = mysqli_query($connect,$query3);
if(!empty($_POST)){
$connect = mysqli_connect($hostname,$username,$password,$databaseName);

$epr='';
$msg='';
if(isset($_GET['epr']))
		$epr=$_GET['epr'];

	if($epr = 'save')
	{	
		$courseID = $_POST['courseID'];
		$sessionID = $_POST['sessionID'];
		$termID = $_POST['termID'];
		$marksID = $_POST['marksID'];
		$marksheader = $_POST['marksheader'];
		$marksmax = $_POST['marksmax'];

		$sql = "INSERT INTO tbl_course_marks_setup(CourseID,SessionID,TermID,MarksID,MarksHeader,MarksMax) VALUES ('$courseID','$sessionID','$termID','$marksID','$marksheader','$marksmax') ";
		//$insert = $connect->query($sql);
		$result5= mysqli_query($connect,$sql);
		//$sql1="INSERT INTO tbl_course_marks_setup (`TeacherID`) VALUES (SELECT (`TeacherID`) FROM tbl_course_teacher
//WHERE `CourseID` = $courseID AND 
//`SessionID` = $sessionID AND `TermID` = $termID)";
//$insertt = mysqli_query($connect,$sql1);
	
		
	}
}
	if($epr = 'delete'){
		$id=$_GET['id'];

		$sql2 = "DELETE FROM tbl_course_marks_setup WHERE ID= '$id'";
		$result6 = mysqli_query($connect,$sql2);
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

<html>
<head>
<style>
div.relative {
    position: relative;
    width: 500px;
    height: 200px;
    border: 3px solid #73AD21;
} 

div.absolute {
    position: absolute;
    top: 40px;
    right: 200;
    width: 400px;
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

	<h1><font color="#2F4F4F">Marks Setup</font></h1>
	<form name="markstup" method="post" action='marksetup.php?epr=save'>



		<p> Course ID &nbsp
<select name='courseID'>
		<?php while ($row1 =mysqli_fetch_array($result1)):;?> 
		<option value="<?php echo $row1['CourseID'];?>"><?php echo $row1['CourseID'];?></option>
	<?php endwhile; ?>
</select>&nbsp &nbsp &nbsp &nbsp &nbsp
    Session ID &nbsp 
<select name='sessionID'>
<?php while ($row2 =mysqli_fetch_array($result2)):;?>
		<option value="<?php echo $row2['SessionID'];?>"><?php echo $row2['SessionID'];?></option>
	<?php endwhile; ?>
</select>&nbsp &nbsp &nbsp &nbsp &nbsp
Term ID &nbsp
<select name='termID'>
<?php while ($row3 =mysqli_fetch_array($result3)):;?>
		<option value="<?php echo $row3['TermID'];?>"><?php echo $row3['TermID'];?></option>
	<?php endwhile; ?>
</select></p>
<br>
<p>Marks ID&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name='marksID' id="marksID" ></p>
<p>Marks Header &nbsp &nbsp &nbsp &nbsp<input type="text" name='marksheader' id="marksheader" ></p>
<p>Marks Maximum &nbsp <input type="text" name='marksmax' id="marksmax"></p><br>
<input name="submit" id="submit" type="submit" value="submit"><br><br>

<ul>
  <li><a href="home.php"><h4>Home</h4></a></li>
</ul>

</form>





<!...........table header...............>
<div class="absolute"><h2><font color="#2F4F4F">Marks list</font></h2>
<table border="1" cellspacing="0" cellpadding="0">
<thead>
<th bgcolor= "#808080">Course ID</th>
<th bgcolor= "#808080">Marks ID</th>
<th bgcolor= "#808080">Marks Header</th>
<th bgcolor= "#808080">Marks Max</th>
<th bgcolor= "#808080">Action</th>
</thead>





<!....................column value...........>
<?php
$connect = mysqli_connect($hostname,$username,$password,$databaseName);
$sql4 = ("SELECT `ID`,`CourseID`,`MarksID`,`MarksHeader`,`MarksMax` FROM tbl_course_marks_setup");
$result4= mysqli_query($connect,$sql4);
while ($row = mysqli_fetch_array($result4)){
	echo "<tr>
	<td>".$row['CourseID']."</td>
	<td>".$row['MarksID']."</td>
	<td>".$row['MarksHeader']."</td>
	<td>".$row['MarksMax']."</td>
	<td align='center'>
	<a href='marksetup.php?epr=delete&id=".$row['ID']."'>DELETE</a> |
	<a href='#'>UPDATE</a>
	</td>
	</tr>";
}
?>
</table></div>
<?php echo $msg; ?>


	 
</body>
</html>