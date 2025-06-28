<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Departmans;
use App\Models\dashboard\Service;
use App\Models\dashboard\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->search;

        $query = Service::query()
            ->leftJoin('supervisors', 'services.supervisors_id', '=', 'supervisors.id')
            ->leftJoin('departmans', 'services.departmans_id', '=', 'departmans.id')
            ->select('services.*'); // مهم: فقط ستون‌های جدول وام‌ها رو بگیر

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('services.name', 'like', "%$search%")
                    ->orWhere('services.idCard', 'like', "%$search%")
                    ->orWhere('services.price', 'like', "%$search%")
                    ->orWhere('services.resone', 'like', "%$search%")
                    ->orWhere('supervisors.name', 'like', "%$search%")
                    ->orWhere('departmans.name', 'like', "%$search%");
            });
        }

        $services = $query->latest('services.created_at')->paginate(10);

        $role = Auth::user()->role;
        $serviceCount = Service::count();
        return view('dashboard/allService', compact('role', 'serviceCount', 'services'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        $services = Service::all();
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return view('dashboard/createService', compact('services', 'role', 'supervisors', 'departmans'));
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'persian_alpha'],
            'idCard' => ['required', 'ir_national_id'],
            'departmans_id' => ['required', 'exists:departmans,id'],
            'supervisors_id' => ['required', 'exists:supervisors,id'],
            'price' => ['required', 'numeric'],
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


        $services = Service::create($fields);
        return $services
            ? redirect()->route('service.create')->with('success', 'دسته‌بندی شما با موفقیت ثبت شد.')
            : redirect()->route('service.create')->with('error', 'مشکلی رخ داده است.');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $service = Service::find($id);
        $role = Auth::user()->role;
        $supervisors = Supervisor::all();
        $departmans = Departmans::all();
        return $service ? view('dashboard.editService', compact('service', 'role', 'supervisors', 'departmans')) : redirect()->route('service.index')->with('error', 'درخواست مورد نظر پیدا نشد.');
    }
    public function update(Request $request, Service $service)
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'subscriber':

                if ($service->status === 'No') {
                    $request->merge([
                        'accept' => $request->has('accept') ? 'Yes' : 'No',
                    ]);

                    $request->validate([
                        'name' => 'required|string|max:255|persian_alpha',
                        'idCard' => 'required|string|ir_national_id',
                        'price' => 'required|numeric',
                        'departmans_id' => 'required|exists:departmans,id',
                        'supervisors_id' => 'required|exists:supervisors,id',
                        'descriptionUser' => 'nullable|string',
                        'accept' => 'required|in:Yes,No',
                    ]);

                    $service->update([
                        'name' => $request->name,
                        'idCard' => $request->idCard,
                        'price' => $request->price,
                        'departmans_id' => $request->departmans_id,
                        'supervisors_id' => $request->supervisors_id,
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
                    'descriptionUser' => 'nullable|string',
                    'accept' => 'required|in:Yes,No',

                ]);
                $service->update([
                    'name' => $request->name,
                    'idCard' => $request->idCard,
                    'price' => $request->price,
                    'departmans_id' => $request->departmans_id,
                    'supervisors_id' => $request->supervisors_id,
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
                $service->update([
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

                $service->update([
                    'finalPrice' => $request->finalPrice,
                    'description' => $request->description,
                    'validationManager1' => $request->validationManager1,
                ]);

                break;
            case 'manager2': // رییس کمیته رفاهی

                $request->validate([
                    'validationManager2' => 'required|in:Yes,No',
                ]);

                $service->update([
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
        $services = Service::findOrfail($id);
        $servicesDestroy = $services->delete();
        return $servicesDestroy ? redirect()->route('service.index')->with('success', 'سرویس مورد نظر با موفقیت حذف گردید') : redirect()->route('service.index')->with('error', 'خطایی در حذف  سرویس مورد نظر رخ داده است');
    }
}
