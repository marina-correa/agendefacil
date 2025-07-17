<?php
namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function indexAgenda()
    {
        $services = Service::all();
        return view('agenda', compact('services'));
    }
}
