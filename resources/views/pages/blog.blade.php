@extends('layouts.furni')

@section('title', 'Blog - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Blog</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Recent Blog</h2>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-1.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">First Time Home Owner Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-2.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Angel Batista</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-3.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Megan Fox </a></span> <span>on <a href="#">Fev 12, 2022</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-4.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">The Ultimate Guide to Maintaining Your Modern Furniture</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Emile Williams</a></span> <span>on <a href="#">Jan 19, 2019</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-5.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">5 Simple Secrets to Keeping Your Sofa Looking Brand New</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Roberto Gonzalez </a></span> <span>on <a href="#">Nov 25, 2023</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="{{ asset('images/post-6.jpg') }}" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">Sustainable Cleaning: How to Protect Your Investment at Home</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Karan James</a></span> <span>on <a href="#">Dec 12, 2025</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Blog Section -->
@endsection
