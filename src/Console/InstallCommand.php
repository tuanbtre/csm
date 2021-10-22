<?php

namespace Tuanbtre\Csm\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';
	/**
     * Install directory.
     *
     * @var string
     */
	protected $adminpath = '';
	protected $modelpath = '';
    /**
     * Create a new command instance.
     *
     * @return void
     */	 
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->initPublish();
        $this->initDatabase();
        $this->initModel();
        $this->initController();
    }
	public function initPublish(){
		$this->call('vendor:publish', ['--provider' => \Tuanbtre\Csm\CsmServiceProvider::class]);
	}
	public function initDatabase()
    {
        $this->call('migrate');
		$m_language = \Tuanbtre\Csm\Models\Language::class;
        if ($m_language::count() == 0) {
            $this->call('db:seed', ['--class' => \Tuanbtre\Csm\Database\Seeds\LanguageSeeder::class]);
        }
		$m_function = \Tuanbtre\Csm\Models\Functions::class;
        if ($m_function::count() == 0) {
            $this->call('db:seed', ['--class' => \Tuanbtre\Csm\Database\Seeds\FunctionSeeder::class]);
        }
		$m_user = \Tuanbtre\Csm\Models\User::class;
        if ($m_user::count() == 0) {
            $this->call('db:seed', ['--class' => \Tuanbtre\Csm\Database\Seeds\UserSeeder::class]);
        }
		$m_routelanguage = \Tuanbtre\Csm\Models\RouteLanguage::class;
        if ($m_routelanguage::count() == 0) {
            $this->call('db:seed', ['--class' => \Tuanbtre\Csm\Database\Seeds\RouteLanguage::class]);
        }
    }
	protected function initModel()
    {
        $this->modelpath = config('admin.modelpath', app_path('Models'));

        if (is_dir($this->modelpath)) {
            $this->line("<error>{$this->modelpath} directory already exists !</error> ");
        }else{
			$this->makeDir("{$this->modelpath}/");
			$this->line('<info>Models directory was created:</info> '.str_replace(base_path(), '', $this->modelpath));
		}
        $this->createAboutusModel();
        $this->createAdvertisementModel();
        $this->createBannerModel();
        $this->createBannerTypeModel();
        $this->createCompanyInfoModel();
        $this->createConfigMailSMTPModel();
        $this->createContactMailModel();
        $this->createFunctionsModel();
        $this->createLanguageModel();
        $this->createMailManagerModel();
        $this->createMetaHeaderModel();
        $this->createNewsModel();
        $this->createNewsTypeModel();
        $this->createPaggingModel();
        $this->createRouteLanguageModel();
        $this->createStaticPageModel();
        $this->createTagsModel();
        $this->createUserModel();
    }
	public function createAboutusModel(){
		$aboutusmodel = $this->modelpath.'/About_us.php';
        $contents = $this->getStub('models/About_us');

        $this->laravel['files']->put(
            $aboutusmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>About_us.php file was created:</info> '.str_replace(base_path(), '', $aboutusmodel));
	}
	public function createAdvertisementModel(){
		$advertisementmodel = $this->modelpath.'/Advertisement.php';
        $contents = $this->getStub('models/Advertisement');

        $this->laravel['files']->put(
            $advertisementmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Advertisement.php file was created:</info> '.str_replace(base_path(), '', $advertisementmodel));
	}
	public function createBannerModel(){
		$bannermodel = $this->modelpath.'/Banner.php';
        $contents = $this->getStub('models/Banner');

        $this->laravel['files']->put(
            $bannermodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Banner.php file was created:</info> '.str_replace(base_path(), '', $bannermodel));
	}
	public function createBannerTypeModel(){
		$bannertypemodel = $this->modelpath.'/BannerType.php';
        $contents = $this->getStub('models/BannerType');

        $this->laravel['files']->put(
            $bannertypemodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>BannerType.php file was created:</info> '.str_replace(base_path(), '', $bannertypemodel));
	}
	public function createCompanyInfoModel(){
		$companyinfomodel = $this->modelpath.'/CompanyInfo.php';
        $contents = $this->getStub('models/CompanyInfo');

        $this->laravel['files']->put(
            $companyinfomodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>CompanyInfo.php file was created:</info> '.str_replace(base_path(), '', $companyinfomodel));
	}
	public function createConfigMailSMTPModel(){
		$configmailsmtpmodel = $this->modelpath.'/ConfigMailSMTP.php';
        $contents = $this->getStub('models/ConfigMailSMTP');

        $this->laravel['files']->put(
            $configmailsmtpmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>ConfigMailSMTP.php file was created:</info> '.str_replace(base_path(), '', $configmailsmtpmodel));
	}
	public function createContactMailModel(){
		$contactmailmodel = $this->modelpath.'/ContactMail.php';
        $contents = $this->getStub('models/ContactMail');

        $this->laravel['files']->put(
            $contactmailmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>ContactMail.php file was created:</info> '.str_replace(base_path(), '', $contactmailmodel));
	}
	public function createFunctionsModel(){
		$functionsmodel = $this->modelpath.'/Functions.php';
        $contents = $this->getStub('models/Functions');

        $this->laravel['files']->put(
            $functionsmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Functions.php file was created:</info> '.str_replace(base_path(), '', $functionsmodel));
	}
	public function createLanguageModel(){
		$languagemodel = $this->modelpath.'/Language.php';
        $contents = $this->getStub('models/Language');

        $this->laravel['files']->put(
            $languagemodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Language.php file was created:</info> '.str_replace(base_path(), '', $languagemodel));
	}
	public function createMailManagerModel(){
		$mailmanagermodel = $this->modelpath.'/MailManager.php';
        $contents = $this->getStub('models/MailManager');

        $this->laravel['files']->put(
            $mailmanagermodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>MailManager.php file was created:</info> '.str_replace(base_path(), '', $mailmanagermodel));
	}
	public function createMetaHeaderModel(){
		$metaheadermodel = $this->modelpath.'/MetaHeader.php';
        $contents = $this->getStub('models/MetaHeader');

        $this->laravel['files']->put(
            $metaheadermodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>MetaHeader.php file was created:</info> '.str_replace(base_path(), '', $metaheadermodel));
	}
	public function createNewsModel(){
		$newsmodel = $this->modelpath.'/News.php';
        $contents = $this->getStub('models/News');

        $this->laravel['files']->put(
            $newsmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>News.php file was created:</info> '.str_replace(base_path(), '', $newsmodel));
	}
	public function createNewsTypeModel(){
		$newstypemodel = $this->modelpath.'/NewsType.php';
        $contents = $this->getStub('models/NewsType');

        $this->laravel['files']->put(
            $newstypemodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>NewsType.php file was created:</info> '.str_replace(base_path(), '', $newstypemodel));
	}
	public function createPaggingModel(){
		$paggingmodel = $this->modelpath.'/Pagging.php';
        $contents = $this->getStub('models/Pagging');

        $this->laravel['files']->put(
            $paggingmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Pagging.php file was created:</info> '.str_replace(base_path(), '', $paggingmodel));
	}
	public function createRouteLanguageModel(){
		$routelanguagemodel = $this->modelpath.'/RouteLanguage.php';
        $contents = $this->getStub('models/RouteLanguage');

        $this->laravel['files']->put(
            $routelanguagemodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>RouteLanguage.php file was created:</info> '.str_replace(base_path(), '', $routelanguagemodel));
	}
	public function createStaticPageModel(){
		$staticpagemodel = $this->modelpath.'/StaticPage.php';
        $contents = $this->getStub('models/StaticPage');

        $this->laravel['files']->put(
            $staticpagemodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>StaticPage.php file was created:</info> '.str_replace(base_path(), '', $staticpagemodel));
	}
	public function createTagsModel(){
		$tagsmodel = $this->modelpath.'/Tags.php';
        $contents = $this->getStub('models/Tags');

        $this->laravel['files']->put(
            $tagsmodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>Tags.php file was created:</info> '.str_replace(base_path(), '', $tagsmodel));
	}
	public function createUserModel(){
		$usermodel = $this->modelpath.'/User.php';
        $contents = $this->getStub('models/User');

        $this->laravel['files']->put(
            $usermodel,
            str_replace('DummyNamespace', 'App\\Models', $contents)
        );
        $this->line('<info>User.php file was created:</info> '.str_replace(base_path(), '', $usermodel));
	}
	
	protected function initController()
    {
        $this->adminpath = config('admin.adminpath', app_path('Http/Controllers/Admin'));

        if (is_dir($this->adminpath)) {
            $this->line("<error>{$this->adminpath} directory already exists !</error> ");
		}else{
			$this->makeDir("{$this->adminpath}/");
			$this->line('<info>Admin directory was created:</info> '.str_replace(base_path(), '', $this->adminpath));
		}
        $this->createAboutusController();
        $this->createAdvertisementController();
        $this->createBannerController();
        $this->createBannerTypeController();
        $this->createChangePassWordController();
        $this->createCKEditorController();
        $this->createCompanyInfoController();
        $this->createConfigMailSMTPController();
        $this->createContactMailController();
        $this->createHomeController();
        $this->createLoginController();
        $this->createMailManagerController();
        $this->createMetaHeaderController();
		$this->createNewsController();
        $this->createNewsTypeController();
        $this->createPaggingController();
        $this->createRegisterController();
        $this->createResetPasswordController();
        $this->createRouteAdminController();
        $this->createRouteLanguageController();
        $this->createStaticPageController();
        $this->createUsermanagerController();
        $this->createUserpermissionController();
    }
	public function createAboutusController()
    {
        $aboutuscontroller = $this->adminpath.'/AboutusController.php';
        $contents = $this->getStub('controllers/AboutusController');

        $this->laravel['files']->put(
            $aboutuscontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>AboutusController.php file was created:</info> '.str_replace(base_path(), '', $aboutuscontroller));
    }
	public function createAdvertisementController()
    {
        $advertisementcontroller = $this->adminpath.'/AdvertisementController.php';
        $contents = $this->getStub('controllers/AdvertisementController');

        $this->laravel['files']->put(
            $advertisementcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>AdvertisementController.php file was created:</info> '.str_replace(base_path(), '', $advertisementcontroller));
    }
	public function createBannerController()
    {
        $bannercontroller = $this->adminpath.'/BannerController.php';
        $contents = $this->getStub('controllers/BannerController');

        $this->laravel['files']->put(
            $bannercontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>BannerController.php file was created:</info> '.str_replace(base_path(), '', $bannercontroller));
    }
	public function createBannerTypeController()
    {
        $bannertypecontroller = $this->adminpath.'/BannerTypeController.php';
        $contents = $this->getStub('controllers/BannerTypeController');

        $this->laravel['files']->put(
            $bannertypecontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>BannerTypeController.php file was created:</info> '.str_replace(base_path(), '', $bannertypecontroller));
    }
	public function createChangePassWordController()
    {
        $changepasswordcontroller = $this->adminpath.'/ChangePassWordController.php';
        $contents = $this->getStub('controllers/ChangePassWordController');

        $this->laravel['files']->put(
            $changepasswordcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>ChangePassWordController.php file was created:</info> '.str_replace(base_path(), '', $changepasswordcontroller));
    }
	public function createCKEditorController()
    {
        $ckeditorcontroller = $this->adminpath.'/CKEditorController.php';
        $contents = $this->getStub('controllers/CKEditorController');

        $this->laravel['files']->put(
            $ckeditorcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>CKEditorController.php file was created:</info> '.str_replace(base_path(), '', $ckeditorcontroller));
    }
	public function createCompanyInfoController()
    {
        $companyinfocontroller = $this->adminpath.'/CompanyInfoController.php';
        $contents = $this->getStub('controllers/CompanyInfoController');

        $this->laravel['files']->put(
            $companyinfocontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>CompanyInfoController.php file was created:</info> '.str_replace(base_path(), '', $companyinfocontroller));
    }
	public function createConfigMailSMTPController()
    {
        $configmailsmtpcontroller = $this->adminpath.'/ConfigMailSMTPController.php';
        $contents = $this->getStub('controllers/ConfigMailSMTPController');

        $this->laravel['files']->put(
            $configmailsmtpcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>ConfigMailSMTPController.php file was created:</info> '.str_replace(base_path(), '', $configmailsmtpcontroller));
    }
	public function createContactMailController()
    {
        $contactmailcontroller = $this->adminpath.'/ContactMailController.php';
        $contents = $this->getStub('controllers/ContactMailController');

        $this->laravel['files']->put(
            $contactmailcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>ContactMailController.php file was created:</info> '.str_replace(base_path(), '', $contactmailcontroller));
    }
	public function createHomeController()
    {
        $homecontroller = $this->adminpath.'/HomeController.php';
        $contents = $this->getStub('controllers/HomeController');

        $this->laravel['files']->put(
            $homecontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>HomeController.php file was created:</info> '.str_replace(base_path(), '', $homecontroller));
    }
	public function createLoginController()
    {
        $logincontroller = $this->adminpath.'/LoginController.php';
        $contents = $this->getStub('controllers/LoginController');

        $this->laravel['files']->put(
            $logincontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>LoginController.php file was created:</info> '.str_replace(base_path(), '', $logincontroller));
    }
	public function createMailManagerController()
    {
        $mailmanagercontroller = $this->adminpath.'/MailManagerController.php';
        $contents = $this->getStub('controllers/MailManagerController');

        $this->laravel['files']->put(
            $mailmanagercontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>MailManagerController.php file was created:</info> '.str_replace(base_path(), '', $mailmanagercontroller));
    }
	public function createMetaHeaderController()
    {
        $metaheadercontroller = $this->adminpath.'/MetaHeaderController.php';
        $contents = $this->getStub('controllers/MetaHeaderController');

        $this->laravel['files']->put(
            $metaheadercontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>MetaHeaderController.php file was created:</info> '.str_replace(base_path(), '', $metaheadercontroller));
    }
	public function createNewsController()
    {
        $newscontroller = $this->adminpath.'/NewsController.php';
        $contents = $this->getStub('controllers/NewsController');

        $this->laravel['files']->put(
            $newscontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>NewsController.php file was created:</info> '.str_replace(base_path(), '', $newscontroller));
    }
	public function createNewsTypeController()
    {
        $newstypecontroller = $this->adminpath.'/NewsTypeController.php';
        $contents = $this->getStub('controllers/NewsTypeController');

        $this->laravel['files']->put(
            $newstypecontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>NewsTypeController.php file was created:</info> '.str_replace(base_path(), '', $newstypecontroller));
    }
	public function createPaggingController()
    {
        $paggingcontroller = $this->adminpath.'/PaggingController.php';
        $contents = $this->getStub('controllers/PaggingController');

        $this->laravel['files']->put(
            $paggingcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>PaggingController.php file was created:</info> '.str_replace(base_path(), '', $paggingcontroller));
    }
	public function createRegisterController()
    {
        $registercontroller = $this->adminpath.'/RegisterController.php';
        $contents = $this->getStub('controllers/RegisterController');

        $this->laravel['files']->put(
            $registercontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>RegisterController.php file was created:</info> '.str_replace(base_path(), '', $registercontroller));
    }
	public function createResetPasswordController()
    {
        $resetpasswordcontroller = $this->adminpath.'/ResetPasswordController.php';
        $contents = $this->getStub('controllers/ResetPasswordController');

        $this->laravel['files']->put(
            $resetpasswordcontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>ResetPasswordController.php file was created:</info> '.str_replace(base_path(), '', $resetpasswordcontroller));
    }
	public function createRouteAdminController()
    {
        $routeadmincontroller = $this->adminpath.'/RouteAdminController.php';
        $contents = $this->getStub('controllers/RouteAdminController');

        $this->laravel['files']->put(
            $routeadmincontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>RouteAdminController.php file was created:</info> '.str_replace(base_path(), '', $routeadmincontroller));
    }
	public function createRouteLanguageController()
    {
        $routelanguagecontroller = $this->adminpath.'/RouteLanguageController.php';
        $contents = $this->getStub('controllers/RouteLanguageController');

        $this->laravel['files']->put(
            $routelanguagecontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>RouteLanguageController.php file was created:</info> '.str_replace(base_path(), '', $routelanguagecontroller));
    }
	public function createStaticPageController()
    {
        $staticpagecontroller = $this->adminpath.'/StaticPageController.php';
        $contents = $this->getStub('controllers/StaticPageController');

        $this->laravel['files']->put(
            $staticpagecontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>StaticPageController.php file was created:</info> '.str_replace(base_path(), '', $staticpagecontroller));
    }
	public function createUsermanagerController()
    {
        $usermanagercontroller = $this->adminpath.'/UsermanagerController.php';
        $contents = $this->getStub('controllers/UsermanagerController');

        $this->laravel['files']->put(
            $usermanagercontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>UsermanagerController.php file was created:</info> '.str_replace(base_path(), '', $usermanagercontroller));
    }
	public function createUserpermissionController()
    {
        $userpermissioncontroller = $this->adminpath.'/UserpermissionController.php';
        $contents = $this->getStub('controllers/UserpermissionController');

        $this->laravel['files']->put(
            $userpermissioncontroller,
            str_replace('DummyNamespace', 'App\\Http\\Controllers\\Admin', $contents)
        );
        $this->line('<info>UserpermissionController.php file was created:</info> '.str_replace(base_path(), '', $userpermissioncontroller));
    }
	protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__."/stubs/$name.stub");
    }
	protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("$path", 0755, true, true);
    }
}
