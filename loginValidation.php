<?php
function loginValidation($conn, $email, $hashPassWord) {
    try
    {
        $sql = "SELECT * FROM account WHERE emailAddress = :email AND password = :password";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashPassWord, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            header("Location: loggedIn.php");
            exit();
        } else 
        {
            return "Invalid email or password.";
        }
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>