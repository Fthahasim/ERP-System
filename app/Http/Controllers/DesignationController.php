<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage-designation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        $data = $request->validated();

        $designation = Designation::create([
            'name' => $data['designation_name'],
            'status' => $data['status'],
        ]);
 
        return response()->json(['message' => 'Designation added successfully']);
    }

    /**
     * to get the datatable
     */
    public function getDataTable(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Designation::all())
                ->addColumn('status', function($row) {
                    return $row->status == 1 ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function($row) {
                    $editUrl = route('designation.show', ['designation' => $row->id]);
                    return '<button class="edit btn btn-success btn-sm" data-id="'.$row->id.'" data-url="'.$editUrl.'">Edit</button>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        return $designation;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request)
    {
        $data = $request->validated();
  
        $designation = Designation::findOrFail($data['id']);

        $designation->update([
            'name' => $data['designation_name'],
            'status' => $data['status'],
        ]);

        return response()->json(['message' => 'Designation updated successfully']);
    }

}
