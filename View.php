<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information</title>
    <link rel="stylesheet" href="mytable.css"> <!-- Linking to CSS file -->
</head>
    <body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="daata";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("connection failed". $conn->connect_error);
    }
    else{
        echo"Connected successfully";
    }

    $id1=$_POST  ['uid']; //retrieving 'id' value
    $name1=$_POST  ['uname']; //retrieving 'name' value
    $email1=$_POST ['email']; //retrieving 'email' value
    $age1 = $_POST['age']; // retrieving 'age' value
    $phone1 = $_POST['phone']; //  retrieving'phone' value

    

    $sql = "insert into mineinfo(uid, uname, email, age, phone) values (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $id1, $name1, $email1, $age1, $phone1);

    if ($stmt->execute()) {
        echo "records inserted";
    }
    else{
        echo"error:".$sql. "<br>" .$conn->error;
    }

    $stmt->close();

// fetching data
$sql_fetch = "SELECT * FROM mineinfo";
    $result = $conn->query($sql_fetch);
// making table for adding name, age, id, email, phone number of the employees
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>User ID</th><th>Name</th><th>Email</th><th>Age</th><th>Phone</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["uid"]."</td><td>".$row["uname"]."</td><td>".$row["email"]."</td><td>".$row["age"]."</td><td>".$row["phone"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
