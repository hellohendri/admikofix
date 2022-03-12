@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.transaction_category.index") }}">Transaction Category</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Transaction Category</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.transaction_category.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage transaction_category_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tipe_transaksi" class="col-md-2 col-form-label">Tipe Transaksi:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="tipe_transaksi" name="tipe_transaksi" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($transaction_type_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('tipe_transaksi') ? old('tipe_transaksi') : $data->tipe_transaksi ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('tipe_transaksi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tipe_transaksi_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="kategori_transaksi" class="col-md-2 col-form-label">Kategori Transaksi:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kategori_transaksi" name="kategori_transaksi"  placeholder="Kategori Transaksi"  value="{{{ old('kategori_transaksi', isset($data)?$data->kategori_transaksi : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('kategori_transaksi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="kategori_transaksi_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.transaction_category.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection