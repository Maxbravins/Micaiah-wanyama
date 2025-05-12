<?php
// Connect to the database
$conn=mysqli_connect('localhost', 'root', '', 'client_statistics');
//select data
$sql = "SELECT id, first_name, last_name, message, email, inquiry_date, phone, gender, house, county FROM housing_inquiries";
$result = mysqli_query($conn, $sql);
var_dump($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
 <!-- Display data    -->
  <table>
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Message</th>
        <th>Email</th>
        <th>Date</th>
        <th>Phone</th>
        <th>gender</th>
        <th>House</th>
        <th>County</th>
    </tr>
    <?php if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {?>
            <!-- #code... -->
             <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['inquiry_date']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['house']; ?></td>
                <td><?php echo $row['county']; ?></td>
                <td><a href="delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')"><button>Delete</button></a></td>
                <td><a href="edit.php?id=<?php echo $row['id'] ?>"><button>edit</button></a></td>
                </tr>
                <?php } ?>

    <?php } ?>

  </table>
</body>
</html>