<?php
$insert = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection settings (XAMPP / localhost defaults)
    $server   = "localhost";
    $username = "root";
    $password = "";
    $database = "trip_us";

    $name   = trim($_POST['name']   ?? '');
    $age    = trim($_POST['age']    ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $email  = trim($_POST['email']  ?? '');
    $phone  = trim($_POST['phone']  ?? '');
    $desc   = trim($_POST['desc']   ?? '');

    if ($name === '') {
        $errors[] = "Please enter your name.";
    }
    if (!ctype_digit($age) || (int)$age < 1 || (int)$age > 120) {
        $errors[] = "Please enter an age between 1 and 120.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!$errors) {
        $con = mysqli_connect($server, $username, $password, $database);

        if (!$con) {
            die("Connection to the database failed due to " . mysqli_connect_error());
        }

        // Prepared statement: user input is never concatenated into the query,
        // so a value like  '); DROP TABLE trip;--  is stored as plain text.
        $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`)
                VALUES (?, ?, ?, ?, ?, ?, current_timestamp())";

        $stmt = $con->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $con->error);
            $errors[] = "Sorry, something went wrong on our side. Please try again later.";
        } else {
            $ageInt = (int)$age;
            $stmt->bind_param("sissss", $name, $ageInt, $gender, $email, $phone, $desc);

            if ($stmt->execute()) {
                $insert = true;
            } else {
                // Log the real reason, show the user something harmless.
                error_log("Insert failed: " . $stmt->error);
                $errors[] = "Sorry, we could not save your entry. Please try again.";
            }

            $stmt->close();
        }

        $con->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to travel form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alan+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="bg.jpg" alt="Hackathon venue">
    <div class="container">
        <h1>Welcome to Hacker's Throne</h1>
        <p>Enter your details and submit this form to confirm your participation in the hackathon</p>

        <?php if ($insert): ?>
            <p class="submitmsg success">Thanks for submitting your form. We are happy to see you joining us for the US trip.</p>
        <?php endif; ?>

        <?php foreach ($errors as $error): ?>
            <p class="submitmsg"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endforeach; ?>

        <form action="index.php" method="post" novalidate>
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="text" name="phone" id="phone" placeholder="Enter your phone">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter more information here. We are happy to help you :)"></textarea>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
