@extends('layouts.app')

@section('content')
<div class="container py-6">
    <!-- 頁面標題 -->
    <div class="row justify-content-center text-center mb-5">
        <div class="col-lg-8">
            <h1 class="h2 mb-3">
                <span class="pb-2" style="border-bottom: 3px solid #EA580C;">專案</span>
            </h1>
            <p class="text-muted">探索我們最新的作品和成功案例</p>
        </div>
    </div>

    <!-- 專案列表 -->
    <div class="row g-4">
        @foreach($projects as $project)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    @if($project->images->isNotEmpty())
                        <img src="{{ Storage::url($project->images->first()->image) }}" 
                             class="card-img-top" 
                             alt="{{ $project->title }}"
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body p-3">
                        <h3 class="card-title h5 mb-2">{{ $project->title }}</h3>
                        @if($project->sub_title)
                            <p class="text-primary small mb-2">{{ $project->sub_title }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
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

    <!-- 分頁 -->
    <div class="mt-5">
        {{ $projects->links() }}
    </div>
</div>
@endsection 