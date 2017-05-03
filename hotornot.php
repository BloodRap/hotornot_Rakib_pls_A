<?php

    include "classes.php";
    $rating = new rating();

?>
    <!DOCTYPE html>
    <html lang="sv">
    <head>
        <meta charset="utf-8" />
        <title>HotOrNot</title>
        <link rel="stylesheet" href="style/hotornot.css">
        <script src="scripts/jquery-3.2.0.js"></script>
        <script src="scripts/scripts.js"></script>
        <script>
            function vote(theme, id) {
                $.ajax({
                    url: 'upvote.php',
                    type: 'post',
                    data: {
                        theme: theme, // pool som väldes
                        id: id // id av bild som du har röstat för
                    },
                    success: function() {
                        $("#photos").load("showThem.php?theme=" + theme); // visa 2 nya bilder efter röstning
                    }
                });
            }

        </script>
    </head>
    <body>
        <main>
            <header></header>
            <h3>Choose the hottest chick or the deadliest weapon!</h3>
            <nav>
                <ul> <!-- Navigation  -->
                    <li><a href="index.php" id="link1" class="link">Home</a></li>
                    <li><a href="toplist.php" id="link2" class="link">Top 10</a></li>
                    <li><a href="upload.php" id="link3" class="link">Upload</a></li>
                </ul>
            </nav>
            <nav>
                <ul> <!-- Navigation genom pool av bilder -->
                    <li><a href="hotornot.php?theme=dank" class="link linkTheme" id="theme1">Dank</a></li>
                    <li><a href="hotornot.php?theme=dark" class="link linkTheme" id="theme2">Dark</a></li>
                    <li><a href="hotornot.php?theme=gaming" class="link linkTheme" id="theme3">Gaming</a></li>
                    <li><a href="hotornot.php?theme=nsfw" class="link linkTheme" id="theme4">NSFW</a></li>
                    <li><a href="hotornot.php?theme=wtf" class="link linkTheme" id="theme5">WTF</a></li>
                    <li><a href="hotornot.php?theme=girls" class="link linkTheme" id="theme6">Girls</a></li>
                </ul>
            </nav>
            <div id="photos"> <!-- Div där två bilder visas -->
                <?php

                if (isset($_GET['theme'])) {
                    $rating->showThem($_GET['theme']);
                } // anropar funktion för att visa 2 bilder av pool som väldes

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
