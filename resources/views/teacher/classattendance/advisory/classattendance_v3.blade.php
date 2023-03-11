<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<style>
    


.save-button  {
  -webkit-border-radius: 10px;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  /* font-family: Arial;
  font-size: 20px; */
  /* padding: 5px 10px; */
  text-align: center;
  text-decoration: none;
  -webkit-animation: saveglowing 1500ms infinite !important;
  -moz-animation: saveglowing 1500ms infinite !important;
  -o-animation: saveglowing 1500ms infinite !important;
  animation: saveglowing 1500ms infinite !important;
}
@-webkit-keyframes saveglowing {
  0% { background-color: #007bff; -webkit-box-shadow: 0 0 3px #007bff; }
  50% { background-color: #007bff; -webkit-box-shadow: 0 0 40px #007bff; }
  100% { background-color: #007bff; -webkit-box-shadow: 0 0 3px #007bff; }
}

@-moz-keyframes saveglowing {
  0% { background-color: #007bff; -moz-box-shadow: 0 0 3px #2e3133; }
  50% { background-color: #007bff; -moz-box-shadow: 0 0 40px #007bff; }
  100% { background-color: #007bff; -moz-box-shadow: 0 0 3px #007bff; }
}

@-o-keyframes saveglowing {
  0% { background-color: #007bff; box-shadow: 0 0 3px #007bff; }
  50% { background-color: #007bff; box-shadow: 0 0 40px #007bff; }
  100% { background-color: #007bff; box-shadow: 0 0 3px #007bff; }
}

@keyframes saveglowing {
  0% { background-color: #007bff; box-shadow: 0 0 3px #007bff; }
  50% { background-color: #007bff; box-shadow: 0 0 40px #007bff; }
  100% { background-color: #007bff; box-shadow: 0 0 3px #007bff; }
}
</style>
@extends('teacher.layouts.app')

@section('content')
<script type="text/javascript" src="{{asset('assets/scripts/jquery.min.js')}}"></script>
<script src="{{asset('assets/scripts/gijgo.min.js')}}" ></script>
@php
if(isset($attendance)){
    $count = count($attendance);
    $promoted = 0;
    $female = 0;
    $male = 0;
    foreach ($attendance as $att) {
        if($att->promotionstatus == 1){
            $promoted+=1;
        }
        if(strtoupper($att->gender) == 'FEMALE'){
            $female+=1;
        }
        elseif(strtoupper($att->gender) == 'MALE'){
            $male+=1;
        }
    }
}

@endphp
<div>
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="active breadcrumb-item"><a href="/classattendance">Attendance</a></li>
            <li class="active breadcrumb-item" aria-current="page">Advisory</li>
            <li class="active breadcrumb-item" aria-current="page">{{$sectioninfo->sectionname}}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-3" hidden>
                        <label>Select School Year</label>
                        <select class="form-control" id="selectedschoolyear">
                            @if(count($schoolyears)>0)
                                @foreach($schoolyears as $schoolyear)
                                    <option value="{{$schoolyear->id}}" @if($schoolyear->id == $syid) selected @endif>{{$schoolyear->sydesc}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3"hidden>
                        <label>Select Semester</label>
                        <select class="form-control" id="selectedsemester">
                            @if(count($semesters)>0)
                                @foreach($semesters as $semester)
                                    <option value="{{$semester->id}}" @if($semester->id == $semid) selected @endif>{{$semester->semester}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Select Year</label>
                        <select class="form-control" style="border: none; border-bottom: 1px solid #ddd" id="selectedyear">
                            @for($to = date('Y'); 2000<$to; $to--)
                              <option value="{{$to}}">{{$to}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Select Month</label>
                        <select id="selectedmonth" class="form-control form-control" style="border: none; border-bottom: 1px solid #ddd">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-info" id="btn-reload"><i class="fa fa-sync"></i> Reload</button>
                        <button type="button" class="btn btn-primary" id="btn-pickdates"><i class="fa fa-calendar"></i> Pick Dates</button>
                        {{-- <button type="button" class="btn btn-primary" id="btn-generate"><i class="fa fa-sync"></i> Generate</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="results-container">

    </div>
</div>
<div class="modal fade" id="show-calendar" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pick Dates</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
          {{-- <div class="row">
              <div class="col-md-12">
                  <em class="text-success">Note: Please click dates to add to the setup!</em>
              </div>
          </div> --}}
          <div class="row">
              <div class="col-md-12" id="calendar-container"></div>
              {{-- <div class="col-md-12" >
                  <label>Selected dates:</label>
                  <br/>
                  <div id="selected-dates-container"></div>
              </div> --}}
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal" >Close</button>
        <button type="button" id="btn-generate" class="btn btn-primary"><i class="fa fa-sync"></i> Generate</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var columnid = 0;
        $('body').addClass('sidebar-collapse');
        $('#btn-reload').hide();
        var selecteddates = [];
        
        $('#btn-pickdates').on('click', function(){
            $('#show-calendar').modal('show')
            var selectedyear = $('#selectedyear').val();
            var selectedmonth = $('#selectedmonth').val();

            $.ajax({
                url: '/classattendance/getcalendar',
                type: 'GET',
                data: {
                    selectedyear    : selectedyear,
                    selectedmonth   : selectedmonth
                }, success:function(data){
                    $('#calendar-container').empty()
                    $('#calendar-container').append(data)
                    if(selecteddates.length>0)
                    {
                        $.each(selecteddates,function(key,value){
                            $('.active-date[data-id='+value+']').addClass('btn-success')
                        })
                        $('#btn-generate').show();
                    }else{
                        
                        $('#btn-generate').hide();
                    }
                }
            })
        })
        $(document).on('click','.active-date', function(){
            $('#selected-dates-container').empty()
            var idx = $.inArray($(this).attr('data-id'), selecteddates);
            if (idx == -1) {
                selecteddates.push($(this).attr('data-id'));
                $(this).addClass('btn-success')
            } else {
                selecteddates.splice(idx, 1);
                $(this).removeClass('btn-success')
            }
            selecteddates.sort(function(a, b) {
                return a - b;
            });
            if(selecteddates.length == 0)
            {
                $('#btn-generate').hide();
            }else{
                $('#btn-generate').show();
            }
        })
        $('#btn-generate').on('click', function(){
            $('.btn-close-modal').click()
            $('body').removeClass('modal-open')
            var selectedyear = $('#selectedyear').val();
            var selectedmonth = $('#selectedmonth').val();
            var selectedschoolyear = $('#selectedschoolyear').val();
            var selectedsemester = $('#selectedsemester').val();
            $.ajax({
                url: '/classattendance/showtable',
                type: 'GET',
                data: {
                    version: '3',
                    levelid  : '{{$gradelevelinfo->id}}',
                    sectionid: '{{$sectioninfo->id}}',
                    selectedschoolyear      : selectedschoolyear,
                    selectedsemester      : selectedsemester,
                    dates           : selecteddates,
                    selectedyear    : selectedyear,
                    selectedmonth   : selectedmonth
                }, success:function(data){
                    $('#results-container').empty()
                    $('#results-container').append(data)
                    $('#results-container').show()
                    $('#btn-reload').show();
                }
            })
        })
        $(document).on('click','#btn-reload', function(){
            var selectedyear = $('#selectedyear').val();
            var selectedmonth = $('#selectedmonth').val();
            var selectedschoolyear = $('#selectedschoolyear').val();
            var selectedsemester = $('#selectedsemester').val();
            Swal.fire({
                title: 'Reloading...',
                allowOutsideClick: false,
                closeOnClickOutside: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            }) 
            $.ajax({
                url: '/classattendance/showtable',
                type: 'GET',
                data: {
                    version: '3',
                    levelid  : '{{$gradelevelinfo->id}}',
                    sectionid: '{{$sectioninfo->id}}',
                    selectedschoolyear      : selectedschoolyear,
                    selectedsemester      : selectedsemester,
                    dates           : selecteddates,
                    selectedyear    : selectedyear,
                    selectedmonth   : selectedmonth
                }, success:function(data){
                    $(".swal2-container").remove();
                    $('body').removeClass('swal2-shown')
                    $('body').removeClass('swal2-height-auto')
                    $('#results-container').empty()
                    $('#results-container').append(data)
                    $('#results-container').show()
                    $('#btn-reload').show();
                }
            })
        })
        var arr = ['present', 'absent', 'late', 'cc','none'];
        i = 0;

        $(document).on('click', 'td[data-class="attstatus"]', function() {
            var controlclicks = $('td[clicked="1"]').length;
            // if(controlclicks == 16)
            // {
            //     toastr.warning('Limited. Please save changes first!', 'Class Attendance')
            // }else{
                if($(this).attr('clicked') == 0)
                {
                    i = 0;
                }
                $(this).attr('clicked','1');
                if(i === arr.length){
                    i=0;   
                }
                if(arr[i] == 'present')
                {
                    $(this).removeAttr('class')
                    $(this).addClass('bg-success')
                    $(this).text('PRESENT')
                }
                else if(arr[i] == 'absent')
                {
                    $(this).removeAttr('class')
                    $(this).addClass('bg-danger')
                    $(this).text('ABSENT')
                }
                else if(arr[i] == 'late')
                {
                    $(this).removeAttr('class')
                    $(this).addClass('bg-warning')
                    $(this).text('LATE')
                }
                else if(arr[i] == 'cc')
                {
                    $(this).removeAttr('class')
                    $(this).addClass('bg-secondary')
                    $(this).text('CC')
                }else{
                    $(this).removeAttr('class')
                    $(this).text('')
                }
                $(this).attr('data-newstatus',arr[i])
                i++;
                return false;
            // }
        });
        var attcounter = 0;
        function saveattendance(selectedschoolyear,selectedsemester,dataobj)
        {
            var firstobj = [dataobj[0]];
            if(dataobj.length != 0)
            {
                console.log(dataobj.length)
                $.ajax({
                        url: '/classattendance/submit',
                        type: 'GET',
                        data: {
                            version: '3',
                            acadprogcode   : '{{$gradelevelinfo->acadprogcode}}',
                            selectedschoolyear   : selectedschoolyear,
                            selectedsemester   : selectedsemester,
                            datavalues   : firstobj
                        },
                        success:function(data){
                            attcounter+=1;
                            $('#attcounting').text(attcounter);
                            dataobj     = dataobj.filter(x=> x.tdate != firstobj[0].tdate || x.studid != firstobj[0].studid )
                            saveattendance(selectedschoolyear,selectedsemester,dataobj)
                            // $(".swal2-container").remove();
                            // $('body').removeClass('swal2-shown')
                            // $('body').removeClass('swal2-height-auto')
                            // toastr.success('Updated successfully!', 'Class Attendance')
                            // $('#btn-generate').click()
                        }, error:function()
                        {
                            saveattendance(selectedschoolyear,selectedsemester,dataobj)
                        }
                    })
            }else{
                $(".swal2-container").remove();
                $('body').removeClass('swal2-shown')
                $('body').removeClass('swal2-height-auto')
                toastr.success('Updated successfully!', 'Class Attendance')
                $('#btn-generate').click()
            }
        }
        var totalchanges;

        $(document).on('click', '#btn-save', function() { 
            attcounter = 0;
            var selectedschoolyear = $('#selectedschoolyear').val();
            var selectedsemester = $('#selectedsemester').val();
            var datavalues = [];

            $('td[clicked="1"]').each(function(){
                
                obj = {
                    studid      : $(this).attr('data-studid'),
                    status      : $(this).attr('data-status'),
                    tdate       : $(this).attr('data-tdate'),
                    newstatus       : $(this).attr('data-newstatus')
                };
                // obj['studid'] = $(this).attr('data-studid');
                // obj['status'] = $(this).attr('data-status');
                // obj['tdate'] = $(this).attr('data-tdate');
                // obj['newstatus'] = $(this).attr('data-newstatus');
                datavalues.push(obj);
            })
            totalchaanges = datavalues.length;
            Swal.fire({
                title: 'Saving changes...',
                html:'<span id="attcounting"></span>/'+totalchaanges,
                allowOutsideClick: false,
                closeOnClickOutside: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })  
            saveattendance(selectedschoolyear,selectedsemester,datavalues)
                   
        })

        $(document).on('click', '.btn-hide', function(){
            columnid = $(this).closest('th').index();
            $(this).closest('th').remove();
            $("tr.eachstud").each(function() {
                $(this).children("td:eq("+columnid+")").remove();
            });
        })
        $(document).on('click', '.btn-column-null', function(){
            columnid = $(this).closest('th').index();
            var selecteddate = $(this).attr('data-date');
            var studids = []
            $('.eachstud').each(function(){
                studids.push($(this).attr('data-id'));
            })
            Swal.fire({
                title: 'Are you sure you want to delete the attedance from this date?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/classattendance/deleteattendancecol',
                        type:"GET",
                        dataType:"json",
                        data:{
                            tdate    :  selecteddate,
                            studids    : JSON.stringify(studids),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Reset successfully!')
                            $("tr.eachstud").each(function() {
                                $(this).children("td:eq("+columnid+")").removeAttr('class');
                                $(this).children("td:eq("+columnid+")").removeAttr('style');
                                $(this).children("td:eq("+columnid+")").text('');
                                $(this).children("td:eq("+columnid+")").attr('data-newstatus','none');
                                $(this).children("td:eq("+columnid+")").attr('clicked','0');
                            });
                        }
                    })
                }
            })
        })
        $(document).on('click', '.btn-column-present', function(){
            columnid = $(this).closest('th').index();
            var selecteddate = $(this).attr('data-date');
            var studids = []
            $('.eachstud').each(function(){
                studids.push($(this).attr('data-id'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this column PRESENT?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Saving changes...',
                        allowOutsideClick: false,
                        closeOnClickOutside: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    }) 
                    $.ajax({
                        url: '/classattendance/presentattendancecol',
                        type:"GET",
                        dataType:"json",
                        data:{
                            tdate    :  selecteddate,
                            studids    : JSON.stringify(studids),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Updated successfully!')
                            $("tr.eachstud").each(function() {
                                $(this).children("td:eq("+columnid+")").removeAttr('class');
                                $(this).children("td:eq("+columnid+")").addClass('bg-success');
                                $(this).children("td:eq("+columnid+")").text('PRESENT');
                                $(this).children("td:eq("+columnid+")").attr('data-newstatus','PRESENT');
                                $(this).children("td:eq("+columnid+")").attr('data-status','PRESENT');
                                $(this).children("td:eq("+columnid+")").attr('clicked','0');
                            });
                            $(".swal2-container").remove();
                            $('body').removeClass('swal2-shown')
                            $('body').removeClass('swal2-height-auto')
                        }
                    })
                }
            })
        })
        $(document).on('click', '.btn-column-late', function(){
            columnid = $(this).closest('th').index();
            var selecteddate = $(this).attr('data-date');
            var studids = []
            $('.eachstud').each(function(){
                studids.push($(this).attr('data-id'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this column LATE?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Saving changes...',
                        allowOutsideClick: false,
                        closeOnClickOutside: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    }) 
                    $.ajax({
                        url: '/classattendance/lateattendancecol',
                        type:"GET",
                        dataType:"json",
                        data:{
                            tdate    :  selecteddate,
                            studids    : JSON.stringify(studids),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Updated successfully!')
                            $("tr.eachstud").each(function() {
                                $(this).children("td:eq("+columnid+")").removeAttr('class');
                                $(this).children("td:eq("+columnid+")").addClass('bg-warning');
                                $(this).children("td:eq("+columnid+")").text('LATE');
                                $(this).children("td:eq("+columnid+")").attr('data-newstatus','LATE');
                                $(this).children("td:eq("+columnid+")").attr('data-status','LATE');
                                $(this).children("td:eq("+columnid+")").attr('clicked','0');
                            });
                            $(".swal2-container").remove();
                            $('body').removeClass('swal2-shown')
                            $('body').removeClass('swal2-height-auto')
                        }
                    })
                }
            })
        })
        $(document).on('click', '.btn-column-absent', function(){
            columnid = $(this).closest('th').index();
            var selecteddate = $(this).attr('data-date');
            var studids = []
            $('.eachstud').each(function(){
                studids.push($(this).attr('data-id'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this column ABSENT?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Saving changes...',
                        allowOutsideClick: false,
                        closeOnClickOutside: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    }) 
                    $.ajax({
                        url: '/classattendance/absentattendancecol',
                        type:"GET",
                        dataType:"json",
                        data:{
                            tdate    :  selecteddate,
                            studids    : JSON.stringify(studids),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Updated successfully!')
                            $("tr.eachstud").each(function() {
                                $(this).children("td:eq("+columnid+")").removeAttr('class');
                                $(this).children("td:eq("+columnid+")").addClass('bg-danger');
                                $(this).children("td:eq("+columnid+")").text('ABSENT');
                                $(this).children("td:eq("+columnid+")").attr('data-newstatus','ABSENT');
                                $(this).children("td:eq("+columnid+")").attr('data-status','ABSENT');
                                $(this).children("td:eq("+columnid+")").attr('clicked','0');
                            });
                            $(".swal2-container").remove();
                            $('body').removeClass('swal2-shown')
                            $('body').removeClass('swal2-height-auto')
                        }
                    })
                }
            })
        })
        $(document).on('click','.btn-row-null', function(){
            var studid = $(this).attr('data-id');
            var thistr = $(this).closest('tr');
            var dates = []
            $('.eachdate').each(function(){
                dates.push($(this).attr('data-date'));
            })
            Swal.fire({
                title: 'Are you sure you want to delete the attedance of the selected student?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/classattendance/deleteattendancerow',
                        type:"GET",
                        dataType:"json",
                        data:{
                            studid   :  studid,
                            dates    : JSON.stringify(dates),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Deleted successfully!')
                            thistr.find('.eachstuddate').each(function(){
                                $(this).removeAttr('class');
                                $(this).addClass('eachstuddate');
                                $(this).removeAttr('style');
                                $(this).text('');
                                $(this).attr('data-newstatus','none');
                                $(this).attr('clicked','0');
                            })
                        }
                    })
                }
            })
        })
        $(document).on('click','.btn-row-present', function(){
            var studid = $(this).attr('data-id');
            var thistr = $(this).closest('tr');
            var dates = []
            $('.eachdate').each(function(){
                dates.push($(this).attr('data-date'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this row PRESENT?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/classattendance/presentattendancerow',
                        type:"GET",
                        dataType:"json",
                        data:{
                            studid   :  studid,
                            dates    : JSON.stringify(dates),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Marked successfully!')
                            thistr.find('.eachstuddate').each(function(){
                                $(this).removeAttr('class');
                                $(this).addClass('eachstuddate');
                                $(this).addClass('bg-success');
                                $(this).removeAttr('style');
                                $(this).text('PRESENT');
                                $(this).attr('data-newstatus','PRESENT');
                                $(this).attr('data-status','PRESENT');
                                $(this).attr('clicked','0');
                            })
                            $('#btn-reload').click()
                        }
                    })
                }
            })
        })
        $(document).on('click','.btn-row-late', function(){
            var studid = $(this).attr('data-id');
            var thistr = $(this).closest('tr');
            var dates = []
            $('.eachdate').each(function(){
                dates.push($(this).attr('data-date'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this row LATE?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/classattendance/lateattendancerow',
                        type:"GET",
                        dataType:"json",
                        data:{
                            studid   :  studid,
                            dates    : JSON.stringify(dates),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Marked successfully!')
                            thistr.find('.eachstuddate').each(function(){
                                $(this).removeAttr('class');
                                $(this).addClass('eachstuddate');
                                $(this).addClass('bg-warning');
                                $(this).removeAttr('style');
                                $(this).text('LATE');
                                $(this).attr('data-newstatus','LATE');
                                $(this).attr('data-status','LATE');
                                $(this).attr('clicked','0');
                            })
                        }
                    })
                }
            })
        })
        $(document).on('click','.btn-row-absent', function(){
            var studid = $(this).attr('data-id');
            var thistr = $(this).closest('tr');
            var dates = []
            $('.eachdate').each(function(){
                dates.push($(this).attr('data-date'));
            })
            Swal.fire({
                title: 'Are you sure you want to mark this row ABSENT?',
                // text: "You won't be able to revert this!",
                html: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/classattendance/absentattendancerow',
                        type:"GET",
                        dataType:"json",
                        data:{
                            studid   :  studid,
                            dates    : JSON.stringify(dates),
                            levelid  : '{{$gradelevelinfo->id}}',
                            sectionid: '{{$sectioninfo->id}}'
                        },
                        // headers: { 'X-CSRF-TOKEN': token },,
                        complete: function(){
                            toastr.success('Marked successfully!')
                            thistr.find('.eachstuddate').each(function(){
                                $(this).removeAttr('class');
                                $(this).addClass('eachstuddate');
                                $(this).addClass('bg-danger');
                                $(this).removeAttr('style');
                                $(this).text('ABSENT');
                                $(this).attr('data-newstatus','ABSENT');
                                $(this).attr('data-status','ABSENT');
                                $(this).attr('clicked','0');
                            })
                        }
                    })
                }
            })
        })
    })
</script>
@endsection