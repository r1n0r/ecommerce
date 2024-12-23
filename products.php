<?php
include 'db.php';

// Fetch the product details based on ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Hero Section */
        .hero-section {
            background: url('<?php echo $product['image_url']; ?>') center/cover no-repeat;
            height: 300px;
            position: relative;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Overlay */
            z-index: 1;
        }

        .hero-section h1 {
            position: relative;
            z-index: 2;
            font-size: 2.5rem;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .col-left,
        .col-right {
            flex: 1;
            padding: 20px;
        }

        .col-left {
            max-width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-image {
            width: 400px;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        .product-details h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .product-details p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        .product-details .price {
            font-size: 1.5rem;
            color: #27ae60;
            margin: 20px 0;
            font-weight: bold;
        }

        .product-details .actions {
            display: flex;
            gap: 20px;
        }

        .actions input[type="number"] {
            padding: 10px;
            width: 80px;
            font-size: 1rem;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            padding: 15px 25px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: transform 0.2s ease, background 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            color: #333;
            border: 1px solid #ccc;
        }

        .btn-secondary:hover {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    </div>

    <!-- Product Details Section -->
    <div class="container">
        <div class="row">
            <!-- Left Column: Image -->
            <div class="col-left">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
            </div>

            <!-- Right Column: Details -->
            <div class="col-right">
                <div class="product-details">
                    <h2>About This Product</h2>
                    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    <div class="price">Price: $<?php echo number_format($product['price'], 2); ?></div>
                </div>

                <!-- Add to Cart Form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="actions">
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                        <a href="index.php" class="btn btn-secondary">Back to Products</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
