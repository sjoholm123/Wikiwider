<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/createWiki.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ //global username och API, skicka med username till varje sida         
    echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>"); 
    $_SESSION['API'];
    $_SESSION['password'];
        $pageID = $_SESSION['pageID'];
    $pageTitle = $_SESSION['pageTitle'];
    $username = $_SESSION['username'];
    
} else {
    header('Location: index.html');
}

?>

    <!--<p class="yeet">Add Subheading</p>-->
    <nav>
        <div class="tools">
            <div id="add_subheader" class="section">
                <img title="Add Subheader" class="add_subheader" src="bilder/add_subheader.svg">
            </div>
            <div id="add_paragraph" class="section">
                <img title="Add Paragraph" class="add_field" src="bilder/add_field_icon.svg">
            </div>
            <div id="add_image" class="section">
                <img title="Add Image" class="add_image" src="bilder/add-image.svg">
            </div>
            <div id="add-infobox" class="section">
                    <img title="Add infobox" class="add_infobox" src="bilder/info-icon.svg">
            </div>
        </div>
        <button class="cancel">Cancel</button>
    </nav>

    <div class="container">
        <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
            <input class="heading" type="text" name="pageTitle" value="<?php echo $pageTitle ?>" placeholder="Heading">
            <input type="hidden" name="username" value="<?php echo $username ?>">
            <input type="hidden" name="pageID" value="<?php echo $pageID ?>">
            <input type="submit" class="create-wiki" name="create" value="Create">
        </form>
    </div>
</body>
<script src="js/createWiki.js"></script>
</html>