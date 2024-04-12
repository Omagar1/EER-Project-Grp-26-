<?php

function addProperty($conn, $ownerID, $EER, $postcode, $address)
{
    $currentDate = date('Y-m-d');

    $sql1 = "SELECT * FROM property WHERE address = :address AND postcode = :postcode;";
    $sql2 = "INSERT INTO property (ownerID, EER, postcode, address, reportIssueDate) VALUES (:ownerID, :EER, :postcode, :address, :reportIssueDate)";

    $stmt1 = $conn->prepare($sql1);
    $stmt2 = $conn->prepare($sql2);

    $stmt1->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt1->bindParam(':postcode', $postcode, PDO::PARAM_STR);

    $stmt2->bindParam(':ownerID', $ownerID, PDO::PARAM_STR);
    $stmt2->bindParam(':EER', $EER, PDO::PARAM_STR);
    $stmt2->bindParam(':postcode', $postcode, PDO::PARAM_STR);
    $stmt2->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt2->bindParam(':reportIssueDate', $currentDate, PDO::PARAM_STR);

    $stmt1->execute();

    $result = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($result)
    {
        return "Property already exists.";
    } else 
    {
        $stmt2->execute();
        return "Property added!";
    }
}
?>