<?php
// Database functions for the Product table

// Get single product by id
function get_product($ProductId) {
    global $db;
    
    $query = '
        SELECT *
        FROM Product as p
        INNER JOIN Category AS pc 
            ON pc.CategoryId = p.CategoryId
        WHERE p.ProductId = :product_id;';
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $ProductId);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_all_products() {
    global $db;
    
    $query = '
        SELECT *
        FROM Product
        ORDER BY ProductId;';
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Get all products by a category id
function get_products_by_category($CategoryId) {
    global $db;
    
    $query = '
        SELECT *
        FROM Product as p
        INNER JOIN Category AS pc 
            ON pc.CategoryId = p.CategoryId
        WHERE p.CategoryId = :category_id
        ORDER BY p.ProductId;';
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $CategoryId);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_featured_products() {
    global $db;

    $query = '
        SELECT *
        FROM Product
        WHERE IsFeatured = 1
        ORDER BY ProductId;';
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>