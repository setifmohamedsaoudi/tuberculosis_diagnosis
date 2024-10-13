<?php
session_start();

// تحديد اللغة
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// تحميل ملف اللغة
$langFile = __DIR__ . '/lang/' . $lang . '.php';
if(file_exists($langFile)) {
    $translations = include($langFile);
} else {
    $translations = include(__DIR__ . '/lang/en.php');
}

include('includes/header.php');

// دالة للتحقق من العمر
function verifierAge($age, $translations) {
    if ($age < 10) {
        echo '<div class="alert alert-warning" role="alert">';
        echo htmlspecialchars($translations['algorithm_not_valid']);
        echo '</div>';
        echo '<a href="index.php" class="btn btn-primary mt-3">' . htmlspecialchars($translations['enter']) . '</a>';
        session_destroy();
        exit();
    } else {
        echo '<div class="alert alert-success" role="alert">';
        echo htmlspecialchars($translations['eligible_for_diagnosis']);
        echo '</div>';
    }
}

// التحقق من الخطوة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom']) && isset($_POST['age']) && !isset($_POST['step'])) {
        // خطوة إدخال اسم وعمر المريض
        $nom = trim($_POST['nom']);
        $age = intval($_POST['age']);

        // تخزين البيانات في الجلسة
        $_SESSION['nom'] = $nom;
        $_SESSION['age'] = $age;

        // التحقق من العمر
        verifierAge($age, $translations);

        // عرض معلومات المريض ونموذج اختيار الأعراض
        echo '<h3>' . ($lang == 'ar' ? 'معلومات المريض' : ($lang == 'fr' ? 'Informations du patient' : 'Patient Information')) . '</h3>';
        echo '<p>' . ($lang == 'ar' ? 'الاسم: ' : ($lang == 'fr' ? 'Nom: ' : 'Name: ')) . htmlspecialchars($nom) . '</p>';
        echo '<p>' . ($lang == 'ar' ? 'العمر: ' : ($lang == 'fr' ? 'Âge: ' : 'Age: ')) . htmlspecialchars($age) . '</p>';

        // عرض نموذج اختيار الأعراض
        ?>
        <div class="mt-4">
            <h4><?php echo htmlspecialchars($translations['signs_symptoms']); ?></h4>
            <form action="diagnosis.php" method="POST">
                <input type="hidden" name="step" value="symptoms">
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
                <button type="submit" class="btn btn-primary mt-3"><?php echo htmlspecialchars($translations['submit']); ?></button>
            </form>
        </div>
        <?php
    }
    elseif (isset($_POST['step']) && $_POST['step'] === 'symptoms') {
        // خطوة اختيار الأعراض
        if (isset($_POST['symptoms']) && is_array($_POST['symptoms'])) {
            $symptoms = $_POST['symptoms'];

            echo '<h4 class="mt-4">' . htmlspecialchars($translations['diagnosis_results']) . '</h4>';

            // تطبيق الخوارزمية بناءً على الأعراض
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

            // إعادة تعيين الجلسة بعد التشخيص
            session_destroy();
        } else {
            echo '<div class="alert alert-warning" role="alert">';
            echo ($lang == 'ar' ? 'لم يتم اختيار أي أعراض. يُرجى اختيار الأعراض المتوفرة.' : 
                   ($lang == 'fr' ? 'Aucun symptôme sélectionné. Veuillez choisir les symptômes disponibles.' : 
                   'No symptoms selected. Please choose the available symptoms.'));
            echo '</div>';
            echo '<a href="form.php" class="btn btn-primary mt-3">' . htmlspecialchars($translations['enter']) . '</a>';
        }
    }
    else {
        // إعادة التوجيه إلى النموذج إذا لم يتم إرسال البيانات بشكل صحيح
        header("Location: form.php");
        exit();
    }
    ?>

    <?php include('includes/footer.php'); ?>
