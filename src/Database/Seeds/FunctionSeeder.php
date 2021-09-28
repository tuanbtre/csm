<?php

namespace Tuanbtre\Csm\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_function')->insert([
			[
				'id' => 1,
				'icon' => 'user-icon.png',
				'url' => null,
				'controlleract' => null,
				'method' => '',
				'title_en' => 'System',
				'title_vn' => 'Hệ thống',
				'description' => null,
				'function_tab' => 'root',
				'route_name' => null,
				'can_grant' => 0,
				'isshow' => 1,
				'parent_id' => 0,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 2,
				'icon' => 'tintuc_items.png',
				'url' => null,
				'controlleract' => null,
				'method' => '',
				'title_en' => 'News',
				'title_vn' => 'Tin tức',
				'description' => null,
				'function_tab' => 'root',
				'route_name' => null,
				'can_grant' => 0,
				'isshow' => 1,
				'parent_id' => 0,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 10,
				'icon' => 'tienich_items.png',
				'url' => null,
				'controlleract' => null,
				'method' => '',
				'title_en' => 'Tiện ích',
				'title_vn' => 'Tiện ích',
				'description' => null,
				'function_tab' => 'root',
				'route_name' => null,
				'can_grant' => 0,
				'isshow' => 1,
				'parent_id' => 0,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 11,
				'icon' => 'tonghop_items.png',
				'url' => null,
				'controlleract' => null,
				'method' => '',
				'title_en' => 'Tổng hợp',
				'title_vn' => 'Tổng hợp',
				'description' => null,
				'function_tab' => 'root',
				'route_name' => null,
				'can_grant' => 0,
				'isshow' => 1,
				'parent_id' => 0,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 101,
				'icon' => null,
				'url' => 'userpermission',
				'controlleract' => 'UserpermissionController@index',
				'method' => 'any',
				'title_en' => 'User Permission',
				'title_vn' => 'Phân quyền',
				'description' => null,
				'function_tab' => 'user-permission',
				'route_name' => 'admin.permission.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 102,
				'icon' => null,
				'url' => 'userlist',
				'controlleract' => 'UsermanagerController@index',
				'method' => 'any',
				'title_en' => 'User List',
				'title_vn' => 'Danh sách người dùng',
				'description' => null,
				'function_tab' => 'user-list',
				'route_name' => 'admin.usermanager.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 103,
				'icon' => null,
				'url' => 'mailmanager',
				'controlleract' => 'MailManagerController@index',
				'method' => 'any',
				'title_en' => 'Mail Manager',
				'title_vn' => 'Quản lý mail',
				'description' => null,
				'function_tab' => 'mail-manager',
				'route_name' => 'admin.mailmanager.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 104,
				'icon' => null,
				'url' => 'pagging',
				'controlleract' => 'PaggingController@index',
				'method' => 'any',
				'title_en' => 'pagging',
				'title_vn' => 'Phân trang',
				'description' => null,
				'function_tab' => 'pagging',
				'route_name' => 'admin.pagging.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 105,
				'icon' => null,
				'url' => 'changepass',
				'controlleract' => 'ChangePassWordController@showchangepass',
				'method' => 'get',
				'title_en' => 'Change Password',
				'title_vn' => 'Đổi mật khẩu',
				'description' => null,
				'function_tab' => 'change-pass',
				'route_name' => 'admin.showchangepass',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 201,
				'icon' => null,
				'url' => 'catnews',
				'controlleract' => 'NewsTypeController@index',
				'method' => 'any',
				'title_en' => 'News',
				'title_vn' => 'Loại tin tức',
				'description' => null,
				'function_tab' => 'news',
				'route_name' => 'admin.news.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 202,
				'icon' => null,
				'url' => 'news',
				'controlleract' => 'NewsController@index',
				'method' => 'any',
				'title_en' => 'News',
				'title_vn' => 'Tin chi tiết',
				'description' => null,
				'function_tab' => 'news',
				'route_name' => 'admin.news.detail',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1001,
				'icon' => null,
				'url' => 'contact-mail',
				'controlleract' => 'ContactMailController@index',
				'method' => 'any',
				'title_en' => 'Contact mail list',
				'title_vn' => 'Danh sách mail liên hệ',
				'description' => null,
				'function_tab' => 'contact-mail',
				'route_name' => 'admin.contactmail.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 10,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1002,
				'icon' => null,
				'url' => 'config-mailsmtp',
				'controlleract' => 'ConfigMailSMTPController@index',
				'method' => 'any',
				'title_en' => 'Config mail smtp',
				'title_vn' => 'Cấu hình mail smtp',
				'description' => null,
				'function_tab' => 'config-mailsmtp',
				'route_name' => 'admin.configmailsmtp.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 10,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1101,
				'icon' => null,
				'url' => 'about-us',
				'controlleract' => 'AboutusController@index',
				'method' => 'any',
				'title_en' => 'About us',
				'title_vn' => 'Giới thiệu',
				'description' => null,
				'function_tab' => 'aboutus',
				'route_name' => 'admin.aboutus.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1102,
				'icon' => null,
				'url' => 'banner-type/{str?}',
				'controlleract' => 'BannerTypeController@index',
				'method' => 'any',
				'title_en' => 'Banner',
				'title_vn' => 'Banner',
				'description' => null,
				'function_tab' => 'banner',
				'route_name' => 'admin.banner.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1103,
				'icon' => null,
				'url' => 'banner/{id?}',
				'controlleract' => 'BannerController@index',
				'method' => 'any',
				'title_en' => 'Banner',
				'title_vn' => 'Banner',
				'description' => null,
				'function_tab' => 'banner',
				'route_name' => 'admin.banner.detail',
				'can_grant' => 0,
				'isshow' => 0,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1110,
				'icon' => null,
				'url' => 'metaheader',
				'controlleract' => 'MetaHeaderController@index',
				'method' => 'any',
				'title_en' => 'Meta Tag',
				'title_vn' => 'Meta Tag',
				'description' => null,
				'function_tab' => 'meta-tag',
				'route_name' => 'admin.metaheader.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1111,
				'icon' => null,
				'url' => 'companyinfo',
				'controlleract' => 'CompanyInfoController@index',
				'method' => 'any',
				'title_en' => 'Company Information',
				'title_vn' => 'Thông tin công ty',
				'description' => null,
				'function_tab' => 'company-info',
				'route_name' => 'admin.companyinfo.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1112,
				'icon' => null,
				'url' => 'staticpage',
				'controlleract' => 'StaticPageController@index',
				'method' => 'any',
				'title_en' => 'Static page',
				'title_vn' => 'Quản lý trang tĩnh',
				'description' => null,
				'function_tab' => 'trang-tinh',
				'route_name' => 'admin.staticpage.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1113,
				'icon' => null,
				'url' => 'staticpagedownload/{id?}',
				'controlleract' => 'StaticPageController@download',
				'method' => 'get',
				'title_en' => 'download',
				'title_vn' => 'download',
				'description' => null,
				'function_tab' => 'download',
				'route_name' => 'admin.staticpage.download',
				'can_grant' => 0,
				'isshow' => 0,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 1114,
				'icon' => null,
				'url' => 'advertisement',
				'controlleract' => 'AdvertisementController@index',
				'method' => 'any',
				'title_en' => 'Advertisement',
				'title_vn' => 'Quảng cáo',
				'description' => null,
				'function_tab' => 'advertisement',
				'route_name' => 'admin.advertisement.index',
				'can_grant' => 1,
				'isshow' => 1,
				'parent_id' => 11,
				'created_at' => now(),
				'updated_at' => now()
			]			
		]);
    }
}
