<?php
function createAccount($conn, $email, $hashPassword, $role)
{
    try
    {
        $currentDate = date('Y-m-d');

        $sql2 = "SELECT * FROM account WHERE emailAddress = :email AND password = :password";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->bindParam(':password', $hashPassword, PDO::PARAM_STR);

        $stmt2->execute();
         
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        if ($result)
        {
            return "An account with that email already exists.";
        } else 
        {
            $sql1 = "INSERT INTO account (emailAddress, password, role, dateCreated, active) VALUES (:email, :password, :role, :dateCreated, :active);";
            $stmt1 = $conn->prepare($sql1);

            $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt1->bindParam(':password', $hashPassword, PDO::PARAM_STR);
            $stmt1->bindParam(':dateCreated', $currentDate, PDO::PARAM_STR);
            $stmt1->bindParam(':role', $role, PDO::PARAM_STR);
            if($role == "admin"){
                $activeVal = 0; // as admin accounts should be approved by admins first
             }else{
                $activeVal = 1;
             }
             $stmt1->bindParam(':active', $activeVal , PDO::PARAM_INT);
             $stmt1->execute();

             header("Location: login.php"); // LOCALHOST
             return "Account created!"; // LOCALHOST

            // $_SESSION["EmailUsed"] = $email; // AZURE
            // header("location: verifyEmail.php"); // AZURE
            // return "Account created! Check Your Emails to Verrify and Log in"; // AZURE

        }
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>