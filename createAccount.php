<?php
function createAccount($conn, $email, $hashPassword, $role)
{
    try
    {
        $sql1 = "INSERT INTO account (emailAddress, Password, role, dateCreated) VALUES (:email, :Password, :role, :date);";
        $sql2 = "SELECT * FROM account WHERE emailAddress = :email;";

        $stmt1 = $conn->prepare($sql1);
        $stmt2 = $conn->prepare($sql2);

        $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt1->bindParam(':Password', $hashPassword, PDO::PARAM_STR);
        $stmt1->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt1->bindParam(':date', $currentDate, PDO::PARAM_STR);
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt2->execute();

        $result = $stmt2->fetch(PDO::FETCH_ASSOC);

        $currentDate = date('Y-m-d');
        $at = "@";
        
        if ($result)
        {
            return "An account with that email already exists." . var_dump($_POST);
            
        }
        elseif (strpos($email, $at) === false)
        // checks if $email doesn't contain an @
        {
            return "Invalid email address.";
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