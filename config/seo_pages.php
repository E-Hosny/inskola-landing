<?php

/**
 * Public SEO landing pages for subjects and stages actually offered.
 * Elementary + Intermediate only. No secondary pages.
 */
return [

    'math' => [
        'type' => 'subject',
        'subject' => 'math',
        'stages' => ['elementary', 'intermediate'],
        'related' => ['math-elementary', 'math-intermediate', 'science', 'elementary', 'intermediate'],
        'ar' => [
            'nav_label' => 'الرياضيات',
            'title' => 'مدرس رياضيات أونلاين للمنهج السعودي | إنسكولا',
            'meta_description' => 'احجز مدرس رياضيات أونلاين للمرحلة الابتدائية والمتوسطة وفق منهج وزارة التعليم السعودية. حصة مباشرة بـ 40 ريال مع شرح وتمارين ومتابعة.',
            'keywords' => 'مدرس رياضيات أونلاين, شرح رياضيات المنهج السعودي, معلم رياضيات خصوصي, حصص رياضيات أونلاين السعودية',
            'h1' => 'مدرس رياضيات أونلاين وفق المنهج السعودي',
            'intro' => 'تساعد إنسكولا طلاب الابتدائي والمتوسط على فهم الرياضيات عبر حصص مباشرة أونلاين مع معلمين ومعلمات ملمّين بمنهج وزارة التعليم.',
            'body' => [
                [
                    'heading' => 'لماذا يحتاج الطالب مدرس رياضيات خصوصي؟',
                    'text' => 'الرياضيات مادة تراكمية؛ أي ضعف في الجمع أو الكسور أو المعادلات يظهر لاحقاً في الاختبارات. الحصة الخصوصية تركز على نقاط الضعف وتعيد بناء الفهم خطوة بخطوة.',
                ],
                [
                    'heading' => 'ما الذي تشمله حصة الرياضيات؟',
                    'text' => 'شرح مباشر للمفهوم، أمثلة من أسلوب المنهج السعودي، تمارين أثناء الحصة، وملاحظات بسيطة تساعد ولي الأمر على المتابعة بعد الجلسة.',
                ],
                [
                    'heading' => 'المراحل المتوفرة',
                    'text' => 'نغطي المرحلة الابتدائية والمرحلة المتوسطة فقط. حدّد صف ابنك عند التواصل لنرشّح المعلم المناسب.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة فردية أونلاين',
                'شرح وفق منهج وزارة التعليم',
                'تمارين مركّزة على أخطاء الطالب',
                'سعر واضح: 40 ريال للحصة',
            ],
            'cta' => 'احجز حصة رياضيات الآن',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة رياضيات أونلاين عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Mathematics',
            'title' => 'Online Math Tutor for the Saudi Curriculum | Inskola',
            'meta_description' => 'Book an online math tutor for elementary and intermediate students aligned with the Saudi Ministry curriculum. Live lesson for 40 SAR with practice and follow-up.',
            'keywords' => 'online math tutor Saudi Arabia, Saudi curriculum math, private math teacher online',
            'h1' => 'Online Math Tutor Aligned with the Saudi Curriculum',
            'intro' => 'Inskola helps elementary and intermediate students understand math through live online lessons with teachers familiar with the Ministry curriculum.',
            'body' => [
                [
                    'heading' => 'Why book a private math tutor?',
                    'text' => 'Math builds on earlier skills. A focused private lesson closes gaps before they affect exams.',
                ],
                [
                    'heading' => 'What each lesson includes',
                    'text' => 'Live explanation, Saudi-curriculum style examples, practice during the session, and simple notes for parents.',
                ],
                [
                    'heading' => 'Available stages',
                    'text' => 'Elementary and intermediate only. Share your child’s grade when you contact us.',
                ],
            ],
            'bullets' => [
                'Live one-to-one online lessons',
                'Aligned with Ministry curriculum',
                'Practice focused on weak points',
                'Clear price: 40 SAR per lesson',
            ],
            'cta' => 'Book a math lesson',
            'whatsapp_text' => 'Hello, I want to book an online math lesson with Inskola',
        ],
    ],

    'science' => [
        'type' => 'subject',
        'subject' => 'science',
        'stages' => ['elementary', 'intermediate'],
        'related' => ['science-elementary', 'math', 'elementary', 'intermediate'],
        'ar' => [
            'nav_label' => 'العلوم',
            'title' => 'مدرس علوم أونلاين للمنهج السعودي | إنسكولا',
            'meta_description' => 'مدرس علوم أونلاين لطلاب الابتدائي والمتوسط في السعودية. حصص مباشرة وفق منهج وزارة التعليم بسعر 40 ريال للحصة.',
            'keywords' => 'مدرس علوم أونلاين, شرح علوم المنهج السعودي, معلم علوم خصوصي, حصص علوم أونلاين',
            'h1' => 'مدرس علوم أونلاين وفق المنهج السعودي',
            'intro' => 'نشرح مفاهيم العلوم بأسلوب مبسّط يناسب عمر الطالب، مع ربط الدرس بتمارين المنهج المدرسي في المرحلة الابتدائية والمتوسطة.',
            'body' => [
                [
                    'heading' => 'شرح واضح بدل الحفظ فقط',
                    'text' => 'كثير من الطلاب يحفظون تعريفات العلوم دون فهم. في إنسكولا نركز على الفهم ثم التطبيق حتى يثبت الدرس.',
                ],
                [
                    'heading' => 'مناسب للاختبارات والواجبات',
                    'text' => 'يمكن توجيه الحصة لمراجعة درس محدد، حل واجب، أو التحضير لاختبار قريب.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة أونلاين',
                'للمرحلة الابتدائية والمتوسطة',
                'تمارين ومتابعة بعد الشرح',
                '40 ريال للحصة الواحدة',
            ],
            'cta' => 'احجز حصة علوم',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة علوم أونلاين عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Science',
            'title' => 'Online Science Tutor for the Saudi Curriculum | Inskola',
            'meta_description' => 'Online science tutoring for elementary and intermediate students in Saudi Arabia. Live lessons aligned with the Ministry curriculum for 40 SAR.',
            'keywords' => 'online science tutor Saudi, Saudi curriculum science, private science teacher',
            'h1' => 'Online Science Tutor Aligned with the Saudi Curriculum',
            'intro' => 'We explain science concepts clearly for elementary and intermediate students, with practice tied to school lessons.',
            'body' => [
                [
                    'heading' => 'Understanding before memorizing',
                    'text' => 'Lessons focus on understanding ideas first, then applying them through practice.',
                ],
                [
                    'heading' => 'Help with homework and exams',
                    'text' => 'Use a lesson to review a topic, finish homework, or prepare for an upcoming test.',
                ],
            ],
            'bullets' => [
                'Live online lessons',
                'Elementary and intermediate stages',
                'Practice and follow-up',
                '40 SAR per lesson',
            ],
            'cta' => 'Book a science lesson',
            'whatsapp_text' => 'Hello, I want to book an online science lesson with Inskola',
        ],
    ],

    'english' => [
        'type' => 'subject',
        'subject' => 'english',
        'stages' => ['elementary', 'intermediate'],
        'related' => ['arabic', 'math', 'elementary', 'intermediate'],
        'ar' => [
            'nav_label' => 'اللغة الإنجليزية',
            'title' => 'مدرس إنجليزي أونلاين للمنهج السعودي | إنسكولا',
            'meta_description' => 'مدرس لغة إنجليزية أونلاين لطلاب الابتدائي والمتوسط وفق المنهج السعودي. حصة مباشرة بـ 40 ريال مع تركيز على القراءة والكتابة والفهم.',
            'keywords' => 'مدرس إنجليزي أونلاين, شرح اللغة الإنجليزية للمنهج السعودي, معلم إنجليزي خصوصي السعودية',
            'h1' => 'مدرس إنجليزي أونلاين وفق المنهج السعودي',
            'intro' => 'نساعد الطالب على تطوير مهارات اللغة الإنجليزية بما يتوافق مع منهجه المدرسي، عبر حصص مباشرة منظمة ومناسبة لعمره.',
            'body' => [
                [
                    'heading' => 'دعم المنهج المدرسي أولاً',
                    'text' => 'نبدأ من دروس المدرسة والواجبات ثم نبني المهارات تدريجياً: المفردات، القراءة، الكتابة، والاستيعاب.',
                ],
                [
                    'heading' => 'حصة مناسبة لمستوى الطالب',
                    'text' => 'سواء كان الطالب مبتدئاً أو يحتاج دعماً قبل الاختبار، نضبط أسلوب الحصة حسب مستواه الحالي.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة أونلاين',
                'ملاءمة للمنهج السعودي',
                'تركيز على نقاط الضعف',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز حصة إنجليزي',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة لغة إنجليزية أونلاين عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'English',
            'title' => 'Online English Tutor for the Saudi Curriculum | Inskola',
            'meta_description' => 'Online English tutoring for elementary and intermediate Saudi students. Live lessons for 40 SAR focused on reading, writing, and understanding.',
            'keywords' => 'online English tutor Saudi Arabia, Saudi curriculum English, private English teacher',
            'h1' => 'Online English Tutor Aligned with the Saudi Curriculum',
            'intro' => 'We help students improve English skills in line with their school curriculum through structured live lessons.',
            'body' => [
                [
                    'heading' => 'School curriculum first',
                    'text' => 'Lessons start from school topics and homework, then build vocabulary, reading, and writing.',
                ],
                [
                    'heading' => 'Matched to the student’s level',
                    'text' => 'We adapt the lesson to beginners or exam-focused support as needed.',
                ],
            ],
            'bullets' => [
                'Live online lessons',
                'Aligned with Saudi curriculum',
                'Focus on weak points',
                '40 SAR per lesson',
            ],
            'cta' => 'Book an English lesson',
            'whatsapp_text' => 'Hello, I want to book an online English lesson with Inskola',
        ],
    ],

    'arabic' => [
        'type' => 'subject',
        'subject' => 'arabic',
        'stages' => ['elementary', 'intermediate'],
        'related' => ['english', 'quran', 'elementary', 'intermediate'],
        'ar' => [
            'nav_label' => 'لغتي',
            'title' => 'مدرس لغتي أونلاين للمنهج السعودي | إنسكولا',
            'meta_description' => 'شرح لغتي أونلاين لطلاب الابتدائي والمتوسط وفق منهج وزارة التعليم. حصص مباشرة مع معلم أو معلمة بسعر 40 ريال.',
            'keywords' => 'شرح لغتي, مدرس لغتي أونلاين, معلم عربي خصوصي, حصص لغتي المنهج السعودي',
            'h1' => 'مدرس لغتي أونلاين وفق المنهج السعودي',
            'intro' => 'نقدم حصصاً مباشرة لمادة لغتي تساعد الطالب على فهم النصوص، القواعد، والإملاء بطريقة مرتبطة بمنهجه المدرسي.',
            'body' => [
                [
                    'heading' => 'تحسين القراءة والكتابة معاً',
                    'text' => 'الحصة تجمع بين فهم المقروء وتمارين الكتابة حتى يتحسن الطالب في الواجبات والاختبارات.',
                ],
                [
                    'heading' => 'مناسب للابتدائي والمتوسط',
                    'text' => 'نغطي احتياجات المرحلة الابتدائية والمتوسطة فقط، مع تبسيط الشرح حسب الصف.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة أونلاين',
                'تركيز على منهج لغتي',
                'تمارين قراءة وكتابة',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز حصة لغتي',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة لغتي أونلاين عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Arabic (Lughati)',
            'title' => 'Online Arabic Tutor for the Saudi Curriculum | Inskola',
            'meta_description' => 'Online Arabic (Lughati) lessons for elementary and intermediate students aligned with the Saudi curriculum. Live tutoring for 40 SAR.',
            'keywords' => 'online Arabic tutor Saudi, Lughati tutoring, Saudi curriculum Arabic',
            'h1' => 'Online Arabic Tutor Aligned with the Saudi Curriculum',
            'intro' => 'Live Arabic lessons that help students with reading comprehension, grammar, and writing tied to school work.',
            'body' => [
                [
                    'heading' => 'Reading and writing together',
                    'text' => 'Each lesson combines comprehension and writing practice for stronger school results.',
                ],
                [
                    'heading' => 'Elementary and intermediate',
                    'text' => 'We currently serve elementary and intermediate stages only.',
                ],
            ],
            'bullets' => [
                'Live online lessons',
                'Focused on Lughati curriculum',
                'Reading and writing practice',
                '40 SAR per lesson',
            ],
            'cta' => 'Book an Arabic lesson',
            'whatsapp_text' => 'Hello, I want to book an online Arabic lesson with Inskola',
        ],
    ],

    'quran' => [
        'type' => 'subject',
        'subject' => 'quran',
        'stages' => ['elementary', 'intermediate'],
        'related' => ['arabic', 'elementary', 'intermediate'],
        'ar' => [
            'nav_label' => 'القرآن الكريم',
            'title' => 'معلم قرآن أونلاين للأطفال | إنسكولا',
            'meta_description' => 'حصص قرآن كريم أونلاين لطلاب الابتدائي والمتوسط مع معلمين ومعلمات مؤهلين. حصة مباشرة بـ 40 ريال عبر إنسكولا.',
            'keywords' => 'معلم قرآن أونلاين, حصص قرآن للأطفال, تحفيظ قرآن أونلاين السعودية',
            'h1' => 'حصص قرآن كريم أونلاين للأطفال',
            'intro' => 'نوفر حصصاً مباشرة آمنة لتلاوة وتحفيظ القرآن الكريم بأسلوب يناسب الطلاب في المرحلة الابتدائية والمتوسطة.',
            'body' => [
                [
                    'heading' => 'بيئة مناسبة للأطفال',
                    'text' => 'الحصص مباشرة ومنظمة، مع اهتمام بتصحيح التلاوة وتشجيع الطالب دون ضغط.',
                ],
                [
                    'heading' => 'متابعة بسيطة لولي الأمر',
                    'text' => 'يمكنك معرفة ما راجعه الطالب وما يحتاج إلى تثبيت في الحصص التالية.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة أونلاين',
                'مناسبة للأطفال',
                'معلمون ومعلمات مؤهلون',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز حصة قرآن',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة قرآن كريم أونلاين عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Quran',
            'title' => 'Online Quran Tutor for Kids | Inskola',
            'meta_description' => 'Online Quran lessons for elementary and intermediate students with qualified teachers. Live session for 40 SAR with Inskola.',
            'keywords' => 'online Quran tutor Saudi, Quran lessons for kids, private Quran teacher online',
            'h1' => 'Online Quran Lessons for Children',
            'intro' => 'Safe live sessions for Quran recitation and memorization suited to elementary and intermediate students.',
            'body' => [
                [
                    'heading' => 'Child-friendly sessions',
                    'text' => 'Structured live lessons focused on correct recitation and encouragement.',
                ],
                [
                    'heading' => 'Simple parent follow-up',
                    'text' => 'Know what was reviewed and what needs reinforcement next time.',
                ],
            ],
            'bullets' => [
                'Live online lessons',
                'Suitable for children',
                'Qualified teachers',
                '40 SAR per lesson',
            ],
            'cta' => 'Book a Quran lesson',
            'whatsapp_text' => 'Hello, I want to book an online Quran lesson with Inskola',
        ],
    ],

    'elementary' => [
        'type' => 'stage',
        'subject' => null,
        'stages' => ['elementary'],
        'related' => ['math-elementary', 'science-elementary', 'math', 'arabic', 'english'],
        'ar' => [
            'nav_label' => 'المرحلة الابتدائية',
            'title' => 'حصص خصوصية أونلاين للمرحلة الابتدائية | إنسكولا',
            'meta_description' => 'حصص خصوصية أونلاين لطلاب المرحلة الابتدائية في السعودية وفق منهج وزارة التعليم. رياضيات، لغتي، إنجليزي، علوم والمزيد بـ 40 ريال للحصة.',
            'keywords' => 'حصص خصوصية ابتدائي, مدرس خصوصي ابتدائي أونلاين, معلم خصوصي للمنهج السعودي ابتدائي',
            'h1' => 'حصص خصوصية أونلاين للمرحلة الابتدائية',
            'intro' => 'إنسكولا تقدم حصصاً مباشرة لطلاب الابتدائي مع معلمين ومعلمات يفهمون احتياجات هذه المرحلة ويثبّتون الدروس بأسلوب واضح.',
            'body' => [
                [
                    'heading' => 'مواد المرحلة الابتدائية المتوفرة',
                    'text' => 'الرياضيات، لغتي، اللغة الإنجليزية، العلوم، الدراسات الاجتماعية، والقرآن الكريم.',
                ],
                [
                    'heading' => 'كيف تحجز؟',
                    'text' => 'تواصل عبر واتساب أو نموذج الحجز، أخبرنا بالصف والمادة، ونرتب لك حصة مباشرة في وقت مناسب.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة فردية',
                'وفق منهج وزارة التعليم',
                'مناسبة لأطفال الابتدائي',
                '40 ريال للحصة الواحدة',
            ],
            'cta' => 'احجز حصة للابتدائي',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة خصوصية للمرحلة الابتدائية عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Elementary',
            'title' => 'Online Private Tutoring for Elementary Students | Inskola',
            'meta_description' => 'Online private lessons for elementary students in Saudi Arabia aligned with the Ministry curriculum. Math, Arabic, English, Science and more for 40 SAR.',
            'keywords' => 'elementary private tutor Saudi, online elementary tutoring, Saudi curriculum elementary',
            'h1' => 'Online Private Lessons for Elementary Students',
            'intro' => 'Live lessons for elementary students with teachers who explain clearly and reinforce school topics.',
            'body' => [
                [
                    'heading' => 'Available elementary subjects',
                    'text' => 'Math, Arabic, English, Science, Social Studies, and Quran.',
                ],
                [
                    'heading' => 'How to book',
                    'text' => 'Contact us on WhatsApp or the booking form with grade and subject, and we schedule a live lesson.',
                ],
            ],
            'bullets' => [
                'Live one-to-one lessons',
                'Ministry curriculum aligned',
                'Designed for elementary students',
                '40 SAR per lesson',
            ],
            'cta' => 'Book an elementary lesson',
            'whatsapp_text' => 'Hello, I want to book an elementary private lesson with Inskola',
        ],
    ],

    'intermediate' => [
        'type' => 'stage',
        'subject' => null,
        'stages' => ['intermediate'],
        'related' => ['math-intermediate', 'math', 'science', 'english', 'arabic'],
        'ar' => [
            'nav_label' => 'المرحلة المتوسطة',
            'title' => 'حصص خصوصية أونلاين للمرحلة المتوسطة | إنسكولا',
            'meta_description' => 'حصص خصوصية أونلاين لطلاب المرحلة المتوسطة في السعودية وفق منهج وزارة التعليم. مدرس خصوصي أونلاين بـ 40 ريال للحصة.',
            'keywords' => 'حصص خصوصية متوسط, مدرس خصوصي متوسط أونلاين, معلم خصوصي المرحلة المتوسطة السعودية',
            'h1' => 'حصص خصوصية أونلاين للمرحلة المتوسطة',
            'intro' => 'نساعد طلاب المتوسط على تثبيت المواد الأساسية عبر حصص مباشرة مركّزة وفق المنهج السعودي.',
            'body' => [
                [
                    'heading' => 'مواد المرحلة المتوسطة',
                    'text' => 'الرياضيات، العلوم، اللغة الإنجليزية، لغتي، الدراسات الاجتماعية، والقرآن الكريم.',
                ],
                [
                    'heading' => 'قبل الاختبارات أو طوال الترم',
                    'text' => 'يمكنك حجز حصة لمراجعة سريعة قبل الاختبار، أو ترتيب حصص منتظمة لتقوية المستوى خلال الترم.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة أونلاين',
                'شرح وفق المنهج السعودي',
                'مناسب للأول والثاني والثالث متوسط',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز حصة للمتوسط',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة خصوصية للمرحلة المتوسطة عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Intermediate',
            'title' => 'Online Private Tutoring for Intermediate Students | Inskola',
            'meta_description' => 'Online private lessons for intermediate students in Saudi Arabia aligned with the Ministry curriculum. Live tutoring for 40 SAR per lesson.',
            'keywords' => 'intermediate private tutor Saudi, online intermediate tutoring, Saudi curriculum intermediate',
            'h1' => 'Online Private Lessons for Intermediate Students',
            'intro' => 'Live focused lessons that help intermediate students strengthen core school subjects.',
            'body' => [
                [
                    'heading' => 'Available intermediate subjects',
                    'text' => 'Math, Science, English, Arabic, Social Studies, and Quran.',
                ],
                [
                    'heading' => 'Before exams or during the term',
                    'text' => 'Book a quick review before a test or regular lessons for ongoing improvement.',
                ],
            ],
            'bullets' => [
                'Live online lessons',
                'Saudi curriculum aligned',
                'Suitable for intermediate grades',
                '40 SAR per lesson',
            ],
            'cta' => 'Book an intermediate lesson',
            'whatsapp_text' => 'Hello, I want to book an intermediate private lesson with Inskola',
        ],
    ],

    'math-elementary' => [
        'type' => 'combo',
        'subject' => 'math',
        'stages' => ['elementary'],
        'related' => ['math', 'math-intermediate', 'elementary', 'science-elementary'],
        'ar' => [
            'nav_label' => 'رياضيات ابتدائي',
            'title' => 'مدرس رياضيات للمرحلة الابتدائية أونلاين | إنسكولا',
            'meta_description' => 'مدرس رياضيات أونلاين لطلاب الابتدائي في السعودية. شرح وفق منهج وزارة التعليم مع تمارين ومتابعة. الحصة بـ 40 ريال.',
            'keywords' => 'مدرس رياضيات للمرحلة الابتدائية, شرح رياضيات ابتدائي, معلم رياضيات خصوصي ابتدائي أونلاين',
            'h1' => 'مدرس رياضيات للمرحلة الابتدائية أونلاين',
            'intro' => 'حصص رياضيات مباشرة تساعد طلاب الابتدائي على فهم العمليات الأساسية وبناء ثقة قبل الواجبات والاختبارات.',
            'body' => [
                [
                    'heading' => 'مناسب لصفوف الابتدائي',
                    'text' => 'سواء كان الطالب في الصفوف الأولى أو العليا من الابتدائي، نضبط الشرح حسب الصف والدرس المطلوب.',
                ],
                [
                    'heading' => 'طريقة الحجز',
                    'text' => 'أرسل صف الطالب والدرس الذي يحتاج مساعدة، واحجز حصة مباشرة عبر واتساب أو نموذج التواصل.',
                ],
            ],
            'bullets' => [
                'شرح مبسّط حسب عمر الطالب',
                'تمارين أثناء الحصة',
                'وفق المنهج السعودي',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز رياضيات ابتدائي',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة رياضيات للمرحلة الابتدائية عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Elementary Math',
            'title' => 'Online Elementary Math Tutor | Inskola',
            'meta_description' => 'Online math tutor for elementary students in Saudi Arabia. Ministry curriculum aligned lessons with practice for 40 SAR.',
            'keywords' => 'elementary math tutor online Saudi, private math teacher elementary',
            'h1' => 'Online Math Tutor for Elementary Students',
            'intro' => 'Live math lessons that help elementary students understand basics and gain confidence before homework and exams.',
            'body' => [
                [
                    'heading' => 'Matched to elementary grades',
                    'text' => 'We adapt the explanation to the student’s grade and the exact school topic.',
                ],
                [
                    'heading' => 'How to book',
                    'text' => 'Share the grade and topic, then book a live lesson via WhatsApp or the contact form.',
                ],
            ],
            'bullets' => [
                'Age-appropriate explanation',
                'Practice during the lesson',
                'Saudi curriculum aligned',
                '40 SAR per lesson',
            ],
            'cta' => 'Book elementary math',
            'whatsapp_text' => 'Hello, I want to book an elementary math lesson with Inskola',
        ],
    ],

    'math-intermediate' => [
        'type' => 'combo',
        'subject' => 'math',
        'stages' => ['intermediate'],
        'related' => ['math', 'math-elementary', 'intermediate', 'science'],
        'ar' => [
            'nav_label' => 'رياضيات متوسط',
            'title' => 'مدرس رياضيات للمرحلة المتوسطة أونلاين | إنسكولا',
            'meta_description' => 'مدرس رياضيات أونلاين لطلاب المتوسط وفق المنهج السعودي. حصص مباشرة لحل الضعف قبل الاختبارات بسعر 40 ريال.',
            'keywords' => 'مدرس رياضيات للمرحلة المتوسطة, شرح رياضيات متوسط, معلم رياضيات خصوصي متوسط أونلاين',
            'h1' => 'مدرس رياضيات للمرحلة المتوسطة أونلاين',
            'intro' => 'نركز على مفاهيم المتوسط مثل الجبر والهندسة والكسور والمعادلات عبر حصص مباشرة مرتبطة بالمنهج المدرسي.',
            'body' => [
                [
                    'heading' => 'تقوية قبل الاختبارات',
                    'text' => 'يمكن تخصيص الحصة لمراجعة وحدة كاملة أو حل نماذج وأسئلة متكررة يخطئ فيها الطالب.',
                ],
                [
                    'heading' => 'متابعة واضحة',
                    'text' => 'يعرف ولي الأمر ما تم شرحه وما يحتاج إلى تمرين إضافي في الحصة التالية.',
                ],
            ],
            'bullets' => [
                'حصص مباشرة فردية',
                'تركيز على منهج المتوسط',
                'تمارين وأسئلة تطبيقية',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز رياضيات متوسط',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة رياضيات للمرحلة المتوسطة عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Intermediate Math',
            'title' => 'Online Intermediate Math Tutor | Inskola',
            'meta_description' => 'Online math tutor for intermediate students aligned with the Saudi curriculum. Live lessons for 40 SAR.',
            'keywords' => 'intermediate math tutor online Saudi, private math teacher intermediate',
            'h1' => 'Online Math Tutor for Intermediate Students',
            'intro' => 'Live lessons focused on intermediate math topics tied directly to school curriculum needs.',
            'body' => [
                [
                    'heading' => 'Exam-focused support',
                    'text' => 'Use a lesson to review a unit or practice the question types your child struggles with.',
                ],
                [
                    'heading' => 'Clear follow-up',
                    'text' => 'Parents know what was covered and what needs more practice next time.',
                ],
            ],
            'bullets' => [
                'Live one-to-one lessons',
                'Intermediate curriculum focus',
                'Applied practice questions',
                '40 SAR per lesson',
            ],
            'cta' => 'Book intermediate math',
            'whatsapp_text' => 'Hello, I want to book an intermediate math lesson with Inskola',
        ],
    ],

    'science-elementary' => [
        'type' => 'combo',
        'subject' => 'science',
        'stages' => ['elementary'],
        'related' => ['science', 'elementary', 'math-elementary'],
        'ar' => [
            'nav_label' => 'علوم ابتدائي',
            'title' => 'مدرس علوم للمرحلة الابتدائية أونلاين | إنسكولا',
            'meta_description' => 'مدرس علوم أونلاين لطلاب الابتدائي وفق منهج وزارة التعليم السعودية. حصة مباشرة بـ 40 ريال مع شرح مبسّط وتمارين.',
            'keywords' => 'مدرس علوم للمرحلة الابتدائية, شرح علوم ابتدائي, معلم علوم خصوصي أونلاين',
            'h1' => 'مدرس علوم للمرحلة الابتدائية أونلاين',
            'intro' => 'نشرح دروس العلوم لطلاب الابتدائي بلغة قريبة من عمرهم، مع ربط الشرح بأمثلة وتمارين المنهج.',
            'body' => [
                [
                    'heading' => 'فهم المفاهيم الأساسية',
                    'text' => 'الحصة تساعد الطالب على استيعاب الفكرة بدل حفظ النص فقط، مما يحسّن أداءه في الواجبات والاختبارات.',
                ],
                [
                    'heading' => 'احجز خلال دقائق',
                    'text' => 'تواصل معنا بالصف والدرس المطلوب، ونرتب حصة مباشرة في أقرب وقت مناسب.',
                ],
            ],
            'bullets' => [
                'شرح مبسّط للأطفال',
                'وفق المنهج السعودي',
                'تمارين أثناء الحصة',
                '40 ريال للحصة',
            ],
            'cta' => 'احجز علوم ابتدائي',
            'whatsapp_text' => 'السلام عليكم، أرغب بحجز حصة علوم للمرحلة الابتدائية عبر إنسكولا',
        ],
        'en' => [
            'nav_label' => 'Elementary Science',
            'title' => 'Online Elementary Science Tutor | Inskola',
            'meta_description' => 'Online science tutor for elementary students aligned with the Saudi Ministry curriculum. Live lesson for 40 SAR.',
            'keywords' => 'elementary science tutor online Saudi, private science teacher elementary',
            'h1' => 'Online Science Tutor for Elementary Students',
            'intro' => 'Age-appropriate live science lessons tied to the Saudi elementary curriculum.',
            'body' => [
                [
                    'heading' => 'Understand core ideas',
                    'text' => 'We focus on understanding concepts, not only memorizing text.',
                ],
                [
                    'heading' => 'Book in minutes',
                    'text' => 'Share the grade and topic and we schedule a live lesson.',
                ],
            ],
            'bullets' => [
                'Child-friendly explanation',
                'Saudi curriculum aligned',
                'Practice during the lesson',
                '40 SAR per lesson',
            ],
            'cta' => 'Book elementary science',
            'whatsapp_text' => 'Hello, I want to book an elementary science lesson with Inskola',
        ],
    ],

];
