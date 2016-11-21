<?php
// Functions for using the product table

// Get single product by id
function get_category($category_id){
    global $db;
    
    $query = '
        SELECT *
        FROM ProductCategory
        WHERE id = :category_id';
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Get single product by id
function get_all_categories(){
    global $db;
    
    $query = '
        SELECT *
        FROM ProductCategory;';
    
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