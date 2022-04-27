@extends('layouts.admin')
@section('content')
    {{-- @include('dashboard.includes.alerts.success') --}}

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=" {{ route('admin.index') }} ">الرئيسية </a>
                                </li>
                                {{-- <li class="breadcrumb-item"><a href="">المتاجر </a>
                                </li> --}}
                                <li class="breadcrumb-item active"> وسائل التوصيل
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل وسيلة التوصيل </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                            action="{{ route('update.shippings.method', $shippingmethod->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            {{-- <input type="hidden" name="id" value=" {{ $shippingmethod->id }} "> --}}
                                            {{-- <input type="hidden" value="" id="latitude" name="latitude">
                                            <input type="hidden" value="" id="longitude" name="longitude"> --}}


                                            {{-- <div class="form-group">
                                                <label> لوجو التجار </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="logo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('logo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات وسيلة
                                                    التوصيل </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم </label>
                                                            <input type="text" value=" {{ $shippingmethod->value }} "
                                                                id="name" class="form-control" placeholder="  "
                                                                name="value">
                                                            @error('value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> قيمة التوصيل </label>
                                                            <input type="number" value="{{ $shippingmethod->plain_value }}" id="name" class="form-control"
                                                                placeholder="" name="plain_value">
                                                            @error('plain_value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                {{-- <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="active"
                                                                id="switcheryColor4" class="switchery"
                                                                data-color="success">
                                                            <label for="switcheryColor4" class="card-title ml-1">الحالة
                                                            </label>

                                                            @error('active')
                                                                <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div> --}}

                                            </div>


                                            {{-- <div id="map" style="height: 500px;width: 1000px;"></div> --}}

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
