<head>
    <link rel="stylesheet" href="styles.css"/>
</head>
<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
include_once("search.php");
$userid = $_SESSION["userID"];
$search = $_POST['search'];
$column = $_POST['column'];
if ($_SESSION['userRole']== 'Tenant'){
    if (isset($_POST['searchButton'])) {
        $sql = "Select propertyID,propertyType,EER,postcode,address FROM property WHERE $column like '%$search%' ORDER BY propertyID ASC;";
        $result = $conn->prepare($sql);
        $result->execute();

        while($row = $result->fetch(PDO::FETCH_ASSOC) ){
            if (isset($row)){
            ?>
                <div>
                    Property Type: <?php echo $row["propertyType"]?><br>
                    Energy efficiency rating: <?php echo $row["EER"]?><br>
                    Postcode: <?php echo $row["postcode"]?><br>
                    Address: <?php echo $row["address"]?><br>
                </div>
                <div>
                    <form method="post" action="saveProperty.php">
                        <input type="hidden" name="pid" value="<?php echo $row['propertyID'] ?>">
                        <input type="submit" value="Save" name="save">
                    </form>
                </div>
<?php
            }//if isset
        }//for while
        
        else {
	        echo "No results found";
        }
    }//if isset
}//if session
elseif ($_SESSION['userRole']== 'Landlord'){
    if (isset($_POST['searchButton'])) {
        $sql ="Select propertyID,propertyType,EER,postcode,address FROM property WHERE $column like '%$search%' AND ownerID=:uid ORDER BY propertyID ASC;"; 
        $sql->bindParam(':uid', $userid, PDO::PARAM_INT);
        $result = $conn->prepare($sql);
        $result->execute();

        while($row = $result->fetch(PDO::FETCH_ASSOC) ){
            if (isset($row)){
            ?>
                <div>
                    Property Type: <?php echo $row["propertyType"]?><br>
                    Energy efficiency rating: <?php echo $row["EER"]?><br>
                    Postcode: <?php echo $row["postcode"]?><br>
                    Address: <?php echo $row["address"]?><br>
                    <a href="updateProperty.php?id=<?php echo $row["propertyID"];?>">Edit</a>
                    <a href="deleteProperty.php?id=<?php echo $row["propertyID"];?>">Delete</a>
                </div>
<?php
            }//if isset
        }//for while
        else {
            echo "No results found";
        }
    }//if isset
}//first elseif session
elseif ($_SESSION['userRole']== 'Admin'){
    if (isset($_POST['searchButton'])) {
        $sql = "Select propertyID,ownerID,propertyType,EER,postcode,address,addressChanged,addressChangedBy,reportIssueDate FROM property WHERE $column like '%$search%' ORDER BY propertyID ASC;";
        $result = $conn->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0){
?>
            <div>
                <h2>View Properties</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Property ID</th>
                            <th>Owner ID</th>
                            <th>Energy Efficiency Rating</th>
                            <th>Postcode</th>
                            <th>Address</th>
                            <th>Address Changed On</th>
                            <th>Address Changed By</th>
                            <th>Report Issue Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try{
                            while($row = $result->fetch(PDO::FETCH_ASSOC) ){
                        ?>
                        <tr>
                            <td><?php echo $row["propertyID"]?></td>
                            <td><?php echo $row["ownerID"]?></td>
                            <td><?php echo $row["propertyType"]?></td>
                            <td><?php echo $row["EER"]?></td>
                            <td><?php echo $row["postcode"]?></td>
                            <td><?php echo $row["address"]?></td>
                            <td><?php echo $row["addressChanged"]?></td>
                            <td><?php echo $row["addressChangedBy"]?></td>
                            <td><?php echo $row["reportIssueDate"]?></td>
                            <td><a href="updateProperty.php?id=<?php echo $row["propertyID"];?>">Edit</a></td>
                            <td><a href="deleteProperty.php?id=<?php echo $row["propertyID"];?>">Delete</a></td>
                        </tr>
                        <?php
                            }//for while loop
                        }catch(PDOException $e){
                            echo $e;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
        }//if result
        else {
            echo "No results found";
        }
    }//if isset
}//second elseif session
?>
<footer class="footer">
    <p>EERCalc © Group 26 2024</p>
</footer>