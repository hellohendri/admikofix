{{--IMPORTANT: this page will be overwritten and any change will be lost!! Use custom_sidebar_bottom.blade.php and custom_sidebar_top.blade.php--}}

@if(Gate::any(['wallet_allow','wallet_edit','transaction_allow','transaction_edit','transaction_type_allow','transaction_type_edit','transaction_category_allow','transaction_category_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "_master" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-chart-pie fa-fw"></i>Master</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "_master" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['wallet_allow', 'wallet_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "wallet" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.wallet.index')}}"><i class="fas fa-wallet fa-fw"></i>Wallet</a></li>
	@endIf
	@if(Gate::any(['transaction_allow', 'transaction_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "transaction" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.transaction.index')}}"><i class="fas fa-comments-dollar fa-fw"></i>Transaction</a></li>
	@endIf
	@if(Gate::any(['transaction_type_allow', 'transaction_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "transaction_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.transaction_type.index')}}"><i class="fas fa-asterisk fa-fw"></i>Transaction Type</a></li>
	@endIf
	@if(Gate::any(['transaction_category_allow', 'transaction_category_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "transaction_category" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.transaction_category.index')}}"><i class="fas fa-comment-medical fa-fw"></i>Transaction Category</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['outlets_allow','outlets_edit','product_allow','product_edit','product_category_allow','product_category_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "_warehouse_product" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-warehouse fa-fw"></i>Warehouse & Product</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "_warehouse_product" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['outlets_allow', 'outlets_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "outlets" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.outlets.index')}}"><i class="fas fa-store fa-fw"></i>Outlets</a></li>
	@endIf
	@if(Gate::any(['product_allow', 'product_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "product" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.product.index')}}"><i class="fas fa-bread-slice fa-fw"></i>Product</a></li>
	@endIf
	@if(Gate::any(['product_category_allow', 'product_category_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "product_category" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.product_category.index')}}"><i class="fas fa-pizza-slice fa-fw"></i>Product Category</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['customers_allow','customers_edit','payment_method_allow','payment_method_edit','payment_status_allow','payment_status_edit','sales_allow','sales_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "_sales_management" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-dollar-sign fa-fw"></i>Sales Management</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "_sales_management" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['customers_allow', 'customers_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "customers" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.customers.index')}}"><i class="fas fa-user-friends fa-fw"></i>Customers</a></li>
	@endIf
	@if(Gate::any(['payment_method_allow', 'payment_method_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "payment_method" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.payment_method.index')}}"><i class="fas fa-credit-card fa-fw"></i>Payment Method</a></li>
	@endIf
	@if(Gate::any(['payment_status_allow', 'payment_status_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "payment_status" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.payment_status.index')}}"><i class="fas fa-check-circle fa-fw"></i>Payment Status</a></li>
	@endIf
	@if(Gate::any(['sales_allow', 'sales_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "sales" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.sales.index')}}"><i class="fas fa-shopping-cart fa-fw"></i>Sales</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['losses_allow','losses_edit','losses_type_allow','losses_type_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_loss" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-fire-alt fa-fw"></i>Loss</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_loss" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['losses_allow', 'losses_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "losses" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.losses.index')}}"><i class="fas fa-fire-alt fa-fw"></i>Losses</a></li>
	@endIf
	@if(Gate::any(['losses_type_allow', 'losses_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "losses_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.losses_type.index')}}"><i class="fas fa-exclamation-circle fa-fw"></i>Losses Type</a></li>
	@endIf
    </ul>
</li>
@endIf