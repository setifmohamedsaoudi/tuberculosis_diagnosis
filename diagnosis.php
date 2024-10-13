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

// دالة للتحقق من صلاحية الخوارزمية بناءً على العمر
function verifierAge($age, $translations) {
    if ($age < 10) {
        echo '<div class="alert alert-warning" role="alert">';
        echo htmlspecialchars($translations['algorithm_not_valid']);
        echo '</div>';
        // إعادة توجيه المستخدم إلى الصفحة الرئيسية بعد عرض الرسالة
        echo '<a href="index.php" class="btn btn-primary mt-3">' . htmlspecialchars($translations['enter']) . '</a>';
        session_destroy(); // إنهاء الجلسة
        exit();
    } else {
        echo '<div class="alert alert-success" role="alert">';
        echo htmlspecialchars($translations['eligible_for_diagnosis']);
        echo '</div>';
    }
}

// التحقق من نوع الطلب (POST) ومعالجة البيانات بناءً على الخطوة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // إذا كانت بيانات الاسم والعمر موجودة في POST، فهذا هو الخطوة الأولى
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
                <!-- تحديد الخطوة كـ "symptoms" -->
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
    // إذا كانت الخطوة هي "symptoms"، فهذا هو الخطوة الثانية
    elseif (isset($_POST['step']) && $_POST['step'] === 'symptoms') {
        // التحقق من أن بيانات المريض موجودة في الجلسة
        if (isset($_SESSION['nom']) && isset($_SESSION['age'])) {
            $nom = $_SESSION['nom'];
            $age = $_SESSION['age'];

            // الحصول على الأعراض المختارة
            if (isset($_POST['symptoms']) && is_array($_POST['symptoms'])) {
                $symptoms = $_POST['symptoms'];

                echo '<h4 class="mt-4">' . htmlspecialchars($translations['diagnosis_results']) . '</h4>';

                // مثال بسيط: إذا كان المريض يعاني من السعال والحمى، يمكن الاشتباه بالسل
                if (in_array('cough', $symptoms) && in_array('fever', $symptoms)) {
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
        } else {
            // إذا لم تكن بيانات المريض موجودة في الجلسة، إعادة التوجيه إلى النموذج
            header("Location: form.php");
            exit();
        }
    }
    else {
        // إذا لم يتم إرسال أي بيانات، إعادة التوجيه إلى النموذج
        header("Location: form.php");
        exit();
    }

    include('includes/footer.php');
    ?>
