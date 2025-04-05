@extends('layouts.app')

@section('content')
<div class="container py-6">
    @if($about)
        <!-- 頁面標題 -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h1 class="h2 mb-3">
                    <span class="pb-2" style="border-bottom: 3px solid #EA580C;">{{ $about->title }}</span>
                </h1>
            </div>
        </div>

        <!-- 內容區域 -->
        <div class="row g-5 align-items-center">
            <!-- 圖片 -->
            @if($about->image)
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ Storage::url($about->image) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="{{ $about->title }}">
                </div>
            @endif

            <!-- 文字內容 -->
            <div class="col-lg-{{ $about->image ? '6' : '12' }}" data-aos="fade-left">
                <div class="pe-lg-4">
                    <div class="content text-muted">
                        {!! $about->content !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- 無資料提示 -->
        <div class="row justify-content-center text-center py-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-5">
                        <i class="bi bi-info-circle text-muted display-1 mb-4"></i>
                        <h2 class="h4 text-muted mb-4">目前沒有關於我們的資料</h2>
                        <p class="text-muted mb-0">請稍後再回來查看。</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if($about)
    <style>
        .content {
            line-height: 1.8;
        }
        .content p {
            margin-bottom: 1rem;
        }
        .content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .content ul, .content ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }
        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.375rem;
            margin: 1.5rem 0;
        }
        .content a {
            color: #EA580C;
            text-decoration: none;
        }
        .content a:hover {
            text-decoration: underline;
        }
    </style>
@endif
@endsection 