<?php
function createAccount($conn, $email, $hashPassword, $role)
{
    try
    {
        //echo "createAccount Ran"; //test
        $sql1 = "INSERT INTO account (emailAddress, Password, role, active) VALUES (:email, :Password, :role, :active);";
        $sql2 = "SELECT * FROM account WHERE emailAddress = :email AND Password = :Password";

        $stmt1 = $conn->prepare($sql1);
        $stmt2 = $conn->prepare($sql2);
        
        $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt1->bindParam(':Password', $hashPassword, PDO::PARAM_STR);
        $stmt1->bindParam(':role', $role, PDO::PARAM_STR);
        if($role == "admin"){
            $stmt1->bindParam(':active', 1 , PDO::PARAM_STR);// as admin accounts should be aproved by admins first -stoped for testing
        }else{
            $stmt1->bindParam(':active', 1 , PDO::PARAM_STR);
        }
        

        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->bindParam(':Password', $hashPassword, PDO::PARAM_STR);

        $stmt2->execute();
        return "testing";
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            return "An account with that email already exists.";
        } else
        {
            $stmt1->execute();
            //header("Location: homePage.php");
            return "Account created!";
        }
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        return $e;
    }
} 
?>