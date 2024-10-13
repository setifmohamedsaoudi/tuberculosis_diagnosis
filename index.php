<?php
session_start();

// التعامل مع اختيار اللغة
if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    // التحقق من صحة اختيار اللغة
    $available_langs = ['en', 'fr', 'ar'];
    if(in_array($lang, $available_langs)) {
        $_SESSION['lang'] = $lang;
    }
    // إعادة التوجيه لتجنب إعادة إرسال النموذج
    header("Location: index.php");
    exit();
}

// تحديد اللغة، الافتراضية هي الإنجليزية
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// تحميل ملف اللغة
$langFile = __DIR__ . '/lang/' . $lang . '.php';
if(file_exists($langFile)) {
    $translations = include($langFile);
} else {
    // الرجوع إلى الإنجليزية إذا لم يتم العثور على ملف اللغة
    $translations = include(__DIR__ . '/lang/en.php');
}

include('includes/header.php');
?>

<div class="text-center">
    <h1><?php echo htmlspecialchars($translations['title']); ?></h1>
    <p><?php echo htmlspecialchars($translations['adolescents_definition']); ?></p>
    <a href="form.php" class="btn btn-primary"><?php echo htmlspecialchars($translations['enter']); ?></a>
</div>

<?php include('includes/footer.php'); ?>
