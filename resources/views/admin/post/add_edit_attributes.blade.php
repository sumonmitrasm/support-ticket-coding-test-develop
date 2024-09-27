@extends('admin.layout.layout')
@section('content')
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">

            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
            <!--End Page header-->

            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <!--div-->
                    @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="">
                        <form name="addImageForm" id="addImageForm" method="post"
                            action="{{ url('admin/add-attributes/' . $posts['id']) }}" enctype="multipart/form-data">@csrf
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $title }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="news_id">Post Id: </label>
                                                <input id="post_id" type="number" class="form-control"
                                                    value="{{ $posts['id'] }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="news_title">Donner  Name: </label>
                                                <input id="post_title" type="text" class="form-control"
                                                    value="{{ $posts['name'] }}" disabled>
                                            </div>


                                            <div class="form-group">
                                                <div class="field_wrapper">
                                                    <div>
                                                        <label class="form-control" style="color: cadetblue; background-color:rgb(73, 72, 78);" for="news_title">Please enter Blood donet date and details</label><br>
                                                        <input type="date" required name="blood_donate_date[]" placeholder="Last Blood Donate Date"/>
                                                        <input type="text" name="details[]" placeholder="Details About Donner"/>
                                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    @if(!empty($posts['donner_image']))
                                                    <img style="width: 170px; height: 170px;"
                                                        src="{{ asset('admin/admin_images/post/donner_image/' . $posts['donner_image']) }}"
                                                        alt="">&nbsp;
                                                    @else
                                                    <img width="150px;" height="140px;" src="{{asset('admin/admin_images/noimage.png')}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer ps-0">
                                        <button type="submit" class="btn btn-primary">Submit Data</button>
                                    </div>
                                </div>
                        </form>


                    </div>
                    <!--/div-->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Donner blood donate date and Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordered text-nowrap key-buttons">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">Attribute Id</th>
                                                        <th class="border-bottom-0">Date</th>
                                                        <th class="border-bottom-0">Details</th>
                                                        <th class="border-bottom-0">Status</th>
                                                        <th class="border-bottom-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($posts['attributes'] as $value)
                                                    <tr>
                                                        <td>{{ $value['id'] }}</td>
                                                        <td>{{ $value['blood_donate_date'] }}</td>
                                                        <td>{{ $value['details'] }}</td>
                                                        <td>
                                                            @if($value['status'] == 1)
                                                            <a class="updatecattributeStatus" id="value-{{$value['id']}}" value_id="{{$value['id']}}" href="javascript:void(0)"><i style="font-size:150%; color: #efa06b;" class="fa-solid fa-toggle-on fa-lg"  status="Active"></i></a>
                                                            @else
                                                            <a class="updatecattributeStatus" id="value-{{$value['id']}}" value_id="{{$value['id']}}" href="javascript:void(0)"><i style="font-size:150%; color: #efa06b;" class="fa-solid fa-toggle-off fa-lg" status="Inactive"></i></a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)" title="Delete Attribute" class="confirmDelete" module="attribute" moduleid="{{$value['id']}}"><i style="font-size:25px; color:red;" class="mdi mdi-file-excel-box"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                            
                        </div>
                    </div>
                    <!--/div-->
                </div>
            </div>
            <!-- /Row -->

        </div>
    </div>
</div>
<!-- Include Bootstrap CSS and JavaScript -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection