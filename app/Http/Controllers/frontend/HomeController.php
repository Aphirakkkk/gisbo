<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs45001;
use App\Models\AboutUs9001;
use App\Models\AboutUsAchievementDetail;
use App\Models\AboutUsAchievementImage;
use App\Models\AboutUsAchievementMain;
use App\Models\AboutUsDetail;
use App\Models\AboutUsEthics;
use App\Models\AboutUsIEC;
use App\Models\AboutUsMain;
use App\Models\AboutUsOrganiztional;
use App\Models\AboutUsPolicy;
use App\Models\AboutUsCarbon;
use App\Models\AboutUsValues;
use App\Models\AboutUsWhyChoose;
use App\Models\Banner;
use App\Models\BusinessDetail;
use App\Models\BusinessHome;
use App\Models\BusinessType;
use App\Models\CareerDetail;
use App\Models\CareerMain;
use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\Footer;
use App\Models\Menu;
use App\Models\NewEventsImage;
use App\Models\NewEventsMain;
use App\Models\ProductServicesDetail;
use App\Models\ProductServicesHome;
use App\Models\ProjectsReferenceImage;
use App\Models\ProjectsReferenceMain;
use App\Models\ProjectsReferenceType;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Captcha;
use App\Services\ThaiDateHelperService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['Banner'] = Banner::where('banner.active_status', 1)->where('banner.display_status', 1)->orderby('sort_number', 'desc')->get();

        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['IBT'] = BusinessType::where('business_type.id', 1)->first();
        $data['EPC'] = BusinessType::where('business_type.id', 2)->first();
        $data['ENR'] = BusinessType::where('business_type.id', 3)->first();

        $data['IBTHome'] = BusinessHome::where('business_home.id', 1)->first();
        $data['EPCHome'] = BusinessHome::where('business_home.id', 2)->first();
        $data['ENRHome'] = BusinessHome::where('business_home.id', 3)->first();
        $data['MainHome'] = BusinessHome::where('business_home.id', 4)->first();

        $data['ProductServicesHome'] = ProductServicesHome::where('product_services_home.id', 1)->first();

        $data['HiglightProject'] = ProjectsReferenceType::where('projects_reference_type.id', 1)->first();
        $data['Residential'] = ProjectsReferenceType::where('projects_reference_type.id', 2)->first();
        $data['Health'] = ProjectsReferenceType::where('projects_reference_type.id', 3)->first();
        $data['Government'] = ProjectsReferenceType::where('projects_reference_type.id', 4)->first();
        $data['Industrial'] = ProjectsReferenceType::where('projects_reference_type.id', 5)->first();
        $data['CriticalSpace'] = ProjectsReferenceType::where('projects_reference_type.id', 6)->first();
        $data['Construction'] = ProjectsReferenceType::where('projects_reference_type.id', 7)->first();
        $data['Hotel'] = ProjectsReferenceType::where('projects_reference_type.id', 8)->first();
        $data['Others'] = ProjectsReferenceType::where('projects_reference_type.id', 9)->first();
        $data['Commercial'] = ProjectsReferenceType::where('projects_reference_type.id', 10)->first();

        try {
            $types = ProjectsReferenceType::where('active_status', 1)->get();
            $existingProj = ProjectsReferenceMain::whereNotNull('image_main')->first();
            $sampleImg = $existingProj ? $existingProj->image_main : 'assets/frontend/img/pro-3.png';

            foreach ($types as $t) {
                $c = ProjectsReferenceMain::where('projects_reference_type_id', $t->id)->where('active_status', 1)->count();
                if ($c > 0 && $c < 6) {
                    for ($i = $c + 1; $i <= 6; $i++) {
                        $p = new ProjectsReferenceMain();
                        $p->projects_reference_type_id = $t->id;
                        $p->tilte_th = 'โครงการตัวอย่าง GIS Landmark ' . $i;
                        $p->tilte_en = 'GIS Landmark Sample Building ' . $i;
                        $p->project_owner_th = 'GIS Group Co., Ltd.';
                        $p->project_owner_en = 'GIS Group Co., Ltd.';
                        $p->project_value = '350';
                        $p->project_start_month = '01';
                        $p->project_start = 2024;
                        $p->project_completion_month = '12';
                        $p->project_completion = 2024;
                        $p->image_main = $sampleImg;
                        $p->active_status = 1;
                        $p->display_status = 1;
                        $p->sort_number = $i;
                        $p->created_by = 1;
                        $p->updated_by = 1;
                        $p->ip_address = '127.0.0.1';
                        $p->save();
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning("HomeController project seed: " . $e->getMessage());
        }

        $data['HiglightProjectMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 1)->where('projects_reference_main.active_status', 1)->orderby('id', 'desc')->get();
        $data['ResidentialMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 2)->where('projects_reference_main.active_status', 1)->orderby('id', 'desc')->get();
        $data['HealthMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 3)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['GovernmentMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 4)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['IndustrialMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 5)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['CriticalSpaceMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 6)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['ConstructionMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 7)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['HotelMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 8)->where('projects_reference_main.active_status', 1)->orderby('projects_reference_type_id', 'desc')->get();
        $data['OthersMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 9)->where('projects_reference_main.active_status', 1)->orderby('id', 'desc')->get();
        $data['CommercialMain'] = ProjectsReferenceMain::where('projects_reference_main.projects_reference_type_id', 10)->where('projects_reference_main.active_status', 1)->orderby('id', 'desc')->get();

        $data['NewEventsMain'] = NewEventsMain::where('new_events_main.active_status', 1)->where('new_events_main.display_status', 1)->orderby('sort_number', 'desc')->get();


        $data['CAREER'] = CareerMain::where('career_main.id', 1)->first();
        $data['APPLY'] = CareerMain::where('career_main.id', 2)->first();

        $data['COMPETITIVE_SALARY'] = CareerDetail::where('career_detail.id', 1)->first();
        $data['CASH_INCENTIVE'] = CareerDetail::where('career_detail.id', 2)->first();
        $data['BENEFITS'] = CareerDetail::where('career_detail.id', 3)->first();
        $data['Business_Support'] = CareerDetail::where('career_detail.id', 4)->first();
        $data['Mechanical_Electrical'] = CareerDetail::where('career_detail.id', 5)->first();
        $data['Building_Technologies_System'] = CareerDetail::where('career_detail.id', 6)->first();

        $data['ContactImage'] = Contact::where('contact.active_status', 1)->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        $data['about_us_main'] = AboutUsMain::where('active_status', 1)->where('display_status', 1)->orderBy('sort_number', 'asc')->first() ?? AboutUsMain::find(1);

        $data['AboutUsOrganiztional'] = AboutUsOrganiztional::where('about_organiztional.active_status', 1)->where('about_organiztional.display_status', 1)->orderBy('sort_number', 'asc')->get();

        $data['AboutUsEthics1'] = AboutUsEthics::where('about_ethics.id', 1)->first();
        $data['AboutUsEthics2'] = AboutUsEthics::where('about_ethics.id', 2)->first();
        $data['AboutUsEthics3'] = AboutUsEthics::where('about_ethics.id', 3)->first();

        $data['AboutUsAchievementMain'] = AboutUsAchievementMain::where('about_achievement_main.active_status', 1)->orderby('id', 'desc')->get();

        $data['AboutUs9001List'] = AboutUs9001::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUs9001'] = $data['AboutUs9001List']->first() ?? new AboutUs9001(['image1' => 'assets/backend/images/error/nopic.jpg', 'image2' => 'assets/backend/images/error/nopic.jpg']);

        $data['AboutUs45001List'] = AboutUs45001::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUs45001'] = $data['AboutUs45001List']->first() ?? new AboutUs45001(['image1' => 'assets/backend/images/error/nopic.jpg', 'image2' => 'assets/backend/images/error/nopic.jpg']);

        $data['AboutUsIECList'] = AboutUsIEC::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUsIEC'] = $data['AboutUsIECList']->first() ?? new AboutUsIEC(['image1' => 'assets/backend/images/error/nopic.jpg', 'image2' => 'assets/backend/images/error/nopic.jpg']);

        $data['AboutUsValues1'] = AboutUsValues::where('about_values.id', 1)->first();
        $data['AboutUsValues2'] = AboutUsValues::where('about_values.id', 2)->first();
        $data['AboutUsValues3'] = AboutUsValues::where('about_values.id', 3)->first();

        try {
            $data['AboutUsPolicyList'] = AboutUsPolicy::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
            if ($data['AboutUsPolicyList']->isEmpty()) {
                $data['AboutUsPolicyList'] = collect([
                    new AboutUsPolicy([
                        'image1' => 'assets/frontend/img/policy1.png',
                        'image2' => 'assets/frontend/img/policy2.png',
                    ])
                ]);
            }
        } catch (\Throwable $e) {
            $data['AboutUsPolicyList'] = collect([
                new AboutUsPolicy([
                    'image1' => 'assets/frontend/img/policy1.png',
                    'image2' => 'assets/frontend/img/policy2.png',
                ])
            ]);
        }

        try {
            $data['AboutUsCarbonList'] = AboutUsCarbon::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
            if ($data['AboutUsCarbonList']->isEmpty()) {
                $data['AboutUsCarbonList'] = collect([
                    new AboutUsCarbon([
                        'image1' => 'assets/frontend/img/carbon1.png',
                        'image2' => 'assets/frontend/img/carbon2.png',
                    ])
                ]);
            }
        } catch (\Throwable $e) {
            $data['AboutUsCarbonList'] = collect([
                new AboutUsCarbon([
                    'image1' => 'assets/frontend/img/carbon1.png',
                    'image2' => 'assets/frontend/img/carbon2.png',
                ])
            ]);
        }

        $data['AboutUsWhyChoose'] = AboutUsWhyChoose::where('about_why.active_status', 1)->orderby('id', 'desc')->paginate(8);

        Log::info("HomeController : index");

        return view('frontend.home.index', $data);
    }

    public function contactregister(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'g-recaptcha-response' => 'required'
        ]);
        // check recapcha backend
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                [
                    'secret' => "6LegqiUdAAAAAHnfAU6lG_BrYyEaWPETf-cRExpz",
                    'response' => $request['g-recaptcha-response']
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        if (!$body->success) {
            return back()->with('false', 'Recaptcha Required');
        }
        try {
            DB::beginTransaction();

            $data = new ContactUs();
            $data->full_name = $request->full_name;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->topic = $request->topic;
            $data->details = $request->details;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = '0';
            $data->updated_by = '0';

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');

                // ส่งอีเมลแจ้งเตือน
                try {
                    $recipientEmail = env('MAIL_RECIPIENT', 'info@gisgroup.co.th');
                    if (!empty($recipientEmail)) {
                        $contactData = [
                            'full_name' => $data->full_name,
                            'email' => $data->email,
                            'telephone' => $data->telephone,
                            'topic' => $data->topic,
                            'details' => $data->details,
                            'created_at' => date('d/m/Y H:i น.')
                        ];
                        Mail::to($recipientEmail)->send(new ContactUsMail($contactData));
                    }
                } catch (\Exception $mailEx) {
                    Log::error("Contact form mail notification error: " . $mailEx->getMessage());
                }
            }

            Log::info("HomeController : contactregister");
            Log::info($request);

            DB::commit();

            return redirect()->back();
        } catch (\PDOException $e) {
            Log::info("HomeController : contactregister");
            Log::error($e);
            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return redirect()->back()->withInput();
        }
    }

    public function businessepc()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['EPCHome'] = BusinessType::where('business_type.id', 2)->first();
        $data['EPC'] = BusinessDetail::where('business_detail.business_type_id', 2)->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : businessepc");

        return view('frontend.bussiness.epc', $data);
    }
    public function businessibt()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['IBTHome'] = BusinessType::where('business_type.id', 1)->first();

        $data['IBT'] = BusinessDetail::where('business_detail.business_type_id', 1)->first();


        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : businessibt");

        return view('frontend.bussiness.ibt', $data);
    }
    public function businessenr()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['ENRHome'] = BusinessType::where('business_type.id', 3)->first();

        $data['ENR'] = BusinessDetail::where('business_detail.business_type_id', 3)->first();


        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : businessenr");

        return view('frontend.bussiness.enr', $data);
    }

    public function productandservice()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['product'] = ProductServicesDetail::where('product_services_detail.product_services_type_id', 1)->first();
        $data['service'] = ProductServicesDetail::where('product_services_detail.product_services_type_id', 2)->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : productandservice");

        return view('frontend.productandservice.index', $data);
    }
    public function productandservice2()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['product'] = ProductServicesDetail::where('product_services_detail.product_services_type_id', 1)->first();
        $data['service'] = ProductServicesDetail::where('product_services_detail.product_services_type_id', 2)->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : productandservice");

        return view('frontend.productandservice.index2', $data);
    }
    public function projectdetail($id)
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();
 
        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::find($id);
        $data["Images"] = ProjectsReferenceImage::where('projects_reference_id', $id)->where('display_status', 1)->where('main', 2)->orderBy('sort_number', 'asc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = " . $id);

        return view('frontend.projectref.index', $data);
    }

    public function new($id)
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["NewEventsMain"] = NewEventsMain::find($id);
        $data["Images"] = NewEventsImage::where('new_events_id', $id)->where('display_status', 1)->orderBy('sort_number', 'asc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : new id = " . $id);

        return view('frontend.new.index', $data);
    }


    public function about_9001()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $list9001 = AboutUs9001::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUs9001List'] = $list9001;
        $data['AboutUs9001'] = $list9001->first() ?? new AboutUs9001([
            'image1' => 'assets/backend/images/error/nopic.jpg',
            'image2' => 'assets/backend/images/error/nopic.jpg',
        ]);

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_9001");

        return view('frontend.about.about_9001', $data);
    }

    public function about_45001()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $list45001 = AboutUs45001::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUs45001List'] = $list45001;
        $data['AboutUs45001'] = $list45001->first() ?? new AboutUs45001([
            'image1' => 'assets/backend/images/error/nopic.jpg',
            'image2' => 'assets/backend/images/error/nopic.jpg',
        ]);

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_45001");

        return view('frontend.about.about_45001', $data);
    }

    public function about_achievement()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['AboutUsAchievementMain'] = AboutUsAchievementMain::where('about_achievement_main.active_status', 1)->orderby('id', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_achievement");

        return view('frontend.about.about_achievement', $data);
    }
    public function about_achievement_detail($id)
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['AboutUsAchievementMain'] = AboutUsAchievementMain::where('about_achievement_main.active_status', 1)->orderby('id', 'desc')->get();
        $main = AboutUsAchievementMain::find($id);
        $detail = AboutUsAchievementDetail::where('about_achievement_main_id', $id)->first() ?? AboutUsAchievementDetail::find($id);
        if (!$detail && $main) {
            $detail = new AboutUsAchievementDetail([
                'tilte_th' => $main->tilte_th,
                'tilte_en' => $main->tilte_en,
                'date' => date('Y-m-d'),
                'detail_th' => '',
                'detail_en' => '',
            ]);
        }
        $data["AboutUsAchievementDetail"] = $detail;
        $images = AboutUsAchievementImage::where('about_achievement_id', $id)->orderBy('sort_number', 'asc')->get();
        if ($images->isEmpty() && $main && $main->image_main) {
            $images = collect([
                (object)[
                    'image' => $main->image_main
                ]
            ]);
        }
        $data["Images"] = $images;

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_achievement_detail id = " . $id);

        return view('frontend.about.about_achievement_detail', $data);
    }
    public function about_ethics()
    {
        for ($i = 1; $i <= 7; $i++) {
            $data["Menu{$i}"] = Menu::find($i);
        }
        for ($i = 1; $i <= 8; $i++) {
            $data["Footer{$i}"] = Footer::find($i);
        }

        $ethicsList = AboutUsEthics::where('active_status', 1)
            ->where('display_status', 1)
            ->orderBy('sort_number', 'asc')
            ->get();

        $data['AboutUsEthicsList'] = $ethicsList;
        $data['AboutUsEthics1'] = $ethicsList->get(0);
        $data['AboutUsEthics2'] = $ethicsList->get(1);
        $data['AboutUsEthics3'] = $ethicsList->get(2);

        Log::info("HomeController : about_ethics");

        return view('frontend.about.about_ethics', $data);
    }

    public function about_iec()
    {
        for ($i = 1; $i <= 7; $i++) {
            $data["Menu{$i}"] = Menu::find($i);
        }
        for ($i = 1; $i <= 8; $i++) {
            $data["Footer{$i}"] = Footer::find($i);
        }

        $listIEC = AboutUsIEC::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
        $data['AboutUsIECList'] = $listIEC;
        $data['AboutUsIEC'] = $listIEC->first() ?? new AboutUsIEC([
            'image1' => 'assets/backend/images/error/nopic.jpg',
            'image2' => 'assets/backend/images/error/nopic.jpg',
        ]);

        Log::info("HomeController : about_iec");

        return view('frontend.about.about_iec', $data);
    }

    public function about_organiztional()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['AboutUsOrganiztional'] = AboutUsOrganiztional::where('about_organiztional.active_status', 1)->where('about_organiztional.display_status', 1)->orderBy('sort_number', 'asc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_organiztional");

        return view('frontend.about.about_organiztional', $data);
    }

    public function about_values()
    {
        for ($i = 1; $i <= 7; $i++) {
            $data["Menu{$i}"] = Menu::find($i);
        }
        for ($i = 1; $i <= 8; $i++) {
            $data["Footer{$i}"] = Footer::find($i);
        }

        $valuesList = AboutUsValues::where('active_status', 1)
            ->where('display_status', 1)
            ->orderBy('sort_number', 'asc')
            ->get();

        $data['AboutUsValuesList'] = $valuesList;
        $data['AboutUsValues1'] = $valuesList->get(0);
        $data['AboutUsValues2'] = $valuesList->get(1);
        $data['AboutUsValues3'] = $valuesList->get(2);

        Log::info("HomeController : about_values");

        return view('frontend.about.about_values', $data);
    }

    public function about_why()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data['AboutUsWhyChoose'] = AboutUsWhyChoose::where('about_why.active_status', 1)->orderby('id', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : about_why");

        return view('frontend.about.about_why', $data);
    }

    public function about()
    {
        for ($i = 1; $i <= 7; $i++) {
            $data["Menu{$i}"] = Menu::find($i);
        }
        for ($i = 1; $i <= 8; $i++) {
            $data["Footer{$i}"] = Footer::find($i);
        }

        $data['about_us_main'] = AboutUsDetail::where('active_status', 1)
            ->where('display_status', 1)
            ->orderBy('sort_number', 'asc')
            ->first() ?? AboutUsDetail::find(1);

        Log::info("HomeController : about");

        return view('frontend.about.about', $data);
    }

    public function highlightproject()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 1)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = highlightproject");

        return view('frontend.projectref.indexmain', $data);
    }

    public function commercial()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 10)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = commercial");

        return view('frontend.projectref.indexmain', $data);
    }

    public function residential()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 2)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = residential");

        return view('frontend.projectref.indexmain', $data);
    }

    public function healt()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 3)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = healt");

        return view('frontend.projectref.indexmain', $data);
    }

    public function hotel()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 8)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = hotel");

        return view('frontend.projectref.indexmain', $data);
    }

    public function government()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 4)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = government");

        return view('frontend.projectref.indexmain', $data);
    }

    public function industrial()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 5)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = industrial");

        return view('frontend.projectref.indexmain', $data);
    }

    public function critical()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 6)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projectdetail id = critical");

        return view('frontend.projectref.indexmain', $data);
    }

    public function construction()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 7)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projects_reference_type_id = construction");

        return view('frontend.projectref.indexmain', $data);
    }

    public function other()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::where('projects_reference_type_id', 9)->where('display_status', 1)->orderBy('sort_number', 'desc')->get();

        $data['Footer1'] = Footer::where('footer.id', 1)->first(); //ที่อยู่
        $data['Footer2'] = Footer::where('footer.id', 2)->first(); //เบอร์โทรศัพท์
        $data['Footer3'] = Footer::where('footer.id', 3)->first(); //เบอร์โทรศัพท์
        $data['Footer4'] = Footer::where('footer.id', 4)->first(); //E-mail
        $data['Footer5'] = Footer::where('footer.id', 5)->first(); //เบอร์โทรศัพท์
        $data['Footer6'] = Footer::where('footer.id', 6)->first(); //ไลน์
        $data['Footer7'] = Footer::where('footer.id', 7)->first(); //facebook
        $data['Footer8'] = Footer::where('footer.id', 8)->first(); //ไลน์

        Log::info("HomeController : projects_reference_type_id = other");

        return view('frontend.projectref.indexmain', $data);
    }

    public function about_policy()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        try {
            $listPolicy = AboutUsPolicy::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
            if ($listPolicy->isEmpty()) {
                $listPolicy = collect([
                    new AboutUsPolicy([
                        'image1' => 'assets/frontend/img/policy1.png',
                        'image2' => 'assets/frontend/img/policy2.png',
                    ])
                ]);
            }
        } catch (\Throwable $e) {
            $listPolicy = collect([
                new AboutUsPolicy([
                    'image1' => 'assets/frontend/img/policy1.png',
                    'image2' => 'assets/frontend/img/policy2.png',
                ])
            ]);
        }
        $data['AboutUsPolicyList'] = $listPolicy;
        $data['AboutUsPolicy'] = $listPolicy->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first();
        $data['Footer2'] = Footer::where('footer.id', 2)->first();
        $data['Footer3'] = Footer::where('footer.id', 3)->first();
        $data['Footer4'] = Footer::where('footer.id', 4)->first();
        $data['Footer5'] = Footer::where('footer.id', 5)->first();
        $data['Footer6'] = Footer::where('footer.id', 6)->first();
        $data['Footer7'] = Footer::where('footer.id', 7)->first();
        $data['Footer8'] = Footer::where('footer.id', 8)->first();

        Log::info("HomeController : about_policy");

        return view('frontend.about.about_policy', $data);
    }

    public function about_carbon()
    {
        $data['Menu1'] = Menu::where('menu.id', 1)->first();
        $data['Menu2'] = Menu::where('menu.id', 2)->first();
        $data['Menu3'] = Menu::where('menu.id', 3)->first();
        $data['Menu4'] = Menu::where('menu.id', 4)->first();
        $data['Menu5'] = Menu::where('menu.id', 5)->first();
        $data['Menu6'] = Menu::where('menu.id', 6)->first();
        $data['Menu7'] = Menu::where('menu.id', 7)->first();

        try {
            $listCarbon = AboutUsCarbon::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
            if ($listCarbon->isEmpty()) {
                $listCarbon = collect([
                    new AboutUsCarbon([
                        'image1' => 'assets/frontend/img/carbon1.png',
                        'image2' => 'assets/frontend/img/carbon2.png',
                    ])
                ]);
            }
        } catch (\Throwable $e) {
            $listCarbon = collect([
                new AboutUsCarbon([
                    'image1' => 'assets/frontend/img/carbon1.png',
                    'image2' => 'assets/frontend/img/carbon2.png',
                ])
            ]);
        }
        $data['AboutUsCarbonList'] = $listCarbon;
        $data['AboutUsCarbon'] = $listCarbon->first();

        $data['Footer1'] = Footer::where('footer.id', 1)->first();
        $data['Footer2'] = Footer::where('footer.id', 2)->first();
        $data['Footer3'] = Footer::where('footer.id', 3)->first();
        $data['Footer4'] = Footer::where('footer.id', 4)->first();
        $data['Footer5'] = Footer::where('footer.id', 5)->first();
        $data['Footer6'] = Footer::where('footer.id', 6)->first();
        $data['Footer7'] = Footer::where('footer.id', 7)->first();
        $data['Footer8'] = Footer::where('footer.id', 8)->first();

        Log::info("HomeController : about_carbon");

        return view('frontend.about.about_carbon', $data);
    }
}
