<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"])) {
    $comment = $_POST["comment"];
    if (!empty($comment)) {
        // Save the comment to a file or database
        $file = 'comments.txt';
        $current = file_get_contents($file);
        $current .= "Comment: $comment\n";
        file_put_contents($file, $current);
        echo "Comment submitted successfully.";
    } else {
        echo "Comment cannot be empty.";
    }
}
?>
