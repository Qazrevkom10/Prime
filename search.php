<?php

include_once 'db.php';



session_start();


function searchGoods($query, $category = null)
{
    global $conn;
    $goods = array();

    
    $whereCondition = "WHERE name LIKE '%$query%'";
    if ($category) {
        $whereCondition .= " AND category_id = $category";
    }

    
    $sql = "SELECT * FROM goods $whereCondition";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $goods[] = $row;
        }
    }

    return $goods;
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
    $query = $_GET['query'];

    
    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

   
    $goodsList = searchGoods($query, $selectedCategory);

    
    $_SESSION['search_results'] = $goodsList;

    
    header("Location: index.php?query=$query&category=$selectedCategory");
    exit;
}
?>
