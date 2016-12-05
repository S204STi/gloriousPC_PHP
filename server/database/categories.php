<?php
// Database functions for the Category table

// Get single category by id
function get_category($CategoryId){
    global $db;
    
    $query = '
        SELECT *
        FROM Category
        WHERE CategoryId = :category_id;';
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $CategoryId);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Get single category by id
function get_all_categories(){
    global $db;
    
    $query = '
        SELECT *
        FROM Category
        ORDER BY CategoryId;';
    
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

function create_category($CategoryName) {
        global $db;

    $query = '
        INSERT INTO Category (
            CategoryName)
        VALUES (
            :categoryName);';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $CategoryName);
        $statement->execute();
        $categoryId = $db->lastInsertId();
        $statement->closeCursor();
        return $categoryId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_category($CategoryName, $CategoryId) {
        global $db;

    $query = '
        UPDATE Category  
        SET CategoryName = :categoryName
        WHERE CategoryId = :categoryId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $CategoryName);
        $statement->bindValue(':categoryId', $CategoryId);      
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_category($CategoryId) {
        global $db;

    $query = '
        DELETE FROM Category
        WHERE CategoryId = :categoryId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryId', $CategoryId);        
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>