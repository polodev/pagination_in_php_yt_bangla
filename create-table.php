<?php

$con = new PDO('mysql:host=localhost;dbname=paginate', 'root', '');
$con->query(" 
  create table people(
    id int(11) auto_increment primary key,
    name varchar(30) not null,
    email varchar(30) not null
  )

 ");