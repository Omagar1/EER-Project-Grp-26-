<link rel="stylesheet" href="styles.css"/>
<?php
require("dbConnect.php");
include_once("navBar.php");
include_once("search.php");
$search = $_POST['search'];
$column = $_POST['column'];
if (isset($_POST['searchButton'])) {
    $sql = "Select accountID,emailAddress,dateCreated,role FROM account WHERE $column like '%$search%' AND active=True ORDER BY accountID ASC;";
    $result = $conn->prepare($sql);
    $result->execute();

    if ($result->rowCount() > 0){
?>
        <div>
        <h2>View Users</h2>
        <table>
        <thead>
            <tr>
                <th>Account ID</th>
                <th>Email Address</th>
                <th>Date Created</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        try{
            while($row = $result->fetch(PDO::FETCH_ASSOC) ){
        ?>
        <tr>                
            <td><?php echo $row["accountID"]?></td>
            <td><?php echo $row["emailAddress"]?></td>
            <td><?php echo $row["dateCreated"]?></td>
            <td><?php echo $row["role"]?></td>
            <td><a href="deleteUser.php?id=<?php echo $row["accountID"];?>">Delete</a></td>
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
?>