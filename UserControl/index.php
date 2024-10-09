<?php
require "config.php";
$conn = connection();
$result = all('users', $conn);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Control</title>
    <style>
        table tbody {
            text-align: center;
        }
    </style>
</head>

<body>
    <a href="create.php">Adicionar Usuário</a>
    <table width="100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $user) {
                echo "<tr>";
                echo "<td> $user->userName </td>";
                echo "<td> $user->email </td>";
                echo '<td> 
                <a href="edit.php?id=' . $user->id . '">Editar</a> - 
                <a href="delete.php?id=' . $user->id . '">Excluir</a>
                </td>';
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
</body>

</html>