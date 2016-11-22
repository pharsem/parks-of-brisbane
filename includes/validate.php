<?php


// check that the email is valid
function validateEmail(&$errors, $field_list, $field_name)
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'This field is required';
    } else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid';
}

function validateUsername(&$errors, $field_list, $field_name) {

    require 'connect.php';

    try {
        $sth = $dbh->prepare("SELECT $field_name FROM members WHERE $field_name = :value");

        $sth->bindParam(':value', $field_list[$field_name]);

        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'This field is required';
    else if (strlen($field_list[$field_name]) < 5 /*|| strlen($field_list[$field_name]) > 15*/)
        $errors[$field_name] = 'The username has to be between 5 and 15 characters';
    else if($result[$field_name] == $field_list[$field_name]) {
        echo "true";
        $errors[$field_name] = 'That username is already in the database, please chose another one';
    }
}

function validatePassword(&$errors, $field_list, $field_name) {
    $uppercase = preg_match('@[A-Z]@', $field_list[$field_name]);
    $lowercase = preg_match('@[a-z]@', $field_list[$field_name]);
    $number    = preg_match('@[0-9]@', $field_list[$field_name]);

    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'This field is required';
    else if (!$uppercase || !$lowercase || !$number || strlen($field_list[$field_name]) < 8)
        $errors[$field_name] = 'Password must be at least 8 characters long and consist of both number(s), upper case letter(s) and lower case letter(s)';
}

function matchPasswords(&$errors, $field_list, $field_name1, $field_name2) {
    if (!($field_list[$field_name1] == $field_list[$field_name2])) {
        $errors[$field_name2] = 'The passwords does not match';
    }
}

// check that the username doesn't exist in the database
function unique($errors, $field_list, $field_name) {
    require 'connect.php';

    echo "here " . $field_name;

    try {
        $sth = $dbh->prepare("SELECT $field_name FROM members WHERE $field_name = :value");

        $sth->bindParam(':value', $field_list[$field_name]);

        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);


        if($result[$field_name] == $field_list[$field_name]) {
            echo "true";
            $errors[$field_name] = 'That username is already in the database, please chose another one';
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }



}

?>