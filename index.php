<?php 
$page = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$limit = 5;
$offset = $page * $limit - $limit ;
/**
1 5 0
2 5 5
3 5 10 ($page * $limit - $limit)
4 5 15
 */

/**
 $number_of_page = ceil(44 / 5) = 9 
 */


$con = new PDO('mysql:host=localhost;dbname=paginate', 'root', '');
$statement = $con->prepare("select * from people limit $limit offset $offset");
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$statement2 = $con->prepare('select * from people');
$statement2->execute();
$total_row = $statement2->rowCount();
$total_page = ceil($total_row / $limit);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All people</title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-info">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>All people</h2>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          </tr>
          <?php foreach($people as $person): ?>
            <tr>
              <td><?= $person->id ?></td>
              <td><?= $person->name ?></td>
              <td><?= $person->email ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
        <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="/?page=<?= $page - 1 ?>" tabindex="-1">Previous</a>
    </li>
    <?php for($i = 1; $i <= $total_page; $i++): ?>
    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>

    <li class="page-item <?php echo $page >= $total_page ? 'disabled' : '' ?> ">
      <a class="page-link" href="/?page=<?= $page + 1 ?>">Next</a>
    </li>
  </ul>
</nav>
      </div>
    </div>
  </div>
</body>
</html>