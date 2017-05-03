<?php

    if(!isset($_COOKIE['admin']) || $_COOKIE['admin'] != "admin") {
        header("location: index.php");
    }
    include "classes.php";
    $rating = new rating();

?>
    <!DOCTYPE html>
    <html lang="sv">

    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="stylesheet" href="style/admin.css">
        <script src="scripts/jquery-3.2.0.js"></script>
        <script src="scripts/scripts.js"></script>
        <script>
            function Delete(theme, id) {
                $.ajax({
                    type: 'post',
                    url: 'delete.php',
                    data: {
                        theme: theme, // pool som väldes
                        id: id // id av bild som du bill radera från databasen
                    },
                    success: function() {
                        $("#photos").load("showAll.php?theme=" + theme); // visa alla bilder igen
                    }
                });
            }

        </script>
    </head>

    <body>
        <main>
            <header></header>
            <h3>Welcome Adminé!</h3>
            <nav>
                <ul> <!-- Navigation -->
                    <li><a href="toplist.php" id="link1" class="link">Top 10</a></li>
                    <li><a href="hotornot.php" id="link2" class="link">Start to Rate</a></li>
                    <li><a href="upload.php" id="link3" class="link">Upload</a></li>
                </ul>
            </nav>
            <nav>
                <ul> <!-- Navigation genom pool av bilder -->
                    <li><a href="admin.php?theme=dank" class="link linkTheme" id="theme1">Dank</a></li>
                    <li><a href="admin.php?theme=dark" class="link linkTheme" id="theme2">Dark</a></li>
                    <li><a href="admin.php?theme=gaming" class="link linkTheme" id="theme3">Gaming</a></li>
                    <li><a href="admin.php?theme=nsfw" class="link linkTheme" id="theme4">NSFW</a></li>
                    <li><a href="admin.php?theme=wtf" class="link linkTheme" id="theme5">WTF</a></li>
                    <li><a href="admin.php?theme=girls" class="link linkTheme" id="theme6">Girls</a></li>
                </ul>
            </nav>
            <div id="photos"> <!-- Div där alla bilder visas -->
                <?php

                if (isset($_GET['theme'])) {
                    $rating->showAll($_GET['theme']);
                } // anropar funktion för att visa alla bilder av pool som väldes

            ?>
            </div>
            <?php // Admins uttloggning

            if(isset($_POST['pass']) && $_POST['pass'] == "harambe") {
                unset($_COOKIE["admin"]);
                header("location: index.php");
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
