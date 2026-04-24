@extends('layouts.clientLayout')
@section('title', 'Products')
@section('content')
    @include('client.partials.inner-hero', ['title' => 'Products', 'subtitle' => 'Our Products', 'breadCrumb' => 'Products'])

    <style>
        body {
            overflow-x: hidden;
        }

        /* === HORIZONTAL FILTER BAR STYLES === */
        .shop-filter-bar {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .shop-filter-bar .row {
            align-items: center;
        }

        .filter-col {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-col label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #666;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }

        .filter-col input,
        .filter-col select {
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 13px;
            background: #fafafa;
            color: #333;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .filter-col input::placeholder,
        .filter-col select {
            color: #666;
        }

        .filter-col input:focus,
        .filter-col select:focus {
            outline: none;
            border-color: #0fbf97;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(15, 191, 151, 0.1);
        }

        .filter-buttons-col {
            display: flex;
            gap: 10px;
            height: 100%;
            align-items: flex-end;
        }

        .filter-btn-horizontal {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            white-space: nowrap;
        }

        .filter-btn-apply {
            background: linear-gradient(135deg, #0fbf97 0%, #0a9e7e 100%);
            color: white;
        }

        .filter-btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(15, 191, 151, 0.3);
        }

        .filter-btn-reset {
            background: #f0f0f0;
            color: #333;
        }

        .filter-btn-reset:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        /* Responsive Filter Bar */
        @media (max-width: 1199px) {
            .filter-col {
                margin-bottom: 10px;
            }

            .filter-col:nth-child(1),
            .filter-col:nth-child(2) {
                flex: 1;
                min-width: 45%;
            }

            .filter-col:nth-child(3),
            .filter-col:nth-child(4) {
                flex: 1;
                min-width: 45%;
            }
        }

        @media (max-width: 767px) {
            .shop-filter-bar {
                padding: 15px 0;
            }

            .filter-col {
                margin-bottom: 12px;
            }

            .filter-col label {
                font-size: 10px;
            }

            .filter-col input,
            .filter-col select {
                padding: 8px 10px;
                font-size: 12px;
            }

            .filter-buttons-col {
                flex-direction: column;
                gap: 8px;
                align-items: stretch;
            }

            .filter-btn-horizontal {
                width: 100%;
            }
        }

    </style>

    
    <!-- shop-banner-area start -->
    <section class="shop-banner-area pt-40 pb-120">
        <div class="container">
            <!-- Filter Bar -->
            <div class="shop-filter-bar mb-30">
                <div class="row px-3 px-md-0">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <!-- Search Input -->
                            <div class="col-md-2 col-sm-6 col-6 filter-col">
                                <label>Search</label>
                                <input type="text" id="name" placeholder="Search products..." class="form-control">
                            </div>

                            <!-- Category Select -->
                            <div class="col-md-2 col-sm-6 col-6 filter-col">
                                <label>Category</label>
                                <select id="category" class="form-control">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sub Category Select -->
                            <div class="col-md-2 col-sm-6 col-6 filter-col">
                                <label>Sub Category</label>
                                <select id="subCategories" class="form-control">
                                    <option value="">All Sub Categories</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Brand Select -->
                            <div class="col-md-2 col-sm-6 col-6 filter-col">
                                <label>Brand</label>
                                <select id="brands" class="form-control">
                                    <option value="">All Brands</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Buttons -->
                            <div class="col-md-4 col-12 filter-buttons-col">
                                <button id="filterBtn" class="filter-btn-horizontal filter-btn-apply">
                                    <i class="fas fa-sliders-h"></i> Apply Filter
                                </button>
                                <button id="resetBtn" class="filter-btn-horizontal filter-btn-reset">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="row">
                <div class="col-12">
                    <!-- Header Row -->
                    <div class="row align-items-center mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">
                            <div class="product-showing">
                                <p id="showing-results" class="mb-0">Loading products...</p>
                            </div>
                            <div class="shop-tab d-flex align-items-center">
                                <ul class="nav" id="myTab" role="tablist">
                                    <!-- Grid/List View Buttons -->
                                    <li class="nav-item d-none d-md-inline-block">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true"><i class="fas fa-th-large"></i></a>
                                    </li>
                                    <li class="nav-item d-none d-md-inline-block">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                            aria-controls="profile" aria-selected="false"><i class="fas fa-list-ul"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Products Container -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row" id="products-grid-container">
                                <!-- Products will be loaded here via JavaScript -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div id="products-list-container">
                                <!-- Products will be loaded here via JavaScript -->
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-12">
                            <div class="basic-pagination basic-pagination-2 text-center mt-20">
                                <ul id="pagination-links">
                                    <!-- Pagination will be loaded here via JavaScript -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-banner-area end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appUrl = "{{ config('app.url') }}";
            let currentPage = 1;
            
            // Event listeners
            document.getElementById('filterBtn').addEventListener('click', function() {
                const name = document.getElementById('name').value;
                const category = document.getElementById('category').value;
                const subCategory = document.getElementById('subCategories').value;
                const brand = document.getElementById('brands').value;
                
                // Initialize an empty object
                const filterObject = {};
                
                // Only add properties if they are not empty
                if (name.length > 0) filterObject.name = name;
                if (category.length > 0) filterObject.category = category;
                if (subCategory.length > 0) filterObject.subCategory = subCategory;
                if (brand.length > 0) filterObject.brand = brand;
                
                console.log('Filters:', filterObject);
                
                // Now you can use filterObject in fetchProducts()
                fetchProducts(currentPage, filterObject);
            });
            document.getElementById('resetBtn').addEventListener('click', function() {
                // Reset filters
                document.getElementById('name').value = '';
                document.getElementById('category').value = '';
                document.getElementById('subCategories').value = '';
                document.getElementById('brands').value = '';
                
                // Fetch products without filters
                fetchProducts(currentPage);
            });
            
            // Fetch products on page load
            fetchProducts(currentPage);
            
            // Function to fetch products
            function fetchProducts(page, filters = {}) {
                // Construct the base URL with pagination
                const baseUrl = `/api/shop?page=${page}`;
                
                // Initialize URLSearchParams for filters (if any)
                const filterParams = new URLSearchParams();
                
                // Append non-empty filters to URLSearchParams
                for (const [key, value] of Object.entries(filters)) {
                    if (value && value.trim() !== '') {  // Only add if value is not empty
                        filterParams.append(key, value);
                    }
                }
                
                // Build the final URL
                const url = filterParams.toString() 
                    ? `${baseUrl}&${filterParams.toString()}`  // If filters exist, append them
                    : baseUrl;  // Otherwise, just use base URL
                
                console.log('Fetching URL:', url);  // For debugging
                
                // Fetch the data
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Products data:', data);
                        updateProductDisplay(data);
                        updatePagination(data.pagination);
                        updateShowingText(data.pagination);
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        document.getElementById('showing-results').textContent = 'Error loading products';
                    });
            }
            
            // Update product display
            function updateProductDisplay(data) {
                const gridContainer = document.getElementById('products-grid-container');
                const listContainer = document.getElementById('products-list-container');

                gridContainer.innerHTML = '';
                listContainer.innerHTML = '';

                data.data.forEach(product => {
                    const imagePath = product.avatar 
                        ? `${window.location.origin}/storage/${product.avatar}`
                        : `${window.location.origin}/img/shop/default.jpg`;

                    const productData = encodeURIComponent(JSON.stringify(product));

                    // === Grid View ===
                    const gridCol = document.createElement('div');
                    gridCol.className = "col-lg-4 col-md-6";
                    gridCol.innerHTML = `
                        <div class="product mb-40 open-product-modal" data-product="${productData}" style="cursor: pointer;">
                            <div class="product__img">
                                <img src="${imagePath}" alt="${product.title}" class="img-fluid">
                                <div class="product-action text-center">
                                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                    <a href="#"><i class="fas fa-heart"></i></a>
                                    <a href="#"><i class="fas fa-expand"></i></a>
                                </div>
                            </div>
                            <div class="product__content text-center pt-30">
                                <span class="pro-cat"><a href="#">${product.category?.title || 'Uncategorized'}</a></span>
                                <h4 class="pro-title">${product.title}</h4>
                                
                            </div>
                        </div>
                    `;
                    gridContainer.appendChild(gridCol);

                    // === List View ===
                    const listRow = document.createElement('div');
                    listRow.className = "row mb-30 open-product-modal";
                    listRow.dataset.product = productData;
                    listRow.style.cursor = "pointer";

                    listRow.innerHTML = `
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="product__img">
                                    <img src="${imagePath}" alt="${product.title}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="product-list-content pt-10">
                                <div class="product__content mb-20">
                                    <span class="pro-cat">${product.category?.title || 'Uncategorized'}</span>
                                    <h4 class="pro-title">${product.title}</h4>
                                    
                                </div>
                                <p>${product.description || 'No description available.'}</p>
                                <div class="product-action-list">
                                    <a class="btn btn-theme" href="#">add to cart</a>
                                    <a class="action-btn" href="#"><i class="fas fa-heart"></i></a>
                                    <a class="action-btn" href="#"><i class="fas fa-expand"></i></a>
                                </div>
                            </div>
                        </div>
                    `;
                    listContainer.appendChild(listRow);
                });
            }

            
            // Update pagination links
            function updatePagination(pagination) {
                const paginationContainer = document.getElementById('pagination-links');
                paginationContainer.innerHTML = '';
                
                // Previous button
                if (pagination.current_page > 1) {
                    paginationContainer.innerHTML += `
                        <li><a href="#" onclick="event.preventDefault(); fetchProducts(${pagination.current_page - 1})"><i class="fas fa-angle-double-left"></i></a></li>
                    `;
                }
                
                // Page numbers
                for (let i = 1; i <= pagination.last_page; i++) {
                    paginationContainer.innerHTML += `
                        <li class="${i === pagination.current_page ? 'active' : ''}">
                            <a href="#" onclick="event.preventDefault(); fetchProducts(${i})">${i}</a>
                        </li>
                    `;
                }
                
                // Next button
                if (pagination.has_more_pages) {
                    paginationContainer.innerHTML += `
                        <li><a href="#" onclick="event.preventDefault(); fetchProducts(${pagination.current_page + 1})"><i class="fas fa-angle-double-right"></i></a></li>
                    `;
                }
            }
            
            // Update showing text
            function updateShowingText(pagination) {
                const showingText = `Showing ${pagination.from}-${pagination.to} of ${pagination.total} results`;
                document.getElementById('showing-results').textContent = showingText;
            }
            
            // Make fetchProducts available globally for pagination clicks
            window.fetchProducts = fetchProducts;    
            
            document.addEventListener("click", function (e) {
                const target = e.target.closest(".open-product-modal");
                if (!target) return;

                const product = JSON.parse(decodeURIComponent(target.dataset.product));

                console.log("Clicked element:", target);
                console.log("Data-product raw:", target.dataset.product);

                // Set modal title
                document.getElementById("productModalLabel").textContent = product.title;

                // Set modal body
                const modalBody = document.querySelector("#productModal .modal-body");
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <img src="${window.location.origin}/storage/${product.avatar || 'img/shop/default.jpg'}" alt="${product.title}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5>${product.title}</h5>
                            <p>${product.description || 'No description available.'}</p>                            
                            ${Array.isArray(product.tags) && product.tags.length 
                                ? `<p><strong>Tags:</strong> ${product.tags.join(', ')}</p>` 
                                : ''}
                            <p><strong>Category:</strong> ${product.category?.title || 'Uncategorized'}</p>
                            <p><strong>Brand:</strong> ${product.brand?.title || 'Unknown'}</p>
                        </div>
                    </div>
                `;


                $('#productModal').modal('show');
            });


        });

        document.addEventListener('DOMContentLoaded', function () {
            // Create overlay element
            const overlay = document.querySelector('.filter-overlay');
            const filterToggle = document.querySelector('.filter-toggle-cbtn');
            const filterSidebar = document.querySelector('.filter-sidebar');

            if (filterToggle && filterSidebar) {
                // Show filter sidebar on toggle button click
                filterToggle.addEventListener('click', function () {
                    filterSidebar.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';

                    // Add close button if not already present
                    if (!filterSidebar.querySelector('.filter-close-cbtn')) {
                    const closeBtn = document.createElement('button');
                    closeBtn.className = 'filter-close-cbtn';
                    closeBtn.innerHTML = '&times;';
                    closeBtn.addEventListener('click', function () {
                        filterSidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                    });
                    filterSidebar.prepend(closeBtn);
                    }
                });

                // Hide filter sidebar on overlay click
                overlay.addEventListener('click', function () {
                    filterSidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }

        });
    </script>    
@endsection

{{-- <div class="price">
    <span>$${product.price}</span>
    ${product.old_price ? `<span class="old-price">$${product.old_price}</span>` : ''}
</div> --}}

{{-- <div class="price">
    <span>$${product.price}</span>
    ${product.old_price ? `<span class="old-price">$${product.old_price}</span>` : ''}
</div> --}}


{{-- <p><strong>Price:</strong> $${product.price}</p>
${product.old_price ? `<p><strong>Old Price:</strong> $${product.old_price}</p>` : ''}
<p><strong>Quantity:</strong> ${product.quantity}</p> --}}