<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url('{{ public_path("fonts/Cairo-Regular.ttf") }}') format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'aealarabiya', DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            border: 2px solid #1a237e;
            padding: 20px;
            margin: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #1a237e;
            padding-bottom: 10px;
        }

        .faculty-name {
            color: #1a237e;
            font-size: 16pt;
            font-weight: bold;
            margin: 5px 0;
        }

        .faculty-name-fr {
            color: #1a237e;
            font-size: 14pt;
            margin: 5px 0;
        }

        .title-box {
            border: 2px solid #000;
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            margin: 20px auto;
            padding: 8px;
        }

        .info-section {
            margin: 20px 0;
            font-size: 14pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .data-table th, .data-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12pt;
        }

        .data-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .signature-section {
            margin-top: 60px;
            width: 100%;
        }

        .signature-right {
            text-align: right;
            float: right;
            width: 45%;
            font-weight: bold;
            font-size: 14pt;
        }

        .signature-left {
            text-align: left;
            float: left;
            width: 45%;
            font-weight: bold;
            font-size: 14pt;
        }

        .clearfix {
            clear: both;
        }

        .content-text {
            margin: 30px 0;
            line-height: 1.8;
            text-align: justify;
            font-size: 13pt;
        }

        .date-line {
            margin: 40px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- PREMIÈRE PAGE: Proposition de promotion -->
<div class="page-wrapper">
    <!-- En-tête -->
    <div class="header">
        <div class="faculty-name">كلية العلوم والتقنيات - مراكش</div>
        <div class="faculty-name-fr">FACULTE DES SCIENCES ET TECHNIQUES - MARRAKECH</div>
    </div>

    <!-- Titre principal -->
    <div class="title-box">اقتراح الترقي في الرتبة</div>

    <!-- Informations de base -->
    <div class="info-section">
        <div style="float: right; width: 50%;">الإطار: {{ $categorieLabel }}</div>
        <div style="float: left; width: 50%;">الدرجة: ({{ $gradeLabel }})</div>
        <div class="clearfix"></div>
    </div>

    <!-- Tableau principal -->
    <table class="data-table">
        <tr>
            <th rowspan="2">الاسم والنسب</th>
            <th rowspan="2">رقم التأجير</th>
            <th colspan="3">الوضعية الحالية</th>
            <th colspan="3">الوضعية المقترحة</th>
        </tr>
        <tr>
            <th>الرتبة</th>
            <th>الرقم</th>
            <th>الأقدمية</th>
            <th>الرتبة</th>
            <th>الرقم</th>
            <th>الأقدمية</th>
        </tr>
        @foreach($employes as $emp)
        <tr>
            <td>{{ $emp->nom }} {{ $emp->prenom }}</td>
            <td>{{ $emp->Matricule ?? 'xxxxx' }}</td>
            <td>{{ $echelons[$emp->idEchlant] ?? $emp->idEchlant }}</td>
            <td>{{ $emp->indiceId }}</td>
            <td>{{ \Carbon\Carbon::parse($emp->AncienneteEchelon)->format('Y/m/d') }}</td>
            <td>{{ $echelons[$emp->nextEchelon] ?? $emp->nextEchelon }}</td>
            <td>{{ $emp->nextIndiceId }}</td>
            <td>{{ $proposedDate }}</td>
        </tr>
        @endforeach
    </table>

    <!-- Section des signatures -->
    <div class="signature-section">
        <div class="signature-right">رئيس المؤسسة</div>
        <div class="signature-left">رئيس الجامعة</div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- DEUXIÈME PAGE: Procès-verbal du comité scientifique -->
<div style="page-break-before: always;"></div>
<div class="page-wrapper">
    <!-- En-tête -->
    <div class="header">
        <div class="faculty-name">كلية العلوم والتقنيات - مراكش</div>
        <div class="faculty-name-fr">FACULTE DES SCIENCES ET TECHNIQUES - MARRAKECH</div>
    </div>

    <!-- Titre principal -->
    <div class="title-box">محضر اللجنة العلمية</div>

    <!-- Contenu principal -->
    <div class="content-text">
        <p>
            طبقا للمرسوم رقم 2.96-804 بتاريخ 11 شوال 1417 (19 فبراير 1997) بتغيير وتتميم المرسوم رقم 2.96-793 الصادر في 11 شوال 1417 (19 فبراير 1997) في شأن النظام الأساسي الخاص بهيئة الأساتذة الباحثين بالتعليم العالي، ولاسيما المادة 09 منه.
        </p>
        <p>
            اجتمعت اللجنة العلمية لكلية العلوم والتقنيات مراكش بتاريخ ............................ لدراسة اقتراحات الترقي في الرتبة الخاصة بمجال التعليم الجامعين بهذه المؤسسة والبت فيها.
        </p>
        <p>
            وبعد المناقشة، قررت اللجنة العلمية الموافقة على ترقية الاستفادة من الرتبة {{ $currentEchelon }} إلى الرتبة {{ $nextEchelon }}.
        </p>
    </div>

    <!-- Date -->
    <div class="date-line">
        حرر في مراكش بتاريخ: .............................
    </div>

    <!-- Signatures -->
    <div class="signature-section">
        <div class="signature-right">أعضاء اللجنة العلمية</div>
        <div class="signature-left">التوقيع</div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>
