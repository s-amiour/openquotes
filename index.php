<?php
require_once "includes/header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenQuotes</title>
</head>
<body>
    <main class="d-flex flex-column justify-content-center align-items-center container my-4">
        <section class="mb-3 fs-1 fw-bold">Want to Keep Track of <span class="bg-warning bg-opacity-75">Your Quotes?</span></section>
        <p class="mb-5 font-monospace ">Maintain wisdom by saving your quotes in a safe place in order to come back later and get inspired.</p>
        <div class="mb-5 w-full h-full bg-secondary bg-opacity-50 rounded-lg shadow-lg p-4 flex flex-col" style="transform: rotate(-10deg);"><div class="mb-3 font-monospace text-xs">quote_deck</div><div class="w-8 h-8 bg-white p-3 rounded mb-2"><div class="w-1/2 h-3 font-monospace rounded-full">my_quote</div></div></div>
        <a href="templates/deck.php" class="mb-4 btn btn-success">Get Started ></a>
        <a href="https://github.com/s-amiour/openquotes" class="mb-4 btn btn-outline-secondary" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 16 16" width="16" height="16" class="octicon octicon-mark-github" aria-hidden="true">
                <path d="M8 0c4.42 0 8 3.58 8 8a8.013 8.013 0 0 1-5.45 7.59c-.4.08-.55-.17-.55-.38 0-.27.01-1.13.01-2.2 0-.75-.25-1.23-.54-1.48 1.78-.2 3.65-.88 3.65-3.95 0-.88-.31-1.59-.82-2.15.08-.2.36-1.02-.08-2.12 0 0-.67-.22-2.2.82-.64-.18-1.32-.27-2-.27-.68 0-1.36.09-2 .27-1.53-1.03-2.2-.82-2.2-.82-.44 1.1-.16 1.92-.08 2.12-.51.56-.82 1.28-.82 2.15 0 3.06 1.86 3.75 3.64 3.95-.23.2-.44.55-.51 1.07-.46.21-1.61.55-2.33-.66-.15-.24-.6-.83-1.23-.82-.67.01-.27.38.01.53.34.19.73.9.82 1.13.16.45.68 1.31 2.69.94 0 .67.01 1.3.01 1.49 0 .21-.15.45-.55.38A7.995 7.995 0 0 1 0 8c0-4.42 3.58-8 8-8Z"></path>
            </svg>
        Star us on GitHub
        </a>
    </main>
</body>
</html>