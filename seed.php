<?php 
$con = new PDO('mysql:host=localhost;dbname=paginate', 'root', '');


for($i = 1; $i <= 50; $i++) {
  $statement = $con->prepare('insert into people (name, email) values(:name, :email) ');
  $statement->execute([
    ":name" => 'sumon' . $i,
    ":email" => 'sumon'. $i .'@gmail.com',
  ]);
}

