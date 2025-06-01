<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap + Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link
      rel="icon"
      href="data:image/svg+xml, %3Csvg xmlns='http://www.w3.org/2000/svg' height='32' width='28' viewBox='0 0 448 512'%3E%3C!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--%3E%3Cpath fill='%23ffffff' d='M448 296c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72zm-256 0c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72z'/%3E%3C/svg%3E"
    />
    <!-- Lexend Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/styles_i.css">
    <title>Sign In Page</title>
</head>
<body>
    <main class="d-flex flex-column justify-content-center align-items-center my-4">
        <section class="prompt-container">
            <div class="d-flex justify-content-between">
                <h1>User Sign In</h1>
            </div>
            <div class="d-flex justify-content-end">
                <a href="../." class="btn btn-danger btn-sm fs-5">X</a>
            </div>
            <?php
            // Include database connection and password hashing functions
            require_once "../includes/db.php";
            require_once "../includes/hash.php";

            if (isset($_POST["sign_in"])){
                $username = $_POST["username"];
                $password = $_POST["password"];

                if (empty($username) || empty($password)){
                    $error = "Username or password required!";
                } else {
                    $sql_select = "SELECT * FROM users WHERE username = '$username'";
                    $prepared_select = $conn->prepare($sql_select);
                    $prepared_select->execute();
                    $row = $prepared_select->fetch();

                    // Check if user already exists
                    if ($prepared_select->rowCount() > 0){
                        $error = "Username already exists!";
                    } else {
                        $hashed_pswrd = hashPassword($password);

                        $sql_insert = "INSERT INTO users (username, password_hash) VALUES ('$username', '$hashed_pswrd')";
                        $prepared_insert = $conn->prepare($sql_insert);

                        if ($prepared_insert->execute()){
                            $user_id = $conn->lastInsertId();

                            session_start();
                            $_SESSION['user_id'] = $user_id;
                            header("Location: deck.php");
                            exit();
                        } else {
                            $error = "Failed Registration. Please wait and try again.";
                        }
                    }
                }

                // Alert user if error
                if(isset($error)){
                    echo "<p class='alert alert-danger' style='margin-top: 5px'>$error</p>";
                }
            }
            ?>
            <form method="post" action="">
                <div class="form-element my-4">
                    <label class="form-label" for="username">Username:</label><br>
                    <input class="form-control" type="text" name="username" required><br><br>
                </div>
                <div class="form-element my-4">
                    <label class="form-label" for="password">Password:</label><br>
                    <input class="form-control" type="password" name="password" required><br><br>
                </div>
                <div class="form-element my-4">
                    <input type="submit" class="btn btn-success" name="sign_in" value="Sign In">
                </div>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </section>
    </main>
</body>
</html>