<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $companies = Company::all();
        $title = 'Total Companies : '. count($companies);

        return view('admin.companies.index', compact('companies', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $title = 'Add Company';
        return view('admin.companies.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);
        Company::create($validatedData);

        return redirect()->route('admin.companies.index')->with('status', 'Company Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        if (Gate::denies('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $title = 'Edit Company';
        return view('admin.companies.edit', compact('company', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $company->update($validatedData);

        return redirect()->route('admin.companies.index')->with('status', 'Company Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {

            if ($company->posts()->exists()) {
                return redirect()->route('admin.companies.index')->with('error', 'Company Can Not Be Deleted Because It Has Posts.');
            }

            Company::destroy($company->id);

            return redirect()->route('admin.companies.index')->with('status', 'Company Deleted Successfully.');
        } catch (QueryException $e) {
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user. Foreign key constraint error: ' . $e->getMessage());
        }
    }
}
