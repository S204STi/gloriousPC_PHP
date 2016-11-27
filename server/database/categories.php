<?php
// Database functions for the Category table

// Get single category by id
function get_category($category_id){
    global $db;
    
    $query = '
        SELECT *
        FROM Category
        WHERE CategoryId = :category_id;';
    
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
?>