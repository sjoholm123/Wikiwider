<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fact.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
    <title>Iron Man</title>
</head>
<body>
<div class="menu">
  <div class="header">
    <img class="image" src="bilder/marvelwiki.png">
  <i class="far fa-times" id="menuCross"></i>
  </div>
  
  <form class="form" action="search.php" method="get">
<input class="search" id="holder" type="text" placeholder="Search for.." name="pageTitle">
</form>
<button class="text logOut"  onclick="location.href='logout.php'">Log Out</button>
<button class="text skapa">Create Article</button>
<button class="text home"  onclick="location.href='loggedin.php'">Home</button>
</div>

<i class="far fa-bars" id="bars"></i>
<form class="new-article" action="newPage.php" method="POST">
    <h1 class="h1">New Article</h1>
        <input class="Title" type="text" placeholder="Article Title" name="pageTitle">
        <input class="article-submit" value="Create" type="submit">
        <button type="button" class="cancel">Cancel</button>
    </form>
    <div class="fakeContainer"></div>
    <?php
    $postID = $_GET['postID'];
        echo '<div class="container">
            <form action="edit_wiki.php?postID='.$postID.'" method="post">
            <div class="line2"></div>
            <div class="posttitle">
                <input type="text" name="postTitle" class="editposttitle" placeholder="Edit your postTitle">
                <span class="help-block"></span>
            </div>
            <div class="pagetext">
                <input type="text" name="pText" class="editptext" placeholder="Edit your text" size="112">
                <span class="help-block"></span>
            </div>
            <div class="fact"></div>
            <div class="editimage"></div>
            <!--<div class="facttext2">
                <textarea type="text" name="pText" class="editptext" placeholder="Insert page title here" size="30">
                <span class="help-block"></span>
            </div>-->
            <div class="button">
                <input type= "submit" class="btn" value="Skicka">
            </div>
            <!--<div class="editname">Real Name</div>
            <div class="editright">Anthony Edward Stark</div>-->
                <input type="hidden" name="postID" class="postID" placeholder="postID" value='.$postID.'>
            </form>
            ';
            ?>
        </div>
</body>
<script src="js/hamburgerMenu.js"></script>
<script src="js/newArticle.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</html>
