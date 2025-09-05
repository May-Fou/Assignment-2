<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <form action="process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="mobile">Mobile No.:</label>
            <input type="text" id="mobile" name="mobile" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label>

            <label>Department:</label>
            <input type="checkbox" id="computer" name="department[]" value="Computer">
            <label for="computer">Computer</label>
            <input type="checkbox" id="business" name="department[]" value="Business">
            <label for="business">Business</label>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4"></textarea>

            <button type="submit" name="save">Register</button>
        </form>
        <hr>
        <a href="view.php">View All Students</a>
    </div>
</body>
</html>