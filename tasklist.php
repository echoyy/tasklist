 <?php 
    header("Content-type:text/html;charset=utf-8");	//中文
 ?>
 
<html>
<head>
	<title> tasklist </title>
</head>

<body>
	<h1> 输入学生学号、姓名、年龄、性别</h1>
	<h2> 学号是主键，根据学号唯一识别学生</h2>
	<form action = "testmysql.php" method = "post">
		<table border = "0">
			<tr>
				<td>学号：</td>
				<td><input type = "text" name="Sno" maxlength = "8" ></td>
			</tr>
			<tr>
				<td>姓名：</td>
				<td><input type = "text" name="Sname" maxlength = "20" ></td>
			</tr>
			<tr>
				<td>年龄：</td>
				<td><input type = "text" name="Sage" maxlength = "3" ></td>
			</tr>
			<tr>
				<td>性别：</td>
				<td><input type = "text" name="Ssex" maxlength = "2" ></td>
			</tr>
			<tr>
				<td><input type = "submit" name="add" value = "增加"></td>
				<td><input type = "submit" name="del" value = "删除"></td>
				<td><input type = "submit" name="finish" value = "完成"></td>
				<td><input type = "submit" name="update" value = "修改"></td>
				<td><input type = "submit" name="checkING" value = "查看进行表"></td>
				<td><input type = "submit" name="checkED" value = "查看完成表"></td>
			</tr>
		</table>
	</form>
</body>

<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);	//去除各种警告
	$Sno = $_POST['Sno'] ; $Sname = $_POST['Sname'] ; $Sage = $_POST['Sage'] ; 	$Ssex = $_POST['Ssex'] ; 	//从表单中去数据
	$db = mysqli_connect('localhost', 'root', '', 'test'); 		//连接数据库
	if (!$db) { 
		echo "Could not connect to MySQL:"; 
		return ;
	}  
	// 添加学生
	function add($db,$Sno,$Sname,$Sage,$Ssex){
		$db=$db ; $Sno =$Sno ; $Sname = $Sname ; $Sage = $Sage ; $Ssex =$Ssex ;
		if (!$Sno){							//主键不可为空
			echo "学号不可为空".'<br/>';			
		}
		else{
			$insert ="insert into test values('$Sno', '$Sname', '$Sage' , '$Ssex')";
			$result = $db->query($insert);
			echo "增加成功".'<br/>';
		}
	}
	//把学生放入完成表
	function finish($db,$Sno){
		$db=$db ; $Sno =$Sno ; 
		$finish ="insert into test_finish select * from test where $Sno = '$Sno'";
		del($db,$Sno);
		$result = $db->query($finish);
	}
	//删除学生
	function del($db,$Sno){
		$db=$db ; $Sno =$Sno ;
		$temp = "select * from test where Sno = '$Sno'" ;	//根据学号查询表中有没有欲删除的记录
		$t_res = $db->query($temp);				//执行查询
		$row=mysqli_fetch_array($t_res);		//查到返回该记录，否则返回null
		if (!$row['0']){
			echo "表中无记录".'<br/>';
		}	
		else{
			$delete ="delete from test where Sno = '$Sno'";
			$result = $db->query($delete);
			echo "删除成功".'<br />';
		}
	}
	//修改学生
	function update($db,$Sno,$Sname,$Sage,$Ssex){
		$db=$db ; $Sno =$Sno ; $Sname = $Sname ; $Sage = $Sage ; $Ssex =$Ssex ;
		if (!$Sno){							//主键不可为空
			echo "学号不可为空".'<br/>';			
		}
		else{
			$update ="UPDATE test SET Sname = '$Sname' ,Sage = '$Sage' , Ssex ='$Ssex'  WHERE Sno = '$Sno'";
			$result = $db->query($update);
			echo "修改成功".'<br/>';
		}
	}
	//查看进行表
	function checkING($db){
		$db = $db;
		if (!$db)
		{
			die('Could not connect: ' . mysql_error());
		}
		$checkING= "SELECT * from test ";
		$result = $db -> query($checkING);
		$num_rows = mysqli_num_rows($result);
		if($num_rows == 0)
			echo "当前表中没有记录，请插入".'<br/>';
		else{
			for($i=0;$ibase_add_user<$num_rows;$i++){
				print_r( $result -> fetch_row());
				echo '<br/>';
			}
		}
	}
	//查看完成表
	function checkED($db){
		$db = $db;
		if (!$db)
		{
			die('Could not connect: ' . mysql_error());
		}
		$checkED = "select * from test_finish";
		$result = $db -> query($checkED);
		$num_rows = mysqli_num_rows($result);
		if($num_rows == 0)
			echo "当前表中没有记录，请插入".'<br/>';
		else{
			for($i=0;$ibase_add_user<$num_rows;$i++){
				print_r( $result -> fetch_row());
				echo '<br/>';
			}
		}
	}
	
	
	if(isset($_POST['add'])){
		add($db,$Sno,$Sname,$Sage,$Ssex);
	}
	if(isset($_POST['del'])){
		del($db,$Sno);
	}
	if(isset($_POST['update'])){
		update($db,$Sno,$Sname,$Sage,$Ssex);
	}
	if(isset($_POST['finish'])){
		finish($db,$Sno);
	}
	if(isset($_POST['checkING'])){
		checkING($db);
	}
	if(isset($_POST['checkED'])){
		checkED($db);
	}
	

?>

</html>
			
