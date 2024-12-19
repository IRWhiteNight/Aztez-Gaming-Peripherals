<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_ict600";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the WHERE clause
$where_conditions = [];

// Check if the price range is submitted
if (isset($_GET['min_price']) && isset($_GET['max_price']) && $_GET['min_price'] !== '' && $_GET['max_price'] !== '') {
    $min_price = $_GET['min_price'];
    $max_price = $_GET['max_price'];
    $where_conditions[] = "price BETWEEN $min_price AND $max_price";
}

// Check if categories are submitted
if (isset($_GET['categories']) && !empty($_GET['categories'])) {
    $categories = $_GET['categories'];
    $categories_list = implode("','", array_map([$conn, 'real_escape_string'], $categories));
    $where_conditions[] = "category IN ('$categories_list')";
}

// Check if brands are submitted
if (isset($_GET['brands']) && !empty($_GET['brands'])) {
    $brands = $_GET['brands'];
    $brands_list = implode("','", array_map([$conn, 'real_escape_string'], $brands));
    $where_conditions[] = "brand IN ('$brands_list')";
}

// Construct the WHERE clause
$where_clause = "";
if (!empty($where_conditions)) {
    $where_clause = "WHERE " . implode(" AND ", $where_conditions);
}

// SQL query to fetch products with the applied filters
$sql = "SELECT * FROM products $where_clause";
$result = $conn->query($sql);
?>