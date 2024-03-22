<?php
function createAccount($conn, $email, $hashPassword)
{
    try
    {
        $sql1 = "INSERT INTO account (emailAddress, Password) VALUES (:email, :Password);";
        $sql2 = "SELECT * FROM account WHERE emailAddress = :email AND Password = :Password";

        $stmt1 = $conn->prepare($sql1);
        $stmt2 = $conn->prepare($sql2);

        $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt1->bindParam(':Password', $hashPassword, PDO::PARAM_STR);
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->bindParam(':Password', $hashPassword, PDO::PARAM_STR);

        $stmt2->execute();

        $result = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            return "An account with that email already exists.";
        } else
        {
            $stmt1->execute();
            header("Location: accountCreated.php");
            return "Account created!";
        }
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
} 
?>