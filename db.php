<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "site";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!function_exists('getCategories')) {
function getCategories(){
    global $conn;
    $categories = array();

    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
            $categories[] = $row;
        }
    }

    return $categories;
}
}

if (!function_exists('getUserFromSession')) {

    function getUserFromSession()
    {
        if (isset($_SESSION['user_id'])) {
            
            $userId = $_SESSION['user_id'];

            global $conn;

            $sql = "SELECT * FROM users WHERE id = $userId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user;
            }
        }

        return null;
    }
}


if (!function_exists('createGoods')) {
function createGoods($name, $price, $image, $user)
{
    global $conn;

    $sql = "INSERT INTO goods (name, price, image, user_id) VALUES ('$name', $price, '$image', '$user')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
       
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('searchGoods')) {
   
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
}


if (!function_exists('readGoods')) {
    function readGoods($category = null)
{
    global $conn;
    $goods = array();

    $whereCondition = $category ? "WHERE category_id = $category" : "";
    $sql = "SELECT * FROM goods $whereCondition";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $goods[] = $row;
        }
    }

    return $goods;
}
}


if (!function_exists('getGoodCategory')) {
function getGoodCategory($id)
{
    global $conn;

    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        return $category;
    }

    return null;
}
}


if (!function_exists('banUser')) {
    function banUser($id)
    {
        global $conn;

        
        $banDuration = new DateInterval('PT2H'); 

        
        $currentTime = new DateTime();

        
        $banExpiration = $currentTime->add($banDuration)->format('Y-m-d H:i:s');

        
        $stmt = $conn->prepare("UPDATE users SET banned = 1, ban_expiration = ? WHERE id = ?");
        $stmt->bind_param("si", $banExpiration, $id);

        if ($stmt->execute()) {
            echo "Ban applied successfully! Ban expiration: $banExpiration";
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
}








if (!function_exists("unbanUser")) {
function unbanUser($id)
{
    global $conn;

    $sql = "UPDATE users SET banned = 0 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('updateRole')) {
function updateRole($id, $role)
{
    global $conn;

    $sql = "UPDATE users SET role = '$role' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('deleteCategory')) {
function deleteCategory($id)
{
    global $conn;

    $sql = "DELETE FROM categories WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('addCategory')) {
function addCategory($name)
{
    global $conn;

    $sql = "INSERT INTO categories (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}


if (!function_exists('updateGood')) {
function updateGood($id, $name, $price, $category)
{
    global $conn;

    $sql = "UPDATE goods SET name = '$name', price = $price, category_id = $category WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('deleteGood')) {
function deleteGood($id)
{
    global $conn;

    $sql = "DELETE FROM goods WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
}

if (!function_exists('rateGood')) {

    function rateGood($user_id, $good_id, $rating){
        global $conn;

        $queryObj = $conn->query("SELECT * FROM users_goods WHERE user_id = $user_id AND good_id = $good_id");

        if($queryObj->num_rows > 0){
            $sql = "UPDATE users_goods SET rating = $rating WHERE user_id = $user_id AND good_id = $good_id";
        }else{
            $sql = "INSERT INTO users_goods (user_id, good_id, rating) VALUES ($user_id, $good_id, $rating)";
        }

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }

    }
}

if (!function_exists('countAvgRating')) {

    function countAvgRating($good_id){
        global $conn;

        $sql = "SELECT AVG(rating) AS avg_rating FROM users_goods WHERE good_id = $good_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $avg_rating = $result->fetch_assoc();
            return $avg_rating['avg_rating'];
        }

        return null;
    }
}

if(!function_exists('addToCart')){
    function addToCart($user_id, $good_id){
        global $conn;

        $sql = "INSERT INTO cart (user_id, good_id) VALUES ($user_id, $good_id)";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }
}

if(!function_exists('getCart')){
    function getCart($user_id){
        global $conn;

        $sql = "SELECT * FROM cart WHERE user_id = $user_id";

        $result = $conn->query($sql);

        $cart = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $cart[] = $row;
            }
        }

        return $cart;
    }
}

if(!function_exists('getGoodFromCart')){
    function getGoodFromCart($good_id){
        global $conn;

        $sql = "SELECT * FROM goods WHERE id = $good_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $good = $result->fetch_assoc();
            return $good;
        }

        return null;
    }

}

if(!function_exists('deleteFromCart')){
    function deleteFromCart($user_id, $good_id, $cart_id){
        global $conn;

        $sql = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id AND good_id = $good_id";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }
}