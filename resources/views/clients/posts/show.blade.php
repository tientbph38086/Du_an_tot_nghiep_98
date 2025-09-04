    @extends('layouts.client')

    @section('content')
        <!-- Banner -->
        <section class="section-banner">
            <div class="row banner-image">
                <div class="banner-overlay"></div>
                <div class="banner-section">
                    <div class="lh-banner-contain">
                        <h2>Blog Detalis</h2>
                        <div class="lh-breadcrumb">
                            <h5>
                                <span class="lh-inner-breadcrumb">
                                    <a href="index.html">Home</a>
                                </span>
                                <span> / </span>
                                <span>
                                    <a href="javascript:void(0)">Blog Detalis</a>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog-details -->
        <section class="section-blog-details padding-tb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="lh-blog-details" data-aos="fade-up" data-aos-duration="1500">
                            <div class="lh-blog-details-image">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            </div>
                            <div class="lh-blog-details-contain">
                                <div class="blog-top-details">
                                    <span>By Admin</span> -
                                    <span>{{ $post->comments_count ?? 0 }} Comment</span> -
                                    <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                                </div>
                                <h4 class="lh-blog-details-heding">{{ $post->title }}</h4>
                                <p>{!! $post->content !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar bên phải -->
                    <div class="col-lg-4 blog-rs">
                        @include('clients.layout.blocks.sidebar-post')
                    </div>
                </div>
            </div>
        </section>
    @endsection
