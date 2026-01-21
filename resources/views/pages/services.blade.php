@extends('layouts.furni')

@section('title', 'Services - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Services</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Services Section -->
<div class="untree_co-section">
    <div class="container">
       
        <div class="row">
            <!-- Start Service 1 -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="service text-center">
                    <span class="icon">
                        <img src="{{ asset('images/truck.svg') }}" alt="Image" class="img-fluid">
                    </span>
                    <h3>Fast & Free Shipping</h3>
                    <p>Fast, Reliable & Free Shipping on all orders. We bring comfort to your doorstep in no time!</p>
                </div>
            </div> 
            <!-- End Service 1 -->

            <!-- Start Service 2 -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="service text-center">
                    <span class="icon">
                        <img src="{{ asset('images/bag.svg') }}" alt="Image" class="img-fluid">
                    </span>
                    <h3>Easy to Shop</h3>
                    <p>Shop your favorite styles in just a few clicks. Fast, simple, and secure</p>
                </div>
            </div> 
            <!-- End Service 2 -->

            <!-- Start Service 3 -->
           <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="service text-center">
                    <span class="icon">
                        <img src="{{ asset('images/support.svg') }}" alt="Image" class="img-fluid">
                    </span>
                    <h3>24/7 Support</h3>
                    <p>Always Online. 24/7 Expert support to ensure your shopping experience is seamless.</p>
                </div>
            </div> 
            <!-- End Service 3 -->

            <!-- Start Service 4 -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="service text-center">
                    <span class="icon">
                        <img src="{{ asset('images/return.svg') }}" alt="Image" class="img-fluid">
                    </span>
                    <h3>Hassle Free Returns</h3>
                    <p>Shop with confidence. Our simple return policy ensures you’re always happy.</p>
                </div>
            </div> 
            <!-- End Service 4 -->
        </div>
    </div>
</div>
<!-- End Services Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">
                        
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;I was looking for a modern sofa that combines comfort with style, and Furni exceeded all my expectations. The quality of the fabric and the craftsmanship is truly outstanding, making it the centerpiece of my living room. Their 24/7 support team helped me choose the right color, and the shipping was incredibly fast and professional. I highly recommend Furni to anyone looking to upgrade their home with premium furniture and a hassle-free shopping experience .&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="{{ asset('images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Maria Jones</h3>
                                            <span class="position d-block mb-3"> XYZ Inc.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;I had a few questions about the dimensions of a chair, and their 24/7 support team responded almost instantly with all the details I needed. The shipping was surprisingly fast, and the furniture arrived in perfect condition. What I love most is the peace of mind that comes with their hassle-free return policy, though I definitely won't be returning anything because I love my new furniture! Furni truly cares about their customers' satisfaction.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="{{ asset('images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Maria Jones</h3>
                                            <span class="position d-block mb-3">CEO.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;The modern interior pieces from Furni have completely changed the vibe of my apartment. I was amazed by the attention to detail and the high-quality materials used in their sofas. The entire process, from browsing the website to the final delivery, was smooth and effortless. It’s rare to find a store that offers such elegant designs at such competitive prices. If you want to elevate your home’s aesthetic, Furni is definitely the place to shop .&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="{{ asset('images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Maria Jones</h3>
                                            <span class="position d-block mb-3"> Co-Founder</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                        <!-- END item -->  
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->
@endsection
