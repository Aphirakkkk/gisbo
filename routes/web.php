<?php



use App\Http\Controllers\backend\AboutUs45001Controller;

use App\Http\Controllers\backend\AboutUs9001Controller;

use App\Http\Controllers\backend\AboutUsAchievementController;

use App\Http\Controllers\backend\AboutUsAchievementDetailController;

use App\Http\Controllers\backend\AboutUsController;

use App\Http\Controllers\backend\AboutUsDetailController;

use App\Http\Controllers\backend\AboutUsEthicsController;

use App\Http\Controllers\backend\AboutUsIECController;

use App\Http\Controllers\backend\AboutUsOrganiztionalStructureController;

use App\Http\Controllers\backend\AboutUsValuesController;

use App\Http\Controllers\backend\AboutUsPolicyController;
use App\Http\Controllers\backend\AboutUsCarbonController;
use App\Http\Controllers\backend\AboutUsWhyChooseController;

use App\Http\Controllers\backend\BannerController;

use App\Http\Controllers\backend\BusinessDetailController;

use App\Http\Controllers\backend\BusinessHomeController;

use App\Http\Controllers\backend\BusinessTypeController;

use App\Http\Controllers\backend\CareerDetailController;

use App\Http\Controllers\backend\CareerMainController;

use App\Http\Controllers\backend\ContactController;

use App\Http\Controllers\backend\ContactUsController;

use App\Http\Controllers\backend\DashboardController;

use App\Http\Controllers\backend\FooterController;

use App\Http\Controllers\backend\MenuController;

use App\Http\Controllers\backend\NewEventsMainController;

use App\Http\Controllers\backend\ProductServicesDetailController;

use App\Http\Controllers\backend\ProductServicesHomeController;

use App\Http\Controllers\backend\ProjectsReferenceMainController;

use App\Http\Controllers\backend\ProjectsReferenceTypeController;

use App\Http\Controllers\backend\UserController;

use App\Http\Controllers\frontend\HomeController;

use Illuminate\Support\Facades\Route;

use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Session;

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/
Route::get('/clearcache', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
    } catch (\Throwable $e) {}

    $viewFiles = glob(storage_path('framework/views/*.php'));
    if ($viewFiles) {
        foreach ($viewFiles as $file) {
            @unlink($file);
        }
    }

    return redirect('/#secondPage');
});



//Change language

Route::get('change/{locale}', function ($locale) {

    Session::put('locale', $locale);

    return redirect()->back();

});

Route::get('/our_businessHome', function () {

    return redirect('/#our_business');

});

Route::get('/pdandserviceHome', function () {

    return redirect('/#pdandservice');

});

Route::get('/projectrefHome', function () {

    return redirect('/#projectref');

});

Route::get('/newsHome', function () {

    return redirect('/#news');

});

Route::get('/careerHome', function () {
    return redirect('/#career');
});

Route::get('/preview-contact-email', function () {
    $contactData = [
        'full_name' => 'คุณสมชาย ใจดี (ตัวอย่างผู้ติดต่อ)',
        'email' => 'somchai.example@gmail.com',
        'telephone' => '089-123-4567',
        'topic' => 'สอบถามข้อมูลบริการ EPC และติดตั้งระบบ Solar Cell',
        'details' => "สวัสดีครับ สนใจอยากขอใบเสนอราคาสำหรับโครงการติดตั้งระบบไฟฟ้าและ Solar Rooftop สำหรับอาคารสำนักงานขนาด 5 ชั้นครับ รบกวนติดต่อกลับด้วยครับ ขอบคุณครับ",
        'created_at' => date('d/m/Y H:i น.')
    ];
    return view('emails.contact_us', compact('contactData'));
});

Route::get('/send-test-contact-email', function () {
    $recipient = env('MAIL_RECIPIENT', 'aphiraksainui@gmail.com');
    $contactData = [
        'full_name' => 'คุณอภิรักษ์ (ทดสอบระบบจาก Localhost)',
        'email' => 'aphiraksainui@gmail.com',
        'telephone' => '081-999-8888',
        'topic' => 'ทดสอบส่งข้อความแจ้งเตือนจากระบบ Contact Us',
        'details' => "นี่คือข้อความทดสอบจากเว็บไซต์ GIS GROUP ส่งตรงเข้าอีเมลของคุณเพื่อตรวจสอบรูปแบบการแสดงผลจริงครับ",
        'created_at' => date('d/m/Y H:i น.')
    ];
    try {
        \Illuminate\Support\Facades\Mail::to($recipient)->send(new \App\Mail\ContactUsMail($contactData));
        return response()->json([
            'status' => 'success',
            'message' => 'ส่งอีเมลทดสอบไปยัง ' . $recipient . ' สำเร็จเรียบร้อยแล้วครับ!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'ยังไม่สามารถส่งเมลออกได้เนื่องจาก: ' . $e->getMessage(),
            'hint' => 'ต้องการการตั้งค่า MAIL_USERNAME และ MAIL_PASSWORD (App Password) ในไฟล์ .env'
        ], 500);
    }
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/contactregister-home', [HomeController::class, 'contactregister'])->name('contactregister.index');

Route::get('/business-epc', [HomeController::class, 'businessepc'])->name('businessepc.index');

Route::get('/business-ibt', [HomeController::class, 'businessibt'])->name('businessibt.index');

Route::get('/business-enr', [HomeController::class, 'businessenr'])->name('businessenr.index');

Route::get('/product-and-service', [HomeController::class, 'productandservice'])->name('productandservice.index');

Route::get('/product-and-service2', [HomeController::class, 'productandservice2'])->name('productandservice.index2');

Route::get('/project-detail/{id}', [HomeController::class, 'projectdetail'])->name('projectdetail.index');



Route::get('/highlightproject', [HomeController::class, 'highlightproject'])->name('projectdetail.highlightproject');

Route::get('/commercial', [HomeController::class, 'commercial'])->name('projectdetail.commercial');

Route::get('/residential', [HomeController::class, 'residential'])->name('projectdetail.residential');

Route::get('/healt', [HomeController::class, 'healt'])->name('projectdetail.healt');

Route::get('/hotel', [HomeController::class, 'hotel'])->name('projectdetail.hotel');

Route::get('/government', [HomeController::class, 'government'])->name('projectdetail.government');

Route::get('/industrial', [HomeController::class, 'industrial'])->name('projectdetail.industrial');

Route::get('/critical', [HomeController::class, 'critical'])->name('projectdetail.critical');

Route::get('/construction', [HomeController::class, 'construction'])->name('projectdetail.construction');

Route::get('/other', [HomeController::class, 'other'])->name('projectdetail.other');



Route::get('/new-detail/{id}', [HomeController::class, 'new'])->name('new.index');

Route::get('/about_9001-detail', [HomeController::class, 'about_9001']);

Route::get('/about_45001-detail', [HomeController::class, 'about_45001']);

Route::get('/about_achievement-detail', [HomeController::class, 'about_achievement']);

Route::get('/about_achievement-detail/{id}', [HomeController::class, 'about_achievement_detail']);

Route::get('/about_ethics-detail', [HomeController::class, 'about_ethics']);

Route::get('/about_iec-detail', [HomeController::class, 'about_iec']);

Route::get('/about_organiztional-detail', [HomeController::class, 'about_organiztional']);

Route::get('/about_values-detail', [HomeController::class, 'about_values']);

Route::get('/about_why-detail', [HomeController::class, 'about_why']);

Route::get('/about-detail', [HomeController::class, 'about']);

Route::get('/about_policy', [HomeController::class, 'about_policy'])->name('about.policy');

Route::get('/about_carbon-detail', [HomeController::class, 'about_carbon'])->name('about.carbon');



//CMS Admin Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



//CMS Admin Banner

Route::resource('/banner', BannerController::class);

Route::post('/banner/updateDelete', [BannerController::class, 'updateDelete'])->name('banner.updateDelete');





//CMS Admin Menu

Route::resource('/menu', MenuController::class);

Route::post('/menu/updateDelete', [MenuController::class, 'updateDelete'])->name('menu.updateDelete');



//CMS Admin Contact Us

Route::resource('/contactus', ContactUsController::class);

Route::post('/contactus/updateDelete', [ContactUsController::class, 'updateDelete'])->name('contactus.updateDelete');



//CMS Admin Users

Route::resource('/user', UserController::class);

Route::post('/user/updateDelete', [UserController::class, 'updateDelete'])->name('user.updateDelete');



//CMS Admin BusinessType

Route::resource('/businesstype', BusinessTypeController::class);

Route::post('/businesstype/updateDelete', [BusinessTypeController::class, 'updateDelete'])->name('businesstype.updateDelete');



//CMS Admin BusinessHome

Route::resource('/businesshome', BusinessHomeController::class);

Route::post('/businesshome/updateDelete', [BusinessHomeController::class, 'updateDelete'])->name('businesshome.updateDelete');



//CMS Admin BusinessDetail

Route::resource('/businessdetail', BusinessDetailController::class);

Route::post('/businessdetail/updateDelete', [BusinessDetailController::class, 'updateDelete'])->name('businessdetail.updateDelete');



//CMS Admin ProductServicesHome

Route::resource('/productserviceshome', ProductServicesHomeController::class);

Route::post('/productserviceshome/updateDelete', [ProductServicesHomeController::class, 'updateDelete'])->name('productserviceshome.updateDelete');



//CMS Admin ProductServicesDetail

Route::resource('/productservicesdetail', ProductServicesDetailController::class);

Route::post('/productservicesdetail/updateDelete', [ProductServicesDetailController::class, 'updateDelete'])->name('productservicesdetail.updateDelete');



//CMS Admin NewEventsMain

Route::resource('/neweventsmain', NewEventsMainController::class);

Route::post('/neweventsmain/updateDelete', [NewEventsMainController::class, 'updateDelete'])->name('neweventsmain.updateDelete');

Route::delete('/neweventsmain/image/delete/{id}', [NewEventsMainController::class, 'destoyImage'])->name('neweventsmain.destoyImage');



//CMS Admin ProjectsReferenceType

Route::resource('/projectsreferencetype', ProjectsReferenceTypeController::class);

Route::post('/projectsreferencetype/updateDelete', [ProjectsReferenceTypeController::class, 'updateDelete'])->name('projectsreferencetype.updateDelete');



//CMS Admin ProjectsReferenceMain

Route::resource('/projectsreferencemain', ProjectsReferenceMainController::class);

Route::post('/projectsreferencemain/updateDelete', [ProjectsReferenceMainController::class, 'updateDelete'])->name('projectsreferencemain.updateDelete');

Route::delete('/projectsreferencemain/image/delete/{id}', [ProjectsReferenceMainController::class, 'destoyImage'])->name('projectsreferencemain.destoyImage');



//CMS Admin Footer

Route::resource('/footer', FooterController::class);

Route::post('/footer/updateDelete', [FooterController::class, 'updateDelete'])->name('footer.updateDelete');



//CMS Admin CareerMain

Route::resource('/careermain', CareerMainController::class);

Route::post('/careermain/updateDelete', [CareerMainController::class, 'updateDelete'])->name('careermain.updateDelete');



//CMS Admin CareerDetail

Route::resource('/careerdetail', CareerDetailController::class);

Route::post('/careerdetail/updateDelete', [CareerDetailController::class, 'updateDelete'])->name('careerdetail.updateDelete');



//CMS Admin Contact

Route::resource('/contact', ContactController::class);



//CMS Admin AboutUs9001

Route::resource('/aboutus9001', AboutUs9001Controller::class);

Route::post('/aboutus9001/updateDelete', [AboutUs9001Controller::class, 'updateDelete'])->name('aboutus9001.updateDelete');



//CMS Admin AboutUs45001

Route::resource('/aboutus45001', AboutUs45001Controller::class);

Route::post('/aboutus45001/updateDelete', [AboutUs45001Controller::class, 'updateDelete'])->name('aboutus45001.updateDelete');



//CMS Admin AboutUsAchievement

Route::resource('/aboutusachievement', AboutUsAchievementController::class);

Route::post('/aboutusachievement/updateDelete', [AboutUsAchievementController::class, 'updateDelete'])->name('aboutusachievement.updateDelete');

Route::delete('/aboutusachievement/image/delete/{id}', [AboutUsAchievementController::class, 'destoyImage'])->name('aboutusachievement.destoyImage');



//CMS Admin AboutUsEthics

Route::resource('/aboutusethics', AboutUsEthicsController::class);

Route::post('/aboutusethics/updateDelete', [AboutUsEthicsController::class, 'updateDelete'])->name('aboutusethics.updateDelete');



//CMS Admin AboutUsIEC

Route::resource('/aboutusiec', AboutUsIECController::class);

Route::post('/aboutusiec/updateDelete', [AboutUsIECController::class, 'updateDelete'])->name('aboutusiec.updateDelete');



//CMS Admin AboutUsOrganiztionalStructure

Route::resource('/aboutusorganiztionalstructure', AboutUsOrganiztionalStructureController::class);

Route::post('/aboutusorganiztionalstructure/updateDelete', [AboutUsOrganiztionalStructureController::class, 'updateDelete'])->name('aboutusorganiztionalstructure.updateDelete');
Route::post('/aboutusorganiztionalstructure/resequence', [AboutUsOrganiztionalStructureController::class, 'resequence'])->name('aboutusorganiztionalstructure.resequence');



//CMS Admin AboutUs

Route::resource('/aboutus', AboutUsController::class);

Route::post('/aboutus/updateDelete', [AboutUsController::class, 'updateDelete'])->name('aboutus.updateDelete');



//CMS Admin AboutUsDetail

Route::resource('/aboutusdetail', AboutUsDetailController::class);

Route::post('/aboutusdetail/updateDelete', [AboutUsDetailController::class, 'updateDelete'])->name('aboutusdetail.updateDelete');



//CMS Admin AboutUsValues

Route::resource('/aboutusvalues', AboutUsValuesController::class);

Route::post('/aboutusvalues/updateDelete', [AboutUsValuesController::class, 'updateDelete'])->name('aboutusvalues.updateDelete');



//CMS Admin AboutUsWhyChoose

Route::resource('/aboutuswhychoose', AboutUsWhyChooseController::class);

Route::post('/aboutuswhychoose/updateDelete', [AboutUsWhyChooseController::class, 'updateDelete'])->name('aboutuswhychoose.updateDelete');



//CMS Admin AboutUsPolicy

Route::resource('/aboutuspolicy', AboutUsPolicyController::class);

Route::post('/aboutuspolicy/updateDelete', [AboutUsPolicyController::class, 'updateDelete'])->name('aboutuspolicy.updateDelete');



//CMS Admin AboutUsCarbon

Route::resource('/aboutuscarbon', AboutUsCarbonController::class);

Route::post('/aboutuscarbon/updateDelete', [AboutUsCarbonController::class, 'updateDelete'])->name('aboutuscarbon.updateDelete');



require __DIR__ . '/auth.php';

