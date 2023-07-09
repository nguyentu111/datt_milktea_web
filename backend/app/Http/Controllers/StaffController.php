<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Resources\StaffCollection;
use App\Http\Resources\StaffResource;
use App\Http\Resources\PositionCollection;
use App\Http\Resources\PositionResource;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use App\Tables\StaffTable;
use DebugBar\DebugBar;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StaffTable $staffTable)
    {
        return view('bewama::pages/dashboard/staff/index', compact('staffTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bewama::pages/dashboard/staff/create');
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'gender' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|digits:10',
            'branch_id' => 'required',
            'roles' => 'required|array|min:1',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required',
            'active' => ['sometimes']
        ]);
        $uploadedFileUrl = null;
        if ($request->has('picture')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        try {
            DB::beginTransaction();
            $newStaff = Staff::create([
                'first_name' =>  $validation['first_name'],
                'last_name' =>  $validation['last_name'],
                'gender' =>  $validation['gender'],
                'phone' => $validation['phone'],
                'picture' =>  $uploadedFileUrl,
                'branch_id' => $validation['branch_id'],
                'dob' => $validation['dob'],
                'active' => $validation['active']
            ]);
            $newUser = User::create([
                'staff_id' => $newStaff->id,
                'email' => $validation['email'],
                'password' => Hash::make(User::DEFAULT_PASSWORD)
            ]);
            foreach ($validation['roles'] as $role) {
                Role::create([
                    'user_id' => $newUser->id,
                    'role' => $role
                ]);
            }
            DB::commit();
            return redirect('dashboard/staffs')->with('message', __('Add staff successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', __($ex->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view('bewama::pages/dashboard/staff/show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $validation = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'gender' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|digits:10',
            'branch_id' => 'required',
            'roles' => 'required|array|min:1',
            'email' => 'required|email|unique:users,email,' . $staff->user->id,
            'dob' => 'required',
            'active' => ['sometimes']
        ]);
        if (Auth::user()->email == $staff->user->email && $validation['active'] == '0') return  redirect('/dashboard/staffs')->with('error', __('Cannot unactive your self'));
        $uploadedFileUrl = $staff->picture;
        if ($request->has('picture')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        try {
            DB::beginTransaction();
            $staff->update($validation);
            $staff->roles()->delete();
            $roles = [];
            foreach ($validation['roles'] as $role) {
                $roles[] = [
                    'user_id' => $staff->user->getKey(),
                    'role' => $role
                ];
            };
            Role::query()->insertOrIgnore($roles);
            if ($validation['email'] !== $staff->email) {
                $staff->user->update(['email' => $validation['email']]);
            }
            $staff->update([...$validation, 'picture' => $uploadedFileUrl]);
            DB::commit();
            return redirect('/dashboard/staffs')->with('message', __('Update staff successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return  redirect('/dashboard/staffs')->with('error', __($ex->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
    }
}
