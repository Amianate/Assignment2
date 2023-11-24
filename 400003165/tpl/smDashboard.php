<html>

<head>
    <link rel="stylesheet" href="../css/style.css">
    <?php session_start();
    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "Research Group Manager") {
            header("Location: gmDashboard.php");
            exit();
        } else
            if ($_SESSION["role"] == "Researcher") {
            header("Location: researcher.php");
            exit();
        }
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
                Research Study Manager:

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
    </div>

    <div id="footer">
        <p>Copyright © Nathan White. All Rights Reserved </p>
    </div>

</body>

<html>