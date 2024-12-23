<?php
include 'includes/db.php';

$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Check if product is a<?php
include 'db.php';

session_start();
$user_id = $_SESSION['admin_id']; // Replace with proper user session ID
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $product_id, $quantity);

if ($stmt->execute()) {
    echo "Product added to cart.";
} else {
    echo "Error: " . $conn->error;
}
?>
lready in cart
$sql = "SELECT * FROM Cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if product exists
    $sql = "UPDATE Cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
} else {
    // Insert new cart item
    $sql = "INSERT INTO Cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
}

if ($stmt->execute()) {
    echo "Item added to cart successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
