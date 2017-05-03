<?php

    include "classes.php";
    $rating = new rating();

?>
    <!DOCTYPE html>
    <html lang="sv">

    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="stylesheet" href="style/toplist.css">
        <script src="scripts/jquery-3.2.0.js"></script>
        <script src="scripts/scripts.js"></script>
    </head>
    <body>
        <header> <!-- LOGO -->
            <img id="welcomeBig" src="images/welcome-logo.png">
            <img id="welcomeSmall" src="images/welcome.png">
            <img id="hotSmall" src="images/hot-or-not.png">
        </header>
       <main>
           <h3>Choose the hottest chick or the deadliest weapon!</h3>
            <nav>
                <ul> <!-- Navigation -->
                    <li><a href="index.php" id="link1" class="link">Home</a></li>
                    <li><a href="hotornot.php" id="link2" class="link">Start to Rate</a></li>
                    <li><a href="upload.php" id="link3" class="link">Upload</a></li>
                </ul>
            </nav>
            <nav>
                <ul> <!-- Navigation genom pool av bilder -->
                    <li><a href="toplist.php?theme=dank" class="link linkTheme" id="theme1">Dank</a></li>
                    <li><a href="toplist.php?theme=dark" class="link linkTheme" id="theme2">Dark</a></li>
                    <li><a href="toplist.php?theme=gaming" class="link linkTheme" id="theme3">Gaming</a></li>
                    <li><a href="toplist.php?theme=nsfw" class="link linkTheme" id="theme4">NSFW</a></li>
                    <li><a href="toplist.php?theme=wtf" class="link linkTheme" id="theme5">WTF</a></li>
                    <li><a href="toplist.php?theme=girls" class="link linkTheme" id="theme6">Girls</a></li>
                </ul>
            </nav>
            <div id="photos"> <!-- Div där 10 bilder visas -->
                <?php

                if (isset($_GET['theme'])) {
                    $rating->showTop($_GET['theme']);
                } // anropar funktion för att visa 10 bilder av pool som väldes med högsta poäng

                ?>
            </div>
            <?php // Admins kontrollinloggning

            if(isset($_POST['pass']) && $_POST['pass'] == "harambe") {
                setcookie("admin", "admin", time()+3600);
                header("location: admin.php");
            }

            ?>
       </main>
        <footer>
            <span>HotOrNot &copy; 2017</span>
            <button id="admin">Admin</button>
            <form id="form" method="post" style="display:none"> <!-- button för att visa admins inloggning form -->
                <input type="password" id="pass" name="pass" placeholder="harambe" autofocus>
            </form>
        </footer>
    </body>
    </html>
