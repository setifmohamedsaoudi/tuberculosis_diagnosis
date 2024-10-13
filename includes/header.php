<?php
// بدء الجلسة إذا لم تكن قد بدأت بالفعل
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// تحديد اللغة، الافتراضية هي الإنجليزية
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// تحميل ملف اللغة
$langFile = __DIR__ . '/../lang/' . $lang . '.php';
if(file_exists($langFile)) {
    $translations = include($langFile);
} else {
    // الرجوع إلى الإنجليزية إذا لم يتم العثور على ملف اللغة
    $translations = include(__DIR__ . '/../lang/en.php');
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($translations['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?php echo htmlspecialchars($translations['title']); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="<?php echo htmlspecialchars($translations['select_language']); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Dropdown اختيار اللغة -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            // عرض اللغة الحالية
                            switch($lang) {
                                case 'en':
                                    echo htmlspecialchars($translations['english']);
                                    break;
                                case 'fr':
                                    echo htmlspecialchars($translations['french']);
                                    break;
                                case 'ar':
                                    echo htmlspecialchars($translations['arabic']);
                                    break;
                                default:
                                    echo htmlspecialchars($translations['english']);
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="index.php?lang=en"><?php echo htmlspecialchars($translations['english']); ?></a></li>
                            <li><a class="dropdown-item" href="index.php?lang=fr"><?php echo htmlspecialchars($translations['french']); ?></a></li>
                            <li><a class="dropdown-item" href="index.php?lang=ar"><?php echo htmlspecialchars($translations['arabic']); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
