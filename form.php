<?php
session_start();

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

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4"><?php echo htmlspecialchars($translations['title']); ?></h2>
        <form action="diagnosis.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label"><?php echo htmlspecialchars($translations['nom']); ?>:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label"><?php echo htmlspecialchars($translations['age']); ?>:</label>
                <input type="number" class="form-control" id="age" name="age" min="0" required>
            </div>
            <!-- يمكنك إضافة حقول إضافية حسب الحاجة بناءً على الخوارزمية التشخيصية -->
            <button type="submit" class="btn btn-success"><?php echo htmlspecialchars($translations['enter']); ?></button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
