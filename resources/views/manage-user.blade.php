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
                            <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="user-lists" class="table-card">
                        <button id="addUserBtn" class="btn btn-prod text-light border-0 m-2" data-bs-toggle="modal" data-bs-target="#userAddModal">Add User</button>
                        <table class="table table-bordered" id="userTable" data-route="{{ Route('user.getData') }}">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Alternative Number</th>
                                    <th>Address</th>
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


<!-- User Add Modal -->
<div id="userAddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ Route('user.store') }}" id="userAddForm">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control shadow-none" required name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control shadow-none" required name="email">
                    </div>
                    <div class="form-group mb-2">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <input type="tel" id="contact_no" class="form-control shadow-none" pattern="[0-9]{10}" required name="contact_no">
                    </div>
                    <div class="form-group mb-2">
                        <label>Alternative Contact Number <small><em>(optional)</em></small></label>
                        <input type="tel" id="alt_contact_no" class="form-control shadow-none" pattern="[0-9]{10}" name="alt_contact_no">
                    </div>
                    <div class="form-group mb-2">
                        <label>Address</label>
                        <textarea type="text" id="address" class="form-control shadow-none"  name="address"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label>Designation <span class="text-danger">*</span></label>
                        <select class="form-select form-select shadow-none" required name="designation">
                            @if($designations->isEmpty())
                                <option selected disabled>No Designations Found</option>
                            @else
                                <option selected disabled>Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            @endif
                        </select>
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
<div id="userEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ Route('user.update') }}" id="userEditForm">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" class="form-control shadow-none" required name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control shadow-none" required name="email">
                    </div>
                    <div class="form-group mb-2">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <input type="tel" id="contact_no" class="form-control shadow-none" pattern="[0-9]{10}" required name="contact_no">
                    </div>
                    <div class="form-group mb-2">
                        <label>Alternative Contact Number <small><em>(optional)</em></small></label>
                        <input type="tel" id="alt_contact_no" class="form-control shadow-none" pattern="[0-9]{10}" name="alt_contact_no">
                    </div>
                    <div class="form-group mb-2">
                        <label>Address</label>
                        <textarea type="text" id="address" class="form-control shadow-none"  name="address"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label>Designation <span class="text-danger">*</span></label>
                        <select class="form-select form-select shadow-none" required name="designation">
                            @if($designations->isEmpty())
                                <option selected disabled>No Designations Found</option>
                            @else
                                <option selected disabled>Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            @endif
                        </select>
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

@endsection