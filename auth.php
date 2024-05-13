<?php
try {
    @include 'connection.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user-type'];

    $sql = "SELECT * FROM users WHERE Username = :username AND Password = :password AND role = :user_type;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        if($user_type == 'admin')
            header("Location: admin.php"); 
        if($user_type == 'student')
            header("Location: student\student_side.php");
    } else {
        echo "Invalid Username or Password";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
