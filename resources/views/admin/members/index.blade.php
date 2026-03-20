@extends('layouts.admin')

@section('title', 'Members List')
@section('page-title', 'Members List')

@section('content')
<div class="container">
    <h1>Members List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Member ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>QR Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                 alt="Photo" width="80" height="80" class="rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->member_id }}</td>
                    <td>{{ $member->full_name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    
                    <td>
                        @if($member->qr_code)
                            <img src="{{ asset('storage/qr-codes/' . $member->qr_code) }}" 
                                 alt="QR Code" width="80" height="80">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Delete form -->
                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    
            @endforeach
        </tbody>
        <a href="{{ route('admin.members.export') }}" 
   class="btn btn-success mb-3">
    Export Excel
</a>
                </tr>
    </table>
</div>
@endsection