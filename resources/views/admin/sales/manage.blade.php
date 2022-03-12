@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.sales.index") }}">Sales</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Sales</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.sales.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage sales_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="customer" class="col-md-2 col-form-label">Customer:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="customer" name="customer" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($customers_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('customer') ? old('customer') : $data->customer ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('customer')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="customer_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-md-2 col-form-label">Jenis Pembayaran:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($payment_method_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('jenis_pembayaran') ? old('jenis_pembayaran') : $data->jenis_pembayaran ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('jenis_pembayaran')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_pembayaran_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="status_pembayaran" class="col-md-2 col-form-label">Status Pembayaran:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="status_pembayaran" name="status_pembayaran" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($payment_status_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('status_pembayaran') ? old('status_pembayaran') : $data->status_pembayaran ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('status_pembayaran')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="status_pembayaran_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="produk" class="col-md-2 col-form-label">Produk:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="produk" name="produk" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($product_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('produk') ? old('produk') : $data->produk ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('produk')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="produk_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah:</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah" name="jumlah"  placeholder="Jumlah"
                                   step="1" 
                                   value="{{{ old('jumlah', isset($data)?$data->jumlah : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="total_harga" class="col-md-2 col-form-label">Total Harga:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">Rp</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="total_harga" name="total_harga" 
                                       placeholder="Total Harga" step="0.01"  data-decimal="2"
                                       value="{{{ old('total_harga', isset($data)?$data->total_harga : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('total_harga')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="total_harga_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-2 col-form-label">Tanggal:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_tanggal" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_tanggal"  id="tanggal" data-toggle="datetimepicker"
                                       placeholder="Tanggal" name="tanggal" value="{{{ old('tanggal', isset($data)?$data->tanggal : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_tanggal" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.sales.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection