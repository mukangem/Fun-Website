<?php
include 'db_connect.php';

$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Sorting logic
switch ($sort_option) {
    case 'price':
        $order_by = 'price ASC';
        break;
    case 'popularity':
        $order_by = 'author ASC'; // Placeholder for real popularity data
        break;
    case 'rating':
        $order_by = 'title ASC'; // Placeholder for real rating data
        break;
    case 'sale':
        $order_by = 'title DESC'; // Placeholder for sale data
        break;
    default:
        $order_by = 'book_id ASC';
}

$sql = "SELECT books.title, books.author, books.price, books.file_link, categories.category_name
        FROM books
        JOIN categories ON books.category_id = categories.category_id
        ORDER BY $order_by";

$statement = $pdo->prepare($sql);
$statement->execute();
$books = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebook Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>All eBooks</h1>
        <div class="sort-section">
            <form method="GET" action="ebooks.php">
                <select name="sort" onchange="this.form.submit()">
                    <option value="default" <?= $sort_option == 'default' ? 'selected' : '' ?>>Default sorting</option>
                    <option value="price" <?= $sort_option == 'price' ? 'selected' : '' ?>>Sort by price</option>
                    <option value="popularity" <?= $sort_option == 'popularity' ? 'selected' : '' ?>>Sort by popularity</option>
                    <option value="rating" <?= $sort_option == 'rating' ? 'selected' : '' ?>>Sort by rating</option>
                    <option value="sale" <?= $sort_option == 'sale' ? 'selected' : '' ?>>Sort by sale</option>
                </select>
            </form>
        </div>
        <div class="book-list">
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p>Author: <?= htmlspecialchars($book['author']) ?></p>
                    <p>Category: <?= htmlspecialchars($book['category_name']) ?></p>
                    <p>Price: $<?= htmlspecialchars($book['price']) ?></p>
                    <a href="<?= htmlspecialchars($book['file_link']) ?>" class="btn">Download PDF</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
