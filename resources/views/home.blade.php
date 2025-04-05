@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="banner-section position-relative overflow-hidden">
    @if($slides->isNotEmpty())
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($slides as $key => $slide)
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $key }}" 
                            class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($slides as $key => $slide)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="height: 600px;">
                        <img src="{{ Storage::url($slide->image) }}" 
                             class="d-block w-100 h-100 object-fit-cover" 
                             alt="{{ $slide->title }}">
                        <div class="carousel-caption d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <h1 class="display-4 text-white mb-4" data-aos="fade-up">{{ $slide->title }}</h1>
                                @if($slide->description)
                                    <p class="lead text-white mb-5" data-aos="fade-up" data-aos-delay="100">
                                        {{ $slide->description }}
                                    </p>
                                @endif
                                @if($slide->link)
                                    <a href="{{ $slide->link }}" 
                                       class="btn btn-outline-light btn-lg" 
                                       data-aos="fade-up" 
                                       data-aos-delay="200">
                                        了解更多
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
</section>

<!-- Projects Section -->
<section class="projects-section py-8 py-md-12">
    <div class="container">
        <div class="row justify-content-center text-center mb-6">
            <div class="col-lg-8">
                <h2 class="display-5 mb-4" data-aos="fade-up">我們的專案</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">探索我們最新的作品和成功案例</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        @if($project->images->isNotEmpty())
                            <img src="{{ Storage::url($project->images->first()->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $project->title }}"
                                 style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h3 class="card-title h5 mb-2">{{ $project->title }}</h3>
                            @if($project->sub_title)
                                <p class="text-primary mb-3">{{ $project->sub_title }}</p>
                            @endif
                            <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($project->description), 150) }}</p>
                            <div class="d-flex flex-column gap-2">
                                @if($project->client)
                                    <div class="text-muted small">
                                        <i class="bi bi-building me-2"></i>{{ $project->client }}
                                    </div>
                                @endif
                                @if($project->location)
                                    <div class="text-muted small">
                                        <i class="bi bi-geo-alt me-2"></i>{{ $project->location }}
                                    </div>
                                @endif
                                @if($project->completion_date)
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar-event me-2"></i>{{ \Carbon\Carbon::parse($project->completion_date)->format('Y-m-d') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-end">
                            @if($project->url)
                                <a href="{{ $project->url }}" class="btn btn-primary btn-sm" target="_blank">
                                    <i class="bi bi-arrow-right-circle me-1"></i>查看詳情
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Color Mode Info -->
<div class="mt-7 mt-sm-8">
    <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
        <div class="alert bg-info bg-opacity-25 d-flex p-3" role="alert">
            <svg class="bi flex-shrink-0 me-2 text-info-emphasis" fill="currentColor" width="20" height="20" role="img" viewbox="0 0 16 16" aria-label="Info:">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
            </svg>
            <div class="ps-1">
                <h3 class="m-0 fw-semibold text-sm text-info-emphasis">
                    Heads up! Color Mode Options:
                </h3>
                <div class="mt-2 text-sm">
                    <p class="m-0 text-info-emphasis">
                        To change the color mode of this template or adjust how they look in different color schemes, please locate the <span class="fst-italic fw-medium">Color Mode Button</span> at the top-right corner of the screen. The button offers three different color mode options: Light, Dark, and Auto.	
                    </p>
                    <hr class="border-info border-opacity-50">
                    <p class="m-0 text-info-emphasis">
                        Happy customizing! 🎨
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 