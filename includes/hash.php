<?php
// Securely hash the password using default algorithm
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify the password
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}
?>