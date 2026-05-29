<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة المدرسة</title>
   <style>
    body { 
        font-family: sans-serif; 
        background: #f3f4f6; 
        text-align: center; 
        padding-top: 50px; 
    }
    .card { 
        background: white; 
        padding: 30px; 
        border-radius: 10px; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        display: inline-block; 
    }
    /* جعل العنوان يتلون ديناميكياً بناءً على لون المدرسة */
    h1 { 
        color: {{ $tenantTheme['primary_color'] ?? '#1e3a8a' }}; 
    }
    /* جعل الأزرار تتلون ديناميكياً بالكامل */
    .btn { 
        background: {{ $tenantTheme['primary_color'] ?? '#1e3a8a' }}; 
        color: white; 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px; 
        margin: 10px; 
        display: inline-block; 
    }
</style>
</head>
<body>
    <div class="card">
        <h1>مرحباً بكم في {{ $school_name }} 🏫</h1>
        <p>المعرف البرمجي للمستأجر الحالي هو: <strong>{{ $school_id }}</strong></p>
        <hr>
        <a href="/results" class="btn">استعراض نتائج الطلاب</a>
        <a href="/login" class="btn">تسجيل دخول الإدارة</a>
    </div>
</body>
</html>