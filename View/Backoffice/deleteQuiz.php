<?php
// Use include_once to ensure the file is included only once
include_once '../../config.php';

// Check if the ID is passed via POST
if (isset($_POST['id'])) {
    $quiz_id = $_POST['id'];

    // Create a PDO connection
    $conn = config::getConnexion();

    // SQL query to delete the quiz from the database
    $sql = "DELETE FROM quizzes WHERE ID = :id";
    $stmt = $conn->prepare($sql);

    // Bind the quiz ID parameter
    $stmt->bindParam(':id', $quiz_id, PDO::PARAM_INT);

    // Execute the query and check if the quiz was deleted
    if ($stmt->execute()) {
        // Redirect to the quizzes list after deletion
        header("Location: ManageQuiz.php");
        exit();
    } else {
        echo "Error: Could not delete qiuz.";
    }
} else {
    echo "Error: No quiz ID provided.";
}
?>
