<?php
include 'db.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $email, $course]);

    header("Location: index.php");
}
?>

<h2>Add Student</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <button name="add">Add Student</button>
</form>
