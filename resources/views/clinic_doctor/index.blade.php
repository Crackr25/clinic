
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fullcalendar-daygrid/main.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fullcalendar-timegrid/main.min.css')}}">
<link rel="stylesheet" href="tschoolschedule{{asset('plugins/fullcalendar-bootstrap/main.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fullcalendar-interaction/main.min.css')}}">



@extends('clinic_doctor.layouts.app')


<style>
    .dataTable                  { font-size:80%; }
    .tschoolschedule .card-body { height:250px; }
    .tschoolcalendar            { font-size: 12px; }
    .tschoolcalendar .card-body { height: 250px; overflow-x: scroll; }
    .teacherd ul li a           { color: #fff; -webkit-transition: .3s; }
    .teacherd ul li             { -webkit-transition: .3s; border-radius: 5px; background: rgba(173, 177, 173, 0.3); margin-left: 2px; }
    .sf5                        { background: rgba(173, 177, 173, 0.3)!important; border: none!important; }
    .sf5menu a:hover            { background-color: rgba(173, 177, 173, 0.3)!important; }
    .teacherd ul li:hover       { transition: .3s; border-radius: 5px; padding: none; margin: none; }

    .small-box                  { box-shadow: 1px 2px 2px #001831c9; overflow-y: auto scroll; }

    .small-box h5               { text-shadow: 1px 1px 2px gray; }

    img{
        border-radius: unset !important;
    }

</style>
@section('content')
@php
    use \Carbon\Carbon;
    $now = Carbon::now();
    $comparedDate = $now->toDateString();

    $appointments = DB::table('clinic_appointments')
            ->select('clinic_appointments.*','users.type','usertype.utype')
            ->join('users','clinic_appointments.userid','=','users.id')
            ->join('usertype','users.type','=','usertype.id')
            ->where('clinic_appointments.adate', date('Y-m-d'))
            ->where('clinic_appointments.admitted','1')
            //->where('clinic_appointments.docid',DB::table('teacher')->where('userid', auth()->user()->id)->where('deleted','0')->first()->id)
            ->get();


        if(count($appointments)>0)
        {
            foreach($appointments as $appointment)
            {
                if($appointment->type == 7)
                {
                    $info = DB::table('studinfo')
                        ->where('userid', $appointment->userid)
                        ->first();
                    $info->title = null;
                }else{
                    $info = DB::table('users')
                        ->where('ID', $appointment->userid)
                        ->first();
                }
                $name_showlast = "";

                if($info->name != null)
                {
                    $name_showlast.=$info->name.' ';
                }
                $name_showlast.=$info->name.' ';

            //   if($info->middlename != null)
            //   {
            //       $name_showfirst.=$info->middlename[0].'. ';
            //   }
            //   $name_showfirst.=$info->lastname.' ';
            //   $name_showfirst.=$info->suffix.' ';

            //   $appointment->name_showfirst = $name_showfirst;

            //   $name_showlast = "";

            //   if($info->title != null)
            //   {
            //       $name_showlast.=$info->title.' ';
            //   }
            //   $name_showlast.=$info->lastname.', ';
            //   $name_showlast.=$info->firstname.' ';

            //   if($info->middlename != null)
            //   {
            //       $name_showlast.=$info->middlename[0].'. ';
            //   }
            //   $name_showlast.=$info->suffix.' ';

            $appointment->name_showlast = $name_showlast;
            $appointedname = '';
            $name = $name_showlast;
            }
        }
        

@endphp



<div class="row">
    <div class="col-md-6">
        <label>Appointments for today</label>
        
        @if(count($appointments)>0)
        <ul class="todo-list" data-widget="todo-list">
           @foreach($appointments as $appointment)
            <li>
            
                <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="{{$appointment->id}}" name="appointment" class="check-appointment" id="todoCheckAppointment{{$appointment->id}}" @if($appointment->label == 1) checked @endif>
                    <label for="todoCheckAppointment{{$appointment->id}}"></label>
                </div>
                <!-- todo text -->
                <span class="text  bg-light text-dark">{{$appointment->name_showlast}}</span>
                <!-- Emphasis label -->
                @if($appointment->atime == null)
                @else
                <small class="badge badge-info bg-light text-dark"><i class="far fa-clock"></i> {{date('M d, Y h:i A', strtotime($appointment->atime))}}</small>
                @endif
                <button type="button" class="btn btn-sm btn-dark edit" data-id="{{$appointment->id}}"><i class="fa fa-info-circle"></i></button>
                <!-- General tools such as edit or delete-->
            </li>
            @endforeach
        </ul>
        @else
        <div class="row">
            <div class="col-md-12 text-center">No Appointments for today</div>
        </div>
        @endif
        </div>
        <div class="col-md-6"></div>
    </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subscriberModalLabel">Appointment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Name:</strong> <span id="subscriberName"></span></p>
                            <table class="table table-striped table-hover" id="subscribersTable2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time Slot</th>
                                        <th>Descriptions</th>
                                    </tr>
                                </thead>
                                <tbody id="subscriberDetails">
                                </tbody>
                            </table>
                        </div>
            </div>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#btn-createapp').on('click', function(){
            window.open("/clinic/appointment/viewdetail");
        })
        $('.edit').on('click', function(){
            var appointmentid   = $(this).attr('data-id');
            console.log(appointmentid);
            $('#myModal').modal('show');
            var modalBody = $('#myModal .modal-body');
            var data =<?php echo json_encode($appointments); ?>;
            
            var appointmentdata = data.filter(x=>x.id==appointmentid);
            console.log(appointmentdata);
            var date1 = new Date(Date.parse(appointmentdata[0].admitteddatetime));
            console.log(appointmentdata[0].name_showlast);
            var date2 = date1.toLocaleDateString("en-US", {month: "long", year: "numeric", day: "numeric", hour: "numeric", minute: "numeric"});
                var tableHtml = `
                    <p style="margin: 0.5rem 0; font-size: 1.2rem; font-weight: bold; color: black;">
                        ${appointmentdata[0].name_showlast}
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Time Slot</th>
                                <th>Descriptions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${date2}</td>
                                <td>${appointmentdata[0].description}</td>
                            </tr>
                        </tbody>
                    </table>
                `;
                modalBody.html(tableHtml);
            // var providerHtml = `<td>${subscriber.PROVIDER}</td>`;
            // var phoneHtml = `<td>${subscriber.PHONENO}</td>`;   
            //console.log(appointmentdata);
            // var data2 =<?php echo json_encode($name); ?>;
            // console.log(data2);
            // console.log(typeof data2);
        
            //     $.ajax({
        //                     url:'/clinic/appointment/viewdetail',
        //                     type:'GET',
        //                     dataType: 'json',
        //                     data: {
        //                         appointmentid        :  appointmentid,
        //                     }    

        //                     success:function(data) {
        //                         if(data == 1){
        //                         console.log(data);
        //                         }else{
        //                         console.log('error');
        //                         }   
        //                     }

        // })
                            
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $('.check-appointment').on('click', function(){
                var appointmentid   = $(this).val();
                var applabel           = 0;
                var labelstring     = 'undone';
                if($(this).prop('checked'))
                {
                    applabel         = 1;
                    labelstring       = 'done'
                }
                Swal.fire({
                    title: 'You are going to mark this appointment '+labelstring+'.',
                    text: 'Would you like to continue?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continue'
                })
                .then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'/clinic/appointment/markdone',
                            type:'GET',
                            dataType: 'json',
                            data: {
                                id        :  appointmentid,
                                applabel  :  applabel
                            },
                            success:function(data) {
                                if(data == 1)
                                {
                                    Toast.fire({
                                        type: 'success',
                                        title: 'Appointment marked '+labelstring+'!'
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        title: 'Something went wrong!'
                                    })
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
    @endsection
