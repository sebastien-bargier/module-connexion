<?php
require('index.php');
require('db.php');

$sql = "SELECT * FROM utilisateurs";
$users = mysqli_query($db,$sql);
$users = mysqli_fetch_all($users,MYSQLI_ASSOC);

?>
<table>
<tr>
    <th>Login</th>
    <th>Prenom</th>
    <th>Nom</th>
    <th>Password</th>
</tr>
<?php
foreach ($users as $user => $value) { ?>
<tr>
    <td><?= $value['login'] ?></td>
    <td><?= $value['prenom'] ?></td>
    <td><?= $value['nom'] ?></td>
    <td><?= $value['password'] ?></td>
</tr>
<?php } ?>
</table>