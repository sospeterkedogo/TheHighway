<?php
require '../database.php';

if(isset($_GET['id'])){
	// list articles by categoryId 
	$articleTable = new DataBaseTable($pdo, 'article', 'id');
	$articles = $articleTable->findAllFrom('categoryId', $_GET['id']);

	$categoryTable = new DataBaseTable($pdo, 'category', 'id');
	$category = $categoryTable->find('id', $_GET['id']);
}

else {
	// list all articles
	$articleTable = new DataBaseTable($pdo, 'article', 'id');
	$articles = $articleTable->findAll();

	$category = ['name' => 'Latest News'];
}

$output =  '<h2>'. $category['name'] . '</h2>';

foreach ($articles as $article) {
	$output .= '<h3><a href="article.php?id=' . $article['id'] . '">' . $article['title'] . '</a></h3>';
	$output .= '<img src="images/banners/randombanner.php" alt="Image" style="width:500px;height:auto;"/>';
}

$title = 'Northampton News - ' . $category['name'];

require  '../templates/userlayout.html.php';
?>