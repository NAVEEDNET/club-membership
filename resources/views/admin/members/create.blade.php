@extends('layouts.admin')

@section('title', 'Add Member')
@section('page-title', 'Add Member')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Member</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Member ID (readonly, auto-generated) --}}
        <div class="mb-3">
            <label>Member ID</label>
            <input type="text" name="member_id" class="form-control" value="{{ $memberId }}" readonly>
        </div>

        {{-- Row 1 --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>NIC</label>
                <input type="text" name="nic" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control">
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Membership Type</label>
                    <select name="membership_type" class="form-control" required>
                     <option value="">Select Membership</option>
                     <option value="Bronze">Bronze</option>
                     <option value="Silver">Silver</option>
                     <option value="Gold">Gold</option>
                     <option value="Platinum">Platinum</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
        </div>

        {{-- Row 3 --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*"
           capture="environment">
            </div>
            <div class="col-md-4 mb-3">
                <label>QR Code</label>
                <div class="border p-2 text-center" style="height: 100px;">
                    <small>Generated after save</small>
                </div>
            </div>
        </div>

        {{-- Row 4 --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Expiry Date</label>
                <input type="date" name="expiry_date" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Save Member</button>
    </form>
</div>
@endsection