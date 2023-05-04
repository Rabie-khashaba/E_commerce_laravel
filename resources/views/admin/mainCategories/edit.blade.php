@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.mainCategories')}}"> الاقسام </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل - {{$mainCategory -> name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="co0llapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.admin.mainCategories',$mainCategory -> id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$mainCategory -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img class="rounded-circle height-150" src="{{$mainCategory -> photo}}" alt=" صوره القسم ">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  القسم </h4>
                                                {{--diaplay the form according to active languages--}}

                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم {{__('messages.'.$mainCategory ->translation_lang)}} </label>
                                                                    <input type="text" value="{{$mainCategory -> name}}" id="name"
                                                                           class="form-control"
                                                                           placeholder= ""
                                                                           name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اختصار اللغه {{__('messages.'.$mainCategory ->translation_lang)}}</label>
                                                                    <input type="text" value="{{$mainCategory ->translation_lang}}" id="abbr"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="category[0][abbr]">
                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox"  value="1"
                                                                           name="category[0][active]"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           @if($mainCategory -> active == 1) checked @endif />
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1"> الحالة  {{__('messages.'.$mainCategory ->translation_lang)}}</label>

                                                                    @error("category.0.active")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" id="homeLable1-tab1" data-toggle="tab" href="#homeLable1" aria-controls="homeLable1" aria-expanded="true">
                                                   Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profileLable1-tab1" data-toggle="tab" href="#profileLable1" aria-controls="profileLable1" aria-expanded="false">
                                                    Profile </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link active" id="aboutLable1-tab1" data-toggle="tab" href="#aboutLable1" aria-controls="aboutLable1" aria-expanded="false">
                                                    About</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane" id="homeLable1" aria-labelledby="homeLable1-tab1" aria-expanded="true">
                                                <p>Candy canes donut chupa chups candy canes lemon drops oat
                                                    cake wafer. Cotton candy candy canes marzipan carrot cake.
                                                    Sesame snaps lemon drops candy marzipan donut brownie tootsie
                                                    roll. Icing croissant bonbon biscuit gummi bears.</p>
                                            </div>
                                            <div class="tab-pane" id="profileLable1" role="tabpanel" aria-labelledby="profileLable1-tab1" aria-expanded="false">
                                                <p>Pudding candy canes sugar plum cookie chocolate cake powder
                                                    croissant. Carrot cake tiramisu danish candy cake muffin
                                                    croissant tart dessert. Tiramisu caramels candy canes chocolate
                                                    cake sweet roll liquorice icing cupcake.</p>
                                            </div>
                                            <div class="tab-pane" id="dropdownLable11" role="tabpanel" aria-labelledby="dropdownLable11-tab" aria-expanded="false">
                                                <p>Cake croissant lemon drops gummi bears carrot cake biscuit
                                                    cupcake croissant. Macaroon lemon drops muffin jelly sugar
                                                    plum chocolate cupcake danish icing. Soufflé tootsie roll
                                                    lemon drops sweet roll cake icing cookie halvah cupcake.</p>
                                            </div>
                                            <div class="tab-pane" id="dropdownLable12" role="tabpanel" aria-labelledby="dropdownLable12-tab" aria-expanded="false">
                                                <p>Chocolate croissant cupcake croissant jelly donut. Cheesecake
                                                    toffee apple pie chocolate bar biscuit tart croissant.
                                                    Lemon drops danish cookie. Oat cake macaroon icing tart
                                                    lollipop cookie sweet bear claw.</p>
                                            </div>
                                            <div class="tab-pane active" id="aboutLable1" role="tabpanel" aria-labelledby="aboutLable1-tab1" aria-expanded="false">
                                                <p>Carrot cake dragée chocolate. Lemon drops ice cream wafer
                                                    gummies dragée. Chocolate bar liquorice cheesecake cookie
                                                    chupa chups marshmallow oat cake biscuit. Dessert toffee
                                                    fruitcake ice cream powder tootsie roll cake.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
