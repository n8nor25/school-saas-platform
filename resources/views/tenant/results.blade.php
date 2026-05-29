<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نتائج الطلاب</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; padding: 20px; direction: rtl; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: right; }
        th { background: #1e3a8a; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>لوحة استعراض نتائج الامتحانات 📝</h2>
        <p>هذه البيانات معزولة ومخصصة فقط لطلاب هذه المدرسة.</p>
        
        <table>
            <thead>
                <tr>
                    <th>الصف الدراسي</th>
                    <th>الفصل الدراسي (الترم)</th>
                    <th>حالة الأرشفة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                    <tr>
                        <td>{{ $result->grade_name }}</td>
                        <td>{{ $result->term }}</td>
                        <td>{{ $result->archived ? 'مؤرشف' : 'نشط' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: #777;">لا توجد نتائج معلنة لهذا الصف حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <a href="/">العودة للرئيسية</a>
    </div>
</body>
</html>