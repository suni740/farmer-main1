@extends('layouts.master')

@section('content')
    <div class="herosection">
        <Navbar />
        <div class="lowerHerosection">
            <div class="heroLeft">
                <div class="heroHeading">
                    <h1>Farm Fresh Veggies Delivered with Care!</h1>
                </div>
                <p>Bringing the Freshest, Nutritious Vegetables Straight from the Farm to Your Table, Ensuring Health and
                    Flavor in Every Bite!</p>
                <div class="searchBox" style="position: relative; display: flex; align-items: center;">
                    <input type="text" placeholder='Search For Products' className='searchInput' style="padding-left: 40px; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 5px;" />
                    <i class="fas fa-search" style="position: absolute; left: 10px; color: #666;"></i>
                </div>
                <div class="smallReview">
                    <div>
                        <h2>1100 <span>+</span></h2>
                        <p>Happy Customer</p>
                    </div>

                    <div>
                        <h2>1100 <span>+</span></h2>
                        <p>Happy Customer</p>
                    </div>

                    <div>
                        <h2>1100 <span>+</span></h2>
                        <p>Happy Customer</p>
                    </div>
                </div>
            </div>
            <div class="heroRight">
                <img src="{{ asset('asset/images/vegy.png') }}" alt="Fresh Vegetables" />
            </div>
        </div>
    </div>
    </Navbar>
    </div>

    <!-- About Us Section -->
    <section class="about-us py-5" style="background-color: #B6FFA1;">
        <div class="container">
            <h2 class="text-center mb-4">About Us</h2>
            <p class="text-center mx-auto" style="max-width: 700px;">
                Welcome to <strong>VeggieStore</strong>! We deliver fresh, locally sourced vegetables straight to your door,
                ensuring quality produce for your healthy lifestyle. Our mission is simple: making farm-fresh nutrition
                convenient and accessible for everyone.
            </p>

            <!-- Social Icons -->
            <div class="social-icons text-center mt-4">
                <a href="#" class="btn btn-outline-dark btn-social mx-1" style="border-radius: 50%;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-outline-dark btn-social mx-1" style="border-radius: 50%;">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="btn btn-outline-dark btn-social mx-1" style="border-radius: 50%;">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-dark btn-social mx-1" style="border-radius: 50%;">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
        @guest
        <div class="container py-3">
            <h2 class="text-center mb-4 pb-2 border-bottom border-success d-inline-block">How It Work...</h2>

            <div class="row text-center">
                @php
                    $titles = ['1', '2', '3', '4'];
                    $descriptions = [
                        'Enjoy fresh vegetable with hot offers.',
                        'Browse and add Groceries to your cart from wide selection.',
                        'Free home delivery service on festivals.',
                        'Effective, Affordable and Reliable. -Your trusted pesticide solution.',
                    ];
                @endphp

                @for ($i = 0; $i < 4; $i++)
                    <div class="col-12 col-md-3 mb-4">
                        <div class="p-4 rounded shadow-sm h-100 bg-white" style="border: 2px solid #0a0b0a;">
                            <h4>{{ $titles[$i] }}</h4>
                            <p><strong>{{ $descriptions[$i] }}</strong></p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        @endguest
    </section>

    <div class="container py-3">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="row text-center">
            <div class="col-12 col-md-3 mb-4 d-flex">
                <div class="service-box p-4 w-100"
                    style="background-color: #f0fff4; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <i class="fas fa-truck fa-3x mb-3 service-icon"></i>
                    <h5>Fast Delivery</h5>
                    <p>Quick and safe delivery of fresh produce to your doorstep.</p>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-4 d-flex">
                <div class="service-box p-4 w-100"
                    style="background-color: #f0fff4; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <i class="fas fa-leaf fa-3x mb-3 service-icon"></i>
                    <h5>Organic Products</h5>
                    <p>Offering 100% organic and pesticide-free vegetables for a healthy lifestyle.</p>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-4 d-flex">
                <div class="service-box p-4 w-100"
                    style="background-color: #f0fff4; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <i class="fas fa-headset fa-3x mb-3 service-icon"></i>
                    <h5>24/7 Support</h5>
                    <p>Always ready to assist you with your orders and inquiries.</p>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-4 d-flex">
                <div class="service-box p-4 w-100"
                    style="background-color: #f0fff4; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <i class="fas fa-tags fa-3x mb-3 service-icon"></i>
                    <h5>Best Pricing</h5>
                    <p>Get top-quality produce at unbeatable prices, directly from farmers.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    @auth('web')
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Featured Products</h2>
                <div class="row">
                    @foreach ($featuredProducts as $product)
                        <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex align-items-stretch">
                            <div class="card w-100" style="min-height: 100%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                <img src="{{ $product->image ?: 'https://via.placeholder.com/300x200' }}"
                                     class="card-img-top"
                                     alt="Product Image"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <p class="card-text"><strong>In Stock:</strong> {{ $product->quantity }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-success btn-lg px-4">
                        View More Products
                    </a>
                </div>
            </div>
        </section>
    @endauth

    @guest
        <section class="py-5" style="background-color: #e8fce6;">
            <div class="container">
                <h2 class="text-center mb-4">Fresh Picks Await!</h2>
                <p class="text-center text-muted mb-5" style="font-size: 1.1rem;">
                    Sign up to see our best seasonal products, specially picked for you!
                </p>

                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="https://www.worldatlas.com/r/w1200/upload/c8/0e/5f/shutterstock-311521226.jpg"
                                class="card-img-top rounded-top" alt="Fresh Veggies" style="height: 250px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="https://d2gr5kl7dt2z3t.cloudfront.net/blog/wp-content/uploads/2017/04/04171241/shutterstock_287590253-750x500.jpg"
                                class="card-img-top rounded-top" alt="Fresh Veggies" style="height: 250px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="https://png.pngtree.com/png-vector/20250423/ourmid/pngtree-farm-fresh-organic-vegetables-in-sack-png-image_16067826.png"
                                class="card-img-top rounded-top" alt="Fresh Veggies"
                                style="height: 250px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="btn btn-lg btn-success px-5 py-2">
                        Register Now
                    </a>
                </div>
            </div>
        </section>
    @endguest

    @php
    $farmers = [
        [
            'name' => 'Rajesh Kumar',
            'location' => 'Beldhia, Lahan',
            'image' => 'https://t4.ftcdn.net/jpg/06/30/06/81/360_F_630068155_RnZI6mC91wz7gUYFVmhzwpl4O6x00Cbh.jpg',
            'experience' => '10 years'
        ],
        [
            'name' => 'Suman Thapa',
            'location' => 'Danda, Nwalpur',
            'image' => 'https://img.freepik.com/free-photo/woman-working-rural-farming-agriculture-sector-celebrate-women-working-field-labour-day_23-2151251988.jpg',
            'experience' => '8 years'
        ],
        [
            'name' => 'Anil Karki',
            'location' => 'Tandi, Chitwan',
            'image' => 'https://t4.ftcdn.net/jpg/07/78/36/51/360_F_778365136_sSuZPMpu62l66K20zBuAmJlakbCKadXW.jpg',
            'experience' => '12 years'
        ],
        [
            'name' => 'Meera Sen',
            'location' => 'Danabari, Dharan',
            'image' => 'https://img.freepik.com/premium-photo/nepali-village-woman-separating-chaff-from-grain-by-winnowing-process-nepalese-harvesting-paddy_999252-10915.jpg',
            'experience' => '5 years'
        ]
    ];
    @endphp

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Our Farmers</h2>
            <div class="row">
                @foreach($farmers as $farmer)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $farmer['image'] }}" class="card-img-top" alt="{{ $farmer['name'] }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">{{ $farmer['name'] }}</h5>
                                <p class="card-text text-muted mb-1">{{ $farmer['location'] }}</p>
                                <small class="text-muted">Experience: {{ $farmer['experience'] }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact py-5">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <p class="text-center">Have questions or need help? Reach out to us anytime!</p>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p><strong>Email:</strong> support@veggiestore.com</p>
                    <p><strong>Phone:</strong> +1 234 567 890</p>
                    <p><strong>Address:</strong> 123 Green Street, Veggie City, VC 45678</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>© 2025 VeggieStore. All rights reserved.</p>
        <div class="social-icons mt-3">
            <a href="#" class="text-white me-3">
                <i class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="#" class="text-white me-3">
                <i class="fab fa-instagram fa-2x"></i>
            </a>
            <a href="#" class="text-white me-3">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="#" class="text-white">
                <i class="fab fa-youtube fa-2x"></i>
            </a>
        </div>
    </footer>
@endsection