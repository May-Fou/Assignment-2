<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM students WHERE id=$id");
            $student = $result->fetch_assoc();
            
            // Convert department string back to array for checkboxes
            $departments = explode(", ", $student['department']);
        ?>
            <h1>Update Student Record</h1>
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>

                <label for="mobile">Mobile No.:</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $student['mobile']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>

                <label>Gender:</label>
                <input type="radio" name="gender" value="Male" <?php echo ($student['gender'] == 'Male') ? 'checked' : ''; ?> required> Male
                <input type="radio" name="gender" value="Female" <?php echo ($student['gender'] == 'Female') ? 'checked' : ''; ?>> Female

                <label>Department:</label>
                <input type="checkbox" name="department[]" value="Computer" <?php echo in_array('Computer', $departments) ? 'checked' : ''; ?>> Computer
                <input type="checkbox" name="department[]" value="Business" <?php echo in_array('Business', $departments) ? 'checked' : ''; ?>> Business
                
                <label for="address">Address:</label>
                <textarea name="address" rows="4"><?php echo $student['address']; ?></textarea>

                <button type="submit" name="update">Update Record</button>
            </form>
            <hr>
            <a href="view.php">Back to Student List</a>
        <?php
        } else {
                   ?>
            <h1>All Students</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM students ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td>";
                            echo "<a href='view.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a> ";
                            // Added the Delete button
                            echo "<a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <hr>
            <a href="index.php">Add New Student</a>
        <?php
        }
        $conn->close();
        ?>
    </div>
</body>
</html>