@extends('layout-dashboard')
@section('content')

{{-- content --}}


<div class="container mt-4">
    <h3>Dashboard</h3>

    <div class="dashboard-index-page d-flex flex-wrap">
        <div class="col-12 col-sm-6  col-xl-3 p-1 p-sm-2">
            <div class="dashboard-summary d-flex align-items-center bg-lite-nav-bar border-0 rounded p-3">
                <div class="col-10 d-flex flex-column">
                    <span class="text-prod-primary reading-value fs-2 fw-normal-lite">{{ $total_designations }}</span>
                    <span class="text-prod-primary reading-header  fw-normal-lite">Designations</span>
                </div>
                <div class="col-2">
                    <div class="icon-conatiner text-center bg-prod-primary rounded">
                        <i class="bi bi-award reading-icon fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6  col-xl-3 p-1 p-sm-2">
            <div class="dashboard-summary d-flex align-items-center bg-lite-nav-bar border-0 rounded p-3">
                <div class="col-10 d-flex flex-column">
                    <span class="text-prod-primary reading-value fs-2 fw-normal-lite">{{ $total_users }}</span>
                    <span class="text-prod-primary reading-header fw-normal-lite">Users</span>
                </div>
                <div class="col-2">
                    <div class="icon-conatiner text-center bg-prod-primary rounded">
                        <i class="bi bi-people reading-icon fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6  col-xl-3 p-1 p-sm-2">
            <div class="dashboard-summary d-flex align-items-center bg-lite-nav-bar border-0 rounded p-3">
                <div class="col-10 d-flex flex-column">
                    <span class="text-prod-primary reading-value fs-2 fw-normal-lite">{{ $active_users }}</span>
                    <span class="text-prod-primary reading-header fw-normal-lite">Active Users</span>
                </div>
                <div class="col-2"> 
                    <div class="icon-conatiner text-center bg-prod-primary rounded">
                        <i class="bi bi-person-check reading-icon fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6  col-xl-3 p-2 p-sm-2">
            <div class="dashboard-summary d-flex align-items-center bg-lite-nav-bar border-0 rounded p-3">
                <div class="col-10 d-flex flex-column">
                    <span class="text-prod-primary reading-value fs-2 fw-normal-lite">{{ $inactive_users }}</span>
                    <span class="text-prod-primary reading-header fw-normal-lite">Inactive USers</span>
                </div>
                <div class="col-2">
                    <div class="icon-conatiner text-center bg-prod-primary rounded">
                        <i class="bi bi-person-x reading-icon text fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection