<html>

<head>
    <link rel="stylesheet" href="../css/style.css">
    <?php session_start();
    
    if (isset($_SESSION["role"])) {
        if($_SESSION["role"] == "Research Study Manager"){
            header("Location: smDashboard.php");             
            exit();         
        }
        else 
        if($_SESSION["role"] == "Researcher"){
            header("Location: researcher.php");             
            exit();
        }
    }
    else{
        header("Location: login.php");
            exit();
    }
    ?>

</head>

<body>
    <div id="header" class="header">
        <div id="topRow">
            <img src="../circle.jpg" alt="Plain circle" width="70px" height="70px">

            <a href="logout.php" id="logout">Log out</a>
        </div>

        <div id="bottomRow">
            <p id="userTitle">
                Research Group Manager:

                <?php
                // Displaying the username from session variables
                if (isset($_SESSION["username"])) {
                    echo $_SESSION["username"];
                } else {
                    echo "ERROR.";
                }
                ?>
            </p>

            <p id="userEmail">
                Email:
                
                <?php
                // Displaying the email from session variables

                if (isset($_SESSION["email"])) {
                    echo $_SESSION["email"];
                } else {
                    echo "ERROR.";
                }
                ?>
            </p>
        </div>
    </div>
    <div class="panels">

        <div class="panel-1">
            <a href="nothing">
                <p>Create new study</p>
            </a>
        </div>

        <div class="panel-2">
            <a href="nothing">
                <p>View all studies</p>
            </a>
        </div>
        <div class="panel-3">
            <a href="nothing">
                <p>Delete Previous Study</p>
            </a>
        </div>

        <div class="panel-4">
            <a href="createUser.php">
                <p>Create New Researchers</p>
            </a>
        </div>

    </div>

    <div id="footer">
        <p>Copyright © Nathan White. All Rights Reserved </p>
    </div>

</body>

<html>