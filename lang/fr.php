<?php
return [
    // العنوان الرئيسي
    'title' => 'Diagnostic de Tuberculose',

    // اختيار اللغة
    'select_language' => 'Sélectionnez la langue:',
    'english' => 'Anglais',
    'arabic' => 'Arabe',
    'french' => 'Français',

    // زر الدخول
    'enter' => 'Entrer',
    'permalink' => 'Lien permanent',

    // تعريف المراهقين
    'adolescents_definition' => 'Les adolescents sont définis dans ce chapitre comme les patients de 10 ans et plus.',

    // علامات وأعراض السل الرئوي
    'signs_symptoms' => 'Signes et symptômes de la tuberculose pulmonaire (TBP)',

    // أعراض مصاب بفيروس نقص المناعة البشرية
    'hiv_positive' => 'En cas d\'infection par le VIH, l\'un des signes suivants : toux, fièvre, perte de poids ou sueurs nocturnes.',

    // أعراض غير مصاب بفيروس نقص المناعة البشرية
    'hiv_negative' => 'En l\'absence d\'infection par le VIH, l\'un des signes suivants : toux de plus de 2 semaines, toux avec hémoptysie, perte de poids inexpliquée, sueurs nocturnes ou suspicion clinique.',

    // LF-LAM
    'lf_lam' => 'LF-LAM',
    'perform_lf_lam' => 'Réaliser le test urinaire de lipoarabinomannane à flux latéral (LF-LAM) uniquement chez les patients infectés par le VIH.',

    // اختبار جزيئي سريع (RMT)
    'perform_rmt' => 'Quel que soit le résultat du LF-LAM, réaliser aussi un test moléculaire rapide (RMT) car :',
    'rmt_positive_if_lf_lam_negative' => 'Un TMR pourrait être positif (meilleure sensibilité) si le LF-LAM est négatif.',
    'rmt_detect_resistance' => 'Un TMR permet en plus de détecter une résistance à la rifampicine.',

    // Xpert MTB/RIF
    'xpert_mtb_rif' => 'Xpert MTB/RIF',
    'perform_xpert_mtb_rif' => 'Réaliser un deuxième test Xpert MTB/RIF (ou Ultra) sur un nouvel échantillon si le premier test montre :',
    'error_invalid_no_result' => 'Erreur/Non valide/Pas de résultat',
    'mtb_detected_rif_indeterminate' => 'MTB détecté ; Résistance à la Rif indéterminée',
    'mtb_not_detected' => 'MTB non détecté (selon le jugement clinique, par exemple suspicion clinique élevée, absence de réponse au traitement antibiotique à court terme pour une pneumonie)',
    'mtb_detected_rif_detected' => 'MTB détecté ; Résistance à la Rif détectée chez un patient présentant un faible risque de résistance à la rifampicine',

    // نتيجة "trace" في Xpert MTB/RIF Ultra
    'trace_result' => 'Si un Xpert MTB/RIF Ultra est utilisé et que le résultat est "trace", réaliser un deuxième test sur un nouvel échantillon, sauf dans les circonstances suivantes :',
    'hiv_children_ep_samples_positive' => 'Patients ayant une infection par le VIH, enfants et échantillons EP : le résultat est considéré comme positif. Ne pas répéter le test.',
    'adults_history_tb' => 'Adultes ayant des antécédents de TB au cours des 5 dernières années : un résultat "trace" ne peut être interprété. Réaliser une culture.',
    'no_interpretation_rif' => 'Aucune interprétation concernant la résistance à la rifampicine n’est possible. Si une résistance à la rifampicine ou à d’autres médicaments antituberculeux est suspectée, réaliser un test de sensibilité aux médicaments phénotypique (pDST) ou un autre DST génotypique (gDST).',

    // Truenat
    'truenat_tests' => 'Les tests Xpert MTB/RIF et Xpert MTB/RIF Ultra peuvent être remplacés par les tests Truenat.',

    // إذا لم تكن اختبارات RMT متاحة
    'rmt_not_available' => 'Si les RMT ne sont pas immédiatement disponibles, envoyer un échantillon pour RMT au laboratoire local de référence.',
    'perform_sputum_microscopy' => 'Réaliser un examen microscopique des crachats et une radiographie pulmonaire (RP) si disponible.',
    'start_treatment' => 'En attendant le résultat du RMT, si l\'examen microscopique des crachats est positif ou si la RP est évocatrice de TB, commencer le traitement antituberculeux en fonction des antécédents de traitement et de contact ainsi que de l\'épidémiologie locale.',

    // Xpert MDR/XDR
    'xpert_mdr_xdr' => 'Xpert MDR/XDR',
    'perform_xpert_mdr_xdr' => 'Réaliser un deuxième test Xpert MTB/XDR sur un nouvel échantillon si le premier test montre :',
    'mtb_detected_drug_indeterminate' => 'MTB détecté ; Résistance aux médicaments indéterminée',
    'mtb_not_detected_after_positive' => 'MTB non détecté après un test Xpert MTB/RIF positif',
    'mtb_detected_drug_detected' => 'MTB détecté ; Résistance aux médicaments détectée chez un patient présentant un faible risque de résistance aux médicaments',

    // عدم إجراء اختبار Xpert MTB/XDR
    'do_not_perform_xpert_mdr_xdr' => 'Le test Xpert MTB/XDR ne doit pas être réalisé si le résultat du test Xpert MTB/RIF Ultra était "trace" sur deux échantillons. Réaliser un pDST ou un autre gDST.',

    // إذا لم يكن Xpert MTB/XDR متاحًا
    'xpert_mdr_xdr_not_available' => 'Si le test Xpert MTB/XDR n’est pas immédiatement disponible et que le laboratoire de référence n’effectue pas ce test, demander un test d’hybridation inverse (LPA) ou un pDST.',

    // RP - Radiographie pulmonaire
    'caverns' => 'Cavernes',
    'infiltrates' => 'Infiltrats dans les lobes supérieurs et segments supérieurs des lobes inférieurs',
    'cavities' => 'Cavités',
    'consolidations' => 'Consolidations (inégales ou confluentes)',
    'mediastinal_lymphadenopathy' => 'Adénopathies médiastinales et hilaires',
    'miliary_pattern' => 'Aspect miliary',
    'see_medical_imaging' => 'Voir aussi Imagerie médicale, Chapitre 3.',

    // pDST و NGS
    'pDST_and_NGS' => 'pDST (et NGS)',
    'perform_pdst_ngs' => 'Un pDST et, si disponible, un séquençage du génome de nouvelle génération (NGS) doivent être réalisés chez tous les patients atteints de TB-MDR/RR afin de détecter une résistance potentielle à la bédaquiline, au linézolide, et à d\'autres médicaments non testés par les RMTs.',

    // معلومات المريض
    'patient_information' => 'Informations du patient',
    'name' => 'Nom',
    'age' => 'Âge',

    // نتائج التشخيص
    'diagnosis_results' => 'Résultats du diagnostic',
    'eligible_for_diagnosis' => 'Le patient est éligible à l\'algorithme de diagnostic.',
    'algorithm_not_valid' => 'L\'algorithme n\'est pas valide pour les patients de moins de 10 ans.',
    'no_sufficient_signs' => 'Aucun signe suffisant pour suspecter la tuberculose.',
    'suspected_tb' => 'Suspicion de tuberculose. Veuillez effectuer les tests nécessaires.',
    'submit' => 'Soumettre',
];
?>
