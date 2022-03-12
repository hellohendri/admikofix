@extends("admin.layouts.default")
@section('breadcrumbs')
<li class="breadcrumb-item active"><a href="{{ route("admin.transaction.index") }}">Transaction</a></li>
@if(isset($data))
<li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
@else
<li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
@endIf
@endsection
@section('pageTitle')
<h1>Transaction</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.transaction.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage transaction_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row">
                <div class="col-2"></div>
                <div class="col">
                    <div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div>
                </div>
            </div>@endif
            <div class="row">

                <div class=" col-12">
                    <!-- <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label">Nama:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{{ old('nama', isset($data)?$data->nama : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('nama')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nama_help" class="text-muted"></small>
                        </div>
                    </div> -->
                    <div class="form-group row multiSelect">
                        <label for="jenis_pembayaran" class="col-md-2 col-form-label">Jenis Pembayaran:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">

                                @foreach($payment_method_all as $id => $value)
                                <option value="{{ $id }}" {{ (old('jenis_pembayaran') ? old('jenis_pembayaran') : $data->jenis_pembayaran ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('tipe_transaksi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_pembayaran_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="tipe_transaksi" class="col-md-2 col-form-label">Tipe Transaksi:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="tipe_transaksi" name="tipe_transaksi" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">

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
                    <div class="form-group row multiSelect">
                        <label for="jenis_transaksi" class="col-md-2 col-form-label">Kategori Transaksi:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">

                                @foreach($transaction_category_all as $id => $value)
                                <option value="{{ $id }}" {{ (old('jenis_transaksi') ? old('jenis_transaksi') : $data->jenis_transaksi ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('jenis_transaksi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_transaksi_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah (Quantity):</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah" name="jumlah" placeholder="Jumlah" step="1" value="{{{ old('jumlah', isset($data)?$data->jumlah : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="total" class="col-md-2 col-form-label">Total:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-prepend input-group-text">Rp</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="total" name="total" required="true" placeholder="Total" step="0.01" data-decimal="2" value="{{{ old('total', isset($data)?$data->total : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('total')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="total_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-2 col-form-label">Tanggal:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datePicker_tanggal" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;" data-date_time_format="{{config('admiko_config.form_date_format')}}" class="form-control datetimepicker-input datePicker" data-target="#datePicker_tanggal" id="tanggal" data-toggle="datetimepicker" placeholder="Tanggal" name="tanggal" value="{{{ old('tanggal', isset($data)?$data->tanggal : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#datePicker_tanggal" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-2 col-form-label">Keterangan:</label>
                        <div class="col-md-10">
                            <textarea class="form-control form-control-textarea simple_text_editor" id="keterangan" name="keterangan" placeholder="Keterangan">{{{ old('keterangan', isset($data)?$data->keterangan : '') }}}</textarea>
                            <div class="invalid-feedback @if ($errors->has('keterangan')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="keterangan_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.transaction.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection