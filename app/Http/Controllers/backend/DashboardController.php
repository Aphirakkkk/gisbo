<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CareerMain;
use App\Models\ContactUs;
use App\Models\NewEventsMain;
use App\Models\ProductServicesHome;
use App\Models\ProjectsReferenceMain;
use App\Models\User;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['titlePage'] = "Dashboard";
        $data['DataTimeThaiFull'] = ThaiDateHelperService::DataTimeThaiFull();

        $data['countBanner'] = Banner::where('active_status', 1)->count();
        $data['countNews'] = NewEventsMain::where('active_status', 1)->count();
        $data['countProjects'] = ProjectsReferenceMain::where('active_status', 1)->count();
        $data['countProducts'] = ProductServicesHome::where('active_status', 1)->count();
        $data['countCareers'] = CareerMain::where('active_status', 1)->count();
        $data['countContacts'] = ContactUs::where('active_status', 1)->count();
        $data['countUsers'] = User::where('active_status', 1)->count();

        $data['recentContacts'] = ContactUs::where('active_status', 1)->latest()->take(5)->get();
        $data['recentNews'] = NewEventsMain::where('active_status', 1)->latest()->take(5)->get();

        return view('backend.dashboard.index', $data);
    }
}
