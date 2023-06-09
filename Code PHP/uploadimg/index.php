<?php
$_SESSION['username'] = "Admin";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Portfolio</title>
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="temp.html" class="header-brand">mmtuts</a>
    <nav>
        <ul>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="about.html">About me</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <a href="cases.html" class="header-cases">Cases</a>
    </nav>
</header>
<main>
    <section class="gallery-links">
        <div class="wrapper">
            <h2>Gallery</h2>

            <div class="gallery-container">
                <?php
                include_once '../includes/dbh.inc.php';

                $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed";
                }else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="#">
                            <div style="background-image: url(../img/gallery/'.$row["imgFullNameGallery"].')"></div>
                            <h3>'.$row["titleGallery"].'</h3>
                            <p>'.$row["descGallery"].'</p>
                        </a>';
                    }
                }
                ?>
            </div>


            <?php
            if(isset($_SESSION['username'])) {
                echo '<div class="gallery-upload">
                        <h2>Upload</h2>
                        <form action="../includes/gallery-upload-inc.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="filename" placeholder="File name...">
                            <input type="text" name="filetitle" placeholder="File title...">
                            <input type="text" name="filedesc" placeholder="Image description...">
                            <input type="file" name="file" >
                            <button type="submit" name="submit">Upload</button>
                        </form>
                </div>';
            }
            ?>
        </div>
    </section>

</main>

</body>
</html>