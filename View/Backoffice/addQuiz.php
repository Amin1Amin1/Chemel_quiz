<?php
// Include the database configuration file
include_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $course_id = $_POST['course_id'];
    $subject_id = $_POST['subject_id'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    // Connect to the database
    $conn = config::getConnexion();

    // SQL query to insert quiz data into the database
    $sql = "INSERT INTO quizzes (course_id, subject_id, question, option_a, option_b, option_c, option_d, correct_option)
            VALUES (:course_id, :subject_id, :question, :option_a, :option_b, :option_c, :option_d, :correct_option)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(':question', $question, PDO::PARAM_STR);
    $stmt->bindParam(':option_a', $option_a, PDO::PARAM_STR);
    $stmt->bindParam(':option_b', $option_b, PDO::PARAM_STR);
    $stmt->bindParam(':option_c', $option_c, PDO::PARAM_STR);
    $stmt->bindParam(':option_d', $option_d, PDO::PARAM_STR);
    $stmt->bindParam(':correct_option', $correct_option, PDO::PARAM_STR);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Quiz added successfully!'); window.location.href='ManageQuiz.php';</script>";
    } else {
        echo "Error: Could not add quiz.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quiz Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body>
    <div class="dashboard-main-wrapper">
        <!-- Navbar -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="./dashboard.php">Quiz Manager</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Doe</h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Sidebar -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="quiz.php">
                                    <i class="fa fa-fw fa-book"></i>Quiz Management
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Add Quiz</h2>
                            <p class="pageheader-text">Add a new quiz by filling in the form below.</p>
                        </div>
                    </div>
                </div>

                <!-- Add Quiz Form -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Add Quiz</h5>
                            <div class="card-body">
                                <form method="POST" action="addQuiz.php">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="course_id">Course ID</label>
                                            <input type="number" class="form-control" id="course_id" name="course_id" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="subject_id">Subject ID</label>
                                            <input type="number" class="form-control" id="subject_id" name="subject_id" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <textarea class="form-control" id="question" name="question" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="option_a">Option A</label>
                                        <input type="text" class="form-control" id="option_a" name="option_a" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="option_b">Option B</label>
                                        <input type="text" class="form-control" id="option_b" name="option_b" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="option_c">Option C</label>
                                        <input type="text" class="form-control" id="option_c" name="option_c" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="option_d">Option D</label>
                                        <input type="text" class="form-control" id="option_d" name="option_d" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="correct_option">Correct Option</label>
                                        <input type="text" class="form-control" id="correct_option" name="correct_option" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Quiz</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
