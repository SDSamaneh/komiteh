<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Announcement;
use App\Models\dashboard\Maadiran;
use App\Models\dashboard\Service;
use App\Models\dashboard\Vam;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // گرفتن کاربر لاگین شده

        if ($user) {
            $vamCount = Vam::where('author_id', $user->id)->count();
            $serviceCount = Service::where('author_id', $user->id)->count();
            $maadiranCount = Maadiran::where('author_id', $user->id)->count();
            $announcementCount = Announcement::count();
        } else {
            $vamCount = $serviceCount = $announcementCount = $maadiranCount = 0;
        }

        $vams = Vam::where('author_id', $user->id)->get()->map(function ($item) {
            return [
                'type' => 'درخواست وام',
                'status' => $item->status,
                'created_at' => $item->created_at,
                'edit_route' => route('vam.edit', $item->id),
            ];
        });

        $services = Service::where('author_id', $user->id)->get()->map(function ($item) {
            return [
                'type' => 'درخواست تعمیرگاه',
                'title' => $item->title,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'edit_route' => route('service.edit', $item->id),
            ];
        });

        $maadirans = Maadiran::where('author_id', $user->id)->get()->map(function ($item) {
            return [
                'type' => 'درخواست خرید از مادیران',
                'title' => $item->title,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'edit_route' => route('maadiran.edit', $item->id),
            ];
        });

        $allRequests = $vams->merge($services)->merge($maadirans)->sortByDesc('created_at');

        return view('dashboard.index', compact('user', 'vamCount', 'allRequests', 'serviceCount', 'announcementCount', 'maadiranCount'));
    }
}
