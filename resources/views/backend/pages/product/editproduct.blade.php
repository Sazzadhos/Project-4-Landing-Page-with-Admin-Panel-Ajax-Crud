<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{asset('backend/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body class="sb-nav-fixed">
        <!--TopBar-->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{Route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Sidebar + Add Product -->
        <div id="layoutSidenav">
            <!--Sidebar-->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{Route('dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Products</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Product
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ Route('create') }}">Add Product</a>
                                    <a class="nav-link" href="{{ Route('manage') }}">Manage Product</a>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <!--Add Product-->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Products</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Add Your Products</li>
                        </ol>

                        <div class="row">
                        <div class=" col-md-12">
                        <div class="card bg-primary text-white mb-4 p-4">
                                
                            <form action="{{ Route('update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <!--Left Part-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""class="pb-2 pt-2">Product Name :</label>
                                        <input type="text"  value="{{ $product->name }}" id="name" name="name" placeholder="Enter Your Product Name" class="form-control">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for=""class="pb-2 pt-2">Category Name :</label>
                                        <select name="category_name" id="category_name" class="form-control">
                                            <option value="">----Select Category---</option>
                                            <option value="PANT" @if($product->category_name == 'PANT') selected @endif >PANT</option>
                                            <option value="SHIRT" @if($product->category_name == 'SHIRT') selected @endif >SHIRT</option>
                                            <option value="JUTA" @if($product->category_name == 'JUTA') selected @endif >JUTA</option>
                                            <option value="PANJABI" @if($product->category_name == 'PANJABI') selected @endif >PANJABI</option>
                                        </select>
                                        @error('category_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for=""class="pb-2 pt-2">Brand name :</label>
                                        <input type="text" id="brand_name" name="brand_name"  value="{{ $product->brand_name }}" placeholder="Enter Your Product brand_name" class="form-control">
                                        @error('brand_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for=""class="pb-2 pt-2">Description :</label>
                                        <textarea class="form-control"  name="description" id="description" cols="4" rows="3" placeholder="Enter Your Product brand_name">{{ $product->description }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <!--Right Part-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <img height="80" src="{{asset('backend/productimage/'.$product->image)}}" alt="sazzad">    
                                    <br>
                                            <label for=""class="pb-2 pt-2">Image :</label>
                                            <input type="file" id="image"  name="image" class="form-control">
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for=""class="pb-2 pt-2">Category Status :</label>
                                            <select name="status" id="status"  class="form-control mb-3">
                                                <option value="0">----Category status---</option>
                                                <option value="1" @if ($product->status == '1') selected @endif >Active</option>
                                                <option value="2" @if ($product->status == '2') selected @endif >Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="form-group ">
                                        <button type="submit" class="form-control btn btn-success p-2">Update Product</button>
                                    </div>

                                </div>
                                </div>
                            </form>                  
                        </div>
                    </div>
                </div>
                </main>
                
                <!--Footer-->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>







        <!--Js Files-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('backend/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{asset('backend/js/datatables-simple-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    </body>
</html>
