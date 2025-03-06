<?php 
session_start();
require '../database.php';

$articleTable = new DataBaseTable($pdo, 'article', 'id');
$article = $articleTable->find('id', $_GET['id']);

$output = '<h3>' . $article['title'] . '</h3>';
$output .= '<img src="images/banners/randombanner.php" alt="Image" style="width:500px;height:auto;"/>';
$output .=  '<p>' . $article['date'] . '</p>' ;
$output .=  '<p>' . $article['description'] . '</p>' ;
$output .= '<p><a href="listarticles.php?author='.$article['author'].'" style="text-decoration: none;">~' . $article['author'] . '</a></p>';

// read from comment table in db and display all comments on website
$output .=  '<h3>Comments:</h3>' ;

$commentTable = new DataBaseTable($pdo, 'comment', 'id');
$comments = $commentTable->findAllFrom('categoryid', $_GET['id']);

foreach ($comments as $comment){
    $output .= $comment['name'] . ': ' . $comment['comment'] . '</br>';
}

// send comments to database
if (isset($_POST['postcomment'])){

    $record = [
        'comment' => $_POST['comment'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'categoryid' => $_POST['id']
    ];

    $commentTable = new DataBaseTable($pdo, 'comment', 'id');
    $commentTable->save($record);

    // redirect to same page to view posted comment
    header('Location: article.php?id=' . $_GET['id'] . '');
}

// log user out
if (isset($_POST['logout'])){
    unset($_SESSION['loggedIN']);
    unset($_SESSION['username1']);
}

if(isset($_SESSION['loggedIN'])){ 
    $output .= '    <form action="article.php?id=' . $_GET['id'] . '" method="POST">
                <label>Comment</label>
                <textarea name="comment"></textarea>
                <input type="hidden" name="name" value=" '.$_SESSION['username1'].' "/>
                <input type="hidden" name="email" value=" '.$_SESSION['email'].' "/>
                <input type="hidden" name="id" value=" '.  $_GET['id'] .' "/>
                <input type="submit" value="Post" name="postcomment" />
            </form></br>';
    // display log out button/form
    $output .= '    <form action="article.php?id=' . $_GET['id'] . '" method="POST">
    <input type="submit" value="Logout" name="logout" />
</form>';

}
else{
    $output .= '</br></br>Click 
                            <a href="userlogin.php?id=' . $_GET['id'] . '">
                                here
                            </a> 
                            to login or sign up and add comment'; 
    $output .= '</br></br></br></br></br>';
}

$title = $article['title'];

require '../templates/userlayout.html.php';
?>