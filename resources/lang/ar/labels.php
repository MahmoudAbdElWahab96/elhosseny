<?php
return [
    'general' => [
        'all' => 'الكل',
        'yes' => 'نعم',
        'no' => 'لا',
        'custom' => 'مخصص',
        'actions' => 'أجراءات',
        'active' => 'نشيط',
        'buttons' => [
            'save' => 'حفظ',
            'update' => 'تحديث',
        ],
        'hide' => 'إخفاء',
        'inactive' => 'غير نشط',
        'none' => 'لا يوجد',
        'show' => 'تبين',
        'toggle_navigation' => 'تبديل التنقل',
    ],
    'backend' => [
        'branches' => [
            'view' => 'عرض الفروع',
            'management' => 'اداره الفروع',
            'create' => 'انشاء',
            'edit' => 'تعديل'
        ],
        'openingBalance' => [
            'create' => 'انشاء ارصده افتتاحيه'
        ],
        'sales_channel' => [
            'view' => 'عرض قناه السوق'
        ],
        'profile_updated' => 'تم تحديث ملفك الشخصي.',
        'access' => [
            'roles' =>
                [
                    'create' => 'إنشاء دور',
                    'edit' => 'تحرير الدور',
                    'management' => 'إدارة الأدوار',
                    'table' =>
                        [
                            'number_of_users' => 'عدد المستخدمين',
                            'permissions' => 'صلاحيات',
                            'role' => 'وظيفة',
                            'sort' => 'فرز',
                            'total' => 'مجموع الأدوار | إجمالي الأدوار',
                        ],
                ],
            'permissions' =>
                [
                    'create' => 'إنشاء إذن',
                    'edit' => 'تحرير الإذن',
                    'management' => 'إدارة الإذن',
                    'table' =>
                        [
                            'permission' => 'الإذن',
                            'display_name' => 'اسم العرض',
                            'sort' => 'فرز',
                            'status' => 'الحالة',
                            'total' => 'مجموع الأدوار | إجمالي الأدوار',
                        ],
                ],
            'users' =>
                [
                    'active' => 'الشركات النشطة',
                    'all_permissions' => 'جميع الأذونات',
                    'change_password' => 'تغيير كلمة السر',
                    'change_password_for' => 'تغيير كلمة المرور لـ: المستخدم',
                    'create' => 'إنشاء مستخدم',
                    'deactivated' => 'الشركات المعطلة',
                    'deleted' => 'الشركات المحذوفة',
                    'edit' => 'تحرير العضو',
                    'edit-profile' => 'تعديل الملف الشخصي',
                    'management' => 'إدارة الشركة',
                    'no_permissions' => 'لا أذونات',
                    'no_roles' => 'لا توجد أدوار لتعيينها.',
                    'permissions' => 'أذونات',
                    'table' =>
                        [
                            'confirmed' => 'تم تأكيد',
                            'created' => 'انشئت',
                            'email' => 'البريد الإلكتروني',
                            'id' => 'ال ID',
                            'last_updated' => 'آخر تحديث',
                            'first_name' => 'الاسم الاول',
                            'last_name' => 'الاسم الاخير',
                            'no_deactivated' => 'لا توجد شركات معطلة',
                            'no_deleted' => 'لا توجد شركات محذوفة',
                            'roles' => 'الأدوار',
                            'total' => 'إجمالي المستخدم | إجمالي المستخدمين',
                        ],
                    'tabs' =>
                        [
                            'titles' =>
                                [
                                    'overview' => 'نظرة عامة',
                                    'history' => 'التاريخ',
                                ],
                            'content' =>
                                [
                                    'overview' =>
                                        [
                                            'avatar' => 'الصورة الرمزية',
                                            'confirmed' => 'تم تأكيد',
                                            'created_at' => 'أنشئت في',
                                            'deleted_at' => 'تم الحذف في',
                                            'email' => 'البريد الإلكتروني',
                                            'last_updated' => 'آخر تحديث',
                                            'name' => 'اسم',
                                            'status' => 'الحالة',
                                        ],
                                ],
                        ],
                    'view' => 'عرض المستخدم',
                ],
        ],
        'pages' => [
            'create' => 'إنشاء صفحة',
            'edit' => 'تعديل الصفحة',
            'management' => 'إدارة الصفحة',
            'title' => 'الصفحات',
            'table' =>
                [
                    'title' => 'عنوان',
                    'status' => 'الحالة',
                    'createdat' => 'أنشئت في',
                    'updatedat' => 'تم التحديث في',
                    'createdby' => 'انشأ من قبل',
                    'all' => 'الكل',
                ],
        ],
        'blogcategories' => [
            'create' => 'إنشاء فئة مدونة',
            'edit' => 'تحرير فئة المدونة',
            'management' => 'إدارة فئة المدونة',
            'table' =>
                [
                    'title' => 'فئة المدونة',
                    'status' => 'الحالة',
                    'createdat' => 'أنشئت في',
                    'createdby' => 'انشأ من قبل',
                    'all' => 'الكل',
                ],
        ],
        'blogtags' => [
            'create' => 'إنشاء علامة مدونة',
            'edit' => 'تحرير علامة المدونة',
            'management' => 'إدارة علامات المدونة',
            'table' =>
                [
                    'title' => 'علامة المدونة',
                    'status' => 'الحالة',
                    'createdat' => 'أنشئت في',
                    'createdby' => 'انشأ من قبل',
                    'all' => 'الكل',
                ],
        ],
        'blogs' => [
            'create' => 'انشاء مدونة',
            'edit' => 'تحرير مدونة',
            'management' => 'إدارة المدونة',
            'table' =>
                [
                    'title' => 'مدونة',
                    'publish' => 'PublishDateTime',
                    'status' => 'الحالة',
                    'createdat' => 'أنشئت في',
                    'createdby' => 'انشأ من قبل',
                    'all' => 'الكل',
                ],
        ],
        'settings' => [
            'edit' => 'تحرير الإعدادات',
            'management' => 'إدارة الإعدادات',
            'title' => 'الإعدادات',
            'seo' => 'إعدادات الشركة وتحسين محركات البحث',
            'companydetails' => 'تفاصيل الاتصال بالشركة',
            'mail' => 'إعدادات البريد',
            'footer' => 'إعدادات التذييل',
            'terms' => 'إعدادات الشروط والأحكام',
            'google' => 'كود جوجل تحليلات المسار',
            'social' => 'روابط وسائل التواصل الاجتماعي',
            'home' => 'إعدادات الصفحة الرئيسية',
            'intro' => 'مقدمة',
            'section' => 'الجزء',
        ],
        'faqs' => [
            'create' => 'إنشاء الأسئلة الشائعة',
            'edit' => 'تحرير الأسئلة المتداولة',
            'management' => 'إدارة الأسئلة الشائعة',
            'table' =>
                [
                    'title' => 'الأسئلة الشائعة',
                    'publish' => 'PublishDateTime',
                    'status' => 'الحالة',
                    'createdat' => 'أنشئت في',
                    'createdby' => 'انشأ من قبل',
                    'answer' => 'إجابة',
                    'question' => 'سؤال',
                    'updatedat' => 'تم التحديث في',
                    'all' => 'الكل',
                ],
        ],
        'menus' => [
            'create' => 'إنشاء قائمة',
            'edit' => 'عدل القائمة',
            'management' => 'إدارة القائمة',
            'title' => 'القوائم',
            'table' =>
                [
                    'name' => 'اسم',
                    'type' => 'اكتب',
                    'createdat' => 'أنشئت في',
                    'createdby' => 'انشأ من قبل',
                    'all' => 'الكل',
                ],
            'field' =>
                [
                    'name' => 'اسم',
                    'type' => 'اكتب',
                    'items' => 'عناصر القائمة',
                    'url' => 'URL',
                    'url_type' => 'نوع URL',
                    'url_types' =>
                        [
                            'route' => 'طريق',
                            'static' => 'ثابتة',
                        ],
                    'open_in_new_tab' => 'افتح URL في علامة تبويب جديدة',
                    'view_permission_id' => 'الإذن',
                    'icon' => 'فئة الرمز',
                    'icon_title' => 'الخط الخط رهيبة. على سبيل المثال. تحرير fa',
                ],
        ],
        'modules' => [
            'create' => 'إنشاء وحدة',
            'management' => 'إدارة الوحدة',
            'title' => 'وحدة',
            'edit' => 'تحرير الوحدة',
            'table' =>
                [
                    'name' => 'اسم وحدة',
                    'url' => 'مسار عرض الوحدة النمطية',
                    'view_permission_id' => 'عرض الإذن',
                    'created_by' => 'انشأ من قبل',
                ],
            'form' =>
                [
                    'name' => 'اسم وحدة',
                    'url' => 'عرض المسار',
                    'view_permission_id' => 'عرض الإذن',
                    'directory_name' => 'اسم الدليل',
                    'namespace' => 'مساحة الاسم',
                    'model_name' => 'اسم النموذج',
                    'controller_name' => 'اسم وحدة التحكم',
                    'resource_controller' => 'تحكم كبير',
                    'table_controller_name' => 'اسم وحدة التحكم',
                    'table_name' => 'اسم الجدول',
                    'route_name' => 'اسم المسار',
                    'route_controller_name' => 'اسم وحدة التحكم',
                    'resource_route' => 'مسارات حيلة',
                    'views_directory' => 'اسم الدليل',
                    'index_file' => 'فهرس',
                    'create_file' => 'انشاء',
                    'edit_file' => 'تعديل',
                    'form_file' => 'شكل',
                    'repo_name' => 'اسم المستودع',
                    'event' => 'اسم الحدث',
                ],
        ],
        'plans' => [
            'create' => 'إنشاء خطة',
            'edit' => 'تعديل الخطة',
            'management' => 'إدارة الخطة',
            'feature' => 'ميزات الخطة',
            'title' => 'الخطط',
            'table' =>
                [
                    'id' => 'كود الخطه',
                    'createdat' => 'أنشئت في',
                    'invoice_period' => 'فترة الفاتورة',
                    'invoice_interval' => 'الفاصل الزمني للفاتورة',
                    'order' => 'خطة ترتيب العرض',
                    'max_employee' => 'تسجيل الموظف الأقصى',
                ],
        ],
        'geos' => [
            'create' => 'إنشاء جيو',
            'edit' => 'تحرير Geo',
            'management' => 'الإدارة الجغرافية',
            'title' => 'Geos',
            'table' =>
                [
                    'id' => 'كود الجيو',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'customers' => [
            'create' => 'إنشاء عميل',
            'edit' => 'تحرير العميل',
            'management' => 'ادارة الزبائن',
            'title' => 'الزبائن',
            'view' => 'عرض العميل',
            'table' =>
                [
                    'id' => 'كود العميل',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'customergroups' => [
            'create' => 'إنشاء مجموعة عملاء',
            'edit' => 'تحرير مجموعة العملاء',
            'management' => 'إدارة مجموعة العملاء',
            'title' => 'مجموعات العملاء',
            'view' => 'عرض مجموعة العملاء',
            'table' =>
                [
                    'id' => 'كود مجموعات العملاء',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'warehouses' => [
            'create' => 'إنشاء مستودع',
            'edit' => 'تحرير المستودع',
            'management' => 'إدارة المستودعات',
            'title' => 'المستودعات',
            'view' => 'عرض المستودع',
            'table' =>
                [
                    'id' => 'كود المستودعات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'productcategories' => [
            'create' => 'إنشاء فئة المنتج',
            'edit' => 'تحرير فئة المنتج',
            'management' => 'إدارة فئات المنتجات',
            'title' => 'فئات المنتجات',
            'view' => 'عرض فئة المنتج',
            'table' =>
                [
                    'id' => 'كود فئات المنتجات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'products' => [
            'create' => 'إنشاء منتج',
            'edit' => 'تحرير المنتج',
            'management' => 'ادارة المنتج',
            'title' => 'منتجات',
            'view' => 'عرض المنتج',
            'table' =>
                [
                    'id' => 'كود المنتجات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'invoices' => [
            'create' => 'إنشاء فاتورة',
            'edit' => 'تحرير الفاتورة',
            'management' => 'فواتير المبيعات الرئيسية',
            'pos_management' => 'فواتير نقاط البيع',
            'title' => 'فواتير',
            'view' => 'عرض الفاتورة',
            'table' =>
                [
                    'id' => 'كود الفواتير',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'orderedSupply' => [
            'create' => 'إنشاء امر توريد',
            'edit' => 'تحرير امر التوريد',
            'management' => 'امر التوريد الرئيسي',
            'pos_management' => 'امر التوريد نقاط البيع',
            'title' => 'امر لتوريد',
            'view' => 'عرض امر التوريد',
            'table' =>
                [
                    'id' => 'كود امر التوريد',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'additionals' => [
            'create' => 'إنشاء ضريبة وخصم',
            'edit' => 'تحرير الضريبة والخصم',
            'management' => 'إدارة الضرائب والخصم',
            'title' => 'الضريبة والخصم',
            'view' => 'عرض الضرائب والخصم',
        ],
        'currencies' => [
            'create' => 'إنشاء عملة',
            'edit' => 'تحرير العملة',
            'management' => 'إدارة العملات',
            'title' => 'العملات',
            'view' => 'عرض العملة',
            'table' =>
                [
                    'id' => 'كود العملات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'terms' => [
            'create' => 'إنشاء شروط',
            'edit' => 'تحرير الشروط',
            'management' => 'إدارة الشروط',
            'title' => 'شروط',
            'view' => 'عرض الشروط',
            'table' =>
                [
                    'id' => 'كود الشروط',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'customfields' => [
            'create' => 'إنشاء حقل مخصص',
            'edit' => 'تحرير الحقل المخصص',
            'management' => 'إدارة الحقول المخصصة',
            'title' => 'الحقول المخصصة',
            'view' => 'عرض الحقل المخصص',
            'table' =>
                [
                    'id' => 'كود الحقول',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'prefixes' => [
            'edit' => 'تحرير البادئة',
            'management' => 'إدارة البادئة',
            'title' => 'البادئات',
            'table' =>
                [
                    'id' => 'ال ID',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'accounts' => [
            'create' => 'إنشاء حساب',
            'edit' => 'تحرير الحساب',
            'management' => 'ادارة الحساب',
            'title' => 'حسابات',
            'view' => 'عرض الحساب',
            'table' =>
                [
                    'id' => 'كود الحسابات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'transactions' => [
            'create' => 'إنشاء حركة',
            'edit' => 'تحرير الحركات',
            'management' => 'ادارة العمليات التجارية',
            'title' => 'الحركات',
            'view' => 'عرض الحركة',
            'table' =>
                [
                    'id' => 'كود الحركات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'templates' => [
            'create' => 'إنشاء قالب',
            'edit' => 'تحرير القالب',
            'management' => 'إدارة القالب',
            'title' => 'قوالب',
            'view' => 'عرض القالب',
            'table' =>
                [
                    'id' => 'كود القوالب',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'transactioncategories' => [
            'create' => 'إنشاء فئة الحركات',
            'edit' => 'تحرير فئة الحركات',
            'management' => 'إدارة فئات الحركات',
            'title' => 'فئات الحركات',
            'view' => 'عرض فئة الحركة',
        ],
        'productvariables' => [
            'create' => 'إنشاء متغير وحدة المنتج',
            'edit' => 'تحرير متغير وحدة المنتج',
            'management' => 'إدارة المتغيرات لوحدة المنتج',
            'title' => 'متغيرات وحدة المنتج',
            'view' => 'عرض متغير وحدة المنتج',
        ],
        'hrms' => [
            'create' => 'إنشاء إدارة الموارد البشرية',
            'permissions' => 'الصلاحيات',
            'edit' => 'إدارة الموارد البشرية',
            'management' => 'إدارة الموارد البشرية',
            'title' => 'إدارة الموارد البشرية',
            'view' => 'مشاهدة ملف HRM',
            'table' =>
                [
                    'id' => 'كود الموارد البشرية',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'banks' => [
            'create' => 'إنشاء بنك',
            'edit' => 'تحرير البنك',
            'management' => 'إدارة البنك',
            'title' => 'البنوك',
            'view' => 'عرض البنك',
            'table' =>
                [
                    'id' => 'كود البنوك',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'countries' => [
            'create' => 'إنشاء بلد',
            'edit' => 'تحرير البلد',
            'management' => 'إدارة البلد',
            'title' => 'البلد',
            'view' => 'عرض البلد',
            'table' =>
                [
                    'id' => 'كود البنوك',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'taxes' => [
            'create' => 'إنشاء ضريبة',
            'edit' => 'تحرير الضريبة',
            'management' => 'إدارة الضريبة',
            'title' => 'الضريبة',
            'view' => 'عرض الضريبة',
            'table' =>
                [
                    'id' => 'كود الضريبة',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'subtaxes' => [
            'create' => 'إنشاء ضريبة فرعية',
            'edit' => 'تحرير الضريبة فرعية',
            'management' => ' إدارة الضريبة فرعية',
            'title' => 'الضريبة الفرعية',
            'view' => 'عرض الضريبة الفرعية',
            'table' =>
                [
                    'id' => 'كود الضريبة',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'units' => [
            'create' => 'إنشاء وحدة',
            'edit' => 'تحرير الوحدة',
            'management' => 'إدارة الوحدة',
            'title' => 'الوحدة',
            'view' => 'عرض الوحدة',
            'table' =>
                [
                    'id' => 'كود الوحدة',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'usergatewayentries' => [
            'create' => 'أضف بوابة الدفع',
            'edit' => 'تحرير بوابة الدفع',
            'management' => 'إدارة بوابات الدفع',
            'title' => 'بوابات الدفع',
            'view' => 'عرض بوابة الدفع',
            'table' =>
                [
                    'id' => 'كود بوابات الدفع',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'departments' => [
            'create' => 'إنشاء قسم الموظف',
            'edit' => 'تحرير قسم الموظف',
            'management' => 'إدارة قسم الموظفين',
            'title' => 'إدارات الموظفين',
            'view' => 'عرض قسم الموظفين',
            'table' =>
                [
                    'id' => 'كود الاقسام',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'quotes' => [
            'create' => 'إنشاء عرض أسعار',
            'edit' => 'تحرير العرض',
            'management' => 'إدارة عرض الأسعار',
            'title' => 'عرض',
            'view' => 'مشاهدة العرض',
            'table' =>
                [
                    'id' => 'كود العروض',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'purchaseorders' => [
            'create' => 'إنشاء أمر شراء',
            'edit' => 'تحرير أمر الشراء',
            'management' => 'إدارة أوامر الشراء',
            'title' => 'طلبات الشراء',
            'view' => 'عرض أمر الشراء',
            'table' =>
                [
                    'id' => 'كود أوامر الشراء',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'orders' => [
            'create' => 'إنشاء النظام',
            'edit' => 'تحرير الطلب',
            'management' => 'إدارة الطلبات',
            'title' => 'الطلب #٪ s',
            'view' => 'مشاهدة الطلب',
            'table' =>
                [
                    'id' => 'كود الطلبات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'suppliers' => [
            'create' => 'إنشاء مورد',
            'edit' => 'تحرير المورد',
            'management' => 'إدارة الموردين',
            'title' => 'الموردون',
            'view' => 'عرض المورد',
            'table' =>
                [
                    'id' => 'كود الموردين',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'tasks' => [
            'create' => 'إنشاء مهمة',
            'edit' => 'تحرير المهمة',
            'management' => 'ادارة المهام',
            'title' => 'مهام',
            'view' => 'عرض المهمة',
            'table' =>
                [
                    'id' => 'كود المهام',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'screens' => [
            'create' => 'إنشاء شاشات مراكز تكلفة',
            'edit' => 'تحرير شاشات مراكز تكلفة',
            'management' => 'ادارة شاشات مراكز تكلفة',
            'title' => 'شاشة مراكز تكلفة',
            'view' => 'عرض شاشات مراكز تكلفة',
            'table' =>
                [
                    'id' => 'كود شاشة مراكز تكلفة',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'costcenters' => [
            'create' => 'قائمة  مراكز تكلفة',
            'edit' => 'تحرير  مراكز تكلفة',
            'management' => 'ادارة  مراكز تكلفة',
            'title' => ' مراكز تكلفة',
            'view' => 'عرض  مراكز تكلفة',
            'table' =>
                [
                    'id' => 'كود  مراكز تكلفة',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'tags' => [
            'create' => 'إنشاء علامة',
            'edit' => 'تحرير العلامة',
            'management' => 'العلامات',
            'title' => 'العلامات',
            'view' => 'عرض العلامة',
            'table' =>
                [
                    'id' => 'كود العلامات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'miscs' => [
            'create' => 'إنشاء إدخال',
            'edit' => 'تحرير دخول',
            'management' => 'إدارة',
            'title' => 'العلامات والأوضاع',
            'view' => 'عرض العلامات والأوضاع',
            'table' =>
                [
                    'id' => 'ال ID',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'projects' => [
            'create' => 'إنشاء مشروع',
            'edit' => 'تحرير المشروع',
            'management' => 'ادارة مشروع',
            'title' => 'المشاريع',
            'view' => 'عرض مشروع',
            'table' =>
                [
                    'id' => 'كود المشاريع',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'notes' => [
            'create' => 'إنشاء ملاحظة',
            'edit' => 'تحرير مذكرة',
            'management' => 'إدارة الملاحظات',
            'title' => 'ملاحظات',
            'view' => 'عرض الملاحظة',
            'table' =>
                [
                    'id' => 'كود الملاحظات',
                    'createdat' => 'أنشئت في',
                ],
        ],
        'events' => [
            'create' => 'انشاء حدث',
            'edit' => 'تحرير الحدث',
            'management' => 'أدارة الحدث',
            'title' => 'الأحداث',
            'view' => 'عرض المناسبة',
            'table' =>
                [
                    'id' => 'كود الاحداث',
                    'createdat' => 'أنشئت في',
                ],
        ],
    ],
    'frontend' => [
        'auth' => [
            'login_box_title' => 'تسجيل الدخول',
            'login_button' => 'تسجيل الدخول',
            'login_with' => 'تسجيل الدخول باستخدام: social_media',
            'register_box_title' => 'تسجيل',
            'register_button' => 'تسجيل',
            'remember_me' => 'تذكرنى',
        ],
        'passwords' => [
            'forgot_password' => 'نسيت رقمك السري؟',
            'reset_password_box_title' => 'إعادة تعيين كلمة المرور',
            'reset_password_button' => 'إعادة تعيين كلمة المرور',
            'send_password_reset_link_button' => 'إرسال رابط إعادة تعيين كلمة السر',
        ],
        'macros' => [
            'country' =>
                [
                    'alpha' => 'رموز البلد ألفا',
                    'alpha2' => 'رموز البلد ألفا 2',
                    'alpha3' => 'رموز البلد ألفا 3',
                    'numeric' => 'الرموز الرقمية للبلد',
                ],
            'macro_examples' => 'أمثلة الماكرو',
            'state' =>
                [
                    'mexico' => 'قائمة ',
                    'us' =>
                        [
                            'us' => 'نحن',
                            'outlying' => 'الأقاليم النائية ',
                            'armed' => 'جاهز',
                        ],
                ],
            'territories' =>
                [
                    'canada' => 'قائمة ',
                ],
            'timezone' => 'وحدة زمنية',
        ],
        'user' => [
            'passwords' =>
                [
                    'change' => 'تغيير كلمة السر',
                ],
            'profile' =>
                [
                    'avatar' => 'الصورة الرمزية',
                    'created_at' => 'أنشئت في',
                    'edit_information' => 'تعديل المعلومات',
                    'email' => 'البريد الإلكتروني',
                    'last_updated' => 'آخر تحديث',
                    'first_name' => 'الاسم الاول',
                    'last_name' => 'الاسم الاخير',
                    'address' => 'عنوان',
                    'state' => 'حالة',
                    'city' => 'مدينة',
                    'zipcode' => 'الرمز البريدي',
                    'ssn' => 'SSN',
                    'update_information' => 'تحديث المعلومات',
                ],
        ],
    ],
];
