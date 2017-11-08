<?php
$pdo = new PDO('mysql:host=localhost;dbname=global;charset=UTF8', 'root', 'qwerty');

function getTable($row){
	return '<tr>'.'<td>'.$row['name'].'</td>'.'<td id="center">'.$row['author'].'</td>'.'<td id="center">'.$row['year'].'</td>'.'<td>'.$row['genre'].'</td>'.'<td id="center">'.$row['isbn'].'</td>'.'</tr>';
}
?>
<html> 
<head>
<style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    
    table th {
        background: #eee;
    }
	#center {
		text-align: center;
	}	
</style>
<title>Список книг</title> 
</head> 
<body>
<h2>Список книг</h2>
<form method="GET">
	<input type="text" name="isbn" placeholder=“ISBN” value="<?php echo (empty($_GET['isbn']) ? '' : $_GET['isbn'])?>"/>    
    <input type="text" name="name" placeholder="Название книги" value="<?php echo (empty($_GET['name']) ? '' : $_GET['name'])?>"/>
    <input type="text" name="author" placeholder="Автор книги" value="<?php echo (empty($_GET['author']) ? '' : $_GET['author'])?>"/>
    <input type="submit" value="Поиск" />
</form>
</br>
<table>
    <tr>
        <th>Название</th>
        <th>Автор</th>
        <th>Год выпуска</th>
        <th>Жанр</th>
        <th>ISBN</th>
    </tr>
<?php
if(empty($_GET) or (empty($_GET['isbn']) and empty($_GET['name']) and empty($_GET['author']))){
	$sql = 'SELECT * FROM books';
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach ($result as $row) {
		echo getTable($row);
	}
}
else if(empty($_GET['isbn'])){
		if(empty($_GET['name']) and !empty($_GET['author'])){
			$sql = 'SELECT * FROM books WHERE author LIKE concat("%", :get_author, "%")';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':get_author', $_GET['author'], PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {
				echo getTable($row);
			}
		}
		else if(!empty($_GET['name']) and empty($_GET['author'])){
			$sql = 'SELECT * FROM books WHERE name LIKE concat("%", :get_name, "%")';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':get_name', $_GET['name'], PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {
				echo getTable($row);
			}
		}
		else if(!empty($_GET['name']) and !empty($_GET['author'])){
			$sql = 'SELECT * FROM books WHERE name LIKE concat("%", :get_name, "%") AND author LIKE concat("%", :get_author, "%")';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':get_name', $_GET['name'], PDO::PARAM_STR);
			$stmt->bindParam(':get_author', $_GET['author'], PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			foreach ($result as $row) {
				echo getTable($row);
			}
		}
}
else if(!empty($_GET['isbn'])){
	if(empty($_GET['name']) and empty($_GET['author'])){
		$sql = 'SELECT * FROM books WHERE isbn LIKE concat("%", :get_isbn, "%")';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':get_isbn', $_GET['isbn'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach ($result as $row) {
			echo getTable($row);
		}
	}
	else if(!empty($_GET['name']) and empty($_GET['author'])){
		$sql = 'SELECT * FROM books WHERE isbn LIKE concat("%", :get_isbn, "%") AND name LIKE concat("%", :get_name, "%")';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':get_isbn', $_GET['isbn'], PDO::PARAM_STR);
		$stmt->bindParam(':get_name', $_GET['name'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach ($result as $row) {
			echo getTable($row);
		}
	}
	else if(empty($_GET['name']) and !empty($_GET['author'])){
		$sql = 'SELECT * FROM books WHERE isbn LIKE concat("%", :get_isbn, "%") AND author LIKE concat("%", :get_author, "%")';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':get_isbn', $_GET['isbn'], PDO::PARAM_STR);
		$stmt->bindParam(':get_author', $_GET['author'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach ($result as $row) {
			echo getTable($row);
		}
	}
	else if(!empty($_GET['name']) and !empty($_GET['author'])){
		$sql = 'SELECT * FROM books WHERE isbn LIKE concat("%", :get_isbn, "%") AND name LIKE concat("%", :get_name, "%") AND author LIKE concat("%", :get_author, "%")';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':get_isbn', $_GET['isbn'], PDO::PARAM_STR);
		$stmt->bindParam(':get_name', $_GET['name'], PDO::PARAM_STR);
		$stmt->bindParam(':get_author', $_GET['author'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach ($result as $row) {
			echo getTable($row);
		}
	}
}
?> 
</table>
</body> 
</html>