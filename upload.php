<?php

    include "classes.php";
    $photos = new photos();

?>
    <!DOCTYPE html>
    <html lang="sv">

    <head>
        <meta charset="utf-8" />
        <title>HotOrNot</title>
        <link rel="stylesheet" href="style/upload.css">
        <link rel="icon" href="images/logo-small-fire.png">
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
            <h3>Come on, upload something, don't be a pussy!</h3>
            <nav>
                <ul> <!-- Navigation -->
                    <li><a href="index.php" id="link1" class="link">Home</a></li>
                    <li><a href="hotornot.php" id="link2" class="link">Start to Rate</a></li>
                    <li><a href="toplist.php" id="link3" class="link">Top 10</a></li>
                </ul>
            </nav>
            <!-- Form där du kan ladda upp en bild -->
            <form id="formUpload" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="hide" required>
                <label for="">Choose a pool:</label>
                <select name="theme">
                    <option value="dank">Dank</option>
                    <option value="dark">Dark</option>
                    <option value="gaming">Gaming</option>
                    <option value="nsfw">NSFW</option>
                    <option value="wtf">WTF</option>
                    <option value="girls">Girls</option>
                </select>
                <br>
                <label for="">Give it a name</label>
                <br>
                <input type="text" name="title" required>
                <br>
                <button id="selectImage" type="button">Select Image</button>
                <button type="submit" name="submit">Upload</button>
                <?php

                    $photos->uploadImage(); // anropar funktion för att ladda upp en bild
                    if (isset($_SESSION['message'])) {
                        echo "<p>{$_SESSION['message']}</p>"; // visar ett meddelande om det finns
                    }

                ?>
            </form>
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
