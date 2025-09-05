<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $email = $conn->real_escape_string($_POST['email']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $address = $conn->real_escape_string($_POST['address']);
    
       $departments = isset($_POST['department']) ? $_POST['department'] : [];
    $department_str = implode(", ", $departments);

       if (isset($_POST['id']) && !empty($_POST['id'])) {
               $id = intval($_POST['id']);
        
        $sql = "UPDATE students SET name=?, mobile=?, email=?, gender=?, department=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $mobile, $email, $gender, $department_str, $address, $id);

        if ($stmt->execute()) {
            echo "<h1>Record updated successfully</h1>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();

    } else {
               $sql = "INSERT INTO students (name, mobile, email, gender, department, address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
       
        $stmt->bind_param("ssssss", $name, $mobile, $email, $gender, $department_str, $address);

        if ($stmt->execute()) {
            echo "<h1>New record created successfully</h1>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
    
    header("refresh:2;url=view.php");

} else {
    header("Location: index.php");
}

$conn->close();
?>