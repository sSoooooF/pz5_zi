<?php
$name = $_POST['name'] ?? null;
$password = $_POST['password'] ?? null;

echo '<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    h1 {
        color: #2c3e50;
    }
    table {
        margin: auto;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #3498db;
        color: white;
    }
    input[type="text"], input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    input[type="submit"] {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #2980b9;
    }
</style>';

if (!isset($name) || !isset($password)) {
    echo "<h1>Please Log In</h1>";
    echo "This page is secret.";
    echo '<form method="post" action="list1.php">
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
} else if ($name == "user" && $password == "pass") {
    echo "<h1>Here it is!</h1>";
    echo "I bet you are glad you can see this secret page.";
} else {
    echo "<h1>Go Away!</h1>";
    echo "You are not authorized to view this resource.";
}
?>
