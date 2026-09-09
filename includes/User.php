<?php

class User
{
    private $studentId;
    private $firstName;
    private $lastName;
    private $username;
    private $password;
    private $dbConnection;

    public function __construct($dbConnection, $firstName = '', $lastName = '', $username = '', $password = '')
    {
        $this->dbConnection = $dbConnection;
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
        $this->username     = $username;
        $this->password     = $password;
    }

    public function getStudentId()  { return $this->studentId; }
    public function getFirstName()  { return $this->firstName; }
    public function getLastName()   { return $this->lastName; }
    public function getUsername()   { return $this->username; }

    public function usernameExists()
    {
        $sql  = "SELECT ID FROM students WHERE USERNAME = ?";
        $stmt = mysqli_prepare($this->dbConnection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $this->username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $usernameFound = mysqli_stmt_num_rows($stmt) > 0;
        mysqli_stmt_close($stmt);

        return $usernameFound;
    }

    public function register()
    {
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $sql  = "INSERT INTO students (STUDENT_FNAME, STUDENT_LNAME, USERNAME, PASSWORD) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->dbConnection, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $this->firstName, $this->lastName, $this->username, $hashedPassword);
        $registrationSuccess = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $registrationSuccess;
    }

    public function login($enteredPassword)
    {
        $sql  = "SELECT ID, STUDENT_FNAME, STUDENT_LNAME, PASSWORD FROM students WHERE USERNAME = ?";
        $stmt = mysqli_prepare($this->dbConnection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $this->username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $studentRow = mysqli_fetch_assoc($result);

            if (password_verify($enteredPassword, $studentRow['PASSWORD'])) {
                $this->studentId = $studentRow['ID'];
                $this->firstName = $studentRow['STUDENT_FNAME'];
                $this->lastName  = $studentRow['STUDENT_LNAME'];
                mysqli_stmt_close($stmt);

                return true;
            }
        }

        mysqli_stmt_close($stmt);

        return false;
    }
}