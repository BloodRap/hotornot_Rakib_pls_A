<?php

    // U P L O A D   O F   P H O T O S
    class photos {
        function uploadImage(){
            session_start();
            include "conn.php";
            if(isset($_POST['submit'])){ // om vi fick en bild, splitrar information om den och behandlar
                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileSizeMB = substr(($fileSize / 10485760), 0, 3); // file size nu i MB istället för bit
                $fileError = $_FILES['file']['error'];

                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedType = array('jpg', 'jpeg', 'png'); // bara de här typer är godkäna

                if (in_array($fileType, $allowedType)) {
                    if ($fileError === 0) { // om inga fel uppstod
                        if ($fileSize < 10485760) { // om bild är mindre är max "vikt"
                            $fileNameNew = uniqid('', true).".".$fileType; // ändrar namn av bild till ett uniqt
                            $fileDestination = "uploads/{$_POST['theme']}/$fileNameNew"; // flyttar bildet dit
                            move_uploaded_file($fileTmpName, $fileDestination); // flyttar
                            $data=$db->prepare("INSERT INTO {$_POST['theme']}(photo, title) VALUES('$fileNameNew', '{$_POST['title']}')"); // sätter in det i databasen
                            $data->execute();
                            $_SESSION['message'] = "File $fileName was successfully uploaded!"; // message success
                            header("location: upload.php");
                        }
                        else {
                            $_SESSION['message'] = "<p>Your file is too big, it was {$fileSizeMB}MB</p>";
                        }
                    }
                    else {
                        $_SESSION['message'] = "<p>There was an error uploading your file. Please, try again!</p>";
                    }
                }
                else {
                    $_SESSION['message'] = "<p>You cannnot upload files of type .$fileType! Allowed are .jpg, .jpeg and .png.</p>";
                }
            }
            else if (session_status() != PHP_SESSION_NONE) {
                session_destroy(); // stänger session för att message ska visas bara en gång
            }
        }
    }
    // U P L O A D   O F   P H O T O S


    // R A T I N G   S Y S T E M
    class rating {
        public function showThem($theme) {
            include "conn.php";
            $req=$db->prepare("SELECT * FROM $theme ORDER BY RAND() LIMIT 2"); // slumpar ut 2 bilder från pool
            $req->execute();
            while ($data=$req->fetch()) {
                echo "<figure><img src='uploads/$theme/{$data['photo']}' width='300' height='300'>
                <figcaption>{$data['title']}</figcaption><button onclick=\"vote('$theme', {$data['id']})\">Upvote</button></figure>"; // echor ut varje bild
            }
        }
        public function upvote($id, $theme) {
            include "conn.php";
            $req=$db->prepare("SELECT rating FROM $theme WHERE id='$id'"); // valjer ett bild som du har röstat för
            $req->execute();
            $data=$req->fetch();
            $newRate = $data['rating'] + 1; // ökar rating med 1 poäng
            $req=$db->prepare("UPDATE $theme SET rating='$newRate' WHERE id='$id'"); // sparar
            $req->execute();
        }
        public function showTop($theme) {
            include "conn.php";
            $req=$db->prepare("SELECT * FROM $theme ORDER BY rating DESC LIMIT 10"); // väljer 10 bilder med största rating
            $req->execute();
            while ($data=$req->fetch()) {
                echo "<figure><img src='uploads/$theme/{$data['photo']}' width='150' height='150'>
                <figcaption>{$data['title']}</figcaption><figcaption>Points:{$data['rating']}</figcaption></figure>";
            } // echor varje bild
        }
        public function showAll($theme) {
            include "conn.php";
            $req=$db->prepare("SELECT * FROM $theme"); // väljer alla bilder från en pool
            $req->execute();
            while ($data=$req->fetch()) {
                echo "<figure><img src='uploads/$theme/{$data['photo']}' width='150' height='150'>
                <figcaption>{$data['title']}</figcaption><button onclick=\"Delete('$theme', {$data['id']})\">Delete</button></figure>";
            } // echor varje bild
        }
        public function delete($theme, $id) {
            include "conn.php";
            $req=$db->prepare("DELETE FROM $theme WHERE id=$id"); // raderar en bild från databasen
            $req->execute();
        }
    }
    // R A T I N G   S Y S T E M

?>














