<?php

namespace App\Http\Requests\dashboard\vam;

use Illuminate\Foundation\Http\FormRequest;

class EditVam extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|persian_alpha',
            'idCard' => 'required|ir_national_id',
            'departmans_id' => 'required|exists:departmans,id',
            'supervisors_id' => 'required|exists:supervisors,id',
            'price' => 'required|numeric',
            'descriptionUser' => 'nullable|string',
            'resone' => 'required|in:تحصیل,ازدواج,جهیزیه,درمان,تصادف,بیمه,فوت اقوام,سایر',
            'accept' => 'required|in:No,Yes',
            'status' => 'nullable|in:No,Yes',
            'memberDate' => 'nullable|persian_date',
            'memberPrice' => 'nullable|numeric',
            'lastSalary' => 'nullable|numeric',
            'debt' => 'nullable|numeric',
            'validationDate' => 'nullable|persian_date',
            'validationHr' => 'nullable|in:Yes,No',
            'validationManager1' => 'nullable|in:No,Yes',
            'finalPrice' => 'nullable|numeric',
            'description' => 'nullable|string',
            'validationManager2' => 'nullable|in:No,Yes',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'idCard.required' => 'کد ملی خود را وارد کنید',
            'departmans_id.required' => 'نام دپارتمان خود را وارد کنید',
            'supervisors_id.required' => 'نام مدیر واحد خود را وارد کنید',
            'price.required' => ' مبلغ درخواستی خود را وارد کنید',
            'price.numeric' => 'مبلغ باید به صورت عددی باشد',
            'accept.required' => 'برای استفاده از امکانات رفاهی باید قوانین را تایید فرمایید'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'author_id' => auth()->id(),
            'accept' => $this->has('status') ? 'Yes' : 'No',
        ]);
    }
}
