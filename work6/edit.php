<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $email, $course, $id]);

    header("Location: index.php");
}
?>

<h2>Edit Student</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?= $student['name'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $student['email'] ?>"><br><br>
    Course: <input type="text" name="course" value="<?= $student['course'] ?>"><br><br>
    <button name="update">Update</button>
</form>
