@extends('admin.layout.layout')
@section('content')
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">
            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">All {{ $title }}</h4>
                </div>
            </div>
            <!--End Page header-->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <!--div-->
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">{{ $title }}</div>
                            <!-- <div><a href="{{ route('add-edit-post') }}"  class="btn btn-block btn-info">Add Tickets</a></div> -->
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                <strong>Error Message: </strong>{{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <br>
                                @endforeach
                            </div>
                            @endif
                            @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error Message: </strong>{{Session::get('error_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success Message: </strong>{{Session::get('success_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                                        <thead>
                                            <tr>
                                               <th class="border-bottom-0">Issue Ticket</th>
                                                <th class="border-bottom-0">Customer Name</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Mobile</th>
                                                <th class="border-bottom-0">Subject</th>
                                                <th class="border-bottom-0">Issue</th>
                                                <!-- <th class="border-bottom-0">Action</th> -->
                                            </tr>
                                        </thead>
                                        <style>
                                            .button-group {
                                                display: inline-block; /* Keep the buttons in the same line */
                                                margin-right: 10px; /* Adjust the spacing between button groups if needed */
                                            }
                                        </style>
                                        <tbody>
                                            @foreach($customarissue as $value)
                                            <tr>
                                            <td>{{ $value->getPost->subject }}</td>
                                                <td>{{ $value->name }}</td>
                                                
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->mobile }}</td>
                                                <td>{{ $value->subject }}</td>
                                                <td>{{ $value->description }}</td>
                                                </td>
                                               
                                                <!-- <td>
                                                    @if($value['status'] == 1)
                                                    <a class="updatePostStatus" id="value-{{$value['id']}}" value_id="{{$value['id']}}" href="javascript:void(0)"><i style="font-size:150%; color: #efa06b;" class="fa-solid fa-toggle-on fa-lg"  status="Active"></i></a>
                                                    @else
                                                    <a class="updatePostStatus" id="value-{{$value['id']}}" value_id="{{$value['id']}}" href="javascript:void(0)"><i style="font-size:150%; color: #efa06b;" class="fa-solid fa-toggle-off fa-lg" status="Inactive"></i></a>
                                                    @endif
                                                </td> -->
                                               
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
