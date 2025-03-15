<div class="menu-nav" id="menu">
        <h2>Menu.</h2>
        <ul id="menuitems">
            <?php 
                if (!isset($pdo)) {
                    require '../database.php';
                }

                $categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
                $stmt = $categoryTable->findAll();

                echo '<li onclick="selectMenuItem(1)" class="selected">
                        <a href="menu.php">All</a>
                    </li>';

                foreach ($stmt as $category) {
                    echo '<li onclick="selectMenuItem(i)">
                            <a href="listproducts.php?id=' . $category['category_id'] . '">' . $category['name'] . '</a>
                          </li>';
                }
            ?>
        </ul>
    </div>

<?php


if(isset($_GET['id'])){
	// list products by categoryId 
	$$productsTable = new DataBaseTable($pdo, 'products', 'productid');
	$products = $$productsTable->findAllFrom('category_id', $_GET['id']);

	$categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
    $stmt = $categoryTable->find('id', $_GET['category_id']);


}

else {
	// list all products
    $productsTable = new DataBaseTable($pdo, 'products', 'productid');
    $products = $productsTable->findAll();

	$category = ['name' => 'All'];
}

$output =  '<h2>'. $category['name'] . '</h2>';

$output .= '<div class="menu-items">';

foreach ($products as $product) {
    $output.= '
        <div class="menu-item">
            <div class="image">
                <img src="images/randombanner.php" alt="menu-item">
            </div>
            <i class="fa-solid fa-circle-info iteminfo"></i>
            <div class="description">
                <h3>'. $product['name'] .'</h3>
                <p>£'. $product['price'] .'</p>
            </div>
            
            <i class="fa-solid fa-plus addtocart"></i>
        </div>
    ';
}
$output .= '</div>';

$title = 'The Highway - ' . $category['name'];

require  '../templates/userlayout.html.php';
?>