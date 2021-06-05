@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Performed New Test
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("test-performed") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="patient_id">Select Patient Name</label>
                            <select class="form-control select2 {{ $errors->has('patients') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                                @foreach($patientNames as $id => $patientName)
                                    <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $patientName }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="available_test_id">Select Test Name</label>
                            <select onchange="set_test_form()" class="form-control select2 {{ $errors->has('available_tests') ? 'is-invalid' : '' }}" name="available_test_id" id="available_test_id" required>
                                @foreach($availableTests as $id => $availableTest)
                                    <option value="{{ $id }}" {{ old('available_test_id') == $id ? 'selected' : '' }}>{{ $availableTest }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('available_tests'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available_tests') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="required" for="Sname_id">Select Status</label>
                            <select class="form-control select2 {{ $errors->has('Sname_id') ? 'is-invalid' : '' }}" name="Sname_id" id="Sname_id" required>
                                @foreach($stat as $id => $sta)
                                    <option value="{{ $id }}">{{ $sta }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('Sname_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('Sname_id') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                    <div class="form-group">
                        <label class="required text-capitalize" for="fee_final">Charged Fee</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rs.</span>
                            </div>
                            <input class="form-control" type="number" name="fee_final" id="fee_final" value="">
                        </div>
                    </div>
                </div>

                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <p class="required">Test Type</p>
                            <label for="urgent">Urgent<span id="urgent_fee"></span></label>
                            <input type="radio" name="type" id="urgent" required value="urgent">
                            <label for="standard">Standard<span id="standard_fee"></span></label>
                            <input type="radio" name="type" id="standard" required checked value="standard">
                        </div>
                    </div>
                </div>

           

                <div id="test_form" class="row">
                    @foreach($allAvailableTests as $test)

                        <div class="form-row col-md-12" id="test{{$test->id}}" class="tests">
                            <div class="col-md-12"><h4>{{$test->name}}</h4></div>
                            @foreach($test->TestReportItems->where("status","active") as $report_item)
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label class="required text-capitalize" for="testResult{{$report_item->id}}">{{$report_item->title}} ({{$report_item->normalRange}}){{$report_item->unit}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">{{$report_item->unit}}</span>
                                            </div>
                                            <input class="form-control" type="number" name="testResult{{$report_item->id}}" id="testResult{{$report_item->id}}" value="" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            var test{{$test->id}}= document.getElementById("test{{$test->id}}").outerHTML;
                            document.getElementById("test{{$test->id}}").outerHTML = "";
                            var test{{$test->id}}_standard ={{$test->testFee}};
                            var test{{$test->id}}_urgent ={{$test->urgentFee}};
                        </script>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function set_test_form() {
            if (document.getElementById("available_test_id").value) {
                document.getElementById("test_form").innerHTML = eval("test" + document.getElementById("available_test_id").value);
                document.getElementById("urgent_fee").innerText = "(" + eval("test" + document.getElementById("available_test_id").value + "_urgent") + ")";
                document.getElementById("standard_fee").innerText = "(" + eval("test" + document.getElementById("available_test_id").value + "_standard") + ")";
            } else {
                document.getElementById("test_form").innerHTML = "";
                document.getElementById("urgent_fee").innerText = "";
                document.getElementById("standard_fee").innerText = "";

            }
            }
    </script>
@endsection