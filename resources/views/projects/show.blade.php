@extends('layouts.app')

@section('content')
<!-- 返回按鈕 -->
<div class="container py-6">
    <div class="mb-4">
        <a href="{{ route('projects.index') }}" class="text-decoration-none" style="color: #EA580C;">
            <i class="bi bi-arrow-left me-2"></i>返回專案列表
        </a>
    </div>
</div>

<!-- 專案詳情 -->
@if($project->images->isNotEmpty())
    <!-- 全寬輪播圖 -->
    <div class="mb-6">
        <div id="projectCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($project->images as $key => $image)
                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="{{ $key }}" 
                            class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($project->images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($image->image) }}" 
                             class="d-block w-100" 
                             alt="{{ $project->title }}"
                             style="height: 600px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- 標題 -->
                    <div class="mb-4">
                        <h1 class="h3 mb-3">
                            <span class="pb-2" style="border-bottom: 3px solid #EA580C;">{{ $project->title }}</span>
                        </h1>
                        @if($project->sub_title)
                            <p class="text-primary mb-0">{{ $project->sub_title }}</p>
                        @endif
                    </div>

                    <!-- 專案描述 -->
                    @if($project->description)
                        <div class="mb-5">
                            <h5 class="mb-4">
                                <span class="pb-2" style="border-bottom: 2px solid #EA580C;">專案描述</span>
                            </h5>
                            <div class="markdown-body">
                                {!! Str::markdown($project->description) !!}
                            </div>
                        </div>
                    @endif

                    <!-- 專案資訊 -->
                    <div class="mb-4">
                        <h5 class="mb-4">
                            <span class="pb-2" style="border-bottom: 2px solid #EA580C;">專案資訊</span>
                        </h5>
                        <div class="row g-4">
                            @if($project->client)
                                <div class="col-md-4">
                                    <strong class="d-block mb-2">客戶</strong>
                                    <span class="text-muted">{{ $project->client }}</span>
                                </div>
                            @endif
                            @if($project->completion_date)
                                <div class="col-md-4">
                                    <strong class="d-block mb-2">完成日期</strong>
                                    <span class="text-muted">{{ $project->completion_date }}</span>
                                </div>
                            @endif
                            @if($project->location)
                                <div class="col-md-4">
                                    <strong class="d-block mb-2">地點</strong>
                                    <span class="text-muted">{{ $project->location }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($project->url)
                        <div>
                            <a href="{{ $project->url }}" class="btn btn-primary px-5" target="_blank" 
                               style="background-color: #EA580C; border-color: #EA580C;">
                                <i class="bi bi-link-45deg me-2"></i>訪問專案網站
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 