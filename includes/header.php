<?php
// Start the session
if(!isset($_SESSION)) {
    session_start();
}

// Determine the language, default to English
if(isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'en';
}

// Load the language file
$langFile = __DIR__ . '/../lang/' . $lang . '.php';
if(file_exists($langFile)) {
    $translations = include($langFile);
} else {
    // Fallback to English if language file not found
    $translations = include(__DIR__ . '/../lang/en.php');
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $translations['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?php echo $translations['title']; ?></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Language Selection Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            // Display current language
                            switch($lang) {
                                case 'en':
                                    echo $translations['english'];
                                    break;
                                case 'fr':
                                    echo $translations['french'];
                                    break;
                                case 'ar':
                                    echo $translations['arabic'];
                                    break;
                                default:
                                    echo $translations['english'];
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="index.php?lang=en"><?php echo $translations['english']; ?></a></li>
                            <li><a class="dropdown-item" href="index.php?lang=fr"><?php echo $translations['french']; ?></a></li>
                            <li><a class="dropdown-item" href="index.php?lang=ar"><?php echo $translations['arabic']; ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
