<?php
// Database functions for the Customer table

function get_customer_by_user_id($AppUserId) {
    global $db;

    $query = '
        SELECT * 
        FROM Customer c
        INNER JOIN AppUser u
            ON c.AppUserId = u.AppUserId
        WHERE c.AppUserId = :appUserId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':appUserId', $AppUserId);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_customer_by_id($CustomerId) {
    global $db;

    $query = '
        SELECT * FROM Customer
        WHERE CustomerId = :customerId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $CustomerId);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function create_customer($FirstName, $LastName, $Address1, $Address2, $City, $State, $Zip, $Email, $AppUserId) {
    global $db;

    $query = '
        INSERT INTO Customer(
            FirstName, LastName, Address1, Address2, City, State, Zip, Email, AppUserId) 
        VALUES( 
            :firstName, :lastName, :address1, :address2, :city, :state, :zip, :email, :appUserId );';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $FirstName);        
        $statement->bindValue(':lastName', $LastName);
        $statement->bindValue(':address1', $Address1);
        $statement->bindValue(':address2', $Address2);
        $statement->bindValue(':city', $City);
        $statement->bindValue(':state', $State);
        $statement->bindValue(':zip', $Zip);
        $statement->bindValue(':email', $Email);
        $statement->bindValue(':appUserId', $AppUserId);
        $statement->execute();
        $customerId = $db->lastInsertId();
        $statement->closeCursor();
        return $customerId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_customer($FirstName, $LastName, $Address1, $Address2, $City, $State, $Zip, $Email, $AppUserId) {
    global $db;

    $query = '
        UPDATE Customer  
        SET FirstName = :firstName, LastName = :lastName, 
            Address1 = :address1, Address2 = :address2, 
            City = :city, State = :state, 
            Zip = :zip, Email = :email
        WHERE AppUserId = :appUserId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $FirstName);        
        $statement->bindValue(':lastName', $LastName);
        $statement->bindValue(':address1', $Address1);
        $statement->bindValue(':address2', $Address2);
        $statement->bindValue(':city', $City);
        $statement->bindValue(':state', $State);
        $statement->bindValue(':zip', $Zip);
        $statement->bindValue(':email', $Email);
        $statement->bindValue(':appUserId', $AppUserId);
        $statement->execute();
        $customerId = $db->lastInsertId();
        $statement->closeCursor();
        return $customerId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


?>