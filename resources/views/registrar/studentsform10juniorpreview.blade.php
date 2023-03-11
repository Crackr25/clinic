
@extends('registrar.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('plugins/jquery-year-picker/css/yearpicker.css')}}" />
    <style>
        td                                          { border-bottom: hidden; }
        input[type=text], .input-group-text, .select{ background-color: white !important; border: hidden; border-bottom: 2px solid #ddd; font-size: 12px !important; }
        .input-group-text                           { border-bottom: hidden; }
        .fontSize                                   { font-size: 12px; }
        .container                                  { overflow-x: scroll !important; }
        table                                       { width: 100%; }
        .inputClass                                 { width: 100%; }
        .tdInputClass                               { padding: 0px !important; }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button            { -webkit-appearance: none; margin: 0; }
    </style>

    @php
        $male = 1;
        $female = 1;
    @endphp
    {{-- <form id="submitSelectSchoolyear" action="/reports/selectSy" method="GET" class="m-0 p-0">
        <input type="hidden" value="{{$schoolyear}}" name="syid"/>
        <input type="hidden" value="School Form 10" name="selectedform"/>
        <input type="hidden" value="{{$academicprogram}}" name="academicprogram"/>
    </form>
    <form id="submitSelectSection" action="/reports/selectSection" method="GET" class="m-0 p-0">
        <input type="hidden" value="{{$schoolyear}}" name="syid"/>
        <input type="hidden" value="School Form 10" name="selectedform"/>
        <input type="hidden" value="{{$academicprogram}}" name="academicprogram"/>
    </form> --}}
    <section class="content-header">
        <div class="col-12">
            @if($academicprogram == 'elementary')
                <h4>Elementary</h4>
            @elseif($academicprogram == 'juniorhighschool')
                <h4>Junior High School</h4>
            @elseif($academicprogram == 'seniorhighschool')
                <h4>Senior High School</h4>
            @endif
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="/reports/{{$academicprogram}}">{{$selectedform}}</a></li>
                    <li class="breadcrumb-item"><a id="selectschoolyear" class="text-info">{{$schoolyeardesc}}</a></li>
                    <li class="breadcrumb-item"><a id="selectsection" class="text-info">{{$selectedsection}}</a></li>
                    <li class="breadcrumb-item"><a href="/reports_schoolform10/students/{{$schoolyear}}/{{$sectionid}}/{{$gradelevelid}}/{{$info->teacherid}}" >School Form 10 (Form 137)</a></li>
                    <li class="breadcrumb-item active">{{$studentdata->lastname}}, {{$studentdata->firstname}} {{$studentdata->middlename}} {{$studentdata->suffix}}.</li> --}}
                </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card card-default color-palette-box">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-file"></i>
                        <strong>Learner's Permanent Academic Record</strong>
                        {{-- {{$studentdata->id}} --}}
                    </h3>
                    <br>
                    <small><em>(Formerly Form 137)</em></small>
                    {{-- @if(isset($gradelevelid)) --}}
                    <form action="/juniorhigh/dashboard" target="_blank" method="get" class="m-0 p-0">
                        <input type="hidden" value="print" name="action"/>
                        <input type="hidden" value="{{$studentdata->id}}" name="studid"/>
                        <input type="hidden" value="{{$academicprogram}}" name="academicprogram"/>
                        <button type="submit" class="btn btn-primary btn-sm text-white float-right">
                            <i class="fa fa-upload"></i>
                        Print
                        </button>
                    </form>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group ">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">NAME:</span>
                                    </div>
                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentdata->lastname}}, {{$studentdata->firstname}} {{$studentdata->middlename}} {{$studentdata->suffix}}." aria-describedby="inputGroupPrepend" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group ">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">SEX:</span>
                                    </div>
                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentdata->gender}}" aria-describedby="inputGroupPrepend" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group ">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">DATE OF BIRTH:</span>
                                    </div>
                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentdata->dob}}" aria-describedby="inputGroupPrepend" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="row bg-gray" style="text-align:center;"> --}}
                    <form action="/juniorhigh/eligibility" method="get">
                        @csrf
                        <div class="bg-gray"><center>ELIGIBILITY FOR SHS ENROLLMENT</center></div>
                        
                        {{-- <input type="hidden" value="{{$academicprogram}}" name="academicprogram"/> --}}
                        <input type="hidden" value="{{$studentdata->id}}" name="studentid"/>
                        {{-- <input type="hidden" value="{{$schoolyear}}" name="syid"/> --}}
                        
                        <div style="border: 1px solid;">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <div class="icheck-primary d-inline">
                                                    @if(count($eligibility)!=0)
                                                        @if($eligibility[0]->completer == 'elem')
                                                            <input type="checkbox" id="radioPrimary1" name="completer" value="elem" checked>
                                                        @else
                                                            <input type="checkbox" id="radioPrimary1" name="completer" value="elem">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="radioPrimary1" name="completer" value="elem">
                                                    @endif
                                                <label for="radioPrimary1">
                                                </label>
                                                </div>
                                            </div>
                                            {{-- <span class="input-group-text" id="inputGroupPrepend"></span> --}}
                                            <input type="text" class="form-control text-uppercase" name="hs_completer" id="validationCustomUsername"  value="Elementary School Completer" aria-describedby="inputGroupPrepend" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Gen. Ave:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="number" class="form-control text-uppercase" name="gen_ave" id="validationCustomUsername"  value="{{$eligibility[0]->gen_ave}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="number" class="form-control text-uppercase" name="gen_ave" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">CITATION: (If Any)</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="citation" id="validationCustomUsername"  value="{{$eligibility[0]->citation}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="citation" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Date of Graduation/Completion (MM/DD/YYYY):</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" id="currentDate" class="currentDate" style="text-align:center;" name="graduation_date" width="100%" value="{{$eligibility[0]->completion_date}}"/>
                                            @else
                                                <input type="text" id="currentDate" class="currentDate" style="text-align:center;" name="graduation_date" width="100%" value=""/>
                                            @endif
                                            {{-- <input type="number" class="form-control text-uppercase" name="jhs_graduationdate" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend"> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">NAME OF SCHOOL:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="schoolname" id="validationCustomUsername"  value="{{$eligibility[0]->schoolname}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="schoolname" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">ADDRESS OF SCHOOL:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="schooladdress" id="validationCustomUsername"  value="{{$eligibility[0]->schooladdress}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="schooladdress" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small>Other Credential Presented</small>
                        <div class="pl-5" style="width:100%;">
                            <div class="form-row">
                                <div class="col-md-2">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <div class="icheck-primary d-inline">
                                                    @if(count($eligibility)!=0)
                                                        @if($eligibility[0]->passer == 'pept')
                                                            <input type="radio" id="passer1" name="passer" value="pept" checked>
                                                        @else
                                                            <input type="radio" id="passer1" name="passer" value="pept">
                                                        @endif
                                                    @else
                                                        <input type="radio" id="passer1" name="passer" value="pept">
                                                    @endif
                                                <label for="passer1">
                                                </label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control text-uppercase" name="pept_passer" id="validationCustomUsername"  value="PEPT Passer" aria-describedby="inputGroupPrepend" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <div class="icheck-primary d-inline">
                                                    @if(count($eligibility)!=0)
                                                        @if($eligibility[0]->passer == 'als') 
                                                            <input type="radio" id="passer2" name="passer" value="als" checked>
                                                        @else
                                                            <input type="radio" id="passer2" name="passer" value="als">
                                                        @endif
                                                    @else
                                                        <input type="radio" id="passer2" name="passer" value="als">
                                                    @endif
                                                <label for="passer2">
                                                </label>
                                                </div>
                                                {{-- <span class="input-group-text" id="inputGroupPrepend">ALS A & E Passer</span> --}}
                                            </div>
                                            <input type="text" class="form-control text-uppercase" name="als_passer" id="validationCustomUsername"  value="ALS A & E Passer" aria-describedby="inputGroupPrepend" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">RATING:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="rating" id="validationCustomUsername"  value="{{$eligibility[0]->rating}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="rating" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Date of Examination/Assessment (mm/dd/yyyy):</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase currentDate" id="examDate" name="exam_date" id="validationCustomUsername"  value="{{$eligibility[0]->exam_date}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase currentDate" id="examDate" name="exam_date" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Name of Testing Center:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="center_name" id="validationCustomUsername"  value="{{$eligibility[0]->learning_center_name}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="center_name" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group ">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Address of Testing Center:</span>
                                            </div>
                                            @if(count($eligibility)!=0)
                                                <input type="text" class="form-control text-uppercase" name="center_address" id="validationCustomUsername"  value="{{$eligibility[0]->learning_center_address}}" aria-describedby="inputGroupPrepend">
                                            @else
                                                <input type="text" class="form-control text-uppercase" name="center_address" id="validationCustomUsername"  value="" aria-describedby="inputGroupPrepend">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($eligibility)==0)
                            <button type="submit" class="btn btn-success btn-sm text-white float-right buttonSubmit">
                                <i class="fa fa-upload"></i>
                            Submit
                            </button>
                        @else
                            <button type="submit" class="btn btn-warning btn-sm text-white float-right buttonSubmit">
                                <i class="fa fa-upload"></i>
                            Update
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                {{-- <li class="breadcrumb-item"><a href="/reports_schoolform10/students/{{$schoolyear}}/{{$info->sectionid}}/{{$info->glevelid}}/{{$info->teacherid}}">{{$info->levelname}} - {{$info->sectionname}}</a></li> --}}
                <li class="breadcrumb-item active">Learner's Permanent Academic Record</li>
            </ol>
        </div>
        <div class="col-md-12">
            <button id="addrecord" type="button" class="btn btn-warning btn-sm float-left"><i class="fa fa-plus"></i></button>
            {{-- <button id="generateBtn" type="button" class="btn btn-primary btn-sm float-left ml-2"> <small><i class="fa fa-sync"></i>&nbsp;Generate</small></button> --}}
            <br>
            @if((string)Session::get('newData') == true)
                <br>
                <br>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> {{ (string)Session::get('newData') }}</h5>
                    
                </div>
            @endif
            @if((string)Session::get('message') == true)
                <br>
                <br>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> {{ (string)Session::get('message') }}</h5>
                
                </div>
            @endif
            @if((string)Session::get('deleteData') == true)
                <br>
                <br>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> {{ (string)Session::get('deleteData') }}</h5>
                    
                </div>
            @endif
        </div>
        &nbsp;
        <div class="col-md-12">
            <div id="addcontainer"></div>
        </div>
        <div class="col-md-12">
            @if(isset($records))
                @php
                    $uniqueId = 1;   
                @endphp
                @foreach ($records as $studentRecord)
                    <div id="accordion">
                        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title col-md-12" >
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$uniqueId}}">
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <div class="position-relative form-group ">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">CLASSIFIED AS:</span>
                                                        </div>
                                                        <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentRecord->gradedetails->levelname}}" aria-describedby="inputGroupPrepend" placeholder="(Grade Level)" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group ">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">School</span>
                                                        </div>
                                                        <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentRecord->schoolinformation->schoolname}}" aria-describedby="inputGroupPrepend" placeholder="(Municipal)" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group ">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">School Year:</span>
                                                        </div>
                                                        <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$studentRecord->gradedetails->sydesc}}" aria-describedby="inputGroupPrepend" placeholder="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne{{$uniqueId}}" class="panel-collapse collapse in">
                                <div class="card-body">
                                    <div class="container">
                                        {{-- @if($studentRecord[0]['operation'] == 1)
                                            <form name="formSubmit" action="" method="GET" class="m-0">
                                                <input type="hidden" name="selectedsection" value="{{$selectedsection}}"/>
                                                <input type="hidden" name="schoolyeardesc" value="{{$schoolyeardesc}}"/>
                                                <input type="hidden" name="selectedform" value="{{$selectedform}}"/>
                                                <input type="hidden" name="currentSectionid" value="{{$sectionid}}"/>
                                                <input type="hidden" name="student_id" value="{{$studentdata->id}}"/>
                                                <input type="hidden" name="editHeaderId" value="{{$studentRecord[2]}}"/>
                                                <input type="hidden" name="academicprogram" value="{{$academicprogram}}"/>
                                                <button type="btn" class="btn btn-warning btn-xs mb-2 editButton"><i class="fa fa-edit"></i>&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            </form>
                                            <button type="btn" class="btn btn-danger btn-xs mb-2 deleteButton" data-toggle="modal" data-target="#deleteButton{{$studentRecord[2]}}"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                            <br>
                                        <!-- Modal -->
                                            <div class="modal fade" id="deleteButton{{$studentRecord[2]}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                <span class="mr-5">Student:</span>
                                                                <span class="">
                                                                    <strong>{{$studentdata->lastname}}, {{$studentdata->firstname}} {{$studentdata->middlename}} {{$studentdata->suffix}}.</strong>
                                                                </span>
                                                            </h5>
                                                        </div>
                                                        <form name="deleteForm" action="" method="GET" class="m-0">
                                                            <div class="modal-body">
                                                                <span class="mr-5">Classified as:</span>
                                                                <span class="ml-3">
                                                                    <strong>{{$studentRecord[0]['gradelevelname']}}</strong>
                                                                </span>
                                                                <br>
                                                                <span class="mr-5">School:</span>
                                                                <span class="ml-5">
                                                                    <strong>{{$studentRecord[0]['schoolname']}}</strong>
                                                                </span>
                                                                <br>
                                                                <span class="mr-5">School Year:</span>
                                                                <span class="ml-3">
                                                                    <strong>{{$studentRecord[0]['schoolyear']}}</strong>
                                                                </span>
                                                                <br>
                                                                <br>
                                                                <strong class="text-danger">Are you sure you want to delete this record?</strong>
                                                                <br>
                                                                <span class="text-danger">Once you confirm, it cannot be undone.</span>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger deleteConfirm">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif --}}
                                        <small>Section:</small>
                                        <br>
                                        <small>Name of Adviser:</small>
                                        <table class="table table-bordered fontSize">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="30%">SUBJECT</th>
                                                    <th colspan="4">QUARTER</th>
                                                    <th rowspan="2">FINAL RATING</th>
                                                    <th rowspan="2">REMARKS</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $avggrade = 0;   
                                                @endphp
                                                @foreach ($studentRecord->grades as $subjects)
                                                    @if($subjects->remarks == 'FAILED')
                                                        <tr style="background-color:#ffb2b9">
                                                    @else
                                                        <tr>
                                                    @endif
                                                            <td>{{$subjects->subjtitle}}</td>
                                                            <td><center>{{$subjects->quarter1}}</center></td>
                                                            <td><center>{{$subjects->quarter2}}</center></td>
                                                            <td><center>{{$subjects->quarter3}}</center></td>
                                                            <td><center>{{$subjects->quarter4}}</center></td>
                                                            <td><center>{{$subjects->finalrating}}</center></td>
                                                            <td><center>{{$subjects->remarks}}</center></td>
                                                            {{-- <td><center>{{$subjects->credits}}</center></td> --}}
                                                        </tr>
                                                        @php
                                                            $avggrade+=$subjects->finalrating;
                                                        @endphp
                                                @endforeach
                                                <tr>
                                                    <td width="30%">&nbsp;</td>
                                                    <td colspan="4"><center>GENERAL AVERAGE</center></td>
                                                    <td>
                                                        @if($avggrade == 0)
                                                        @else
                                                        <center>{{$avggrade/count($studentRecord->grades)}}</center>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($avggrade == 0)
                                                        @else
                                                        @if(($avggrade/count($studentRecord->grades))>75)
                                                        <center>PASSED</center>
                                                        @else
                                                        <center>FAILED</center>
                                                        @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $uniqueId+=1;   
                    @endphp
                @endforeach
            @endif
            @php
                $uniqueId = 111;   
            @endphp
            @foreach ($torrecords as $torrecord)
                <div id="accordion">
                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title col-md-12" >
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$uniqueId}}">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="position-relative form-group ">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">CLASSIFIED AS:</span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$torrecord->levelname->levelname}}" aria-describedby="inputGroupPrepend" placeholder="(Grade Level)" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group ">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">School</span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$torrecord->schoolinfo->schoolname}}" aria-describedby="inputGroupPrepend" placeholder="(Municipal)" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group ">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">School Year:</span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" id="validationCustomUsername"  value="{{$torrecord->schoolyear->schoolyear}}" aria-describedby="inputGroupPrepend" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne{{$uniqueId}}" class="panel-collapse collapse in">
                            <div class="card-body">
                                <div class="container">
                                    <form name="formSubmit" action="/junior/editform10/edit" method="GET" class="m-0">
                                        <input type="hidden" name="student_id" value="{{$studentdata->id}}"/>
                                        <input type="hidden" name="academicprogram" value="{{$academicprogram}}"/>
                                        <input type="hidden" name="recordid" value="{{$torrecord->schoolyear->id}}"/>
                                        <button type="submit" class="btn btn-warning btn-xs mb-2 editButton"><i class="fa fa-edit"></i>&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                    </form>
                                    <button type="btn" class="btn btn-danger btn-xs mb-2 deleteButton" data-toggle="modal" data-target="#deleteButton{{$torrecord->schoolyear->id}}"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                    <br>
                                <!-- Modal -->
                                    <div class="modal fade" id="deleteButton{{$torrecord->schoolyear->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                                        <span class="mr-5">Student:</span>
                                                        <span class="">
                                                            <strong>{{$studentdata->lastname}}, {{$studentdata->firstname}} {{$studentdata->middlename}} {{$studentdata->suffix}}.</strong>
                                                        </span>
                                                    </h5>
                                                </div>
                                                <form name="deleteForm" action="/junior/deleteform10" method="GET" class="m-0">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="studentid" value="{{$studentdata->id}}"/>
                                                        <input type="hidden" name="headerid" value="{{$torrecord->schoolyear->id}}"/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger deleteConfirm">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <small>Section:</small>
                                    <br>
                                    <small>Name of Adviser:</small>
                                    <table class="table table-bordered fontSize">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="30%">SUBJECT</th>
                                                <th colspan="4">QUARTER</th>
                                                <th rowspan="2">FINAL RATING</th>
                                                <th rowspan="2">REMARKS</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($torrecord->grades)>0)
                                                @foreach ($torrecord->grades as $subjects)
                                                    @if($subjects->finalrating < 75)
                                                        <tr style="background-color:#ffb2b9">
                                                    @else
                                                        <tr>
                                                    @endif
                                                            <td>{{$subjects->subj_desc}}</td>
                                                            <td><center>{{$subjects->quarter1}}</center></td>
                                                            <td><center>{{$subjects->quarter2}}</center></td>
                                                            <td><center>{{$subjects->quarter3}}</center></td>
                                                            <td><center>{{$subjects->quarter4}}</center></td>
                                                            <td><center>{{$subjects->finalrating}}</center></td>
                                                            <td><center>{{$subjects->action}}</center></td>
                                                        </tr>                                                    
                                                @endforeach
                                            @endif
                                            @if(count($torrecord->generalaverage)>0)
                                                <tr>
                                                    <td width="30%">&nbsp;</td>
                                                    <td colspan="4"><center>GENERAL AVERAGE</center></td>
                                                    <td>
                                                        {{$torrecord->generalaverage[0]->genave}}
                                                    </td>
                                                    <td>
                                                        {{-- @if($avggrade == 0)
                                                        @else
                                                        @if(($avggrade/count($studentRecord->grades))>75)
                                                        <center>PASSED</center>
                                                        @else
                                                        <center>FAILED</center>
                                                        @endif
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $uniqueId+=1;   
                @endphp
            @endforeach
        </div>
    </div>
    {{-- </div> --}}
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- fullCalendar 2.2.5 -->
    <!-- InputMask -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('plugins/jquery-year-picker/js/yearpicker.js')}}"></script>
    <script src="{{asset('assets/scripts/gijgo.min.js')}}" ></script>
    <script>
        $(document).ready(function() {
            if($('input[name=completer]').prop("checked")==true){
                console.log('asd');
            }
            else{
                $('input[name=gen_ave]').prop('disabled','true');
                $('input[name=citation]').prop('disabled','true');
                $('input[name=graduation_date]').prop('disabled','true');
                $('input[name=schoolname]').prop('disabled','true');
                $('input[name=schooladdress]').prop('disabled','true');
                // $('.buttonSubmit').addClass('disabled');
                $('input[name=completer]').on('click', function(){
                    if($(this).prop('checked')==true){
                        $('input[name=gen_ave]').removeAttr('disabled');
                        $('input[name=citation]').removeAttr('disabled');
                        $('input[name=graduation_date]').removeAttr('disabled');
                        $('input[name=schoolname]').removeAttr('disabled');
                        $('input[name=schooladdress]').removeAttr('disabled');
                        // $('.buttonSubmit').removeClass('disabled');
                    }
                    else{
                        // console.log($('input[name=gen_ave]').prop('disabled','true'))
                        $('input[name=gen_ave]').prop('disabled','true');
                        $('input[name=citation]').prop('disabled','true');
                        $('input[name=graduation_date]').prop('disabled','true');
                        $('input[name=schoolname]').prop('disabled','true');
                        $('input[name=schooladdress]').prop('disabled','true');
                        // $('.buttonSubmit').addClass('disabled');
                    }
                })
            }
            $('#currentDate').datepicker({
            format: 'yyyy-mm-dd'
            });
            $('#examDate').datepicker({
            format: 'yyyy-mm-dd'
            });
            $('#addrecord').on('click',function(){
                var newRow = 1;
                $('#addcontainer').prepend(
                    '<div class="card">'+
                        '<div class="ribbon-wrapper ribbon-sm">'+
                            '<div class="ribbon bg-warning text-sm">NEW</div>'+
                        '</div>'+
                        '<button id="removeCard'+newRow+'" class="btn btn-xs btn-outline-danger removeCard col-md-1"><i class="fa fa-times"></i></button>'+
                        '<form action="/junior/addform10" method="GET">'+
                            '@csrf'+
                        '<div class="card-header">'+
                            '<div class="form-row">'+
                                '<div class="col-md-6">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">SCHOOL</span>'+
                                            '</div>'+
                                            '<input id="school" name="school" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(SCHOOL)" required />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">SCHOOL ID</span>'+
                                            '</div>'+
                                            '<input id="schoolid" name="schoolid" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(SCHOOL ID)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-row">'+
                                '<div class="col-md-4">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">DISTRICT</span>'+
                                            '</div>'+
                                            '<input id="district" name="district" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(DISTRICT)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">DIVISION</span>'+
                                            '</div>'+
                                            '<input id="division" name="division" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(DIVISION)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">REGION</span>'+
                                            '</div>'+
                                            '<input id="region" name="region" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(REGION)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-row">'+
                                '<div class="col-md-3">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">CLASSIFIED AS:</span>'+
                                            '</div>'+
                                            '<select id="gradelevelid" name="gradelevelid" class="form-control form-control-sm text-uppercase select" required>'+
                                                '<option value=""></option>'+
                                                '@foreach($gradelevels as $level)'+
                                                    '<option value="{{$level->id}}">{{$level->levelname}}</option>'+
                                                '@endforeach'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">SECTION</span>'+
                                            '</div>'+
                                            '<input id="section" name="section" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(Section)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">School Year:</span>'+
                                            '</div>'+
                                            '<input type="text" name="schoolyear_from" class="yearpicker form-control" value="" />'+
                                            '<div class="input-group-append">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">to</span>'+
                                            '</div>'+
                                            '<input type="text" name="schoolyear_to" class="yearpicker form-control" value="" />'+
                                            // '<input id="schoolyear" name="schoolyear" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="School Year" required>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-row">'+
                                '<div class="col-md-12">'+
                                    '<div class="position-relative form-group ">'+
                                        '<div class="input-group input-group-sm">'+
                                            '<div class="input-group-prepend">'+
                                                '<span class="input-group-text" id="inputGroupPrepend">Name of Adviser/Teacher</span>'+
                                            '</div>'+
                                            '<input id="teacher" name="teacher" type="text" class="form-control text-uppercase" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="(Name of Adviser/Teacher)" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-body">'+
                            '<div class="col-md-12">'+
                                    '<input type="hidden" name="studentid" value="{{$studentdata->id}}"/>'+
                                    '<input type="hidden" name="academicprogram" value="juniorhighschool"/>'+
                                    '<table class="table table-bordered uppercase fontSize" style="text-align:center;">'+
                                        '<thead>'+
                                            '<tr>'+
                                                '<th rowspan="2"width="30%">SUBJECT</th>'+
                                                '<th colspan="4">QUARTER</th>'+
                                                '<th rowspan="2">FINAL RATING</th>'+
                                                '<th rowspan="2">REMARKS</th>'+
                                                '<th></th>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>1</th>'+
                                                '<th>2</th>'+
                                                '<th>3</th>'+
                                                '<th>4</th>'+
                                                '<th></th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody id="tbody">'+
                                            '<tr>'+
                                                '<td class="tdInputClass"><input type="text" class="form-control" name="entry'+newRow+'[]" required/></td>'+
                                                '<td class="tdInputClass"><input type="number grades" class="form-control" max="100" name="entry'+newRow+'[]" value="0" required/></td>'+
                                                '<td class="tdInputClass"><input type="number grades" class="form-control" name="entry'+newRow+'[]" value="0" required/></td>'+
                                                '<td class="tdInputClass"><input type="number grades" class="form-control" name="entry'+newRow+'[]" value="0" required/></td>'+
                                                '<td class="tdInputClass"><input type="number grades" class="form-control" name="entry'+newRow+'[]" value="0" required/></td>'+
                                                '<td class="tdInputClass"><input type="number grades" class="form-control" name="entry'+newRow+'[]" value="0" required/></td>'+
                                                '<td class="tdInputClass"><input type="text" class="form-control" name="entry'+newRow+'[]" required/></td>'+
                                                '<td class="removebutton"><center><i class="fa fa-trash text-gray"></i></center></td>'+
                                            '</tr>'+
                                        '</tbody>'+
                                        '<tfoot>'+
                                            '<tr>'+
                                                '<td class="tdInputClass"><input type="text" class="form-control" name="entryGen[]" value="General Average" disabled/></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td class="tdInputClass"><input type="number" class="form-control grades" name="entryGen[]" required/></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<td colspan="7" style="border-bottom: hidden; border-left: hidden;"></td>'+
                                                '<td id="addrow"><center><i class="fa fa-plus"></i></center></td>'+
                                            '</tr>'+
                                        '</tfoot>'+
                                    '</table>'+
                                    '<button type="submit" class="btn btn-block btn-warning">Submit Form</button>'+
                                '</div>'+
                            '</div>'+
                        '</form>'+
                    '</div>'
                );
                newRow+=1;
                $('#addrow').on('click', function(){
                    var closestTable = $(this).closest("table");
                    closestTable.append(
                        '<tr>'+
                            '<td class="tdInputClass"><input type="text" class="form-control" name="entry'+newRow+'[]" required/></td>'+
                            '<td class="tdInputClass"><input type="number" class="form-control grades" name="entry'+newRow+'[]" value="0" required/></td>'+
                            '<td class="tdInputClass"><input type="number" class="form-control grades" name="entry'+newRow+'[]" value="0" required/></td>'+
                            '<td class="tdInputClass"><input type="number" class="form-control grades" name="entry'+newRow+'[]" value="0" required/></td>'+
                            '<td class="tdInputClass"><input type="number" class="form-control grades" name="entry'+newRow+'[]" value="0" required/></td>'+
                            '<td class="tdInputClass"><input type="number" class="form-control grades" name="entry'+newRow+'[]" value="0" required/></td>'+
                            '<td class="tdInputClass"><input type="text" class="form-control" name="entry'+newRow+'[]" required/></td>'+
                            '<td class="removebutton"><center><i class="fa fa-trash text-gray"></i></center></td>'+
                        '</tr>'
                    );
                    newRow+=1;
                    $('.grades').on('change', function () {
                        var input = parseInt(this.value);
                        if (input < 60 )
                            $(this).val('60')
                        else if (input > 100 )
                            $(this).val('100')
                        return;
                    });
                });
                $(document).on('click', '.removebutton', function () {
                    $(this).closest('tr').remove();
                    return false;
                });
                $('.removeCard').on('click', function () {
                    $(this).closest('.card').remove();
                    return false;
                });
                // $('input').on('input', function () {
                    
                //     var value = $(this).val();
                    
                //     if ((value !== '') && (value.indexOf('.') === -1)) {
                        
                //         $(this).val(Math.max(Math.min(value, 100), -100));
                //     }
                // });
                $('.grades').on('change', function () {
                    var input = parseInt(this.value);
                    if (input < 60 )
                        $(this).val('60')
                    else if (input > 100 )
                        $(this).val('100')
                    return;
                });
                $(".yearpicker").yearpicker();
            });
            // $(".editButton").on('click',function () {
            //     var student_id = $(this).prev().prev().attr('value');
            //     var header_id = $(this).prev().prev().attr('value');
            //     $('form[name=formSubmit]').attr('action', '/editForm10/preview/'+student_id+'/'+header_id+'').submit();

            // });
            // $(".deleteConfirm").on('click',function () {

            //     var student_id = $('input[name=student_id]').val();
            //     var header_id = $('input[name=editHeaderId]').val();
            //     $('form[name=deleteForm]').attr('action', '/editForm10/delete/'+student_id+'/'+header_id+'').submit();

            // });
            });
    </script>
@endsection