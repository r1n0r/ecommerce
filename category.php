<?php
include 'db.php';

// Get the category from the query string, default to 'Men' if not provided
$category = $_GET['category'] ?? 'Men';

// Prepare the SQL statement to fetch products based on the category
$sql = "SELECT * FROM products WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

// Organize products by type
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[$row['type']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category); ?> Collection</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    /* Header Section */
    .category-header {
        background: url('path-to-category-banner.jpg') center/cover no-repeat;
        color: white;
        padding: 80px 20px;
        text-align: center;
        position: relative;
    }

    .category-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        z-index: 1;
    }

    .category-header h1,
    .category-header p {
        position: relative;
        z-index: 2;
    }

    .category-header h1 {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .category-header p {
        font-size: 1.2rem;
    }

    /* Section Styling */
    .section {
        padding: 50px 20px;
    }

    .section h2 {
        font-size: 2rem;
        margin-bottom: 10px;
        text-transform: capitalize;
        color: #333;
    }

    .section p {
        font-size: 1rem;
        color: #777;
        margin-bottom: 30px;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* Always four columns */
        gap: 20px;
    }

    @media (max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr); /* Three columns for medium screens */
        }
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr); /* Two columns for tablets */
        }
    }

    @media (max-width: 576px) {
        .product-grid {
            grid-template-columns: 1fr; /* One column for mobile */
        }
    }

    .product-card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-decoration: none;
        color: #000;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .product-content {
        padding: 15px;
        text-align: center;
    }

    .product-content h3 {
        font-size: 1rem;
        margin: 10px 0;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .product-content .price {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
    }
</style>



</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Header Section -->
    <div class="category-header">
        <h1><?php echo htmlspecialchars($category); ?> Collection</h1>
        <p>Discover our curated selection of Jackets, Shirts, Pants, and Shoes for <?php echo htmlspecialchars($category); ?>.</p>
    </div>

    <!-- Jackets Section -->
    <div class="section">
        <h2>Jackets</h2>
        <p>Stay warm and stylish with our latest collection of premium jackets.</p>
        <div class="product-grid">
            <?php if (!empty($products['Jackets'])) {
                foreach ($products['Jackets'] as $product) { ?>
                    <a href="products.php?id=<?php echo $product['id']; ?>" class="product-card">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>No jackets available in this category.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Shirts Section -->
    <div class="section">
        <h2>Shirts</h2>
        <p>Upgrade your wardrobe with our versatile and stylish shirts.</p>
        <div class="product-grid">
            <?php if (!empty($products['Shirts'])) {
                foreach ($products['Shirts'] as $product) { ?>
                    <a href="products.php?id=<?php echo $product['id']; ?>" class="product-card">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>No shirts available in this category.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Pants Section -->
    <div class="section">
        <h2>Pants</h2>
        <p>Find the perfect pair of pants for every occasion.</p>
        <div class="product-grid">
            <?php if (!empty($products['Pants'])) {
                foreach ($products['Pants'] as $product) { ?>
                    <a href="products.php?id=<?php echo $product['id']; ?>" class="product-card">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>No pants available in this category.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Shoes Section -->
    <div class="section">
        <h2>Shoes</h2>
        <p>Step into style with our latest range of shoes.</p>
        <div class="product-grid">
            <?php if (!empty($products['Shoes'])) {
                foreach ($products['Shoes'] as $product) { ?>
                    <a href="products.php?id=<?php echo $product['id']; ?>" class="product-card">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                        </div>
                    </a>
                <?php }
            } else { ?>
                <p>No shoes available in this category.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
