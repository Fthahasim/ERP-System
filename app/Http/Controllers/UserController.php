<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Designation;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::all();
        return view('manage-user',['designations' => $designations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
    
        DB::beginTransaction();
        try {
          
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['contact_no']), 
                'role' => UserRoles::User->value
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'contact_no' => $data['contact_no'],
                'alt_contact_no' => $data['alt_contact_no'] ?? null,
                'address' => $data['address'],
                'designation_id' => $data['designation'],
                'status' => $data['status']
            ]);

            DB::commit();
            return response()->json(['message' => 'User added successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * to get the datatable
     */
    public function getDataTable(Request $request)
    {
        $user = User::where('role','!=',UserRoles::Admin->value)
                        ->orderBy('name')
                        ->with('userDetail')
                        ->get();

        if ($request->ajax()) {
            return DataTables::of($user)
                ->addColumn('contact_no', function ($row) {
                    return $row->userDetail->contact_no ?? 'N/A';
                })
                ->addColumn('alt_contact_no', function ($row) {
                    return $row->userDetail->alt_contact_no ?? 'N/A';
                })
                ->addColumn('address', function ($row) {
                    return $row->userDetail->address ?? 'N/A';
                })
                ->addColumn('designation', function ($row) {
                    $designation = Designation::where('id',$row->userDetail->designation_id)->first();
                    return $designation->name ?? 'N/A';
                })
                ->addColumn('status', function($row) {
                    return $row->userDetail->status == 1 ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function($row) {
                    $editUrl = route('user.show', ['user' => $row->id]);
                    return '<button class="edit btn btn-success btn-sm" data-id="'.$row->id.'" data-url="'.$editUrl.'">Edit</button>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->load('userDetail');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();
    
        DB::beginTransaction();
        try {
            $user = User::findOrFail($data['id']);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $userDetail = UserDetail::where('user_id', $user->id)->first();
            if ($userDetail) {
                $userDetail->update([
                    'contact_no' => $data['contact_no'],
                    'alt_contact_no' => $data['alt_contact_no'] ?? null,
                    'address' => $data['address'],
                    'designation_id' => $data['designation'],
                    'status' => $data['status']
                ]);
            }
            
            DB::commit();
            return response()->json(['message' => 'User updated successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

}
