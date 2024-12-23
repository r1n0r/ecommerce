<?php
include 'includes/db.php';

$user_id = $_POST['user_id'];

// Calculate total amount
$sql = "SELECT SUM(Products.price * Cart.quantity) AS total_amount
        FROM Cart
        JOIN Products ON Cart.product_id = Products.id
        WHERE Cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_amount = $row['total_amount'];

// Insert into Orders
$sql = "INSERT INTO Orders (user_id, total_amount) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $user_id, $total_amount);
$stmt->execute();
$order_id = $stmt->insert_id;

// Insert into OrderItems
$sql = "SELECT * FROM Cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

while ($item = $cart_items->fetch_assoc()) {
    $sql = "INSERT INTO OrderItems (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['quantity'] * $item['price']);
    $stmt->execute();
}

// Clear Cart
$sql = "DELETE FROM Cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo "Order placed successfully!";
?>
