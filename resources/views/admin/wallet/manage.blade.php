@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.wallet.index") }}">Wallet</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Wallet</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.wallet.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage wallet_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jenis_saldo" class="col-md-2 col-form-label">Jenis Saldo:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="jenis_saldo" name="jenis_saldo" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($payment_method_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('jenis_saldo') ? old('jenis_saldo') : $data->jenis_saldo ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('jenis_saldo')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_saldo_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah_saldo" class="col-md-2 col-form-label">Jumlah Saldo:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">Rp</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="jumlah_saldo" name="jumlah_saldo" 
                                       placeholder="Jumlah Saldo" step="0.01"  data-decimal="2"
                                       value="{{{ old('jumlah_saldo', isset($data)?$data->jumlah_saldo : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('jumlah_saldo')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="jumlah_saldo_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.wallet.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection