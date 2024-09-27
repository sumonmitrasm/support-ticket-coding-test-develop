@extends('frontend.layout.layout')
@section('content')
	<!-- Home Banner -->
			<section class="course-content cart-widget">
				<div class="container">
					<div class="student-widget">
						<div class="student-widget-group">
							<div class="row">
								<div class="col-lg-12">
									<div class="cart-head">
										<h4>All Tickets ({{$ticketscount}})</h4>
									</div>
									<div class="cart-group">
										<div class="row">
                                            @foreach($tickets as $ticket)
											<div class="col-lg-12 col-md-12 d-flex">
												<div class="course-box course-design list-course d-flex">
													<div class="product">
														<div class="product-img">
															<a href="course-details.html">
																<img class="img-fluid" style="wide: 30px;" alt="Img" src="{{ asset('admin/admin_images/post/large/'.$ticket->image) }}">
															</a>
														</div>
														<div class="product-content">
															<div class="head-course-title">
																<h3 class="title"><a href="course-details.html">{{$ticket->subject}}</a></h3>
															</div>
															<div class="course-info d-flex align-items-center border-bottom-0 pb-0">
																<p>{!! $ticket->description !!}</p>
															</div>
															
														</div>
                                                        @if($ticket->status == 1)
														<div class="cart-remove">
															<a href="{{ route('send-message', ['id' => $ticket['id']]) }}" class="btn btn-primary">Open</a>
														</div>
                                                        @else
                                                        <div class="cart-remove">
															<a href="javascript:void(0);" class="btn btn-primary">Close</a>
														</div>
                                                        @endif
													</div>
												</div>
											</div>
                                            @endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- /Home Banner -->		
@endsection