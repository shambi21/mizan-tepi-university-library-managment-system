<html>
<head>
	<title>Mizan-Tepi university</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body>
<?php
session_start();
	include "../conn.php";
	if (isset($_POST['search'])) {
		$item=$_POST['item1'];
		$type=$_POST['search_type1'];
		$table='';
		
	//function used for retrive data from database

		function retrive($result){
			while($row = mysqli_fetch_assoc($result)) {
				echo "<div class='jumbotron container col-sm-5 h3' style='opacity:0.8'>";
				echo "<ul style='list-style:none;'>";
				echo "<li> <b class='text-success'>title:&nbsp&nbsp</b> ".$row['book_title']."</li>";
				echo "<li> <b class='text-success'>author/editor:&nbsp&nbsp</b> ".$row['author']."</li>";
				echo "<li> <b class='text-success'>call no:&nbsp&nbsp</b> ".$row['call_no']."</li>";
				echo "<li> <b class='text-success'>edition:&nbsp&nbsp</b> ".$row['edition']."</li>";
				echo "<li> <b class='text-success'>year:&nbsp&nbsp</b> ".$row['year_of_publication']."</li>";
				echo "<li> <b class='text-success'>acc_no:&nbsp&nbsp</b> ".$row['acc_no']."</li>";
				echo "</ul>";
				echo "<b>shelfmark:&nbsp&nbsp</b>"."<pre class='text-info h2'>".$row['shelfmark']."</pre>";
				echo "<li class='btn btn-danger'> <a href='loan_form.php?lend=".$row['roll_no']."'class='text-white h5' style='text-decoration:none;'>take book</a> </li>";
				echo "<a href='loan_home.php'><button class='btn btn-primary float-right'>home</button><a>";
				echo "</div>";
			}
			if (mysqli_num_rows($result)==0) {
				echo "<div class='container jumbotron text-success'>";
				echo "<h1>item not found! <a  href='loan_home.php'class ='btn btn-dark text-white'>try again</a></h1>";
				echo "</div>";
			}
		}
		if (empty($item)) {
			echo "<div class='container jumbotron text-danger'>";
			echo "<h1>empty search! <a  href='loan_home.php'class ='btn btn-danger text-white'>try again</a></h1>";
			echo "</div>";
		}
		else{
		//function to display books from specified collage and table
			function display($name){
				global $conn,$item,$type;
					if($type=='title'){
						$sql="select * from circulation_books where book_title like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> </h1>";
						retrive($result);
					}
					if($type=='author'){
						$sql="select * from circulation_books where author like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> </h1>";
						retrive($result);
					}
					if($type=='year of publication'){
						$sql="select * from circulation_books where year_of_publication like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> </h1>";
						retrive($result);
					}
					if ($type=='none') {
						echo "<div class='jumbotron container text-success h2'>";
						echo " <p>select search_type first</p>";
						echo "<a href='circulation.php'><button class='btn btn-primary'>try again</button></a>";
						echo "</div>";
					}	
				}
				
			$name="circulation";
			display($name);
		}
	}

	if (isset($_POST['submit'])) {

		$item=$_POST['item'];
		$type=$_POST['search_type'];
		$collage=$_POST['collage'];
		
	//function used for retrive data from database

		function retrive($result){
			while($row = mysqli_fetch_assoc($result)) {
				echo "<div class='jumbotron container col-sm-5 h3' style='opacity:0.8'>";
				echo "<ul style='list-style:none;'>";
				echo "<li> <b class='text-danger'>title:&nbsp&nbsp</b> ".$row['book_title']."</li>";
				echo "<li> <b class='text-danger'>author/editor:&nbsp&nbsp</b> ".$row['author']."</li>";
				echo "<li> <b class='text-danger'>acc_no:&nbsp&nbsp</b> ".$row['acc_no']."</li>";
				echo "<li> <b class='text-danger'>edition:&nbsp&nbsp</b> ".$row['edition']."</li>";
				echo "<li> <b class='text-danger'>year:&nbsp&nbsp</b> ".$row['year_of_publication']."</li>";
				echo "<li> <b class='text-danger'>ISBN:&nbsp&nbsp</b> ".$row['ISBN']."</li>";
				echo "<li> <b class='text-danger'>call no:&nbsp&nbsp</b> ".$row['call_no']."</li>";
				echo "<li> <b class='text-danger'>publisher name:&nbsp&nbsp</b> ".$row['publisher_name']."</li>";
				echo "<li> <b class='text-danger'>place of publication:&nbsp&nbsp</b> ".$row['place_of_publication']."</li>";
				echo "</ul>";
				echo "<b>shelfmark:&nbsp&nbsp</b>"."<pre class='text-info h2'>".$row['shelfmark']."</pre>";
				echo "<li class='btn btn-danger'> <a href='loan_form.php?take=".$row['roll_no']."'class='text-white h5' style='text-decoration:none;'>take book</a> </li>";
				echo "<a href='loan_home.php'><button class='btn btn-primary float-right'>home</button><a>";
				echo "</div>";
				}
			if (mysqli_num_rows($result)==0) {
				echo "<div class='container jumbotron text-success'>";
				echo "<h1>item not found! <a  href='loan_home.php'class ='btn btn-dark text-white'>try again</a></h1>";
				echo "</div>";
			}
		}
		if (empty($item)) {
			echo "<div class='container jumbotron text-danger'>";
			echo "<h1>empty search! <a  href='loan_home.php'class ='btn btn-primary text-white'>try again</a></h1>";
			echo "</div>";
		}
		else{
		//function to display books from specified collage and table
			function display($collage,$table,$name){
				global $conn,$item,$type;
				if ($collage==$collage) {
					if($type=='title'){
						$sql="select * from $table where book_title like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> collage </h1>";
						retrive($result);
					}
					if($type=='author'){
						$sql="select * from $table where author like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> collage </h1>";
						retrive($result);
					}
					if($type=='year of publication'){
						$sql="select * from $table where year_of_publication like '%$item%' ";
						$result=mysqli_query($conn,$sql);
						echo "<h1 class='container bg-light'>related book from <b class='text-success'>$name</b> collage </h1>";
						retrive($result);
					}
				}	
			}
			switch ($collage) {
				case 'fb':
					$table='fb';
					$name="FB";
					$_SESSION['table']=$table;
					display($collage,$table,$name);
					break;
				case 'agriculture':
					$table='agriculture';
					$name="Agriculture";
					$_SESSION['table']=$table;
					display($collage,$table,$name);
					break;
				case 'health':
					$table='health';
					$name="Health";
					$_SESSION['table']=$table;
					display($collage,$table,$name);
					break;
				case 'social':
					$table='social_and_humanity';
					$name="Social and Humanity";
					$_SESSION['table']=$table;
					display($collage,$table,$name);
					break;
				case 'law':
					$table='law';
					$name="Law";
					$_SESSION['table']=$table;
					display($collage,$table,$name);
					break;
				default:
					echo "<div class='jumbotron container text-success h2'>";
					echo " <p>select collage or search_type first</p>";
					echo "<a href='../index.php'><button class='btn btn-primary'>try again</button></a>";
					echo "</div>";
					break;
			}
		}

	}
 ?>