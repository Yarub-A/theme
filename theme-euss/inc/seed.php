<?php
/**
 * Auto-provisioning of content on activation.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_switch_theme', 'theme_euss_seed_content' );

function theme_euss_seed_content() {
    theme_euss_disable_discussion_settings();
    theme_euss_create_languages();
    $pages = theme_euss_create_pages();
    theme_euss_create_menus( $pages );
    theme_euss_seed_terms();
    theme_euss_seed_posts();
    theme_euss_seed_options();
}

function theme_euss_disable_discussion_settings() {
    update_option( 'default_comment_status', 'closed' );
    update_option( 'default_ping_status', 'closed' );
}

function theme_euss_create_languages() {
    if ( function_exists( 'pll_register_string' ) && function_exists( 'pll_languages_list' ) ) {
        $languages = pll_languages_list();
        if ( empty( $languages ) ) {
            // Developers should configure languages manually. This placeholder ensures documentation is explicit.
        }
    }
}

function theme_euss_seed_page_content( $key, $lang ) {
    static $content = null;

    if ( null === $content ) {
        $content = [
            'home' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تأسست الجامعة الأوروبية للعلوم الذكية في مملكة السويد عام 2019/2020 برقم التسجيل 559306-7902 ومقرها مدينة يوتوبوري، وتعد ملتقى دولياً لمختلف الثقافات.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>تتبع الجامعة النظام الجامعي السويدي وتمنح درجات البكالوريوس والماجستير والدكتوراه بالإضافة إلى شهادات مهنية معتمدة في السويد والعالم العربي والدولي، مع اعتماد التعليم المدمج والافتراضي عبر منصة الجامعة.</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul><li>لغات التدريس: العربية، الإنجليزية، السويدية.</li><li>بيئة تعليمية بحثية تنمي الموارد البشرية وتدعم التعاون الدولي.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.2
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The European University for Smart Sciences was founded in Sweden in 2019/2020 under registration 559306-7902, headquartered in Gothenburg as an international hub for diverse cultures.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Following the Swedish higher education system, the university awards bachelor’s, master’s, and doctoral degrees alongside accredited professional certificates, using a blended and virtual learning platform.</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul><li>Languages of instruction: Arabic, English, and Swedish.</li><li>A research-focused environment that develops human capital and supports international cooperation.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.2
            ],
            'admissions' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>يستند القبول في الجامعة الأوروبية للعلوم الذكية إلى شمولية توفر فرص التعليم العالي للطلبة داخل السويد وخارجها، مع مراعاة خصوصية كل طالب ودعمه للوصول إلى البرامج المناسبة.</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul><li>قبول خريجي الثانويات العلمية والأدبية والتجارية والمعاهد المتوسطة.</li><li>مرونة لاستقبال الطلبة من ذوي الاحتياجات الخاصة والطلبة الدوليين دون قيود على نوع الشهادة.</li><li>إتاحة التعليم الحضوري داخل السويد والتعليم عن بعد عبر المنصة الافتراضية للجامعة.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Admissions at the European University for Smart Sciences are designed to keep higher education accessible for students in Sweden and worldwide, tailoring pathways that match each learner’s background.</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul><li>Eligibility for graduates of scientific, literary, commercial secondary schools, and intermediate institutes.</li><li>Inclusive policies welcoming students with disabilities and international applicants without certificate restrictions.</li><li>On-campus study in Sweden complemented by a virtual platform for remote learners.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
            ],
            'admission-requirements' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>يشترط للتسجيل في برامج البكالوريوس الحصول على شهادة البكالوريا أو ما يعادلها.</li><li>تمنح البرامج العليا فرصة متابعة الدراسات للطلبة الحاصلين على شهادات جامعية معترف بها.</li><li>يتم تقييم الطلبة عبر مقابلات أكاديمية ومراجعة الوثائق للتأكد من الملاءمة العلمية.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>Bachelor applicants must hold a recognized baccalaureate or equivalent secondary diploma.</li><li>Graduate and postgraduate entrants provide accredited university degrees aligned with the selected major.</li><li>Academic interviews and document checks confirm suitability for each program track.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
            ],
            'admissions-documents' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>صورة عن جواز السفر أو الهوية الوطنية.</li><li>سيرة ذاتية حديثة.</li><li>صورة شخصية حديثة.</li><li>العنوان الكامل مع رقم الهاتف.</li><li>تحديد التخصص أو البرنامج المطلوب.</li><li>إثبات تسديد رسوم التسجيل للطلبة غير الأوروبيين.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>Copy of a valid passport or national ID.</li><li>Updated curriculum vitae.</li><li>Recent personal photograph.</li><li>Full contact address and phone number.</li><li>Declared major or desired study program.</li><li>Proof of registration fee payment for non-European students.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.23
            ],
            'admissions-online' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تتيح الجامعة منصة إلكترونية متكاملة للتقديم ومتابعة الملفات، حيث يمكن للطلبة تحميل الوثائق، متابعة مراحل القبول، والتواصل مع وحدة القبول دون الحاجة إلى الحضور.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>تتم المعالجة بالتنسيق مع الكليات لضمان مطابقة المتقدم مع المسار الأكاديمي الأنسب.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.23
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The digital admissions portal enables applicants to upload documents, track application status, and correspond with the admissions office without physical visits.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Faculties coordinate with the portal to match each candidate with the most appropriate academic pathway.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.23
            ],
            'admissions-fees' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تلتزم الجامعة برسوم تسجيل شفافة للطلبة غير الأوروبيين مع إتاحة خطط دفع مرنة مرتبطة بكل برنامج، بينما يخضع الطلبة الأوروبيون للوائح الرسوم المحلية.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.23
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Transparent registration fees apply to non-European students with flexible payment arrangements per program, while European learners follow prevailing local regulations.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.23
            ],
            'admissions-faq' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>يمكن للطلبة إعادة الاختبار في حال عدم اجتيازه ضمن الفترة المقررة.</li><li>توفر الجامعة دعماً إرشادياً للطلبة الجدد لاختيار التخصص المناسب.</li><li>يستفيد الطلبة الدوليون من خدمات المتابعة عبر ممثلي الجامعة في بلدانهم.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.18, p.23
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>Students may retake assessments if they do not pass on the first attempt within the scheduled window.</li><li>Academic advising helps new learners select majors aligned with their goals.</li><li>International students receive support through university representatives in their respective countries.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.18, p.23
            ],
            'academics' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تغطي البرامج الأكاديمية في الجامعة المسارات التأهيلية والبكالوريوس والماجستير وما بعد الدكتوراه والدورات المهنية، مع تركيز على المهارات التطبيقية والبحث العلمي.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The academic portfolio spans preparatory tracks, bachelor programs, master studies, postdoctoral research, and professional courses with an applied, research-driven orientation.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
            ],
            'academics-preparatory' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تقدم المسارات التأهيلية جسراً معرفياً للطلبة الجدد لإكسابهم مهارات اللغة والتقنية والمنهجيات الأكاديمية قبل الالتحاق بالبرنامج الرئيسي.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Preparatory programs build language, technology, and academic skills that prepare students for success in their chosen degree tracks.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
            ],
            'academics-undergraduate' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تصمم برامج البكالوريوس وفق المعايير السويدية مع مزج التعليم النظري بالتطبيق العملي، وتغطي تخصصات الإعلام، التربية، الهندسة، الآداب، والعلوم الإدارية.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Undergraduate degrees follow Swedish standards, blending theoretical knowledge with practice across media, education, engineering, humanities, and management disciplines.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.8
            ],
            'academics-graduate' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تدعم برامج الماجستير تنمية البحث العلمي والمهارات المهنية المتقدمة، مع مشاريع تطبيقية تعالج قضايا التنمية الإقليمية والدولية.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Master’s studies cultivate advanced research capabilities and professional expertise through applied projects that address regional and international development priorities.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
            ],
            'academics-postdoc' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>توفر مرحلة ما بعد الدكتوراه منصة بحثية للباحثين لمواصلة الابتكار العلمي وتبادل الخبرات مع المراكز المتعاونة.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The postdoctoral stage offers a research platform for scholars to pursue innovation and share expertise with partner centers.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
            ],
            'academics-professional' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تغطي الدورات المهنية الاحتياجات السوقية وتمنح شهادات معتمدة تعزز الجاهزية العملية للمتدربين في قطاعات متعددة.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Professional courses respond to labor market needs, awarding accredited certificates that strengthen workplace readiness across sectors.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.9
            ],
            'colleges' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>كلية الإعلام والاتصال</li><li>كلية العلوم التربوية والنفسية</li><li>كلية الهندسة وتكنولوجيا الحاسبات</li><li>كلية الآداب واللغات</li><li>كلية الدراسات العليا والبحث العلمي</li><li>كلية العلوم الطبية المساعدة</li><li>كلية القانون والعلوم السياسية</li><li>كلية الإدارة والاقتصاد</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.7
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>College of Media and Communication</li><li>College of Educational and Psychological Sciences</li><li>College of Engineering and Computer Technology</li><li>College of Arts and Languages</li><li>College of Graduate Studies and Scientific Research</li><li>College of Allied Medical Sciences</li><li>College of Law and Political Sciences</li><li>College of Administration and Economics</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.7
            ],
            'research' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تؤكد الجامعة هويتها كمؤسسة بحثية علمية تطمح إلى تنمية الموارد البشرية وخدمة قضايا التنمية والتعاون الدولي عبر برامج بحث وتطوير مستدامة.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.2
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The university operates as a scientific research institution that develops human resources and advances development and international cooperation through sustained R&amp;D initiatives.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.2
            ],
            'research-twinning' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تعقد الجامعة اتفاقيات اعتراف أكاديمي وتوأمة علمية مع جامعات عربية وأوروبية وأمريكية، ويجري توثيقها عبر منظمة الاعتماد الدولية IAO.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="https://www.iao.org/Sweden-Vastra-Gotaland-County/European-University-for-Smart-Sciences" target="_blank" rel="noopener">رابط منظمة IAO</a></p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.25-28
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The university maintains academic recognition and twinning agreements with Arab, European, and American institutions, documented through the International Accreditation Organization (IAO).</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="https://www.iao.org/Sweden-Vastra-Gotaland-County/European-University-for-Smart-Sciences" target="_blank" rel="noopener">IAO accreditation profile</a></p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.25-28
            ],
            'research-outcomes' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تدعم الجامعة مخرجات بحثية متجددة عبر إشراك الطلبة في مشاريع تتناول الابتكار، التنمية، والخدمات المجتمعية، وتوفير منصات للنشر العلمي.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Students and faculty co-create research outputs that address innovation, development, and community services while benefiting from university-supported publication venues.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18
            ],
            'research-journals' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تعمل الكليات مع المجلات العلمية المتخصصة لنشر الأبحاث المحكمة وتشجيع التبادل الأكاديمي عبر اللغات الثلاث المعتمدة.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Faculties collaborate with specialized scientific journals to publish peer-reviewed studies and promote multilingual scholarly exchange.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18
            ],
            'about' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>الجامعة الأوروبية للعلوم الذكية مؤسسة أكاديمية سويدية تأسست لتكون ملتقى دولياً، وتدمج التعليم الحضوري والافتراضي لدعم الإبداع والابتكار.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.2
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The European University for Smart Sciences is a Swedish academic institution that unites on-campus and virtual learning to nurture creativity and innovation for a global community.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.2
            ],
            'about-mission' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>تقديم تعليم حديث قائم على البحث العلمي وتنمية المهارات المهنية.</li><li>اعتماد التعلم القائم على الموارد والفصول الافتراضية.</li><li>توفير محاضرات مباشرة وتفاعل أكاديمي يدعم التميز.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.4
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>Deliver modern education grounded in scientific research and professional skill development.</li><li>Adopt resource-based learning with virtual classrooms.</li><li>Provide live lectures and interactive academic engagement that drives excellence.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.4
            ],
            'about-vision' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>ترسخ الجامعة رؤيتها كمؤسسة رائدة في توظيف التقنيات الذكية لتوسيع فرص التعليم العالي، وتعزيز مكانة مخرجاتها في السويد والعالم.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.4
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The university envisions leading the adoption of smart technologies to expand higher-education opportunities and elevate the global standing of its graduates.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.4
            ],
            'about-structure' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>يعتمد الهيكل التنظيمي على رئاسة الجامعة والكليات المتخصصة والمراكز التابعة التي تدعم الجودة الأكاديمية وخدمة المجتمع.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.4
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>The organizational structure integrates the university presidency, specialized colleges, and affiliated centers that reinforce academic quality and community service.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.4
            ],
            'about-centers' => [
                'ar' => <<<'HTML'
<!-- wp:list -->
<ul><li>مركز تعليم اللغات والترجمة القانونية.</li><li>مركز التأهيل والتطوير التربوي.</li><li>المركز الثقافي السويدي العراقي.</li><li>مركز الإبداع والابتكار.</li><li>مركز الاستشارات النفسية.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.21-22
                'en' => <<<'HTML'
<!-- wp:list -->
<ul><li>Language Teaching and Legal Translation Center.</li><li>Educational Rehabilitation and Development Center.</li><li>Swedish-Iraqi Cultural Center.</li><li>Innovation and Creativity Center.</li><li>Psychological Counseling Center.</li></ul>
<!-- /wp:list -->
HTML
                , // PDF p.21-22
            ],
            'about-faculty' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>يضم الكادر التدريسي نخبة من الخبرات الأكاديمية والمهنية التي تشرف على تقديم البرامج بثلاث لغات وتواكب المستجدات البحثية.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.22
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Faculty members bring advanced academic and professional expertise to deliver programs in three languages while staying aligned with emerging research trends.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.22
            ],
            'news-events' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>تابع آخر الأخبار والفعاليات المتعلقة بالبرامج الأكاديمية، الامتحانات الدورية، والشراكات الدولية التي تعلنها الجامعة تباعاً.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18, p.25
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Stay informed about academic updates, examination schedules, and international partnerships announced by the university throughout the year.</p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.18, p.25
            ],
            'contact' => [
                'ar' => <<<'HTML'
<!-- wp:paragraph -->
<p>العنوان: Hildebrandsgatan 5, 41705 Gothenburg, Sweden</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>البريد الإلكتروني: info@edu.renita.se &nbsp;&nbsp;|&nbsp;&nbsp; الهاتف: 0046 763091170</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>الموقع الإلكتروني: <a href="https://edu.renita.se" target="_blank" rel="noopener">https://edu.renita.se</a></p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.24
                'en' => <<<'HTML'
<!-- wp:paragraph -->
<p>Address: Hildebrandsgatan 5, 41705 Gothenburg, Sweden</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Email: info@edu.renita.se &nbsp;&nbsp;|&nbsp;&nbsp; Phone: +46 763091170</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Website: <a href="https://edu.renita.se" target="_blank" rel="noopener">https://edu.renita.se</a></p>
<!-- /wp:paragraph -->
HTML
                , // PDF p.24
            ],
        ];
    }

    return $content[ $key ][ $lang ] ?? '';
}

function theme_euss_create_pages() {
    $page_tree = [
        'home' => [
            'template'      => 'front-page.php',
            'translations'  => [
                'ar' => [
                    'title'   => 'الرئيسية',
                    'slug'    => 'home-ar',
                    'content' => theme_euss_seed_page_content( 'home', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Home',
                    'slug'    => 'home-en',
                    'content' => theme_euss_seed_page_content( 'home', 'en' ),
                ],
            ],
        ],
        'admissions' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'القبول والتسجيل',
                    'slug'    => 'admissions-ar',
                    'content' => theme_euss_seed_page_content( 'admissions', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Admissions',
                    'slug'    => 'admissions',
                    'content' => theme_euss_seed_page_content( 'admissions', 'en' ),
                ],
            ],
            'children'    => [
                'admission-requirements' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'شروط القبول',
                            'slug'    => 'admission-requirements-ar',
                            'content' => theme_euss_seed_page_content( 'admission-requirements', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Admission Requirements',
                            'slug'    => 'admission-requirements',
                            'content' => theme_euss_seed_page_content( 'admission-requirements', 'en' ),
                        ],
                    ],
                ],
                'admissions-documents' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الوثائق',
                            'slug'    => 'admissions-documents-ar',
                            'content' => theme_euss_seed_page_content( 'admissions-documents', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Required Documents',
                            'slug'    => 'admissions-documents',
                            'content' => theme_euss_seed_page_content( 'admissions-documents', 'en' ),
                        ],
                    ],
                ],
                'admissions-online' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'التقديم الإلكتروني',
                            'slug'    => 'admissions-online-ar',
                            'content' => theme_euss_seed_page_content( 'admissions-online', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Online Application',
                            'slug'    => 'admissions-online',
                            'content' => theme_euss_seed_page_content( 'admissions-online', 'en' ),
                        ],
                    ],
                ],
                'admissions-fees' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرسوم',
                            'slug'    => 'admissions-fees-ar',
                            'content' => theme_euss_seed_page_content( 'admissions-fees', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Tuition & Fees',
                            'slug'    => 'admissions-fees',
                            'content' => theme_euss_seed_page_content( 'admissions-fees', 'en' ),
                        ],
                    ],
                ],
                'admissions-faq' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الأسئلة الشائعة',
                            'slug'    => 'admissions-faq-ar',
                            'content' => theme_euss_seed_page_content( 'admissions-faq', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Admissions FAQ',
                            'slug'    => 'admissions-faq',
                            'content' => theme_euss_seed_page_content( 'admissions-faq', 'en' ),
                        ],
                    ],
                ],
            ],
        ],
        'academics' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'البرامج الأكاديمية',
                    'slug'    => 'academics-ar',
                    'content' => theme_euss_seed_page_content( 'academics', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Academics',
                    'slug'    => 'academics',
                    'content' => theme_euss_seed_page_content( 'academics', 'en' ),
                ],
            ],
            'children'    => [
                'academics-preparatory' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المسارات التأهيلية',
                            'slug'    => 'academics-preparatory-ar',
                            'content' => theme_euss_seed_page_content( 'academics-preparatory', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Preparatory Tracks',
                            'slug'    => 'academics-preparatory',
                            'content' => theme_euss_seed_page_content( 'academics-preparatory', 'en' ),
                        ],
                    ],
                ],
                'academics-undergraduate' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'البكالوريوس',
                            'slug'    => 'academics-undergraduate-ar',
                            'content' => theme_euss_seed_page_content( 'academics-undergraduate', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Undergraduate',
                            'slug'    => 'academics-undergraduate',
                            'content' => theme_euss_seed_page_content( 'academics-undergraduate', 'en' ),
                        ],
                    ],
                ],
                'academics-graduate' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الدراسات العليا',
                            'slug'    => 'academics-graduate-ar',
                            'content' => theme_euss_seed_page_content( 'academics-graduate', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Graduate Studies',
                            'slug'    => 'academics-graduate',
                            'content' => theme_euss_seed_page_content( 'academics-graduate', 'en' ),
                        ],
                    ],
                ],
                'academics-postdoc' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'ما بعد الدكتوراه',
                            'slug'    => 'academics-postdoc-ar',
                            'content' => theme_euss_seed_page_content( 'academics-postdoc', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Postdoctoral',
                            'slug'    => 'academics-postdoc',
                            'content' => theme_euss_seed_page_content( 'academics-postdoc', 'en' ),
                        ],
                    ],
                ],
                'academics-professional' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الدورات المهنية',
                            'slug'    => 'academics-professional-ar',
                            'content' => theme_euss_seed_page_content( 'academics-professional', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Professional Courses',
                            'slug'    => 'academics-professional',
                            'content' => theme_euss_seed_page_content( 'academics-professional', 'en' ),
                        ],
                    ],
                ],
            ],
        ],
        'colleges' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الكليات',
                    'slug'    => 'colleges-ar',
                    'content' => theme_euss_seed_page_content( 'colleges', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Colleges',
                    'slug'    => 'colleges',
                    'content' => theme_euss_seed_page_content( 'colleges', 'en' ),
                ],
            ],
        ],
        'research' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'البحث العلمي',
                    'slug'    => 'research-ar',
                    'content' => theme_euss_seed_page_content( 'research', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Research',
                    'slug'    => 'research',
                    'content' => theme_euss_seed_page_content( 'research', 'en' ),
                ],
            ],
            'children'    => [
                'research-twinning' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'اتفاقيات التوأمة',
                            'slug'    => 'research-twinning-ar',
                            'content' => theme_euss_seed_page_content( 'research-twinning', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Twinning Agreements',
                            'slug'    => 'research-twinning',
                            'content' => theme_euss_seed_page_content( 'research-twinning', 'en' ),
                        ],
                    ],
                ],
                'research-outcomes' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المخرجات البحثية',
                            'slug'    => 'research-outcomes-ar',
                            'content' => theme_euss_seed_page_content( 'research-outcomes', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Research Outcomes',
                            'slug'    => 'research-outcomes',
                            'content' => theme_euss_seed_page_content( 'research-outcomes', 'en' ),
                        ],
                    ],
                ],
                'research-journals' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المجلات العلمية',
                            'slug'    => 'research-journals-ar',
                            'content' => theme_euss_seed_page_content( 'research-journals', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Scientific Journals',
                            'slug'    => 'research-journals',
                            'content' => theme_euss_seed_page_content( 'research-journals', 'en' ),
                        ],
                    ],
                ],
            ],
        ],
        'about' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'عن الجامعة',
                    'slug'    => 'about-ar',
                    'content' => theme_euss_seed_page_content( 'about', 'ar' ),
                ],
                'en' => [
                    'title'   => 'About',
                    'slug'    => 'about',
                    'content' => theme_euss_seed_page_content( 'about', 'en' ),
                ],
            ],
            'children'    => [
                'about-mission' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرسالة',
                            'slug'    => 'about-mission-ar',
                            'content' => theme_euss_seed_page_content( 'about-mission', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Mission',
                            'slug'    => 'about-mission',
                            'content' => theme_euss_seed_page_content( 'about-mission', 'en' ),
                        ],
                    ],
                ],
                'about-vision' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرؤية',
                            'slug'    => 'about-vision-ar',
                            'content' => theme_euss_seed_page_content( 'about-vision', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Vision',
                            'slug'    => 'about-vision',
                            'content' => theme_euss_seed_page_content( 'about-vision', 'en' ),
                        ],
                    ],
                ],
                'about-structure' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الهيكل التنظيمي',
                            'slug'    => 'about-structure-ar',
                            'content' => theme_euss_seed_page_content( 'about-structure', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Organizational Structure',
                            'slug'    => 'about-structure',
                            'content' => theme_euss_seed_page_content( 'about-structure', 'en' ),
                        ],
                    ],
                ],
                'about-centers' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المراكز التابعة',
                            'slug'    => 'about-centers-ar',
                            'content' => theme_euss_seed_page_content( 'about-centers', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Affiliated Centers',
                            'slug'    => 'about-centers',
                            'content' => theme_euss_seed_page_content( 'about-centers', 'en' ),
                        ],
                    ],
                ],
                'about-faculty' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الكادر التدريسي',
                            'slug'    => 'about-faculty-ar',
                            'content' => theme_euss_seed_page_content( 'about-faculty', 'ar' ),
                        ],
                        'en' => [
                            'title'   => 'Faculty & Staff',
                            'slug'    => 'about-faculty',
                            'content' => theme_euss_seed_page_content( 'about-faculty', 'en' ),
                        ],
                    ],
                ],
            ],
        ],
        'news-events' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الأخبار والفعاليات',
                    'slug'    => 'news-events-ar',
                    'content' => theme_euss_seed_page_content( 'news-events', 'ar' ),
                ],
                'en' => [
                    'title'   => 'News & Events',
                    'slug'    => 'news-events',
                    'content' => theme_euss_seed_page_content( 'news-events', 'en' ),
                ],
            ],
        ],
        'contact' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الاتصال بنا',
                    'slug'    => 'contact-ar',
                    'content' => theme_euss_seed_page_content( 'contact', 'ar' ),
                ],
                'en' => [
                    'title'   => 'Contact',
                    'slug'    => 'contact',
                    'content' => theme_euss_seed_page_content( 'contact', 'en' ),
                ],
            ],
        ],
    ];

    $flat_pages = [];
    theme_euss_create_page_branch( $page_tree, [], $flat_pages );

    return $flat_pages;
}

function theme_euss_create_page_branch( array $nodes, array $parent_ids, array &$flat ) {
    foreach ( $nodes as $key => $node ) {
        $translations = $node['translations'];
        $created_ids  = [];

        foreach ( $translations as $lang => $data ) {
            $parent_id = $parent_ids[ $lang ] ?? 0;
            $created_ids[ $lang ] = theme_euss_upsert_page( $data, $node['template'], $parent_id );

            if ( function_exists( 'pll_set_post_language' ) ) {
                pll_set_post_language( $created_ids[ $lang ], $lang );
            }
        }

        if ( function_exists( 'pll_save_post_translations' ) && count( $created_ids ) > 1 ) {
            pll_save_post_translations( $created_ids );
        }

        $flat[ $key ] = $created_ids;

        if ( ! empty( $node['children'] ) ) {
            theme_euss_create_page_branch( $node['children'], $created_ids, $flat );
        }
    }
}

function theme_euss_upsert_page( array $page_data, $template, $parent_id = 0 ) {
    $defaults = [
        'title'   => __( 'Untitled Page', 'theme-euss' ),
        'slug'    => wp_unique_post_slug( uniqid( 'page-' ), 0, 'publish', 'page', 0 ),
        'content' => __( 'Content will be available soon.', 'theme-euss' ),
    ];

    $page_data = wp_parse_args( $page_data, $defaults );
    $existing  = get_page_by_path( $page_data['slug'] );

    if ( $existing ) {
        $update = [ 'ID' => $existing->ID ];
        $needs_update = false;

        if ( $existing->post_title !== $page_data['title'] ) {
            $update['post_title'] = $page_data['title'];
            $needs_update         = true;
        }

        if ( (int) $existing->post_parent !== (int) $parent_id ) {
            $update['post_parent'] = $parent_id;
            $needs_update          = true;
        }

        if ( $needs_update ) {
            wp_update_post( $update );
        }

        $page_id = $existing->ID;
    } else {
        $page_id = wp_insert_post( [
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $page_data['title'],
            'post_name'    => $page_data['slug'],
            'post_parent'  => $parent_id,
            'post_content' => $page_data['content'],
        ] );
    }

    if ( $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }

    return $page_id;
}

function theme_euss_create_menus( $pages ) {
    $locations = [
        'main_ar'   => 'main_ar',
        'main_en'   => 'main_en',
        'top_ar'    => 'top_ar',
        'top_en'    => 'top_en',
        'footer_ar' => 'footer_ar',
        'footer_en' => 'footer_en',
    ];

    $menus = [];
    foreach ( $locations as $location => $key ) {
        $menu = wp_get_nav_menu_object( $key );
        if ( ! $menu ) {
            $menu_id = wp_create_nav_menu( $key );
        } else {
            $menu_id = $menu->term_id;
        }
        $menus[ $location ] = $menu_id;
    }

    $menu_structure = [
        'main_ar' => [
            [ 'key' => 'home' ],
            [
                'key'      => 'admissions',
                'children' => [ 'admission-requirements', 'admissions-documents', 'admissions-online', 'admissions-fees', 'admissions-faq' ],
            ],
            [
                'key'      => 'academics',
                'children' => [ 'academics-preparatory', 'academics-undergraduate', 'academics-graduate', 'academics-postdoc', 'academics-professional' ],
            ],
            [ 'key' => 'colleges' ],
            [
                'key'      => 'research',
                'children' => [ 'research-twinning', 'research-outcomes', 'research-journals' ],
            ],
            [
                'key'      => 'about',
                'children' => [ 'about-mission', 'about-vision', 'about-structure', 'about-centers', 'about-faculty' ],
            ],
            [ 'key' => 'news-events' ],
            [ 'key' => 'contact' ],
        ],
        'main_en' => [
            [ 'key' => 'home' ],
            [
                'key'      => 'admissions',
                'children' => [ 'admission-requirements', 'admissions-documents', 'admissions-online', 'admissions-fees', 'admissions-faq' ],
            ],
            [
                'key'      => 'academics',
                'children' => [ 'academics-preparatory', 'academics-undergraduate', 'academics-graduate', 'academics-postdoc', 'academics-professional' ],
            ],
            [ 'key' => 'colleges' ],
            [
                'key'      => 'research',
                'children' => [ 'research-twinning', 'research-outcomes', 'research-journals' ],
            ],
            [
                'key'      => 'about',
                'children' => [ 'about-mission', 'about-vision', 'about-structure', 'about-centers', 'about-faculty' ],
            ],
            [ 'key' => 'news-events' ],
            [ 'key' => 'contact' ],
        ],
        'top_ar'    => [ [ 'key' => 'contact' ] ],
        'top_en'    => [ [ 'key' => 'contact' ] ],
        'footer_ar' => [ [ 'key' => 'home' ], [ 'key' => 'admissions' ], [ 'key' => 'academics' ] ],
        'footer_en' => [ [ 'key' => 'home' ], [ 'key' => 'admissions' ], [ 'key' => 'academics' ] ],
    ];

    foreach ( $menu_structure as $location => $items ) {
        $lang        = str_contains( $location, '_ar' ) ? 'ar' : 'en';
        $menu_id     = $menus[ $location ];
        $existing    = wp_get_nav_menu_items( $menu_id, [ 'post_status' => 'any' ] );
        $existing_map = [];

        if ( $existing ) {
            foreach ( $existing as $menu_item ) {
                $key = $menu_item->object_id . ':' . (int) $menu_item->menu_item_parent;
                $existing_map[ $key ] = (int) $menu_item->ID;
            }
        }

        theme_euss_sync_menu_branch( $items, $pages, $menu_id, $lang, 0, $existing_map );
    }

    set_theme_mod( 'nav_menu_locations', [
        'main_ar'   => $menus['main_ar'],
        'main_en'   => $menus['main_en'],
        'top_ar'    => $menus['top_ar'],
        'top_en'    => $menus['top_en'],
        'footer_ar' => $menus['footer_ar'],
        'footer_en' => $menus['footer_en'],
    ] );
}

function theme_euss_sync_menu_branch( array $items, array $pages, $menu_id, $lang, $parent_item_id = 0, array &$existing_map = [] ) {
    foreach ( $items as $item ) {
        if ( empty( $item['key'] ) || empty( $pages[ $item['key'] ][ $lang ] ) ) {
            continue;
        }

        $object_id = (int) $pages[ $item['key'] ][ $lang ];
        $map_key   = $object_id . ':' . (int) $parent_item_id;

        if ( isset( $existing_map[ $map_key ] ) ) {
            $menu_item_id = $existing_map[ $map_key ];
        } else {
            $menu_item_id = wp_update_nav_menu_item(
                $menu_id,
                0,
                [
                    'menu-item-title'     => get_the_title( $object_id ),
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-object-id' => $object_id,
                    'menu-item-status'    => 'publish',
                    'menu-item-parent-id' => $parent_item_id,
                ]
            );

            $existing_map[ $map_key ] = (int) $menu_item_id;
        }

        if ( ! empty( $item['children'] ) ) {
            theme_euss_sync_menu_branch( $item['children'], $pages, $menu_id, $lang, $menu_item_id, $existing_map );
        }
    }
}

function theme_euss_seed_terms() {
    $departments = [
        [ 'ar' => 'قسم الذكاء الاصطناعي', 'en' => 'Artificial Intelligence Department', 'slug' => 'ai-department' ], // PDF p.10
        [ 'ar' => 'قسم الحاسوب والبرمجيات', 'en' => 'Computer and Software Department', 'slug' => 'computer-software-department' ], // PDF p.10
        [ 'ar' => 'قسم التمريض والخدمات الطبية', 'en' => 'Nursing and Medical Services Department', 'slug' => 'nursing-medical-services' ], // PDF p.10
        [ 'ar' => 'قسم التصنيع الزراعي', 'en' => 'Agro-Industrial Department', 'slug' => 'agro-industrial-department' ], // PDF p.10
        [ 'ar' => 'إدارة الأعمال', 'en' => 'Business Administration', 'slug' => 'business-administration' ], // PDF p.11
        [ 'ar' => 'نظم المعلومات', 'en' => 'Information Systems', 'slug' => 'information-systems' ], // PDF p.11
        [ 'ar' => 'العلوم المالية والمصرفية', 'en' => 'Finance and Banking Sciences', 'slug' => 'finance-banking-sciences' ], // PDF p.11
        [ 'ar' => 'القانون', 'en' => 'Law', 'slug' => 'law-department' ], // PDF p.12
        [ 'ar' => 'العلوم السياسية', 'en' => 'Political Sciences', 'slug' => 'political-sciences' ], // PDF p.12
        [ 'ar' => 'هندسة الحاسبات', 'en' => 'Computer Engineering', 'slug' => 'computer-engineering' ], // PDF p.12
        [ 'ar' => 'هندسة الفحص والسيطرة النوعية', 'en' => 'Inspection and Quality Control Engineering', 'slug' => 'quality-control-engineering' ], // PDF p.12
        [ 'ar' => 'الهندسة الكهربائية', 'en' => 'Electrical Engineering', 'slug' => 'electrical-engineering' ], // PDF p.12
        [ 'ar' => 'إدارة المشاريع الهندسية', 'en' => 'Engineering Project Management', 'slug' => 'engineering-project-management' ], // PDF p.12
        [ 'ar' => 'الهندسة الطبية الحيوية', 'en' => 'Biomedical Engineering', 'slug' => 'biomedical-engineering' ], // PDF p.13
        [ 'ar' => 'هندسة الأجهزة الطبية', 'en' => 'Medical Devices Engineering', 'slug' => 'medical-devices-engineering' ], // PDF p.13
        [ 'ar' => 'العلوم التربوية', 'en' => 'Educational Sciences', 'slug' => 'educational-sciences' ], // PDF p.14
        [ 'ar' => 'علم النفس', 'en' => 'Psychology', 'slug' => 'psychology-department' ], // PDF p.14
        [ 'ar' => 'الإرشاد النفسي والتوجيه التربوي', 'en' => 'Psychological Counseling and Educational Guidance', 'slug' => 'counseling-guidance' ], // PDF p.14
        [ 'ar' => 'التربية الخاصة', 'en' => 'Special Education', 'slug' => 'special-education' ], // PDF p.14
        [ 'ar' => 'العلوم الشرعية', 'en' => 'Sharia Sciences', 'slug' => 'sharia-sciences' ], // PDF p.14
        [ 'ar' => 'الصحة العامة', 'en' => 'Public Health', 'slug' => 'public-health' ], // PDF p.15
        [ 'ar' => 'التغذية العلاجية', 'en' => 'Therapeutic Nutrition', 'slug' => 'therapeutic-nutrition' ], // PDF p.15
        [ 'ar' => 'قسم اللغة العربية', 'en' => 'Arabic Language Department', 'slug' => 'arabic-language-department' ], // PDF p.16
        [ 'ar' => 'قسم اللغة الإنجليزية', 'en' => 'English Language Department', 'slug' => 'english-language-department' ], // PDF p.16
        [ 'ar' => 'قسم اللغة السويدية', 'en' => 'Swedish Language Department', 'slug' => 'swedish-language-department' ], // PDF p.16
        [ 'ar' => 'قسم اللغة الفرنسية', 'en' => 'French Language Department', 'slug' => 'french-language-department' ], // PDF p.16
        [ 'ar' => 'قسم الترجمة', 'en' => 'Translation Department', 'slug' => 'translation-department' ], // PDF p.16
        [ 'ar' => 'قسم علم الاجتماع', 'en' => 'Sociology Department', 'slug' => 'sociology-department' ], // PDF p.16
        [ 'ar' => 'مرحلة ما بعد الدكتوراه', 'en' => 'Postdoctoral Stage', 'slug' => 'postdoctoral-stage' ], // PDF p.17
    ];

    foreach ( $departments as $department ) {
        theme_euss_upsert_translated_term( 'departments', $department );
    }

    $programs = [
        [ 'ar' => 'البرامج التأهيلية', 'en' => 'Preparatory Programs', 'slug' => 'preparatory-programs' ], // PDF p.8
        [ 'ar' => 'البكالوريوس', 'en' => 'Bachelor Programs', 'slug' => 'bachelor-programs' ], // PDF p.8
        [ 'ar' => 'الماجستير', 'en' => 'Master Programs', 'slug' => 'masters-programs' ], // PDF p.8
        [ 'ar' => 'الدراسات المهنية', 'en' => 'Professional Studies', 'slug' => 'professional-studies' ], // PDF p.9
        [ 'ar' => 'ما بعد الدكتوراه', 'en' => 'Postdoctoral Studies', 'slug' => 'postdoctoral-studies' ], // PDF p.9
    ];

    foreach ( $programs as $program ) {
        theme_euss_upsert_translated_term( 'programs', $program );
    }
}

function theme_euss_upsert_translated_term( $taxonomy, array $labels ) {
    $slug = sanitize_title( $labels['slug'] ?? $labels['en'] ?? $labels['ar'] );
    $term = get_term_by( 'slug', $slug, $taxonomy );

    if ( ! $term ) {
        $term_id = wp_insert_term(
            $labels['ar'],
            $taxonomy,
            [ 'slug' => $slug ]
        );

        if ( is_wp_error( $term_id ) ) {
            return;
        }

        $term_id = $term_id['term_id'];
    } else {
        $term_id = $term->term_id;
        wp_update_term( $term_id, $taxonomy, [ 'name' => $labels['ar'] ] );
    }

    if ( function_exists( 'pll_set_term_language' ) ) {
        pll_set_term_language( $term_id, 'ar' );
        $en_slug    = $slug . '-en';
        $en_term    = get_term_by( 'slug', $en_slug, $taxonomy );
        $en_term_id = 0;

        if ( ! $en_term ) {
            $en_insert = wp_insert_term(
                $labels['en'],
                $taxonomy,
                [ 'slug' => $en_slug ]
            );

            if ( is_wp_error( $en_insert ) ) {
                return;
            }

            $en_term_id = $en_insert['term_id'];
        } else {
            $en_term_id = $en_term->term_id;
            wp_update_term( $en_term_id, $taxonomy, [ 'name' => $labels['en'] ] );
        }

        pll_set_term_language( $en_term_id, 'en' );
        pll_save_term_translations( [ 'ar' => $term_id, 'en' => $en_term_id ] );
    }
}

function theme_euss_seed_posts() {
    $news_items = [
        [
            'slug'         => 'study-and-exams-update',
            'post_type'    => 'news',
            'translations' => [
                'ar' => [
                    'title'   => 'تحديث نظام الدراسة والامتحانات', // PDF p.18
                    'slug'    => 'study-and-exams-update-ar',
                    'content' => "<!-- wp:paragraph --><p>تُلزم الجامعة الطلبة المقيمين داخل السويد بالحضور الحضوري وأداء الامتحانات في مقر غوتنبورغ، مع إتاحة الدراسة عن بعد للطلبة خارج السويد عبر المنصة الافتراضية.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>يمكن للطلبة الدوليين أداء الاختبارات في السفارات السويدية أو الجامعات المتعاونة أو عبر ممثلي الجامعة، ويحق لهم إعادة الاختبار عند الحاجة.</p><!-- /wp:paragraph -->",
                ],
                'en' => [
                    'title'   => 'Study and Examination Update', // PDF p.18
                    'slug'    => 'study-and-exams-update-en',
                    'content' => "<!-- wp:paragraph --><p>Students residing in Sweden attend classes on campus in Gothenburg and complete assessments in person, while international learners engage remotely through the virtual platform.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Examinations may be hosted at Swedish embassies, partner universities, or accredited representatives abroad, and students are allowed a retake if they do not pass.</p><!-- /wp:paragraph -->",
                ],
            ],
        ],
        [
            'slug'         => 'international-recognition',
            'post_type'    => 'news',
            'translations' => [
                'ar' => [
                    'title'   => 'الاعتماد الدولي للشهادات', // PDF p.19-20
                    'slug'    => 'international-recognition-ar',
                    'content' => "<!-- wp:paragraph --><p>تصدر الجامعة شهاداتها المعترف بها في السويد مع إمكانية تصديقها من كاتب العدل السويدي ووزارة الخارجية والسفارات المعنية بنظام الأبوستيل.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>يمكن للطالب استلام نسخة معتمدة عبر البريد الدولي، وتدعم الجامعة اتفاقيات الاعتراف الأكاديمي والتوأمة العلمية مع مؤسسات عربية وأوروبية وأمريكية.</p><!-- /wp:paragraph -->",
                ],
                'en' => [
                    'title'   => 'International Certificate Recognition', // PDF p.19-20
                    'slug'    => 'international-recognition-en',
                    'content' => "<!-- wp:paragraph --><p>University degrees are issued in Sweden and may be authenticated by the Swedish notary public, Ministry of Foreign Affairs, and relevant embassies through the apostille process.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Learners can request certified copies via international mail, backed by academic recognition and twinning agreements with Arab, European, and American institutions.</p><!-- /wp:paragraph -->",
                ],
            ],
        ],
    ];

    foreach ( $news_items as $item ) {
        theme_euss_upsert_translated_post( $item );
    }

    $colleges = [
        [
            'slug'         => 'college-media-communication',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية الإعلام والاتصال', // PDF p.7
                    'slug'    => 'college-media-communication',
                    'content' => "<!-- wp:paragraph --><p>تعمل الكلية على إعداد إعلاميين قادرين على إنتاج المحتوى المتعدد المنصات باللغات العربية والإنجليزية والسويدية، مع برامج تدمج الاتصال المؤسسي والتقنيات الرقمية.</p><!-- /wp:paragraph -->",
                ],
                'en' => [
                    'title'   => 'College of Media and Communication', // PDF p.7
                    'slug'    => 'college-media-communication-en',
                    'content' => "<!-- wp:paragraph --><p>This college prepares multilingual media professionals to produce cross-platform content with strong corporate communication and digital technology skills.</p><!-- /wp:paragraph -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-education-psychology',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية العلوم التربوية والنفسية', // PDF p.7
                    'slug'    => 'college-education-psychology',
                    'content' => "<!-- wp:list --><ul><li>العلوم التربوية</li><li>علم النفس</li><li>الإرشاد النفسي والتوجيه التربوي</li><li>التربية الخاصة</li><li>العلوم الشرعية</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Educational and Psychological Sciences', // PDF p.7
                    'slug'    => 'college-education-psychology-en',
                    'content' => "<!-- wp:list --><ul><li>Educational Sciences</li><li>Psychology</li><li>Psychological Counseling and Educational Guidance</li><li>Special Education</li><li>Sharia Sciences</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-engineering-technology',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية الهندسة وتكنولوجيا الحاسبات', // PDF p.7
                    'slug'    => 'college-engineering-technology',
                    'content' => "<!-- wp:list --><ul><li>قسم الذكاء الاصطناعي</li><li>قسم الحاسوب والبرمجيات</li><li>هندسة الحاسبات</li><li>هندسة الفحص والسيطرة النوعية</li><li>الهندسة الكهربائية</li><li>إدارة المشاريع الهندسية</li><li>الهندسة الطبية الحيوية</li><li>هندسة الأجهزة الطبية</li><li>قسم التصنيع الزراعي</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Engineering and Computer Technology', // PDF p.7
                    'slug'    => 'college-engineering-technology-en',
                    'content' => "<!-- wp:list --><ul><li>Artificial Intelligence</li><li>Computer and Software Engineering</li><li>Computer Engineering</li><li>Inspection and Quality Control Engineering</li><li>Electrical Engineering</li><li>Engineering Project Management</li><li>Biomedical Engineering</li><li>Medical Devices Engineering</li><li>Agro-Industrial Engineering</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-arts-languages',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية الآداب واللغات', // PDF p.7
                    'slug'    => 'college-arts-languages',
                    'content' => "<!-- wp:list --><ul><li>قسم اللغة العربية</li><li>قسم اللغة الإنجليزية</li><li>قسم اللغة السويدية</li><li>قسم اللغة الفرنسية</li><li>قسم الترجمة</li><li>قسم علم الاجتماع</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Arts and Languages', // PDF p.7
                    'slug'    => 'college-arts-languages-en',
                    'content' => "<!-- wp:list --><ul><li>Arabic Language Department</li><li>English Language Department</li><li>Swedish Language Department</li><li>French Language Department</li><li>Translation Department</li><li>Sociology Department</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-graduate-research',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية الدراسات العليا والبحث العلمي', // PDF p.7
                    'slug'    => 'college-graduate-research',
                    'content' => "<!-- wp:paragraph --><p>تحتضن هذه الكلية برامج الماجستير والدكتوراه ومرحلة ما بعد الدكتوراه مع حاضنات بحثية لدعم مشاريع التنمية والابتكار.</p><!-- /wp:paragraph -->",
                ],
                'en' => [
                    'title'   => 'College of Graduate Studies and Scientific Research', // PDF p.7
                    'slug'    => 'college-graduate-research-en',
                    'content' => "<!-- wp:paragraph --><p>The college oversees master, doctoral, and postdoctoral pathways with research incubators that support development and innovation projects.</p><!-- /wp:paragraph -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-allied-medical-sciences',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية العلوم الطبية المساعدة', // PDF p.7
                    'slug'    => 'college-allied-medical-sciences',
                    'content' => "<!-- wp:list --><ul><li>قسم التمريض والخدمات الطبية</li><li>الصحة العامة</li><li>التغذية العلاجية</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Allied Medical Sciences', // PDF p.7
                    'slug'    => 'college-allied-medical-sciences-en',
                    'content' => "<!-- wp:list --><ul><li>Nursing and Medical Services</li><li>Public Health</li><li>Therapeutic Nutrition</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-law-political-sciences',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية القانون والعلوم السياسية', // PDF p.7
                    'slug'    => 'college-law-political-sciences',
                    'content' => "<!-- wp:list --><ul><li>القانون</li><li>العلوم السياسية</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Law and Political Sciences', // PDF p.7
                    'slug'    => 'college-law-political-sciences-en',
                    'content' => "<!-- wp:list --><ul><li>Law</li><li>Political Sciences</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
        [
            'slug'         => 'college-administration-economics',
            'post_type'    => 'colleges',
            'translations' => [
                'ar' => [
                    'title'   => 'كلية الإدارة والاقتصاد', // PDF p.7
                    'slug'    => 'college-administration-economics',
                    'content' => "<!-- wp:list --><ul><li>إدارة الأعمال</li><li>نظم المعلومات</li><li>العلوم المالية والمصرفية</li></ul><!-- /wp:list -->",
                ],
                'en' => [
                    'title'   => 'College of Administration and Economics', // PDF p.7
                    'slug'    => 'college-administration-economics-en',
                    'content' => "<!-- wp:list --><ul><li>Business Administration</li><li>Information Systems</li><li>Finance and Banking Sciences</li></ul><!-- /wp:list -->",
                ],
            ],
        ],
    ];

    foreach ( $colleges as $college ) {
        theme_euss_upsert_translated_post( $college );
    }
}

function theme_euss_upsert_translated_post( array $item ) {
    $translations = $item['translations'];
    $created      = [];

    foreach ( $translations as $lang => $data ) {
        $slug     = sanitize_title( $data['slug'] ?? ( $lang . '-' . $item['slug'] ) );
        $existing = get_posts(
            [
                'name'        => $slug,
                'post_type'   => $item['post_type'],
                'post_status' => 'any',
                'numberposts' => 1,
            ]
        );

        if ( $existing ) {
            $post_id = $existing[0]->ID;
            wp_update_post(
                [
                    'ID'           => $post_id,
                    'post_title'   => $data['title'],
                    'post_content' => $data['content'],
                    'post_status'  => 'publish',
                ]
            );
        } else {
            $post_id = wp_insert_post(
                [
                    'post_type'    => $item['post_type'],
                    'post_status'  => 'publish',
                    'post_title'   => $data['title'],
                    'post_name'    => $slug,
                    'post_content' => $data['content'],
                ]
            );
        }

        if ( function_exists( 'pll_set_post_language' ) ) {
            pll_set_post_language( $post_id, $lang );
        }

        $created[ $lang ] = $post_id;
    }

    if ( function_exists( 'pll_save_post_translations' ) && count( $created ) > 1 ) {
        pll_save_post_translations( $created );
    }
}

function theme_euss_seed_options() {
    update_option( 'euss_contact_phone', '+46 763091170' ); // PDF p.24
    update_option( 'euss_contact_email', 'info@edu.renita.se' ); // PDF p.24
    update_option( 'euss_contact_address', 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden' ); // PDF p.24
}
