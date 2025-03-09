<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        return view('pages.website.index');
    }
    public function contactUs(): View
    {
        return view('pages.website.contact');
    }
    public function privacyPolicy(): View
    {
        return view('pages.website.privacy-policy');
    }
    public function refundPolicy(): View
    {
        return view('pages.website.refund-policy');
    }
    public function shippingPolicy(): View
    {
        return view('pages.website.shipping-policy');
    }
    public function aboutUs(): View
    {
        return view('pages.website.about-us');
    }

    public function products(): View
    {
        return view('pages.website.products');
    }

    public function deleteAccount(): View
    {
        return view('pages.website.delete-account');
    }
}
