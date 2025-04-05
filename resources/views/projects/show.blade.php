@extends('layouts.app')

@section('content')
<div class="container py-6">
    <!-- 返回按鈕 -->
    <div class="mb-4">
        <a href="{{ route('projects.index') }}" class="text-decoration-none" style="color: #EA580C;">
            <i class="bi bi-arrow-left me-2"></i>返回專案列表
        </a>
    </div>

    <!-- 專案詳情 -->
    <div class="row g-4">
        <!-- 圖片輪播 -->
        <div class="col-lg-8">
            @if($project->images->isNotEmpty())
                <div id="projectCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($project->images as $key => $image)
                            <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="{{ $key }}" 
                                    class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner rounded shadow">
                        @foreach($project->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($image->image) }}" 
                                     class="d-block w-100" 
                                     alt="{{ $project->title }}"
                                     style="height: 500px; object-fit: cover;">
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
            @endif
        </div>

        <!-- 專案資訊 -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h1 class="h3 mb-3">{{ $project->title }}</h1>
                    @if($project->sub_title)
                        <p class="text-primary mb-4">{{ $project->sub_title }}</p>
                    @endif

                    @if($project->description)
                        <div class="mb-4">
                            <h5 class="mb-3">專案描述</h5>
                            <div class="text-muted">{!! $project->description !!}</div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="mb-3">專案資訊</h5>
                        <ul class="list-unstyled">
                            @if($project->client)
                                <li class="mb-2">
                                    <strong class="me-2">客戶：</strong>
                                    <span class="text-muted">{{ $project->client }}</span>
                                </li>
                            @endif
                            @if($project->completion_date)
                                <li class="mb-2">
                                    <strong class="me-2">完成日期：</strong>
                                    <span class="text-muted">{{ $project->completion_date }}</span>
                                </li>
                            @endif
                            @if($project->location)
                                <li class="mb-2">
                                    <strong class="me-2">地點：</strong>
                                    <span class="text-muted">{{ $project->location }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    @if($project->url)
                        <a href="{{ $project->url }}" class="btn btn-primary w-100" target="_blank" 
                           style="background-color: #EA580C; border-color: #EA580C;">
                            <i class="bi bi-link-45deg me-2"></i>訪問專案網站
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 