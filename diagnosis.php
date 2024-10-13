<?php
session_start();

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

// الحصول على بيانات المريض من النموذج
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;

// دالة للتحقق من صلاحية الخوارزمية بناءً على العمر
function verifierAge($age, $translations) {
    if ($age < 10) {
        echo '<div class="alert alert-warning" role="alert">';
        echo $translations['algorithm_not_valid'] ?? 'The algorithm is not valid for patients under 10 years old.';
        echo '</div>';
        exit();
    } else {
        echo '<div class="alert alert-success" role="alert">';
        echo $translations['eligible_for_diagnosis'] ?? 'The patient is eligible for the diagnostic algorithm.';
        echo '</div>';
    }
}

// ترجمة الرسائل في ملفات lang
// تأكد من إضافة الترجمات التالية في ملفات lang:
// 'algorithm_not_valid', 'eligible_for_diagnosis'

verifierAge($age, $translations);

// عرض معلومات المريض
echo '<h3>' . ($lang == 'ar' ? 'معلومات المريض' : ($lang == 'fr' ? 'Informations du patient' : 'Patient Information')) . '</h3>';
echo '<p>' . ($lang == 'ar' ? 'الاسم: ' : ($lang == 'fr' ? 'Nom: ' : 'Name: ')) . htmlspecialchars($nom) . '</p>';
echo '<p>' . ($lang == 'ar' ? 'العمر: ' : ($lang == 'fr' ? 'Âge: ' : 'Age: ')) . htmlspecialchars($age) . '</p>';

// متابعة الخوارزمية التشخيصية بناءً على النص المترجم
// يمكنك هنا إضافة الخطوات التالية مثل فحص الأعراض وإجراء الفحوصات المطلوبة

// مثال بسيط لإكمال الخوارزمية
?>

<div class="mt-4">
    <h4><?php echo $translations['signs_symptoms']; ?></h4>
    <form action="diagnosis.php" method="POST">
        <!-- يمكنك إضافة حقول إضافية هنا بناءً على الخوارزمية -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="cough" id="cough" name="symptoms[]">
            <label class="form-check-label" for="cough">
                <?php echo ($lang == 'ar' ? 'سعال' : ($lang == 'fr' ? 'Toux' : 'Cough')); ?>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="fever" id="fever" name="symptoms[]">
            <label class="form-check-label" for="fever">
                <?php echo ($lang == 'ar' ? 'حمى' : ($lang == 'fr' ? 'Fièvre' : 'Fever')); ?>
            </label>
        </div>
        <!-- أضف المزيد من الأعراض حسب الحاجة -->
        <button type="submit" class="btn btn-primary mt-3"><?php echo $translations['submit'] ?? 'Submit'; ?></button>
    </form>
</div>

<?php
// معالجة الأعراض والتشخيص
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['symptoms'])) {
    $symptoms = $_POST['symptoms'];
    
    echo '<h4 class="mt-4">' . ($lang == 'ar' ? 'نتائج التشخيص' : ($lang == 'fr' ? 'Résultats du diagnostic' : 'Diagnosis Results')) . '</h4>';
    
    // مثال بسيط: إذا كان المريض يعاني من السعال والحمى، يمكن الاشتباه بالسل
    if(in_array('cough', $symptoms) && in_array('fever', $symptoms)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($lang == 'ar' ? 'يُشتبه في إصابة المريض بالسل. يُرجى إجراء الفحوصات اللازمة.' : 
               ($lang == 'fr' ? 'Suspicion de tuberculose. Veuillez effectuer les tests nécessaires.' : 
               'Tuberculosis is suspected. Please perform the necessary tests.'));
        echo '</div>';
    } else {
        echo '<div class="alert alert-info" role="alert">';
        echo ($lang == 'ar' ? 'لا توجد علامات كافية للاشتباه بالسل.' : 
               ($lang == 'fr' ? 'Aucun signe suffisant pour suspecter la tuberculose.' : 
               'No sufficient signs to suspect tuberculosis.'));
        echo '</div>';
    }
}
?>

<?php include('includes/footer.php'); ?>
