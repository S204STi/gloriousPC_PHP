<?php 

// Used to pullup user information for someone logged in
function get_user($AppUserId) {
    global $db;
    
    $query = '
            SELECT * FROM AppUser
            WHERE AppUserId = :appUserId;';

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

// Used for logging in 
function get_user_by_login($UserName, $Password) {
    global $db;

    $Password = sha1($UserName . $Password);

    $query = '
        SELECT * FROM AppUser
        WHERE UserName = :userName 
            AND Password = :password;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $UserName);
        $statement->bindValue(':password', $Password);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Used to check for conflicting usernames.
function get_user_by_userName($UserName) {
    global $db;

    $query = '
        SELECT * FROM AppUser
        WHERE UserName = :userName;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $UserName);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Make a new user
function create_user($UserName, $Password, $IsAdmin = FALSE) {
    global $db;

    $Password = sha1($UserName . $Password);

    $query = '
        INSERT INTO AppUser (
            UserName, Password, IsAdmin) 
        VALUES( 
            :userName, :password, :isAdmin );';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $UserName);
        $statement->bindValue(':password', $Password);
        $statement->bindValue(':isAdmin', $IsAdmin);
        $statement->execute();
        $userId = $db->lastInsertId();
        $statement->closeCursor();
        return $userId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Update the user, they cannot change their admin status
function update_user($UserName, $Password, $AppUserId) {
    global $db;

    $Password = sha1($UserName . $Password);

    $query = '
        UPDATE AppUser  
        SET UserName = :userName, Password = :password 
        WHERE AppUserId = :appUserId;';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $UserName);
        $statement->bindValue(':password', $Password);
        $statement->bindValue(':appUserId', $AppUserId);
        $statement->execute();
        $userId = $db->lastInsertId();
        $statement->closeCursor();
        return $userId;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>