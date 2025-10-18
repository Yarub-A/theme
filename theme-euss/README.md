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
- الهيدر والفوتر ثابتان؛ يمكن تعديل الشعارات والخطوط من تخصيص الثيم.
- صفحة الخيارات (ACF) متاحة تحت **EUSS Options** لإدارة بيانات الاتصال، الخريطة، وروابط الشبكات.
- الصفحات الرئيسية تستخدم حقول ACF (Hero، الإحصاءات، الشركاء، الإعلانات).
- كائنات CPT:
  - **News (الأخبار)**: أرشيف `/news`، لا تعليقات، يدعم التاريخ والصورة.
  - **Colleges (الكليات)**: أرشيف `/colleges` مع حقول أقسام وبرامج وطاقم عمل.
- يستخدم Polylang لربط الترجمات؛ يمكن إعادة بناء المحتوى عبر أمر WP-CLI: `wp euss seed`.

## السلاجز النهائية
| اللغة | الصفحة | السلاج |
|-------|--------|--------|
| AR | الرئيسية | home-ar |
| AR | القبول والتسجيل | admissions-ar |
| AR | شروط القبول | admission-requirements-ar |
| AR | الوثائق | admissions-documents-ar |
| AR | التقديم الإلكتروني | admissions-online-ar |
| AR | الرسوم | admissions-fees-ar |
| AR | الأسئلة الشائعة | admissions-faq-ar |
| AR | البرامج الأكاديمية | academics-ar |
| AR | المسارات التأهيلية | academics-preparatory-ar |
| AR | البكالوريوس | academics-undergraduate-ar |
| AR | الدراسات العليا | academics-graduate-ar |
| AR | ما بعد الدكتوراه | academics-postdoc-ar |
| AR | الدورات المهنية | academics-professional-ar |
| AR | الكليات | colleges-ar |
| AR | البحث العلمي | research-ar |
| AR | اتفاقيات التوأمة | research-twinning-ar |
| AR | المخرجات البحثية | research-outcomes-ar |
| AR | المجلات العلمية | research-journals-ar |
| AR | عن الجامعة | about-ar |
| AR | الرسالة | about-mission-ar |
| AR | الرؤية | about-vision-ar |
| AR | الهيكل التنظيمي | about-structure-ar |
| AR | المراكز التابعة | about-centers-ar |
| AR | الكادر التدريسي | about-faculty-ar |
| AR | الأخبار والفعاليات | news-events-ar |
| AR | الاتصال بنا | contact-ar |
| EN | Home | home-en |
| EN | Admissions | admissions |
| EN | Admission Requirements | admission-requirements |
| EN | Required Documents | admissions-documents |
| EN | Online Application | admissions-online |
| EN | Tuition & Fees | admissions-fees |
| EN | Admissions FAQ | admissions-faq |
| EN | Academics | academics |
| EN | Preparatory Tracks | academics-preparatory |
| EN | Undergraduate | academics-undergraduate |
| EN | Graduate Studies | academics-graduate |
| EN | Postdoctoral | academics-postdoc |
| EN | Professional Courses | academics-professional |
| EN | Colleges | colleges |
| EN | Research | research |
| EN | Twinning Agreements | research-twinning |
| EN | Research Outcomes | research-outcomes |
| EN | Scientific Journals | research-journals |
| EN | About | about |
| EN | Mission | about-mission |
| EN | Vision | about-vision |
| EN | Organizational Structure | about-structure |
| EN | Affiliated Centers | about-centers |
| EN | Faculty & Staff | about-faculty |
| EN | News & Events | news-events |
| EN | Contact | contact |

## إعدادات الأمان
- تعطيل التعليقات عالميًا وإخفاء الروابط.
- إعادة توجيه محاولات الوصول إلى صفحات تسجيل الدخول إلى الصفحة الرئيسية.
- منع الوصول إلى REST `/wp/v2/users` لغير الموثقين.
- إخفاء شريط الإدارة في الواجهة.

## الأوامر المفيدة
- إعادة تهيئة البيانات: `wp euss seed`
- فحص الكود: `phpcs --standard=phpcs.xml`

## الملاحظات
- بيانات الاتصال والشركاء والبرامج تحتوي TODO ريثما يتم استخراج التفاصيل الدقيقة من ملف PDF.
