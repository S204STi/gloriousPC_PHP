<?php
// Database functions for the Product table

// Get single product by id
function get_product($ProductId) {
    global $db;
    
    $query = '
        SELECT *
        FROM Product as p
        LEFT OUTER JOIN Category AS pc 
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

function create_product($ProductName, $Description, $Stock, $PriceEach, $ImagePath, $CategoryId, $IsFeatured) {
        global $db;

    $query = '
        INSERT INTO Product (
            ProductName, Description, Stock, PriceEach, ImagePath, CategoryId, IsFeatured)
        VALUES (
            :productName, :description, :stock, :priceEach, :imagePath, :categoryId, :isFeatured);';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $ProductName);
        $statement->bindValue(':description', $Description);
        $statement->bindValue(':stock', $Stock);
        $statement->bindValue(':priceEach', $PriceEach);
        $statement->bindValue(':imagePath', $ImagePath);
        $statement->bindValue(':categoryId', $CategoryId);
        $statement->bindValue(':isFeatured', $IsFeatured);
        $statement->execute();
        $productId = $db->lastInsertId();
        $statement->closeCursor();
        return $productId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_product($ProductName, $Description, $Stock, $PriceEach, $ImagePath, $CategoryId, $IsFeatured, $ProductId) {
        global $db;

    $query = '
        UPDATE Product  
        SET ProductName = :productName, Description = :description, 
            Stock = :stock, PriceEach = :priceEach, 
            ImagePath = :imagePath, CategoryId = :categoryId, 
            IsFeatured = :isFeatured
        WHERE ProductId = :productId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $ProductName);
        $statement->bindValue(':description', $Description);
        $statement->bindValue(':stock', $Stock);
        $statement->bindValue(':priceEach', $PriceEach);
        $statement->bindValue(':imagePath', $ImagePath);
        $statement->bindValue(':categoryId', $CategoryId);
        $statement->bindValue(':isFeatured', $IsFeatured);
        $statement->bindValue(':productId', $ProductId);        
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_product($ProductId) {
        global $db;

    $query = '
        DELETE FROM Product
        WHERE ProductId = :productId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':productId', $ProductId);        
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>