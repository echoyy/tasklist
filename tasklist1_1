<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);	//去除各种警告
	
	$db = mysqli_connect('localhost', 'root', '', 'test'); 		//连接数据库
	if (!$db) { 
		echo "Could not connect to MySQL:"; 
		return ;
	}
	
	$task = $_POST['task'];	$id= $_POST['id'];		//传参
	
	if(isset($_POST['add'])){
		$insert ="insert into tasklist values('$task', '1')";
		$resInsert = $db->query($insert);
	}
	
	if(isset($_POST['del'])){
		$taskInt =$id-1;
		$delete ="delete from tasklist where task = (select task from ( select task from tasklist limit $taskInt,1) a)";
		$resDelete= $db->query($delete);		
	}
	
	if(isset($_POST['com'])){
		$taskInt =$id-1;
		$delete ="update  tasklist set state = '0' where task = (select task from ( select task from tasklist limit $taskInt,1) a)";
		$resDelete= $db->query($delete);		
	}
	
	if(isset($_POST['alter'])){
		$taskInt =$id-1;
		$update ="update  tasklist set task = '$task',state = '1' where task = (select task from ( select task from tasklist limit $taskInt,1) a)";
		$resDelete= $db->query($update);		
	}
	
	$query= "SELECT * FROM tasklist ";    
	$result = $db -> query($query);     	//执行query语句，结果返回到$result	
	?>
	
<html>
<head>
	<title> tasklist </title>
</head>

<body>
	<form action = "tasklisk.php" method = "post">
		<table border = "0">
			<?php 
				if(!empty($result)) : ?>  		<!-- 为了能在php里嵌套H5，将｛｝改成了: endif格式 -->
			<ol>
				<?php foreach ($result as $res ) :?>
				<li>
					<?php  if($res['state'] == '1') { ?>
					<strong><?php echo $res['task'].'<br />';?></strong> <?php }else{ ?>
					<?php echo $res['task'].'<br />';}?>
				</li>
				<?php endforeach;?>
			</ol>
			<?php endif;?>
			<tr>
				<td>输入任务框<input type = "text" name="task" maxlength = "100"  ></td>		<!-- 输入框 -->
				<td><input type = "submit" name="add" value = "添加"></td>		<!-- 增加button -->
			<tr>
			<tr>
				<td>输入序号框<input type = "text" name="id" maxlength = "2" size ="2"  ></td>		<!-- 输入框 -->
				<td><input type = "submit" name="alter" value = "修改"></td>
				<td><input type = "submit" name="del" value = "删除"></td>
				<td><input type = "submit" name="com" value = "完成"></td>
			</tr>
		</table>
	</form>
</body>
</html>



