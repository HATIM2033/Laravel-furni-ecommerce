@extends('layouts.furni')

@section('title', 'About Us - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>About Us</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start About Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose Us</h2>
                <p>At Furni, we combine premium quality with an effortless shopping experience. Our mission is to provide stylish, durable furniture that fits your lifestyle perfectly.</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/truck.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Fast &amp; Free Shipping</h3>
                            <p>Fast, Reliable & Free Shipping on all orders. We bring comfort to your doorstep in no time!</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/bag.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Easy to Shop</h3>
                            <p>Shop your favorite styles in just a few clicks. Fast, simple, and secure.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/support.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>24/7 Support</h3>
                            <p>Always Online. 24/7 Expert support to ensure your shopping experience is seamless.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/return.svg') }}" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Hassle Free Returns</h3>
                            <p>Shop with confidence. Our simple return policy ensures you’re always happy.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="{{ asset('images/why-choose-us-img.jpg') }}" alt="Image" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End About Section -->

<!-- Start Team Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title text-center mb-3">Our Team</h2>
            </div>
        </div>
        <div class="row">
            <!-- Start Column 1 -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="team">
                    <img src="{{ asset('images/person-1.jpg') }}" alt="Image" class="img-fluid mb-4">
                    <h3>John Smith</h3>
                    <p class="position">CEO & Founder</p>
                    <p>The visionary behind Furni, dedicated to redefining modern living spaces. With a passion for design and quality, he leads the team to ensure every customer finds their perfect home match.</p>
                </div>
            </div> 
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="team">
                    <img src="{{ asset('images/person_2.jpg') }}" alt="Image" class="img-fluid mb-4">
                    <h3>Jane Doe</h3>
                    <p class="position">Product Designer</p>
                    <p>The creative mind responsible for our sleek aesthetics. She blends functionality with modern art, carefully selecting materials to create furniture that is as durable as it is beautiful</p>
                </div>
            </div> 
            <!-- End Column 2 -->

            <!-- Start Column 3 -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="team">
                    <img src="{{ asset('images/person_3.jpg') }}" alt="Image" class="img-fluid mb-4">
                    <h3>Bob Johnson</h3>
                    <p class="position">Marketing Head</p>
                    <p>The voice of Furni. He specializes in sharing our story with the world, ensuring that our latest collections and best deals reach every home-decor enthusiast.</p>
                 </div>
            </div> 
            <!-- End Column 3 -->

            <!-- Start Column 4 -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="team">
                    <img src="{{ asset('images/person_4.jpg') }}" alt="Image" class="img-fluid mb-4">
                    <h3>Alice Williams</h3>
                    <p class="position">Sales Manager</p>
                    <p>Our bridge between the brand and the customer. He ensures a seamless shopping journey, focusing on building long-term relationships and providing the best value for every client.</p>
                </div>
            </div> 
            <!-- End Column 4 -->
        </div>
    </div>
</div>
<!-- End Team Section -->
@endsection
