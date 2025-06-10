<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dashboard\Maadiran;
use Illuminate\Support\Facades\Auth;
use App\Models\dashboard\Departmans;
use App\Models\dashboard\Supervisor;

class MaadiranController extends Controller
{

    public function index()
    {
        $maadirans = Maadiran::all();
        $role = Auth::user()->role;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        $maadiranCount = Maadiran::count();
        return view('dashboard/allMaadiran', compact('maadirans', 'role', 'maadiranCount', 'supervisors', 'departmans'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        $maadirans = Maadiran::all();
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return view('dashboard/createMaadiran', compact('maadirans', 'role', 'supervisors', 'departmans'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'persian_alpha'],
            'idCard' => ['required', 'ir_national_id'],
            'departmans_id' => ['required', 'exists:departmans,id'],
            'supervisors_id' => ['required', 'exists:supervisors,id'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'in:موبایل,لپتاپ,لوازم خانگی,تلویزیون,سایر'],
            'descriptionUser' => ['nullable', 'string'],
            'accept' => ['required', 'in:No,Yes'],

        ], [
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'idCard.required' => 'کد ملی را وارد کنید',
            'departmans_id.required' => 'دپارتمان خود را وارد کنید',
            'supervisors_id.required' => 'مدیر واحد خود را انتخاب کنید',
            'price.required' => 'مبلغ درخواست را وارد کنید',
            'price.numeric' => 'مبلغ باید به صورت عدد باشد',
            'accept.required' => 'قوانین را میپذیرم'
        ]);


        $role = Auth::user()->role;

        if (!in_array($role, ['admin', 'author', 'manager1', 'manager2', 'humanResources', 'subscriber'])) {
            abort(403, 'دسترسی غیرمجاز');
        }

        $fields['author_id'] = Auth::id();
        $fields['accept'] = $request->has('accept') ? 'Yes' : 'No';


        $maadirans = Maadiran::create($fields);
        return $maadirans
            ? redirect()->route('maadiran.create')->with('success', 'درخواست شما با موفقیت ثبت شد.')
            : redirect()->route('maadiran.create')->with('error', 'مشکلی رخ داده است.');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maadiran = Maadiran::find($id);
        $role = Auth::user()->role;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return $maadiran ? view('dashboard.editMaadiran', compact('maadiran', 'role', 'supervisors', 'departmans')) : redirect()->route('maadiran.index')->with('error', 'درخواست مورد نظر پیدا نشد.');
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
