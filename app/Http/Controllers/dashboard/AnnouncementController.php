<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Announcement;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::all();
        $role = Auth::user()->role;
        $announcementCount = Announcement::count();
        return view('dashboard/allAnnouncement', compact('announcements', 'role', 'announcementCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Auth::user()->role;
        $announcements = Announcement::all();

        return view('dashboard/createAnnouncement', compact('announcements', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // اعتبارسنجی
        $fields =  $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'files.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx',
        ],[

            'title.required' => 'عنوان اطلاعیه را وارد کنید',
            'description.required' => 'توضیحات را وارد کنید',
        ]);

        $fields['author_id'] = Auth::id();

        // ذخیره فایل‌ها (اگر وجود داشته باشد)
        if ($request->hasFile('files')) {

            $file = $request->file('files');

            $path = $file->store('images/announcements', 'public');

            $fields['files'] = $path;
        } 

        $announcement = Announcement::create($fields);

        return $announcement ? redirect()->route('announcement.index')->with('success', 'اطلاعیه با موفقیت ثبت شد.') : redirect()->route('announcement.index')->with('success', 'خطایی رخ داده است');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
