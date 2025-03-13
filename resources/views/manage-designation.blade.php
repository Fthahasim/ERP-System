@extends('layout-dashboard')
@section('content')

{{-- content --}}


<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-auto">
                            <h4 class="card-title mb-0 flex-grow-1">Designations</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="designation-lists" class="table-card">
                        <button id="addDesignationBtn" class="btn btn-prod text-light border-0 m-2" data-bs-toggle="modal" data-bs-target="#designationAddModal">Add Designation</button>
                        <table class="table table-bordered" id="designationTable" data-route="{{ Route('designation.getData') }}">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>


<!-- Designation Modal -->
<div id="designationAddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Designation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ Route('designation.store') }}" id="designationAddForm">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Designation Name <span class="text-danger">*</span></label>
                        <input type="text" id="designation_name" class="form-control shadow-none" required name="designation_name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select shadow-none" required name="status">
                            <option selected value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-prod text-light">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div id="designationEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Designation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ Route('designation.update') }}" id="designationEditForm">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-2">
                        <label>Designation Name <span class="text-danger">*</span></label>
                        <input type="text" id="designation_name" class="form-control shadow-none" name="designation_name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select shadow-none" name="status">
                            <option selected value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-prod text-light">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection