<?php
$conn = new mysqli("localhost","root","","batool_db");

if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
};
if($_SERVER["REQUEST_METHOD"]=='POST'){
    if(isset($_POST["insert"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conn->query("INSERT into users(name,email,password) VALUES('$name','$email','$password')");
    }
    elseif(isset($_POST["delete"])){
        $id= $_POST["id"];
        $conn->query("DELETE FROM users WHERE id = $id");
    }
    
};

$user = $conn->query("SELECT id, name,email,password FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid py-5 px-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="jumbotron">
                    <form method="post">
                        <h1 class="display-5 text-center mb-4">SignUp</h1>
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" id="name" name="name" placeholder="Enter username"  class="form-control" required >

                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email"name="email" placeholder="Enter email"  class="form-control" required >

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter password"  class="form-control" required >

                        </div>
                        <button class="btn btn-custom w-100" name="insert" id="insert">SignUp</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <h2 class="text-center">Registed Users</h2>
    <table class="table table-bordered table-stripped">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
if ($user->num_rows > 0) {
    while($row = $user->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>
    <form method='post'>
    <input type='hidden' name='id' value='" . $row['id'] . "'>
    <button type='submit' name='delete' id='delete' onclick='return
    confirm(\"Are you sure you want to delete this user?\")'>Delete</button>
    </form>
    </td>";
    echo "</tr>";
    }
    } else {
    echo "<tr><td colspan='3'>No records found</td></tr>"; 
    } 
    $conn->close();

?>
</table>
</body>
</html>
