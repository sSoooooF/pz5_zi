<?php
$name = $_POST['name'] ?? null;
$password = $_POST['password'] ?? null;

if (!isset($name) || !isset($password)) {
    echo "<h1>Please Log In</h1>";
    echo "This page is secret.";
    echo '<form method="post" action="list2.php">
            <table border="1">
            <tr>
            <th> Username </th>
            <td> <input type="text" name="name"> </td>
            </tr>
            <tr>
            <th> Password </th>
            <td> <input type="password" name="password"> </td>
            </tr>
            <tr>
            <td colspan="2" align="center">
            <input type="submit" value="Log In">
            </td>
            </tr>
            </table>
          </form>';
} else {
    $mysql = new mysqli('localhost', 'root', '1111', 'auth');
    if ($mysql->connect_error) {
        echo 'Cannot connect to database: ' . $mysql->connect_error;
        exit;
    }

    $stmt = $mysql->prepare('SELECT COUNT(*) FROM auth WHERE name = ? AND pass = ?');
    $stmt->bind_param('ss', $name, crypt($password,'22'));
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "<h1>Here it is!</h1>";
        echo "I bet you are glad you can see this secret page.";
    } else {
        echo "<h1>Go Away!</h1>";
        echo "You are not authorized to view this resource.";
    }

    $mysql->close();
}
?>
