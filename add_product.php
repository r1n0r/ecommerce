<?php
include 'db.php';
// Initialize variables for success and error messages
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $type = $_POST['type']; // Added product type

    // File upload handling
    $image_path = "";
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['product_image']['name']);
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            $error = "Failed to upload image.";
        }
    }

    // Insert into database if no errors
    if (empty($error)) {
        $sql = "INSERT INTO products (name, description, price, category, type, image_url) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsss", $name, $description, $price, $category, $type, $image_path);
        if ($stmt->execute()) {
            $success = "Product added successfully!";
            echo "<script>
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            </script>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.8rem;
            color: #333;
        }

        .form-container .alert {
            padding: 15px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container input[type="file"] {
            padding: 5px;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .form-container button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Product</h2>

        <!-- Success and Error Messages -->
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" placeholder="Enter product name" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter product description" required></textarea>

            <label for="price">Price ($)</label>
            <input type="number" name="price" id="price" step="0.01" placeholder="Enter product price" required>

            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
                <option value="Kids">Kids</option>
            </select>

            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="" disabled selected>Select a type</option>
                <option value="Jackets">Jackets</option>
                <option value="Shirts">Shirts</option>
                <option value="Pants">Pants</option>
                <option value="Shoes">Shoes</option>
            </select>

            <label for="product_image">Product Image</label>
            <input type="file" name="product_image" id="product_image">

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
