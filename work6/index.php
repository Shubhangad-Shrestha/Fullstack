<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';
?>

<h2>Student List</h2>
<a href="add.php">➕ Add New Student</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

<?php
$stmt = $conn->query("SELECT * FROM students");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['course']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Delete this student?\")'> Delete</a>
        </td>
    </tr>";
}
?>
</table>
