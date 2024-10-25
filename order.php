<?php
// Database connection
$db = new SQLite3('restaurant.db');

// Create table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    address TEXT NOT NULL,
    item1 TEXT NOT NULL,
    item2 TEXT NOT NULL,
    item3 TEXT NOT NULL,
    item4 TEXT NOT NULL,
    item5 TEXT NOT NULL
)");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = SQLite3::escapeString($_POST['name']);
    $email = SQLite3::escapeString($_POST['email']);
    $phone = SQLite3::escapeString($_POST['phone']);
    $address = SQLite3::escapeString($_POST['address']);
    $item1 = SQLite3::escapeString($_POST['item1']);
    $item2 = SQLite3::escapeString($_POST['item2']);
    $item3 = SQLite3::escapeString($_POST['item3']);
    $item4 = SQLite3::escapeString($_POST['item4']);
    $item5 = SQLite3::escapeString($_POST['item5']);

    // Insert data into the database
    $stmt = $db->prepare("INSERT INTO orders (name, email, phone, address, item1, item2, item3, item4, item5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $phone);
    $stmt->bindValue(4, $address);
    $stmt->bindValue(5, $item1);
    $stmt->bindValue(6, $item2);
    $stmt->bindValue(7, $item3);
    $stmt->bindValue(8, $item4);
    $stmt->bindValue(9, $item5);
    
    if ($stmt->execute()) {
        echo "<h2>Order Submitted Successfully!</h2>";
        echo "<p>Thank you , $name! Here are your order details:</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Phone: $phone</p>";
        echo "<p>Address: $address</p>";
        echo "<p>Selected Items:</p>";
        echo "<ul>
                <li>Menu Item 1: $item1</li>
                <li>Menu Item 2: $item2</li>
                <li>Menu Item 3: $item3</li>
                <li>Menu Item 4: $item4</li>
                <li>Menu Item 5: $item5</li>
              </ul>";
    } else {
        echo "<h2>Order Submission Failed, Please Try Again.</h2>";
    }
}
$db->close();
?>
