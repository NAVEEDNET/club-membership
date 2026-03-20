@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="container">

    <h2 class="mb-4">Club Dashboard</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Members</h5>
                    <h2>{{ $totalMembers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Active Members</h5>
                    <h2>{{ $activeMembers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Expired Members</h5>
                    <h2>{{ $expiredMembers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Renewed Members</h5>
                    <h2>{{ $renewedMembers }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection