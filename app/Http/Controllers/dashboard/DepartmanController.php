<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Departmans;
use App\Models\dashboard\Supervisor;
use Illuminate\Http\Request;

class DepartmanController extends Controller
{

    public function index(Request $request)
    {
             $query = Departmans::query();
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $departmans = $query->latest('departmans.created_at')->paginate(10);
        $departmanCount = Departmans::count();
        return view('dashboard/departman', compact('departmans', 'departmanCount'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'persian_alpha'],

        ], [
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
        ]);
        $departman = Departmans::create($fields);

        return $departman ? redirect()->route('departman.index')->with('success', '  دپارتمان با موفقیت اضافه شد') :  redirect()->route('departman.index')->with('error', 'خطایی رخ داده است');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $departman = Departmans::find($id);

        return $departman ? view('dashboard.editDepartman', compact('departman')) : redirect()->route('departman.index')->with('error', 'درخواست مورد نظر پیدا نشد.');
    }


    public function update(Request $request, string $id)
    {
        // دریافت دپارتمان مورد نظر
        $departman = Departmans::findOrFail($id);

        // اعتبارسنجی ورودی
        $request->validate([
            'name' => 'required|string|max:255|unique:departmans,name,' . $departman->id, // چک کردن یکتا بودن نام
        ]);

        // به‌روزرسانی اطلاعات دپارتمان
        $departman->name = $request->input('name');
        $departman->save(); // ذخیره تغییرات در دیتابیس

        // بازگشت به صفحه دپارتمان‌ها با پیام موفقیت
        return redirect()->route('departman.index')->with('success', 'دپارتمان با موفقیت ویرایش شد.');
    }

    public function destroy(string $id)
    {
        // بررسی وجود مدیر واحد وابسته به دپارتمان
        $departman = Departmans::findOrFail($id);

        // بررسی اینکه آیا مدیر واحدی به این دپارتمان وابسته است یا نه
        $supervisorExists = Supervisor::where('departmans_id', $id)->exists();

        if ($supervisorExists) {
            // اگر مدیر واحدی وجود داشته باشد که وابسته به این دپارتمان باشد
            return redirect()->route('departman.index')->with('error', 'این دپارتمان به یک مدیر واحد وابسته است و نمی‌توان آن را حذف کرد.');
        }

        // حذف دپارتمان اگر هیچ مدیر واحدی وابسته به آن نباشد
        $departman->delete();

        // بازگشت به صفحه دپارتمان‌ها با پیام موفقیت
        return redirect()->route('departman.index')->with('success', 'دپارتمان با موفقیت حذف شد.');
    }
}
