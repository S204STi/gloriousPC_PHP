<?php
// Database functions for the Customer table

function get_customer_by_user_id($userId) {
    global $db;

    $query = '
        SELECT * FROM Customer c
            INNER JOIN AppUser u
            ON c.AppUserId = u.AppUserId
        WHERE c.AppUserId = :userId';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_customer_by_id($customerId) {
    global $db;

    $query = '
        SELECT * FROM Customer
        WHERE CustomerId = :customerId';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function create_customer($firstName, $lastName, $address1, $address2, $city, $state, $zip, $email, $userId) {
    global $db;

    $query = '
        INSERT INTO Customer (FirstName, LastName, Address1, Address2, City, State, Zip, Email, AppUserId) 
        VALUES( :firstName, :lastName, :address1, :address2, :city, :state, :zip, :email, :userId )';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);        
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':address1', $address1);
        $statement->bindValue(':address2', $address2);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':zip', $zip);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':userId', $userId);
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