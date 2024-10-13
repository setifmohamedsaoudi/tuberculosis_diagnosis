<?php
session_start();

// Handle language selection
if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    // Validate language choice
    $available_langs = ['en', 'fr', 'ar'];
    if(in_array($lang, $available_langs)) {
        $_SESSION['lang'] = $lang;
    }
    // Redirect to avoid resubmission
    header("Location: index.php");
    exit();
}

// Determine the language, default to English
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Load the language file
$langFile = __DIR__ . '/lang/' . $lang . '.php';
if(file_exists($langFile)) {
    $translations = include($langFile);
} else {
    // Fallback to English if language file not found
    $translations = include(__DIR__ . '/lang/en.php');
}

include('includes/header.php');
?>

<div class="text-center">
    <h1><?php echo $translations['title']; ?></h1>
    <p><?php echo $translations['adolescents_definition']; ?></p>
    <a href="form.php" class="btn btn-primary"><?php echo $translations['enter']; ?></a>
</div>

<?php include('includes/footer.php'); ?>
