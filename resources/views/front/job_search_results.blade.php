<!-- resources/views/front/job_search_results.blade.php -->

@extends('front.layouts.app')

@section('content')
<section class="section-3 py-5">
    <div class="container">
        <h2>Jobs in {{ $category->name }}</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @if ($jobs->isNotEmpty())
                            @foreach ($jobs as $job)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->position_name }}</h3>
                                            <p>{!! $job->description !!}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $job->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $job->job_type ?? 'N/A' }}</span>
                                                </p>

                                                @if (!is_null($job->start_date) && !is_null($job->end_date))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-calendar"></i></span>
                                                    <span class="ps-1">{{ $job->start_date }} <b>To</b> {{ $job->end_date }}</span>
                                                </p>
                                                @endif

                                                @if (!is_null($job->salary_range_from) && !is_null($job->salary_range_to))
                                                    <div class="mb-3">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $job->salary_range_from }} - {{ $job->salary_range_to }} LPA</span>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('front.user.details', $job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No jobs available in this category.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection