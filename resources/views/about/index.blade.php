@extends('layouts.app')

@section('title', $about->title)

@section('description', $about->meta_description)

@section('image', $about->meta_image)

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
                    <div class="markdown-content text-muted">
                        {!! Str::markdown($about->content) !!}
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
        .markdown-content {
            line-height: 1.8;
        }
        .markdown-content p {
            margin-bottom: 1.5rem;
        }
        .markdown-content h1, 
        .markdown-content h2, 
        .markdown-content h3, 
        .markdown-content h4, 
        .markdown-content h5, 
        .markdown-content h6 {
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 600;
        }
        .markdown-content h1 { font-size: 2rem; }
        .markdown-content h2 { font-size: 1.75rem; }
        .markdown-content h3 { font-size: 1.5rem; }
        .markdown-content h4 { font-size: 1.25rem; }
        .markdown-content h5 { font-size: 1.1rem; }
        .markdown-content h6 { font-size: 1rem; }
        .markdown-content ul, 
        .markdown-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.75rem;
        }
        .markdown-content li {
            margin-bottom: 0.5rem;
        }
        .markdown-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 2rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .markdown-content a {
            color: #EA580C;
            text-decoration: none;
            transition: all 0.2s;
        }
        .markdown-content a:hover {
            text-decoration: underline;
        }
        .markdown-content blockquote {
            border-left: 4px solid #EA580C;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #666;
        }
        .markdown-content code {
            background-color: #f8f9fa;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
            color: #333;
        }
        .markdown-content pre {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
            overflow-x: auto;
        }
        .markdown-content pre code {
            background-color: transparent;
            padding: 0;
            font-size: 0.875em;
            color: #333;
        }
        .markdown-content hr {
            margin: 2rem 0;
            border-top: 2px solid #eee;
        }
        .markdown-content table {
            width: 100%;
            margin: 1.5rem 0;
            border-collapse: collapse;
        }
        .markdown-content th,
        .markdown-content td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
        }
        .markdown-content th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
    </style>
@endif
@endsection 