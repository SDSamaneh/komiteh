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

    public function index(Request $request)
    {
               $search = $request->search;

        $query = Maadiran::query()
            ->leftJoin('supervisors', 'maadirans.supervisors_id', '=', 'supervisors.id')
            ->leftJoin('departmans', 'maadirans.departmans_id', '=', 'departmans.id')
            ->select('maadirans.*'); // مهم: فقط ستون‌های جدول وام‌ها رو بگیر

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('maadirans.name', 'like', "%$search%")
                    ->orWhere('maadirans.idCard', 'like', "%$search%")
                    ->orWhere('maadirans.price', 'like', "%$search%")
                    ->orWhere('supervisors.name', 'like', "%$search%")
                    ->orWhere('departmans.name', 'like', "%$search%");
            });
        }

        $maadirans = $query->latest('maadirans.created_at')->paginate(10);

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


    public function update(Request $request, Maadiran $maadiran)
    {
         $user = auth()->user();

        switch ($user->role) {
            case 'subscriber':

                if ($maadiran->status === 'No') {
                    $request->merge([
                        'accept' => $request->has('accept') ? 'Yes' : 'No',
                    ]);
                    $request->validate([
                        'name' => 'required|string|max:255|persian_alpha',
                        'idCard' => 'required|string|ir_national_id',
                        'departmans_id' => 'required|exists:departmans,id',
                        'supervisors_id' => 'required|exists:supervisors,id',
                        'price' => 'required|numeric',
                        'category' => 'required|in:موبایل,لپتاپ,لوازم خانگی,تلویزیون,سایر',
                        'descriptionUser' => 'nullable|string',
                        'accept' => 'required|in:Yes,No',
                    ]);

                    $maadiran->update([
                        'name' => $request->name,
                        'idCard' => $request->idCard,
                        'departmans_id' => $request->departmans_id,
                        'supervisors_id' => $request->supervisors_id,
                        'price' => $request->price,
                        'category' => $request->category,
                        'descriptionUser' => $request->descriptionUser,
                        'accept' => $request->accept,
                    ]);
                } else {
                    return back()->with('error', 'امکان ویرایش وجود ندارد. درخواست وارد مراحل بعدی شده است.');
                }
                break;

            case 'author':

                $request->merge([
                    'accept' => $request->has('accept') ? 'Yes' : 'No',
                ]);

                $request->validate([
                    'name' => 'required|string|max:255|persian_alpha',
                    'idCard' => 'required|string|ir_national_id',
                    'price' => 'required|numeric',
                    'departmans_id' => 'required|exists:departmans,id',
                    'supervisors_id' => 'required|exists:supervisors,id',
                    'resone' => 'required|in:تحصیل,ازدواج,جهیزیه,درمان,تصادف,بیمه,فوت اقوام,سایر',
                    'descriptionUser' => 'nullable|string',
                    'accept' => 'required|in:Yes,No',

                ]);
                $maadiran->update([
                    'name' => $request->name,
                    'idCard' => $request->idCard,
                    'price' => $request->price,
                    'departmans_id' => $request->departmans_id,
                    'supervisors_id' => $request->supervisors_id,
                    'resone' => $request->resone,
                    'descriptionUser' => $request->descriptionUser,
                    'accept' => $request->accept,
                ]);
                break;


            case 'humanResources':
                $request->validate([
                    'memberDate' => 'required|date_format:Y/m/d|persian_date',
                    'memberPrice' => 'required|numeric',
                    'lastSalary' => 'required|numeric',
                    'debt' => 'required|numeric',
                    'validationDate' => 'required|date_format:Y/m/d|persian_date',
                    'validationHr' => 'required|in:Yes,No',
                ]);
                $maadiran->update([
                    'memberDate' => $request->memberDate,
                    'memberPrice' => $request->memberPrice,
                    'lastSalary' => $request->lastSalary,
                    'debt' => $request->debt,
                    'validationDate' => $request->validationDate,
                    'validationHr' => $request->validationHr,
                ]);
                break;
            case 'manager1': // مدیر مالی            
                $request->validate([
                    'validationManager1' => 'required|in:Yes,No',
                    'finalPrice' => 'required|numeric',
                    'description' => 'nullable|string|max:1000',
                ]);

                $maadiran->update([
                    'finalPrice' => $request->finalPrice,
                    'description' => $request->description,
                    'validationManager1' => $request->validationManager1,
                ]);

                break;

            case 'manager2': // رییس کمیته رفاهی
                $request->validate([
                    'validationManager2' => 'required|in:Yes,No',
                ]);

                $maadiran->update([
                    'validationManager2' => $request->validationManager2,
                ]);

                break;

            default:
                return abort(403, 'شما اجازه دسترسی به این عملیات را ندارید.');
        }

        return redirect()->back()->with('success', 'تغییرات با موفقیت ذخیره شد.');
    }

    public function destroy(string $id)
    {
         $maadiran = Maadiran::findOrfail($id);
        $maadiranDestroy = $maadiran->delete();
        return $maadiranDestroy ? redirect()->route('maadiran.index')->with('success', 'درخواست مورد نظر با موفقیت حذف گردید') : redirect()->route('maadiran.index')->with('error', 'خطایی در حذف درخواست  مورد نظر رخ داده است');
    }
}
