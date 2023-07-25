<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Customer;
use App\Tables\BranchTable;
use App\Traits\ApiResponses;
use Cloudinary\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BranchTable $branchTable)
    {
        return view('bewama::pages/dashboard/branch/index', compact('branchTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bewama::pages/dashboard/branch/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'max:50'],
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|digits:10',
            'address' => 'required',
            'active' => 'required',
            'picture' => ['required', 'image'],
            'date_open' => ['required'],
        ]);
        Customer::create([
            'first_name' => $validation['name'],
            'last_name' => 'default',
            'phone' => 0,
        ]);
        $uploadedFileUrl = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        Branch::create(array_merge($validation, ['picture' => $uploadedFileUrl]));
        return redirect('/dashboard/branches')->with('message', __('Create branch successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {

        return view('bewama::pages/dashboard/branch/show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Branch $branch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|digits:10',
            'address' => 'required',
            'active' => 'required',
            'picture' => ['image'],
            'date_open' => ['required'],
        ]);
        $defaultCustomer = $this->getDefaultCustomer();
        if ($defaultCustomer) {
            $defaultCustomer->first_name = $data['name'];
            $defaultCustomer->save();
        } else {
            Customer::create([
                'first_name' => $data['name'],
                'last_name' => 'default',
                'phone' => 0,
            ]);
        }

        if ($request->has('picture')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
            $branch->update(array_merge($data, ['picture' => $uploadedFileUrl]));
        } else $branch->update($data);
        return redirect('/dashboard/branches')->with('message', __('Update branch successfully'));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Branch $branch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Branch $branch)
    {
        // dd($branch->products(), $branch->staffs(), $branch->orders, $branch->imports, $branch->exports);
        if ($branch->products()->exists()) {
            return redirect('/dashboard/branches')->with('error', __('Branch has products cannot delete'));;
        }
        if ($branch->staffs()->exists()) {
            return redirect('/dashboard/branches')->with('error', __('Branch has staffs cannot delete'));;
        }
        if ($branch->orders()->exists()) {
            return redirect('/dashboard/branches')->with('error', __('Branch has orders cannot delete'));;
        }
        if ($branch->exports()->exists()) {
            return redirect('/dashboard/branches')->with('error', __('Branch has exports cannot delete'));;
        }
        if ($branch->imports()->exists()) {
            return redirect('/dashboard/branches')->with('error', __('Branch has imports cannot delete'));;
        }
        $branch->delete();
        return redirect('/dashboard/branches')->with('message', __('Delete successfully'));;
    }
    public function getBranches()
    {
        $branches = Branch::query()->with(['products'])->where('active', true)->get();
        return $this->successCollectionResponse($branches);
    }
    protected function getDefaultCustomer()
    {
        $branchName = Auth::user()->staff->branch->name;
        $defaultCus = Customer::query()->where('last_name', 'default')
            ->where('first_name', $branchName)->get();
        return $defaultCus;
    }
}
