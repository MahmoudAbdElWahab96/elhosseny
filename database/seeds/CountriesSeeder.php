<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::insert(" INSERT INTO `all_countries` (`id`, `image_code`, `name_en`, `code`, `name_ar`) VALUES
            (231, 'TR', 'Turkey', 90, 'تركيا'),
            (66, 'EG', 'Egypt', 20, 'مصر'),
            (121, 'KW', 'Kuwait', 965, 'الكويت'),
            (1, 'AF', 'Afghanistan', 93, 'أفغانستان'),
            (2, 'AX', 'Aland Islands', 358, 'جزر آلاند'),
            (3, 'AL', 'Albania', 355, 'ألبانيا'),
            (4, 'DZ', 'Algeria', 213, 'الجزائر'),
            (5, 'AS', 'American Samoa', 1684, 'ساموا-الأمريكي'),
            (6, 'AD', 'Andorra', 376, 'أندورا'),
            (7, 'AO', 'Angola', 244, 'أنغولا'),
            (8, 'AI', 'Anguilla', 1264, 'أنغويلا'),
            (9, 'AQ', 'Antarctica', 0, 'أنتاركتيكا'),
            (10, 'AG', 'Antigua and Barbuda', 1268, 'أنتيغوا وبربودا'),
            (11, 'AR', 'Argentina', 54, 'الأرجنتين'),
            (12, 'AM', 'Armenia', 374, 'أرمينيا'),
            (13, 'AW', 'Aruba', 297, 'أروبه'),
            (14, 'AU', 'Australia', 61, 'أستراليا'),
            (15, 'AT', 'Austria', 43, 'النمسا'),
            (16, 'AZ', 'Azerbaijan', 994, 'أذربيجان'),
            (17, 'BS', 'Bahamas', 1242, 'الباهاماس'),
            (18, 'BH', 'Bahrain', 973, 'البحرين'),
            (19, 'BD', 'Bangladesh', 880, 'بنغلاديش'),
            (20, 'BB', 'Barbados', 1246, 'بربادوس'),
            (21, 'BY', 'Belarus', 375, 'روسيا البيضاء'),
            (22, 'BE', 'Belgium', 32, 'بلجيكا'),
            (23, 'BZ', 'Belize', 501, 'بيليز'),
            (24, 'BJ', 'Benin', 229, 'بنين'),
            (25, 'BM', 'Bermuda', 1441, 'جزر برمودا'),
            (26, 'BT', 'Bhutan', 975, 'بوتان'),
            (27, 'BO', 'Bolivia', 591, 'بوليفيا'),
            (28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 599, ''),
            (29, 'BA', 'Bosnia and Herzegovina', 387, 'البوسنة و الهرسك'),
            (30, 'BW', 'Botswana', 267, 'بوتسوانا'),
            (31, 'BV', 'Bouvet Island', 0, 'جزيرة بوفيه'),
            (32, 'BR', 'Brazil', 55, 'البرازيل'),
            (33, 'IO', 'British Indian Ocean Territory', 246, 'إقليم المحيط الهندي البريطاني'),
            (34, 'BN', 'Brunei Darussalam', 673, 'بروني'),
            (35, 'BG', 'Bulgaria', 359, 'بلغاريا'),
            (36, 'BF', 'Burkina Faso', 226, 'بوركينا فاسو'),
            (37, 'BI', 'Burundi', 257, 'بوروندي'),
            (38, 'KH', 'Cambodia', 855, 'كمبوديا'),
            (39, 'CM', 'Cameroon', 237, 'كاميرون'),
            (40, 'CA', 'Canada', 1, 'كندا'),
            (41, 'CV', 'Cape Verde', 238, 'الرأس الأخضر'),
            (42, 'KY', 'Cayman Islands', 1345, 'جزر كايمان'),
            (43, 'CF', 'Central African Republic', 236, 'جمهورية أفريقيا الوسطى'),
            (44, 'TD', 'Chad', 235, 'تشاد'),
            (45, 'CL', 'Chile', 56, 'شيلي'),
            (46, 'CN', 'China', 86, 'الصين'),
            (47, 'CX', 'Christmas Island', 61, 'جزيرة عيد الميلاد'),
            (48, 'CC', 'Cocos (Keeling) Islands', 672, 'جزر كوكوس'),
            (49, 'CO', 'Colombia', 57, 'كولومبيا'),
            (50, 'KM', 'Comoros', 269, 'جزر القمر'),
            (51, 'CG', 'Congo', 242, 'الكونغو'),
            (52, 'CD', 'Congo, the Democratic Republic of the', 242, 'جمهورية الكونغو الديمقراطية'),
            (53, 'CK', 'Cook Islands', 682, 'جزر كوك'),
            (54, 'CR', 'Costa Rica', 506, 'كوستاريكا'),
            (55, 'CI', 'Cote D\'Ivoire', 225, 'ساحل العاج'),
            (56, 'HR', 'Croatia', 385, 'كرواتيا'),
            (57, 'CU', 'Cuba', 53, 'كوبا'),
            (58, 'CW', 'Curacao', 599, 'كوراكاو'),
            (59, 'CY', 'Cyprus', 357, 'قبرص'),
            (60, 'CZ', 'Czech Republic', 420, 'الجمهورية التشيكية'),
            (61, 'DK', 'Denmark', 45, 'الدانمارك'),
            (62, 'DJ', 'Djibouti', 253, 'جيبوتي'),
            (63, 'DM', 'Dominica', 1767, 'دومينيكا'),
            (64, 'DO', 'Dominican Republic', 1809, 'الجمهورية الدومينيكية'),
            (65, 'EC', 'Ecuador', 593, 'إكوادور'),
            (67, 'SV', 'El Salvador', 503, 'إلسلفادور'),
            (68, 'GQ', 'Equatorial Guinea', 240, 'غينيا الاستوائي'),
            (69, 'ER', 'Eritrea', 291, 'إريتريا'),
            (70, 'EE', 'Estonia', 372, 'استونيا'),
            (71, 'ET', 'Ethiopia', 251, 'أثيوبيا'),
            (72, 'FK', 'Falkland Islands (Malvinas)', 500, 'جزر فوكلاند'),
            (73, 'FO', 'Faroe Islands', 298, 'جزر فارو'),
            (74, 'FJ', 'Fiji', 679, 'فيجي'),
            (75, 'FI', 'Finland', 358, 'فنلندا'),
            (76, 'FR', 'France', 33, 'فرنسا'),
            (77, 'GF', 'French Guiana', 594, 'غويانا الفرنسية'),
            (78, 'PF', 'French Polynesia', 689, 'بولينيزيا الفرنسية'),
            (79, 'TF', 'French Southern Territories', 0, 'أراض فرنسية جنوبية وأنتارتيكية'),
            (80, 'GA', 'Gabon', 241, 'الغابون'),
            (81, 'GM', 'Gambia', 220, 'غامبيا'),
            (82, 'GE', 'Georgia', 995, 'جيورجيا'),
            (83, 'DE', 'Germany', 49, 'ألمانيا'),
            (84, 'GH', 'Ghana', 233, 'غانا'),
            (85, 'GI', 'Gibraltar', 350, 'جبل طارق'),
            (86, 'GR', 'Greece', 30, 'اليونان'),
            (87, 'GL', 'Greenland', 299, 'جرينلاند'),
            (88, 'GD', 'Grenada', 1473, 'غرينادا'),
            (89, 'GP', 'Guadeloupe', 590, 'جزر جوادلوب'),
            (90, 'GU', 'Guam', 1671, 'جوام'),
            (91, 'GT', 'Guatemala', 502, 'غواتيمال'),
            (92, 'GG', 'Guernsey', 44, 'غيرنسي'),
            (93, 'GN', 'Guinea', 224, 'غينيا'),
            (94, 'GW', 'Guinea-Bissau', 245, 'غينيا-بيساو'),
            (95, 'GY', 'Guyana', 592, 'غيانا'),
            (96, 'HT', 'Haiti', 509, 'هايتي'),
            (97, 'HM', 'Heard Island and Mcdonald Islands', 0, 'جزيرة هيرد وجزر ماكدونالد'),
            (98, 'VA', 'Holy See (Vatican City State)', 39, 'دولة الفاتيكان'),
            (99, 'HN', 'Honduras', 504, 'هندوراس'),
            (100, 'HK', 'Hong Kong', 852, 'هونغ كونغ'),
            (101, 'HU', 'Hungary', 36, 'المجر'),
            (102, 'IS', 'Iceland', 354, 'آيسلندا'),
            (103, 'IN', 'India', 91, 'الهند'),
            (104, 'ID', 'Indonesia', 62, 'أندونيسيا'),
            (105, 'IR', 'Iran, Islamic Republic of', 98, 'إيران'),
            (106, 'IQ', 'Iraq', 964, 'العراق'),
            (107, 'IE', 'Ireland', 353, 'إيرلندا'),
            (108, 'IM', 'Isle of Man', 44, 'جزيرة مان'),
            (110, 'IT', 'Italy', 39, 'إيطاليا'),
            (111, 'JM', 'Jamaica', 1876, 'جمايكا'),
            (112, 'JP', 'Japan', 81, 'اليابان'),
            (113, 'JE', 'Jersey', 44, 'جيرزي'),
            (114, 'JO', 'Jordan', 962, 'الأردن'),
            (115, 'KZ', 'Kazakhstan', 7, 'كازاخستان'),
            (116, 'KE', 'Kenya', 254, 'كينيا'),
            (117, 'KI', 'Kiribati', 686, 'كيريباتي'),
            (118, 'KP', 'Korea, Democratic People\'s Republic of', 850, 'كوريا الشمالية'),
            (119, 'KR', 'Korea, Republic of', 82, 'كوريا الجنوبية'),
            (120, 'XK', 'Kosovo', 381, 'كوسوفو'),
            (122, 'KG', 'Kyrgyzstan', 996, 'قيرغيزستان'),
            (123, 'LA', 'Lao People\'s Democratic Republic', 856, 'لاوس'),
            (124, 'LV', 'Latvia', 371, 'لاتفيا'),
            (125, 'LB', 'Lebanon', 961, 'لبنان'),
            (126, 'LS', 'Lesotho', 266, 'ليسوتو'),
            (127, 'LR', 'Liberia', 231, 'ليبيريا'),
            (128, 'LY', 'Libyan Arab Jamahiriya', 218, 'ليبيا'),
            (129, 'LI', 'Liechtenstein', 423, 'ليختنشتين'),
            (130, 'LT', 'Lithuania', 370, 'لتوانيا'),
            (131, 'LU', 'Luxembourg', 352, 'لوكسمبورغ'),
            (132, 'MO', 'Macao', 853, 'ماكاو'),
            (133, 'MK', 'Macedonia, the Former Yugoslav Republic of', 389, 'مقدونيا'),
            (134, 'MG', 'Madagascar', 261, 'مدغشقر'),
            (135, 'MW', 'Malawi', 265, 'مالاوي'),
            (136, 'MY', 'Malaysia', 60, 'ماليزيا'),
            (137, 'MV', 'Maldives', 960, 'المالديف'),
            (138, 'ML', 'Mali', 223, 'مالي'),
            (139, 'MT', 'Malta', 356, 'مالطا'),
            (140, 'MH', 'Marshall Islands', 692, 'جزر مارشال'),
            (141, 'MQ', 'Martinique', 596, 'مارتينيك'),
            (142, 'MR', 'Mauritania', 222, 'موريتانيا'),
            (143, 'MU', 'Mauritius', 230, 'موريشيوس'),
            (144, 'YT', 'Mayotte', 269, 'مايوت'),
            (145, 'MX', 'Mexico', 52, 'المكسيك'),
            (146, 'FM', 'Micronesia, Federated States of', 691, 'مايكرونيزيا'),
            (147, 'MD', 'Moldova, Republic of', 373, 'مولدافيا'),
            (148, 'MC', 'Monaco', 377, 'موناكو'),
            (149, 'MN', 'Mongolia', 976, 'منغوليا'),
            (150, 'ME', 'Montenegro', 382, 'الجبل الأسود'),
            (151, 'MS', 'Montserrat', 1664, 'مونتسيرات'),
            (152, 'MA', 'Morocco', 212, 'المغرب'),
            (153, 'MZ', 'Mozambique', 258, 'موزمبيق'),
            (154, 'MM', 'Myanmar', 95, 'ميانمار'),
            (155, 'NA', 'Namibia', 264, 'ناميبيا'),
            (156, 'NR', 'Nauru', 674, 'نورو'),
            (157, 'NP', 'Nepal', 977, 'نيبال'),
            (158, 'NL', 'Netherlands', 31, 'هولندا'),
            (159, 'AN', 'Netherlands Antilles', 599, 'جزر الأنتيل الهولندي'),
            (160, 'NC', 'New Caledonia', 687, 'كاليدونيا الجديدة'),
            (161, 'NZ', 'New Zealand', 64, 'نيوزيلندا'),
            (162, 'NI', 'Nicaragua', 505, 'نيكاراجوا'),
            (163, 'NE', 'Niger', 227, 'النيجر'),
            (164, 'NG', 'Nigeria', 234, 'نيجيريا'),
            (165, 'NU', 'Niue', 683, 'ني'),
            (166, 'NF', 'Norfolk Island', 672, 'جزيرة نورفولك'),
            (167, 'MP', 'Northern Mariana Islands', 1670, 'جزر ماريانا الشمالية'),
            (168, 'NO', 'Norway', 47, 'النرويج'),
            (169, 'OM', 'Oman', 968, 'عمان'),
            (170, 'PK', 'Pakistan', 92, 'باكستان'),
            (171, 'PW', 'Palau', 680, 'بالاو'),
            (172, 'PS', 'Palestinian Territory, Occupied', 970, 'فلسطين'),
            (173, 'PA', 'Panama', 507, 'بنما'),
            (174, 'PG', 'Papua New Guinea', 675, 'بابوا غينيا الجديدة'),
            (175, 'PY', 'Paraguay', 595, 'باراغواي'),
            (176, 'PE', 'Peru', 51, 'بيرو'),
            (177, 'PH', 'Philippines', 63, 'الفليبين'),
            (178, 'PN', 'Pitcairn', 64, 'بيتكيرن'),
            (179, 'PL', 'Poland', 48, 'بولونيا'),
            (180, 'PT', 'Portugal', 351, 'البرتغال'),
            (181, 'PR', 'Puerto Rico', 1787, 'بورتو ريكو'),
            (182, 'QA', 'Qatar', 974, 'قطر'),
            (183, 'RE', 'Reunion', 262, 'ريونيون'),
            (184, 'RO', 'Romania', 40, 'رومانيا'),
            (185, 'RU', 'Russian Federation', 70, 'روسيا'),
            (186, 'RW', 'Rwanda', 250, 'رواندا'),
            (187, 'BL', 'Saint Barthelemy', 590, ''),
            (188, 'SH', 'Saint Helena', 290, ''),
            (189, 'KN', 'Saint Kitts and Nevis', 1869, 'سانت كيتس ونيفس'),
            (190, 'LC', 'Saint Lucia', 1758, 'القديسة لوسيا'),
            (191, 'MF', 'Saint Martin', 590, 'القديس مارتن'),
            (192, 'PM', 'Saint Pierre and Miquelon', 508, 'سان بيير وميكلون'),
            (193, 'VC', 'Saint Vincent and the Grenadines', 1784, 'سانت فنسنت وجزر غرينادين'),
            (194, 'WS', 'Samoa', 684, 'ساموا'),
            (195, 'SM', 'San Marino', 378, 'سان مارينو'),
            (196, 'ST', 'Sao Tome and Principe', 239, 'ساو تومي وبرينسيبي'),
            (197, 'SA', 'Saudi Arabia', 966, 'المملكة العربية السعودية'),
            (198, 'SN', 'Senegal', 221, 'السنغال'),
            (199, 'RS', 'Serbia', 381, 'صربيا'),
            (200, 'CS', 'Serbia and Montenegro', 381, 'صربيا والجبل الأسود'),
            (201, 'SC', 'Seychelles', 248, 'سيشيل'),
            (202, 'SL', 'Sierra Leone', 232, 'سيراليون'),
            (203, 'SG', 'Singapore', 65, 'سنغافورة'),
            (204, 'SX', 'Sint Maarten', 1, 'سينت مارتن'),
            (205, 'SK', 'Slovakia', 421, 'سلوفاكيا'),
            (206, 'SI', 'Slovenia', 386, 'سلوفينيا'),
            (207, 'SB', 'Solomon Islands', 677, 'جزر سليمان'),
            (208, 'SO', 'Somalia', 252, 'الصومال'),
            (209, 'ZA', 'South Africa', 27, 'جنوب أفريقيا'),
            (210, 'GS', 'South Georgia and the South Sandwich Islands', 500, 'المنطقة القطبية الجنوبية'),
            (211, 'SS', 'South Sudan', 211, 'السودان الجنوبي'),
            (212, 'ES', 'Spain', 34, 'إسبانيا'),
            (213, 'LK', 'Sri Lanka', 94, 'سيريلانكا'),
            (214, 'SD', 'Sudan', 249, 'السودان'),
            (215, 'SR', 'Suriname', 597, 'سورينام'),
            (216, 'SJ', 'Svalbard and Jan Mayen', 47, 'سفالبارد ويان ماين'),
            (217, 'SZ', 'Swaziland', 268, 'سوازيلند'),
            (218, 'SE', 'Sweden', 46, 'السويد'),
            (219, 'CH', 'Switzerland', 41, 'سويسرا'),
            (220, 'SY', 'Syrian Arab Republic', 963, 'سوريا'),
            (221, 'TW', 'Taiwan, Province of China', 886, 'تايوان'),
            (222, 'TJ', 'Tajikistan', 992, 'طاجيكستان'),
            (223, 'TZ', 'Tanzania, United Republic of', 255, 'تنزانيا'),
            (224, 'TH', 'Thailand', 66, 'تايلندا'),
            (225, 'TL', 'Timor-Leste', 670, 'تيمور الشرقية'),
            (226, 'TG', 'Togo', 228, 'توغو'),
            (227, 'TK', 'Tokelau', 690, 'توكيلاو'),
            (228, 'TO', 'Tonga', 676, 'تونغا'),
            (229, 'TT', 'Trinidad and Tobago', 1868, 'ترينيداد وتوباغو'),
            (230, 'TN', 'Tunisia', 216, 'تونس'),
            (232, 'TM', 'Turkmenistan', 7370, 'تركمانستان'),
            (233, 'TC', 'Turks and Caicos Islands', 1649, 'جزر توركس وكايكوس'),
            (234, 'TV', 'Tuvalu', 688, 'توفالو'),
            (235, 'UG', 'Uganda', 256, 'أوغندا'),
            (236, 'UA', 'Ukraine', 380, 'أوكرانيا'),
            (237, 'AE', 'United Arab Emirates', 971, 'الإمارات العربية المتحدة'),
            (238, 'GB', 'United Kingdom', 44, 'المملكة المتحدة'),
            (239, 'US', 'United States', 1, 'الولايات المتحدة'),
            (240, 'UM', 'United States Minor Outlying Islands', 1, 'قائمة الولايات والمناطق الأمريكية'),
            (241, 'UY', 'Uruguay', 598, 'أورغواي'),
            (242, 'UZ', 'Uzbekistan', 998, 'أوزباكستان'),
            (243, 'VU', 'Vanuatu', 678, 'فانواتو'),
            (244, 'VE', 'Venezuela', 58, 'فنزويلا'),
            (245, 'VN', 'Viet Nam', 84, 'فيتنام'),
            (246, 'VG', 'Virgin Islands, British', 1284, 'الجزر العذراء الأمريكي'),
            (247, 'VI', 'Virgin Islands, U.s.', 1340, 'فنزويلا'),
            (248, 'WF', 'Wallis and Futuna', 681, 'والس وفوتونا'),
            (249, 'EH', 'Western Sahara', 212, 'الصحراء الغربية'),
            (250, 'YE', 'Yemen', 967, 'اليمن'),
            (251, 'ZM', 'Zambia', 260, 'زامبيا'),
            (252, 'ZW', 'Zimbabwe', 263, 'زمبابوي');
        ");
    }
}
