@extends('layouts.admin')

@section('title', 'Edit Member')
@section('page-title', 'Edit Member')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Edit Member: {{ $member->full_name }}</h4>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Member ID (Read-only) -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Member ID</label>
                    <input type="text" class="form-control" value="{{ $member->member_id }}" readonly>
                </div>

                <!-- Full Name -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="full_name" value="{{ $member->full_name }}" class="form-control" required>
                </div>

                <!-- NIC -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">NIC / Passport</label>
                    <input type="text" name="nic" value="{{ $member->nic }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <!-- DOB -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ $member->date_of_birth }}" class="form-control">
                </div>

                <!-- Membership Type -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Membership Type *</label>
                    <select name="membership_type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="Junior" {{ $member->membership_type === 'Junior' ? 'selected' : '' }}>Junior</option>
                        <option value="Senior" {{ $member->membership_type === 'Senior' ? 'selected' : '' }}>Senior</option>
                        <option value="Life" {{ $member->membership_type === 'Life' ? 'selected' : '' }}>Life</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $member->email }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <!-- Phone -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ $member->phone }}" class="form-control">
                </div>

                <!-- Start Date -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Membership Start Date *</label>
                    <input type="date" name="start_date" value="{{ $member->start_date }}" class="form-control" required>
                </div>

                <!-- Expiry Date -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Membership Expiry Date *</label>
                    <input type="date" name="expiry_date" value="{{ $member->expiry_date }}" class="form-control" required>
                </div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ $member->address }}</textarea>
            </div>

            <!-- Photo Upload -->
            <div class="mb-4">
                <label class="form-label">Member Photo</label>
                @if($member->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $member->photo) }}" width="100" height="100" class="rounded">
                        <p class="text-muted small">Current photo</p>
                    </div>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small class="text-muted">Allowed: JPG, PNG (Max 2MB). Leave blank to keep current photo.</small>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Member</button>
            </div>
        </form>
    </div>
</div>
@endsection