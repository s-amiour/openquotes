<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

// Check if a message is set
if (isset($_SESSION['message'])) {
    // Choose the alert based on the message type
    $type = $_SESSION['msg_type'] === "success" ? "alert-success" : "alert-danger";

    // Display message
    echo "<p class='alert $type'>{$_SESSION['message']}</p>";

    // Unset message session variables
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS + Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />
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
    <title>Quote Deck</title>
</head>
<body>
    <nav class="navbar d-flex container justify-content-between my-4">
        <ul class="nav__logo">
            <li>
                <a id="logo" href="logout.php" onclick>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" width="28" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448 296c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72zm-256 0c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72z"/></svg>
                    <span>OpenQuotes</span>
                </a>
            </li>
        </ul>
    </nav>
    <main class="container my-4">
        <h2 class="fw-bold">Welcome to your Quotes Deck</h2>
        <h3 class="fw-bold">My Quotes</h3>
        <div class="d-flex justify-content-end">
            <a href="create_quote.php" class="btn btn-primary">Create Quote</a>
        </div>
        <hr>
        <section class="deck-container">
        <?php
        // Retrieve user's quotes from the database
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM quotes WHERE user_id = '$user_id'";
        $prepared = $conn->prepare($sql);
        $prepared->execute();
        while ($row = $prepared->fetch()) {
            echo "<div class='card'>";
            echo "<h4 class='card-header font-monospace fst-italic'>— {$row['author']}</h4>";
            echo "<div class='card-body font-monospace'>{$row['quote']}</div>";
            echo "<div class='d-flex justify-content-between card-footer'>";
            echo "<a href='read_quote.php?id={$row['id']}'><img class='quote-btn' src=\"../images/view.svg\" alt=\"\"></a>";
            echo "<a href='update_quote.php?id={$row['id']}'><img class='quote-btn' src=\"../images/update.svg\" alt=\"\"></a>";
            echo "<a href='delete_quote.php?id={$row['id']}'><img class='quote-btn' src=\"../images/trash.svg\" alt=\"\"></a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
        </section>
        <br>
        <hr>
        <a class="d-flex justify-content-center btn btn-danger btn-lg" href="logout.php">Logout</a><br><br>
        <a class="d-flex justify-content-center btn btn-outline-danger btn-lg" href="user_delete.php">Delete Account</a>
    </main>
</body>
</html>