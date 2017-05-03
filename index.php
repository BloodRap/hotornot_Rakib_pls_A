<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8" />
    <title>HotOrNot</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="icon" href="images/logo-small-fire.png">
    <script src="scripts/jquery-3.2.0.js"></script>
    <script src="scripts/scripts.js"></script>
</head>

<body>
    <header> <!--  LOGO  -->
        <img id="welcomeBig" src="images/welcome-logo.png">
        <img id="welcomeSmall" src="images/welcome.png">
        <img id="hotSmall" src="images/hot-or-not.png">
    </header>

    <main>
        <h3>Challenge yourself or punish an ugly bitch!</h3>
        <nav>
            <ul><!-- Navigation  -->
                <li><a href="toplist.php" id="link1" class="link">Top 10</a></li>
                <li><a href="hotornot.php" id="link2" class="link">Start to Rate</a></li>
                <li><a href="upload.php" id="link3" class="link">Upload</a></li>
            </ul>
        </nav>

        <?php // Admins kontrollinloggning

        if(isset($_POST['pass']) && $_POST['pass'] == "harambe") {
            setcookie("admin", "admin", time()+3600);
            header("location: admin.php");
        }

        ?>
    </main>

    <footer>
        <span>HotOrNot &copy; 2017</span>
        <button id="admin">Admin</button> <!-- button för att visa admins inloggning form  -->
        <form id="form" method="post" style="display:none">
            <input type="password" id="pass" name="pass" placeholder="harambe" autofocus>
        </form>
    </footer>
</body>

</html>
