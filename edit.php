<?php
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$id) {
    header("Location: dashboard.php"); // Redirect if ID is missing
    exit;
}

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $course = $_POST['house'];
    $county = $_POST['county'];
    $id = $_POST['id']; // Added this to ensure we have the ID

    // Update the record using prepared statements
$stmt = $conn->prepare("UPDATE housing_inquiries SET first_name=?, last_name=?, message=?, email=?, phone=?, inquiry_date=?, gender=?, house=?, county=? WHERE id=?");
$stmt->bind_param("ssssssssss", $firstname, $lastname, $message, $email, $phone, $date, $gender, $course, $county, $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect to dashboard after successful update
        exit;
    } else {
        echo "Update failed: " . $stmt->error;
    }
}

// Fetch the record if not submitting
$stmt = $conn->prepare("SELECT * FROM housing_inquiries WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: Record not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h2 {
        color: #333;

    }
    form {
        max-width: 400px;
        margin: 15px;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }
    </style>
<body>
    <!-- Update form -->
     <section>
        <h2>Update Record</h2>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="first_name" value="<?php echo $user['first_name']; ?>">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="last_name" value="<?php echo $user['last_name']; ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="message"><?php echo $user['message']; ?></textarea>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $user['inquiry_date']; ?>">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $user['gender']; ?>">
            <label for="house">House:</label>
            <input type="text" id="house" name="house" value="<?php echo $user['house']; ?>">
            <label for="county">County:</label>
            <input type="text" id="county" name="county" value="<?php echo $user['county']; ?>">
            <input type="submit" value="Update">

</body>
</html>
