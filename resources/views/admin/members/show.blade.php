@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Member Details</h4>
        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <!-- Member Photo -->
                <div class="col-md-3 text-center">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}"
                             class="img-fluid rounded mb-3"
                             style="max-height:200px;">
                    @else
                        <div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center" style="height:200px; width:100%;">
                            <span class="text-muted">No Photo</span>
                        </div>
                    @endif
                    
                    <!-- QR Code Display -->
                    @if($member->qr_code)
                        <hr>
                        <h6>QR Code</h6>
                        <img src="{{ asset('storage/qr-codes/' . $member->qr_code) }}"
                             class="img-fluid"
                             style="max-width:150px;">
                    @endif
                </div>

                <!-- Member Info -->
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tr>
                            <th>Membership No</th>
                            <td>{{ $member->member_id}}</td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $member->full_name }}</td>
                        </tr>
                        <tr>
                            <th>NIC</th>
                            <td>{{ $member->nic }}</td>
                        </tr>
                        <tr>
                            <th>MEMBERSHIP TYPE</th>
                            <td>{{ $member->membership_type }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $member->date_of_birth}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $member->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $member->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $member->address }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-3 text-end">
                <a href="{{ route('admin.members.index') }}"
                   class="btn btn-secondary">
                    ← Back to Members
                </a>
            </div>

        </div>
    </div>

</div>
@endsection