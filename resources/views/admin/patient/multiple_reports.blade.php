@extends('layouts.admin')
@section('content')
    <style>
        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
    <div class="card">
        <div class="card-header">
            Test Reports
        </div>

        @include("admin.TestPerformed.partial_patient")
        @foreach($tests as $testPerformedsId)
            @include("admin.TestPerformed.partial_report")
        @endforeach

        <div class="col-md-12 mb-12 noprint">
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
        </div>
    </div>

@endsection