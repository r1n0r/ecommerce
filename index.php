<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - eCommerce</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: url('images/banner.jpg') center/cover no-repeat;
            color: white;
            padding: 150px 20px;
            text-align: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
            z-index: 1;
        }

        .hero-section h1,
        .hero-section p {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        /* Category Section */
        .category-section {
            padding: 50px 20px;
            text-align: center;
        }

        .category-section h2 {
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .category-item {
            position: relative;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            color: #000;
        }

        .category-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .category-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #ddd;
        }

        .category-content {
            padding: 20px;
            text-align: center;
        }

        .category-content h3 {
            font-size: 1.5rem;
            margin: 0;
            color: #333;
        }

        .category-content p {
            font-size: 0.9rem;
            color: #777;
            margin-top: 8px;
        }

        /* Overlay Effect */
        .category-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .category-item:hover::after {
            opacity: 1;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Welcome to Our Store</h1>
        <p>Discover the best products tailored for you.</p>
    </div>

     <!-- Category Section -->
     <div class="category-section">
        <h2>Shop by Category</h2>
        <div class="category-grid">
            <!-- Men -->
            <a href="category.php?category=Men" class="category-item">
                <img src="images/men.jpg" alt="Men">
                <div class="category-content">
                    <h3>Men</h3>
                    <p>Explore the latest fashion for men.</p>
                </div>
            </a>
            <!-- Women -->
            <a href="category.php?category=Women" class="category-item">
                <img src="images/women.jpg" alt="Women">
                <div class="category-content">
                    <h3>Women</h3>
                    <p>Discover stunning styles for women.</p>
                </div>
            </a>
            <!-- Kids -->
            <a href="category.php?category=Kids" class="category-item">
                <img src="images/kids.jpg" alt="Kids">
                <div class="category-content">
                    <h3>Kids</h3>
                    <p>Trendy outfits for your little ones.</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
