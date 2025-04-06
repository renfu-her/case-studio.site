@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="banner-section position-relative overflow-hidden">
    @if($slides->isNotEmpty())
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- 輪播指示器 -->
            <div class="carousel-indicators">
                @foreach($slides as $key => $slide)
                    <button type="button" 
                            data-bs-target="#bannerCarousel" 
                            data-bs-slide-to="{{ $key }}" 
                            class="{{ $key === 0 ? 'active' : '' }}" 
                            aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>

            <!-- 輪播內容 -->
            <div class="carousel-inner">
                @foreach($slides as $key => $slide)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <div class="position-relative" style="height: 600px;">
                            @if($slide->image)
                                <div class="position-absolute w-100 h-100">
                                    <img src="{{ Storage::url($slide->image) }}" 
                                         class="w-100 h-100" 
                                         alt="{{ $slide->title }}"
                                         style="object-fit: cover;">
                                </div>
                            @else
                                <div class="position-absolute w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                                </div>
                            @endif

                            <!-- 輪播文字內容 -->
                            <div class="position-absolute bottom-0 w-100" style="background: rgba(0, 0, 0, 0.5);">
                                <div class="container">
                                    <div class="text-center py-4">
                                        <h2 class="text-white mb-2" data-aos="fade-up">
                                            {{ $slide->title }}
                                        </h2>
                                        @if($slide->description)
                                            <p class="text-white-75 mb-0" data-aos="fade-up" data-aos-delay="100">
                                                {{ $slide->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 輪播控制按鈕 -->
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <div class="d-flex align-items-center justify-content-center" 
                     style="width: 50px; height: 50px; background: rgba(0, 0, 0, 0.5); border-radius: 50%;">
                    <i class="bi bi-chevron-left text-white" style="font-size: 24px;"></i>
                </div>
                <span class="visually-hidden">上一張</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <div class="d-flex align-items-center justify-content-center" 
                     style="width: 50px; height: 50px; background: rgba(0, 0, 0, 0.5); border-radius: 50%;">
                    <i class="bi bi-chevron-right text-white" style="font-size: 24px;"></i>
                </div>
                <span class="visually-hidden">下一張</span>
            </button>
        </div>

        <style>
            .carousel-control-prev,
            .carousel-control-next {
                width: 10%;
                opacity: 0.8;
                transition: opacity 0.3s;
            }

            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                opacity: 1;
            }

            @media (max-width: 768px) {
                .carousel-control-prev,
                .carousel-control-next {
                    width: 15%;
                }
            }
        </style>
    @endif
</section>

<!-- Services Section -->
<section class="services-section py-6">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="h2 mb-3" data-aos="fade-up">
                    <span class="pb-2" style="border-bottom: 3px solid #EA580C;">服務</span>
                </h2>
                <p class="text-muted" data-aos="fade-up" data-aos-delay="100">專業的服務，為您提供最佳解決方案</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-4" style="min-height: 250px;">
                            <div class="mb-4">
                                <i class="{{ $service->icon }} fa-3x text-primary" style="color: #EA580C !important;"></i>
                            </div>
                            <h3 class="card-title h5 mb-3">{{ $service->title }}</h3>
                            @if($service->sub_title)
                                <p class="card-text text-muted small mb-0">{{ $service->sub_title }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="projects-section py-6 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="h2 mb-3" data-aos="fade-up">
                    <span class="pb-2" style="border-bottom: 3px solid #EA580C;">專案</span>
                </h2>
                <p class="text-muted" data-aos="fade-up" data-aos-delay="100">探索我們最新的作品和成功案例</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative" style="height: 250px;">
                            @if($project->images->isNotEmpty())
                                <div class="position-absolute w-100 h-100 bg-white d-flex align-items-center justify-content-center">
                                    <img src="{{ Storage::url($project->images->first()->image) }}" 
                                         class="mw-100 mh-100" 
                                         alt="{{ $project->title }}"
                                         style="object-fit: contain;">
                                </div>
                            @else
                                <div class="position-absolute w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-3 d-flex flex-column">
                            <div class="flex-grow-1">
                                <h3 class="card-title h5 mb-2">{{ $project->title }}</h3>
                                @if($project->sub_title)
                                    <p class="text-primary small mb-0">{{ $project->sub_title }}</p>
                                @endif
                            </div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary btn-sm text-white" style="background-color: #EA580C; border-color: #EA580C;">
                                    <i class="bi bi-arrow-right-circle me-1"></i>查看詳情
                                </a>
                                @if($project->url)
                                    <a href="{{ $project->url }}" class="btn btn-outline-primary btn-sm" target="_blank" style="color: #EA580C; border-color: #EA580C;">
                                        <i class="bi bi-link-45deg me-1"></i>訪問網站
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection 