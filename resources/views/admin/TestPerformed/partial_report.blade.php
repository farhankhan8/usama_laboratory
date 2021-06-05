<div class="card-body">
    <div class="col-md-9"><h3>{{ $testPerformedsId->availableTest->category->Cname }}</h3></div>
    <div class="col-md-9"><h4>{{ $testPerformedsId->availableTest->name }}</h4></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th>Test</th>
                        <th>Unit</th>
                        <th>Result</th>
                        <th>REFERENCE RANGE</th>
                        @php $x=1; @endphp
                        @foreach($getpatient->testPerformed->where("available_test_id",$testPerformedsId->availableTest->id)->where("id","<",$testPerformedsId->id)->sortByDesc('id')->take(2) as $old_test)
                        <th>History {{$x}}&nbsp<span class="text-black-50"></span>({{ date('d-m-Y H:m:s', strtotime($old_test->created_at)) }})</th>
                        @php $x++; @endphp
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($testPerformedsId->testReport as $testReport)
                   <tr>
                        <td class="text-capitalize">{{$testReport->report_item->title}}</td>
                        <td class="">{{$testReport->report_item->unit}}</td>
                        <td>{{ $testReport->value }}</td>
                        <td>({{$testReport->report_item->normalRange}}){{$testReport->report_item->unit}}</td>
                        @foreach($getpatient->testPerformed->where("available_test_id",$testPerformedsId->availableTest->id)->where("id","<",$testPerformedsId->id)->sortByDesc('id')->take(2) as $old_test)
                        <td>{{ $old_test->testReport->where("test_report_item_id",$testReport->test_report_item_id)->first()->value }}</td>
                        @endforeach
                    </tr>
                        @endforeach
                    </tbody>
            </table>
            </div>
        </div>
</div>
