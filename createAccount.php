<?php
function createAccount($conn, $email, $hashPassword, $role)
{
    try
    {
        //echo "createAccount Ran"; //test
        
        $sql2 = "SELECT * FROM account WHERE emailAddress = :email AND Password = :Password";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->bindParam(':Password', $hashPassword, PDO::PARAM_STR);

        $stmt2->execute();
         
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        if ($result)
        {
            return "An account with that email already exists.";
        } else
        {
            $sql1 = 'INSERT INTO account (emailAddress, password, role, active) VALUES (:email, :password, :role, :active);';
            $stmt1 = $conn->prepare($sql1);
            //
            $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
            
            $stmt1->bindParam(':password', $hashPassword, PDO::PARAM_STR);
            
            $stmt1->bindParam(':role', $role, PDO::PARAM_STR);
            return "testing";

            if($role == "admin"){
                $stmt1->bindParam(':active', True , PDO::PARAM_BOOL);// as admin accounts should be aproved by admins first -stoped for testing
            }else{
                $stmt1->bindParam(':active', True , PDO::PARAM_BOOL);
            }
            
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