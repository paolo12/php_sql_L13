<?php
$pdo = new PDO('mysql:host=localhost;dbname=global;charset=UTF8', 'root', 'qwerty');
$sql = 'SELECT name, author, year, isbn, genre FROM books';

function getTable($row){
	return '<tr>'.'<td>'.$row['name'].'</td>'.'<td id="center">'.$row['author'].'</td>'.'<td id="center">'.$row['year'].'</td>'.'<td>'.$row['genre'].'</td>'.'<td id="center">'.$row['isbn'].'</td>'.'</tr>';
}

function getValue($vl){
	if(empty($_GET) or empty($_GET[strval($vl)])){
		return '';
	}
	else{
		return strip_tags($_GET[strval($vl)]);
	}
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
    <input type="text" name="isbn" placeholder="ISBN" value="<?php echo getValue('isbn');?>"/>
    <input type="text" name="name" placeholder="Название книги" value="<?php echo getValue('name');?>"/>
    <input type="text" name="author" placeholder="Автор книги" value="<?php echo getValue('author'); ?>"/>
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
		echo getTable($row);
	}
}
else if(!empty($_GET['isbn'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE isbn='.'"'.$_GET['isbn'].'"') as $row) {
		echo getTable($row);
	}
}
else if(!empty($_GET['name'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE name='.'"'.$_GET['name'].'"') as $row) {
		echo getTable($row);
	}
}
else if(!empty($_GET['author'])){
	foreach ($pdo->query('SELECT name, author, year, isbn, genre FROM books WHERE author='.'"'.$_GET['author'].'"') as $row) {
		echo getTable($row);
	}
}
else{
	foreach ($pdo->query($sql) as $row) {
		echo getTable($row);
	}
}
?> 
</table>
</body> 
</html>