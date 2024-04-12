
<header class="header">

    <?php var_dump($_SESSION)//test?>
    <?php if(isset($_SESSION["loggedIn"]) And $_SESSION["loggedIn"] == true ):?>
        <div class="header-text">
            <h1>Energy Efficiency Application</h1>
        </div>
        <div class="header-buttons">
            <?php switch ($_SESSION["userRole"]):
                case "admin" :?>
                    <a href="manageProperties.php">Manage Properties</a>
                    <a href="placeholder.php">Add New Property</a>
                    <?php break;
                case "landlord":?>
                    <a href="manageProperties.php">Manage Properties</a>
                    <a href="placeholder.php">Add New Property</a>
                    <?php break;
                case "tenant":?>
                    <a href="viewProperty.php">Search Properties</a>
                    <a href="veiwSavedProperty.php">Veiw Saved Properties</a>
                    <?php break;?>
            <?php endswitch?>
            <a href="#manageAccount.php">View Profile</a>
            <a href="home.php">Home</a>
            <a href="logout.php">Log out</a>
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

