<?php
$pdo = new PDO('mysql:host=localhost;dbname=global;charset=UTF8', 'root', 'qwerty');
$sql = 'SELECT name, author, year, isbn, genre FROM books';

function getTable($row){
	echo '<tr>';
	echo '<td>'.$row['name'].'</td>';
	echo '<td id="center">'.$row['author'].'</td>';
	echo '<td id="center">'.$row['year'].'</td>';
	echo '<td>'.$row['genre'].'</td>';
	echo '<td id="center">'.$row['isbn'].'</td>';
	echo '</tr>';
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
    <input type="text" name="isbn" placeholder="ISBN" value="<?php
		if(empty($_GET['isbn'])){
			echo '';
		}
		else{
			echo trim($_GET['isbn']);
		}
	?>"/>
    <input type="text" name="name" placeholder="Название книги" value="<?php
		if(empty($_GET['name'])){
			echo '';
		}
		else{
			echo trim($_GET['name']);
		}
	?>"/>
    <input type="text" name="author" placeholder="Автор книги" value="<?php
		if(empty($_GET['author'])){
			echo '';
		}
		else{
			echo trim($_GET['author']);
		}
	?>"/>
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
if(empty($_GET)){
	foreach ($pdo->query($sql) as $row) {
		getTable($row);
	}
}
else if(!empty($_GET['isbn'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE isbn='.'"'.$_GET['isbn'].'"') as $row) {
		getTable($row);
	}
}
else if(!empty($_GET['name'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE name='.'"'.$_GET['name'].'"') as $row) {
		getTable($row);
	}
}
else if(!empty($_GET['author'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE author='.'"'.$_GET['author'].'"') as $row) {
		getTable($row);
	}
}
else{
	foreach ($pdo->query($sql) as $row) {
		getTable($row);
	}
}
?> 
</table>
</body> 
</html>