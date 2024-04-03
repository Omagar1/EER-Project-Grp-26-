
<header class="header">

    
    <?php if(isset($_SESSION["loggedin"]) And $_SESSION["loggedin"] == true ):?>
        <div class="header-text">
            <h1><a href="home.php">Energy Efficiency Application</a></h1>
        </div>
        <div class="header-buttons">
        <?php switch ($_SESSION["role"]):?>
            <?php case "admin" :?>
                <a href="manageProperties.php">Manage Properties</a>
                <a href="placeholder.php">Add New Property</a>
            <?php case "landlord":?>
                <a href="manageProperties.php">Manage Properties</a>
                <a href="placeholder.php">Add New Property</a>
                <?break;?>
            <?php case "tennant"?>
                <a href="viewProperty.php">Search Properties</a>
                <a href="placeholder.php">veiw Saved Properties</a>
                <?break;?>
            <a href="placeholder.php">View Profile</a>
            <a href="placeholder.php">Log out</a>
        </div>
    <?php else:?>
        <div class="header-text">
            <h1>Energy Efficiency Application</h1>
        </div>
        <div class="header-buttons">
            <a href="signUp.php">Sign Up</a>
            <a href="index.php">Log in</a>
        </div>
    <?php endif;?>
</header>

