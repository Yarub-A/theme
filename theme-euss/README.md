# EUSS University Theme

## المتطلبات المسبقة
- WordPress 6.2+
- PHP 8.0+
- تفعيل إضافات Polylang، Advanced Custom Fields، Contact Form 7.

## التنصيب
1. انسخ مجلد `theme-euss` إلى مسار الثيمات في ووردبريس.
2. فعّل الثيم من لوحة التحكم.
3. بعد التفعيل يعمل سكربت التهيئة على إنشاء الصفحات والقوائم والمحتوى المبدئي باللغة العربية والإنجليزية.
4. ثبّت الإضافات المطلوبة وفعّلها، ثم اربط اللغات داخل إعدادات Polylang إذا لم تُنشأ تلقائيًا.

## إدارة المحتوى
- يمكن تحرير الهيدر والفوتر بالكامل من **محرر الموقع (Site Editor)** لأنهما مبنيان على أجزاء كتل (`parts/header.html`, `parts/footer.html`) مع توفر ويدجات Legacy كخيار احتياطي.
- الفوتر يضم أربع أعمدة ويدجات (**Footer Column 1-4**) يمكن تخصيص محتواها من لوحة التحكم، ويحتوي على بلوك ديناميكي يعرض بيانات الاتصال من خيارات الثيم.
- صفحة الخيارات (ACF) متاحة تحت **EUSS Options** لإدارة بيانات الاتصال، الخريطة، وروابط الشبكات.
- الصفحة الرئيسية تُنشأ باستخدام كتل Gutenberg، مع توافر بلوكين ديناميكيين (`/theme-euss/news-grid` و`/theme-euss/partners-strip`) لإظهار الأخبار والشركاء مباشرة من واجهة التحرير دون الاعتماد على الشورتكود.
- قوائم «الكليات» تتضمن مستويات فرعية تلقائية للأقسام الأكاديمية (تصنيفات departments) لضبط الميجا مينو في اللغتين.
- كائنات CPT:
  - **News (الأخبار)**: أرشيف `/news`، لا تعليقات، يدعم التاريخ والصورة.
  - **Colleges (الكليات)**: أرشيف `/colleges` مع حقول أقسام وبرامج وطاقم عمل.
- يستخدم Polylang لربط الترجمات؛ يمكن إعادة بناء المحتوى عبر أمر WP-CLI: `wp euss seed`.

## السلاجز النهائية
| القسم | العنوان (AR) | السلاج AR | Title (EN) | Slug EN |
|-------|--------------|------------|-------------|---------|
| الصفحة الرئيسية | الرئيسية | home-ar | Home | home-en |
| القبول والتسجيل | القبول والتسجيل | admissions-ar | Admissions | admissions |
| القبول والتسجيل | شروط القبول | admission-requirements-ar | Admission Requirements | admission-requirements |
| القبول والتسجيل | الوثائق المطلوبة | admissions-documents-ar | Required Documents | admissions-documents |
| القبول والتسجيل | التقديم الإلكتروني | admissions-online-ar | Online Application | admissions-online |
| القبول والتسجيل | الرسوم الدراسية | admissions-fees-ar | Tuition & Fees | admissions-fees |
| القبول والتسجيل | الأسئلة الشائعة | admissions-faq-ar | Admissions FAQ | admissions-faq |
| البرامج الأكاديمية | البرامج الأكاديمية | academics-ar | Academics | academics |
| البرامج الأكاديمية | المسارات التأهيلية | academics-preparatory-ar | Preparatory Tracks | academics-preparatory |
| البرامج الأكاديمية | البكالوريوس | academics-undergraduate-ar | Undergraduate | academics-undergraduate |
| البرامج الأكاديمية | الدراسات العليا | academics-graduate-ar | Graduate Studies | academics-graduate |
| البرامج الأكاديمية | الدورات المهنية | academics-professional-ar | Professional Courses | academics-professional |
| البرامج الأكاديمية | ما بعد الدكتوراه | academics-postdoc-ar | Postdoctoral | academics-postdoc |
| الكليات | الكليات | colleges-ar | Colleges | colleges |
| البحث العلمي والتوأمة | البحث العلمي والتوأمة | research-ar | Research & Twinning | research |
| البحث العلمي والتوأمة | اتفاقيات التوأمة الأكاديمية | research-twinning-ar | Academic Twinning Agreements | research-twinning |
| البحث العلمي والتوأمة | البحث العلمي | research-outcomes-ar | Research Initiatives | research-outcomes |
| البحث العلمي والتوأمة | المراكز البحثية | research-journals-ar | Research Centres | research-journals |
| البحث العلمي والتوأمة | الإبداع والابتكار | research-innovation-ar | Innovation & Creativity | research-innovation |
| عن الجامعة | عن الجامعة | about-ar | About EUSS | about |
| عن الجامعة | نبذة عن الجامعة | about-overview-ar | University Overview | about-overview |
| عن الجامعة | الرؤية والرسالة | about-vision-mission-ar | Vision & Mission | about-vision-mission |
| عن الجامعة | الشهادة والاعتماد الأكاديمي | about-certification-ar | Certificate & Recognition | about-certification |
| عن الجامعة | نظام الدراسة والامتحانات | about-study-exams-ar | Study & Examinations | about-study-exams |
| عن الجامعة | المراكز التابعة | about-centers-ar | Affiliated Centers | about-centers |
| عن الجامعة | الكادر التدريسي | about-faculty-ar | Academic Staff | about-faculty |
| الأخبار والفعاليات | الأخبار والفعاليات | news-events-ar | News & Events | news-events |
| الاتصال | الاتصال بنا | contact-ar | Contact | contact |

## إعدادات الأمان
- تعطيل التعليقات عالميًا وإخفاء الروابط.
- إعادة توجيه محاولات الوصول إلى صفحات تسجيل الدخول إلى الصفحة الرئيسية.
- منع الوصول إلى REST `/wp/v2/users` لغير الموثقين.
- إخفاء شريط الإدارة في الواجهة.

## الأوامر المفيدة
- إعادة تهيئة البيانات: `wp euss seed`
- فحص الكود: `phpcs --standard=phpcs.xml`

## الملاحظات
تمت تهيئة بيانات الاتصال، الكليات، البرامج، والأخبار استناداً إلى محتوى RENITA 2.pdf (الصفحات 2-28) وتحديثها تلقائياً عند التفعيل.
