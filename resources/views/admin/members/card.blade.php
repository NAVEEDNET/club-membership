<!DOCTYPE html>
<html>
<head>
    <style>

        body{
            font-family: Arial, sans-serif;
        }

        .card{
            width: 350px;
            height: 220px;
            border-radius: 15px;
            color: white;
            padding: 15px;
            background-image: url("{{ public_path('bg1.jpg') }}");
            background-size: cover;
        }

        .club{
            text-align:center;
            font-size:16px;
            font-weight:bold;
        }

        .address{
            text-align:center;
            font-size:12px;
        }

        .logo{
            width:60px;
        }

        .row{
            display:flex;
            margin-top:10px;
        }

        .left{
            width:65%;
        }

        .right{
            width:35%;
            text-align:center;
        }

        .photo{
            width:70px;
            height:70px;
            border-radius:5px;
        }

        .qr{
            width:70px;
        }

        .label{
            font-size:12px;
        }

        .value{
            font-size:14px;
            font-weight:bold;
        }

    </style>
</head>
<body>


<!-- FRONT CARD -->

<div class="card">

    <div style="text-align:center">
        <img src="{{ public_path('annoor.png') }}" class="logo">
    </div>

    <div class="club">
        ANNOOR SPORTS CLUB
    </div>

    <div class="address">
        Deltota Wanahapuwa
    </div>

    <hr>

    <div class="row">

        <div class="left">

            <div class="label">Name</div>
            <div class="value">{{ $member->full_name }}</div>

            <div class="label">Member ID</div>
            <div class="value">{{ $member->member_id }}</div>

            <div class="label">Expiry</div>
            <div class="value">{{ $member->expiry_date }}</div>

        </div>

        <div class="right">

            <img src="{{ public_path('storage/'.$member->photo) }}"
                 class="photo">

            <br>

            <img src="{{ public_path('storage/qr-codes/'.$member->qr_code) }}"
                 class="qr">

        </div>

    </div>

</div>


<br><br>


<!-- BACK CARD -->

<div class="card">

    <div class="club">
        ANNOOR SPORTS CLUB
    </div>

    <hr>

    <p>Name : {{ $member->full_name }}</p>
    <p>Member No : {{ $member->member_id }}</p>
    <p>Phone : {{ $member->phone }}</p>

    <br>

    <p style="text-align:center;font-size:12px;">
        Official Membership Card
    </p>

</div>


</body>
</html>