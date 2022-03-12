@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.product.index") }}">Product</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Product</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.product.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage product_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-md-2 col-form-label">Nama Produk:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"  placeholder="Nama Produk"  value="{{{ old('nama_produk', isset($data)?$data->nama_produk : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('nama_produk')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nama_produk_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="jenis_produk" class="col-md-2 col-form-label">Jenis Produk:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="jenis_produk" name="jenis_produk" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($product_category_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('jenis_produk') ? old('jenis_produk') : $data->jenis_produk ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('jenis_produk')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_produk_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="outlets" class="col-md-2 col-form-label">Outlets:*</label>
                        <div class="col-md-10">
                            <select class="form-select" id="outlets" name="outlets" required="true">
                                
                                @foreach($outlets_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('outlets') ? old('outlets') : $data->outlets ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('outlets')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="outlets_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah_stock" class="col-md-2 col-form-label">Jumlah Stock:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah_stock" name="jumlah_stock" required="true" placeholder="Jumlah Stock"
                                   step="1" 
                                   value="{{{ old('jumlah_stock', isset($data)?$data->jumlah_stock : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah_stock')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_stock_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="hpp" class="col-md-2 col-form-label">HPP:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">Rp</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="hpp" name="hpp" 
                                       placeholder="HPP" step="0.01"  data-decimal="2"
                                       value="{{{ old('hpp', isset($data)?$data->hpp : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('hpp')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="hpp_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-2 col-form-label">Harga Jual:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">Rp</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="harga_jual" name="harga_jual" required="true"
                                       placeholder="Harga Jual" step="0.01"  data-decimal="2"
                                       value="{{{ old('harga_jual', isset($data)?$data->harga_jual : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('harga_jual')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="harga_jual_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer form-actions" id="form-group-buttons">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary float-start me-1 mb-1 mb-sm-0 save-button">{{trans('admiko.table_save')}}</button>
                    <a href="{{ route("admin.product.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection