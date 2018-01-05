<div class="book-block"><!--features_items-->
	<div id="wrap-inner">
		<div id="khach-hang">
			<h3>Thông tin khách hàng</h3>
			<p>
				<span class="info">Khách hàng: </span>
				{{ $info['name'] }}
			</p>
			<p>
				<span class="info">Email: </span>
				{{ $info['email'] }}
			</p>
			<p>
				<span class="info">Điện thoại: </span>
				{{ $info['phone'] }}
			</p>
			<p>
				<span class="info">Địa chỉ: </span>
				{{ $info['add'] }}
			</p>
		</div>
		<div id="hoa-don">
			<h3>Hóa đơn mua hàng</h3>
			<table class="cart-table">
            <tr>
                <th class="col-md-3">Tên sản phẩm</th>
                <th class="col-md-1">Số lượng</th>
                <th class="col-md-1">Đơn giá</th>
                <th class="col-md-1">Thành tiền</th>
            </tr>
        @foreach($cart as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{$item->qty}}</td>
                <td>{{ number_format($item->price) }}</td>
                <td><a class="total{{$item->id}}">{{ number_format($item->total) }}</a></td>
            </tr>
        @endforeach
            <tr>
                <td colspan="3">Tổng</td>
                <td>{{ $total }}</td>
            </tr>
        @if (isset($coupon_code))
            <tr>
                <td>Mã giảm giá</td>
                <td>{{ $coupon_code }}</td>
                <td colspan="2"> Giảm giá </td>
                <td> - {{ $sale_coupon_amount }}</td>
            </tr>
        @endif
            <tr>
                <td colspan="3">Thanh toán </td>
                <td>{{ $grandTotal }}</td>
            </tr>
        </table>
		</div>
		<div id="xac-nhan">
			<br>
			<p align="justify">
				<b>Quý khách đã đặt hàng thành công!</b><br />
				• Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
				• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
				<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của chúng Tôi!</b>
			</p>
		</div>
	</div>
</div>
	<!-- endmain -->
<script type="text/javascript">
	$(function() {
		var pull        = $('#pull');
		menu        = $('nav ul');
		menuHeight  = menu.height();

		$(pull).on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});
	});

	$(window).resize(function(){
		var w = $(window).width();
		if(w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
</script>
