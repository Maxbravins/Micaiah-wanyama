<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');

$id = $_GET['id'];

// delete the record
$sql = "DELETE FROM housing_inquiries WHERE id=$id";
mysqli_query($conn, $sql);
header("Location: dashboard.php");
if (mysqli_affected_rows($conn) > 0) {
    echo "Record deleted successfully";
}

?>