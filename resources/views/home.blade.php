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
                                <h1 class="display-4 text-white mb-4 text-shadow-lg" data-aos="fade-up" 
                                    style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ $slide->title }}</h1>
                                @if($slide->description)
                                    <p class="lead text-white mb-5 text-shadow" data-aos="fade-up" data-aos-delay="100"
                                       style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);">
                                        {{ $slide->description }}
                                    </p>
                                @endif
                                @if($slide->link)
                                    <a href="{{ $slide->link }}" 
                                       class="btn btn-outline-light btn-lg shadow-sm" 
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
                <h2 class="display-5 mb-4" data-aos="fade-up">
                    <span class="pb-2" style="border-bottom: 3px solid #EA580C;">我們的專案</span>
                </h2>
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
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-end">
                            @if($project->url)
                                <a href="{{ $project->url }}" class="btn btn-primary text-white btn-sm" target="_blank" style="background-color: #EA580C; border-color: #EA580C;">
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

@endsection 