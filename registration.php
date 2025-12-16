<?php
// Initialize variables
$name = $email = "";
$errors = [];
$success = "";

// If form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Collect data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 2. VALIDATION
    if (empty($name)) {
        $errors['name'] = "Name is required!";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format!";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required!";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters!";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match!";
    }

    // 3. If NO errors → save user
    if (count($errors) === 0) {

        // Read JSON file
        $file = "users.json";

        if (!file_exists($file)) {
            file_put_contents($file, "[]");
        }

        $json_data = file_get_contents($file);
        $users = json_decode($json_data, true);

        if (!is_array($users)) {
            $users = [];
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // New user
        $new_user = [
            "name" => $name,
            "email" => $email,
            "password" => $hashed_password
        ];

        // Add to users array
        $users[] = $new_user;

        // Save back to JSON
        if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT))) {
            $success = "Registration successful! 🎉";
            $name = $email = "";
        } else {
            $errors['file'] = "Error saving user data!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 16px; font-weight: bold; }
        .form-box { width: 350px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        input { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { padding: 10px; width: 100%; background: purple; color: white; border: none; }
    </style>
</head>
<body>

<h2>User Registration</h2>

<?php if ($success): ?>
    <div class="success"><?= $success ?></div>
<?php endif; ?>

<div class="form-box">
<form action="" method="POST">

    <label>Name</label>
    <input type="text" name="name" value="<?= $name ?>">
    <div class="error"><?= $errors['name'] ?? "" ?></div>

    <label>Email</label>
    <input type="text" name="email" value="<?= $email ?>">
    <div class="error"><?= $errors['email'] ?? "" ?></div>

    <label>Password</label>
    <input type="password" name="password">
    <div class="error"><?= $errors['password'] ?? "" ?></div>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password">
    <div class="error"><?= $errors['confirm_password'] ?? "" ?></div>

    <button type="submit">Register</button>

    <div class="error"><?= $errors['file'] ?? "" ?></div>

</form>
</div>

</body>
</html>
