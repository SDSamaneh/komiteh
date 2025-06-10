<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Departmans;
use App\Models\dashboard\Maadiran;
use App\Models\dashboard\Service;
use App\Models\dashboard\Supervisor;
use Illuminate\Http\Request;
use App\Models\dashboard\Vam;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    // vamRequest
    public function vamRequestsForSupervisor()
    {
        // شناسه مدیر واحد لاگین شده
        $supervisorId = auth()->user()->supervisor_id;
        // وام‌هایی که نویسنده‌شان کاربری است که supervisor_id آن برابر با این مقدار است
        $vams = Vam::whereHas('user', function ($query) use ($supervisorId) {
            $query->where('supervisor_id', $supervisorId);
        })->with('user')->get();

        return view('dashboard/supervisorVams', compact('vams'));
    }

    public function editVam(Vam $vam)
    {
        // اطمینان از اینکه این وام متعلق به کاربر زیرمجموعه مدیر است:
        $supervisorId = auth()->user()->supervisor_id;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();

        if ($vam->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }

        return view('dashboard/editSupervisorVams', compact('vam', 'supervisors', 'departmans'));
    }

    public function updateVam(Request $request, Vam $vam)
    {
        $supervisorId = auth()->user()->supervisor_id;

        if ($vam->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }

        $request->validate([

            'status' => 'required|in:No,Yes',
        ]);

        try {
            $vam->update([
                'status' => $request->status,
            ]);

            return redirect()->route('supervisor.vam.index')->with('success', 'درخواست با موفقیت به‌روزرسانی شد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطایی در ذخیره‌سازی رخ داده است.');
        }
    }

    // serviceRequest
    public function serviceRequestsForSupervisor()
    {
        $supervisorId = auth()->user()->supervisor_id;
        $services = Service::whereHas('user', function ($query) use ($supervisorId) {
            $query->where('supervisor_id', $supervisorId);
        })->with('user')->get();

        return view('dashboard/supervisorServices', compact('services'));
    }

    public function editService(Service $service)
    {
        // اطمینان از اینکه این وام متعلق به کاربر زیرمجموعه مدیر است:
        $supervisorId = auth()->user()->supervisor_id;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();

        if ($service->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }

        return view('dashboard/editSupervisorServics', compact('service', 'supervisors', 'departmans'));
    }

    public function updateService(Request $request, Service $service)
    {
        $supervisorId = auth()->user()->supervisor_id;

        if ($service->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }
        $request->validate([

            'status' => 'required|in:No,Yes',
        ]);

        try {
            $service->update([
                'status' => $request->status,
            ]);

            return redirect()->route('supervisor.service.index')->with('success', 'درخواست با موفقیت به‌روزرسانی شد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطایی در ذخیره‌سازی رخ داده است.');
        }
    }

    // maadiranRequest
    public function maadiranRequestsForSupervisor()
    {
        // شناسه مدیر واحد لاگین شده
        $supervisorId = auth()->user()->supervisor_id;
        // وام‌هایی که نویسنده‌شان کاربری است که supervisor_id آن برابر با این مقدار است
        $maadirans = Maadiran::whereHas('user', function ($query) use ($supervisorId) {
            $query->where('supervisor_id', $supervisorId);
        })->with('user')->get();

        return view('dashboard/supervisorMaadirans', compact('maadirans'));
    }
    public function editMaadiran(Maadiran $maadiran)
    {

        $supervisorId = auth()->user()->supervisor_id;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();

        if ($maadiran->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }

        return view('dashboard/editSupervisorMaadirans', compact('maadiran', 'supervisors', 'departmans'));
    }

    public function updateMaadiran(Request $request, Maadiran $maadiran)
    {

        $supervisorId = auth()->user()->supervisor_id;

        if ($maadiran->user->supervisor_id !== $supervisorId) {
            abort(403, 'دسترسی غیرمجاز');
        }
        $request->validate([

            'status' => 'required|in:No,Yes',
        ]);

        try {
            $maadiran->update([
                'status' => $request->status,
            ]);

            return redirect()->route('supervisor.maadiran.index')->with('success', 'درخواست با موفقیت به‌روزرسانی شد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطایی در ذخیره‌سازی رخ داده است.');
        }
    }



    public function index()
    {
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        $supervisorCount = Supervisor::count();
        return view('dashboard/supervisor', compact('supervisors', 'departmans', 'supervisorCount'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'persian_alpha'],
            'idCard' => ['required', 'ir_national_id'],
            'departmans_id' => ['required', 'exists:departmans,id'],

        ], [
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'idCard.required' => 'کد ملی خود را وارد کنید.'
        ]);

        $supervisor = Supervisor::create($fields);

        return $supervisor ? redirect()->route('supervisor.index')->with('success', '  مدیر واحد با موفقیت اضافه شد') :  redirect()->route('supervisor.index')->with('error', 'خطایی رخ داده است');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
