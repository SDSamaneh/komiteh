<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Departmans;
use Illuminate\Http\Request;

class DepartmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmans = Departmans::all();
        $departmanCount = Departmans::count();
        return view('dashboard/departman', compact('departmans', 'departmanCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
