<?php

function getUserByUsername($username)
{
    global $db;
    $query = "SELECT * FROM users WHERE username = :username";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        return $statement->fetch();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
}

function getPasswordById($id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id = :id";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $user = $statement->fetch();
        return $user['password'];
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
}

function saveUserData($username, $password)
{
    global $db;
    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
        return true;
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
}

function isAuthenticated()
{
  global $session;
  return $session->get('logged_in', false);
}

function loginUser($user)
{
    global $session;
    $session->set('logged_in', true);
    $session->set('id', $user['id']);
}

function changePassword($password, $id)
{
    global $db;
    $query = "UPDATE users SET password = :password WHERE id = :id";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
}