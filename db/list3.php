<?php
$name = $_POST['name'] ?? null;
$password = $_POST['password'] ?? null;
$reg_name = $_POST['reg_name'] ?? null;
$reg_password = $_POST['reg_password'] ?? null;

$mysql = new mysqli('localhost', 'root', '1111', 'auth');

if ($mysql->connect_error) {
    echo 'Cannot connect to database: ' . $mysql->connect_error;
    exit;
}

if (isset($reg_name) && isset($reg_password)) {
    $stmt_check = $mysql->prepare('SELECT COUNT(*) FROM auth WHERE name = ?');
    $stmt_check->bind_param('s', $reg_name);
    $stmt_check->execute();
    $stmt_check->bind_result($user_exists);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($user_exists > 0) {
        echo "<h1>Registration Failed</h1>";
        echo "User with this name already exists.";
    } else {
        $stmt_register = $mysql->prepare('INSERT INTO auth (name, pass) VALUES (?, ?)');
        $hashed_password = crypt($reg_password, '22');
        $stmt_register->bind_param('ss', $reg_name, $hashed_password);
        if ($stmt_register->execute()) {
            echo "<h1>Registration Successful!</h1>";
            echo "You can now log in.";
        } else {
            echo "<h1>Registration Error</h1>";
            echo "Something went wrong. Try again.";
        }
        $stmt_register->close();
    }
}

if (!isset($name) || !isset($password)) {
    echo "<h1>Please Log In</h1>";
    echo "This page is secret.";
    echo '<form method="post" action="list3.php">
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

    echo '<h2>Registration</h2>
          <form method="post" action="list3.php">
            <table border="1">
            <tr>
            <th> Username </th>
            <td> <input type="text" name="reg_name"> </td>
            </tr>
            <tr>
            <th> Password </th>
            <td> <input type="password" name="reg_password"> </td>
            </tr>
            <tr>
            <td colspan="2" align="center">
            <input type="submit" value="Register">
            </td>
            </tr>
            </table>
          </form>';
} else {
    $stmt = $mysql->prepare('SELECT COUNT(*) FROM auth WHERE name = ? AND pass = ?');
    $stmt->bind_param('ss', $name, crypt($password, '22'));
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
}

$mysql->close();
?>
