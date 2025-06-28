<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Http\Controllers\Controller;

use App\Http\Requests\dashboard\vam\EditVam;
use App\Http\Requests\dashboard\vam\StoreVam;
use App\Models\dashboard\Departmans;
use App\Models\dashboard\Supervisor;
use App\Models\dashboard\Vam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\dashboard\Vam as DashboardVam;

class VamController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, DashboardVam $vam)
    {
        $search = $request->search;

        $query = Vam::query()
            ->leftJoin('supervisors', 'vams.supervisors_id', '=', 'supervisors.id')
            ->leftJoin('departmans', 'vams.departmans_id', '=', 'departmans.id')
            ->select('vams.*'); // مهم: فقط ستون‌های جدول وام‌ها رو بگیر

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('vams.name', 'like', "%$search%")
                    ->orWhere('vams.idCard', 'like', "%$search%")
                    ->orWhere('vams.price', 'like', "%$search%")
                    ->orWhere('vams.resone', 'like', "%$search%")
                    ->orWhere('supervisors.name', 'like', "%$search%")
                    ->orWhere('departmans.name', 'like', "%$search%");
            });
        }

        $vams = $query->latest('vams.created_at')->paginate(10);
        $role = Auth::user()->role;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        $vamCount = Vam::count();

        return view('dashboard/allVamKomiteh', compact('vams', 'role', 'vamCount', 'supervisors', 'departmans'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        $vams = Vam::all();
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return view('dashboard/vamKomiteh', compact('vams', 'role', 'supervisors', 'departmans'));
    }

    public function store(StoreVam $request)
    {
        // اجازه ثبت فقط اگر مجاز باشه
        $this->authorize('create', Vam::class);

        // اعتبارسنجی داده‌ها
        $fields = $request->validated();
        $fields['author_id'] = Auth::id();
        $fields['accept'] = $request->has('accept') ? 'Yes' : 'No';
        $fields['status'] = $request->has('status') ? 'Yes' : 'No';

        // ایجاد رکورد
        $vams = Vam::create($fields);

        // بازگشت نتیجه
        return $vams
            ? redirect()->route('vam.create')->with('success', 'درخواست وام با موفقیت ثبت شد.')
            : redirect()->route('vam.create')->with('error', 'مشکلی رخ داده است.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $vam = Vam::find($id);
        $role = Auth::user()->role;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return $vam ? view('dashboard.editVamKomiteh', compact('vam', 'role', 'supervisors', 'departmans')) : redirect()->route('vam.index')->with('error', 'درخواست مورد نظر پیدا نشد.');
    }

    public function update(Request $request, DashboardVam $vam)
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'subscriber':

                if ($vam->status === 'No') {
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

                    $vam->update([
                        'name' => $request->name,
                        'idCard' => $request->idCard,
                        'price' => $request->price,
                        'departmans_id' => $request->departmans_id,
                        'supervisors_id' => $request->supervisors_id,
                        'resone' => $request->resone,
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
                $vam->update([
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
                $vam->update([
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
                    'finalPrice' => 'required|numeric',
                    'description' => 'nullable|string|max:1000',
                    'validationManager1' => 'required|in:Yes,No',
                ]);

                $vam->update([
                    'finalPrice' => $request->finalPrice,
                    'description' => $request->description,
                    'validationManager1' => $request->validationManager1,
                ]);

                break;

            case 'manager2': // رییس کمیته رفاهی

                $request->validate([
                    'validationManager2' => 'required|in:Yes,No',
                ]);

                $vam->update([
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
        $vam = Vam::findOrfail($id);
        $vamDestroy = $vam->delete();
        return $vamDestroy ? redirect()->route('vam.index')->with('success', 'درخواست مورد نظر با موفقیت حذف گردید') : redirect()->route('vam.index')->with('error', 'خطایی در حذف درخواست  مورد نظر رخ داده است');
    }
}
