<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('../includes/db.php');

// Check if quote ID is provided
if (!isset($_GET['id'])) {
    header("Location: deck.php");
    exit();
}

// Get quote ID from the URL
$quote_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Check if form submitted
if(isset($_POST['update_quote'])) {
    $quote = $_POST['quote'];
    $author = $_POST['author'];

    // Update quote in database
    $sql = "UPDATE quotes SET quote = '$quote', author = '$author' WHERE id = '$quote_id' AND user_id = '$user_id'";
    $prepared = $conn->prepare($sql);
    if($prepared->execute()) {
        $_SESSION['message'] = "Quote updated successfully!";
        $_SESSION['msg_type'] = "success";
        header("Location: deck.php");
    } else {
        $error = "Error updating quote. Please try again later.";
    }
}

// Retrieve quote details from database
$sql = "SELECT * FROM quotes WHERE id = '$quote_id' AND user_id = '$user_id'";
$prepared = $conn->prepare($sql);
$prepared->execute();
$row = $prepared->fetch();
$author = $row['author'];
$quote = $row['quote'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS + Icon -->
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
    <title>Update Page</title>
</head>
<body>
    <main class="d-flex flex-column justify-content-center align-items-center my-4">
        <section class="prompt-container">
            <div class="d-flex justify-content-between">
                <h1>Create Quote</h1>
            </div>
            <?php
            // Alert user if error
            if(isset($error)) {
                echo "<p class='alert alert-danger  style='margin-top: 5px'>$error</p>";
            }
            ?>
            <div class="d-flex justify-content-end">
                <a href="deck.php" class="btn btn-danger btn-sm fs-5">X</a>
            </div>

            <form method="post" action="">
                <div class="form-element my-4">
                    <label class="form-label" for="quote">Quote:</label><br>
                    <textarea class="form-control" name="quote" required><?php echo $quote; ?></textarea><br>
                </div>

                <div class="form-element my-4">
                    <label class="form-label" for="author">Author:</label><br>
                    <input class="form-control" type="text" name="author" value="<?php echo $author; ?>" required></textarea><br>
                </div>

                <div class="form-element my-4">
                    <input type="submit" class="btn btn-success btn-sm" name="update_quote" value="Update Quote">
                </div>
            </form>
        </section>
    </main>
</body>
</html>