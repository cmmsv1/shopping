@php
    $total = 0;
@endphp
@if (count($carts)>0)
    @foreach ($carts as $cart)                      
    <li class="pr-cart-item">
        <input type="hidden" value="{{$cart->products->id}}" class="productcart_id"> 
        <div class="product-image">
            <figure><img src="{{asset('assets/images/products')}}/{{$cart->products->image}}" alt=""></figure>
        </div>
        <div class="product-name">
            <a class="link-to-product" href="{{route('product.detail',$cart->products->slug)}}">{{$cart->products->name}}</a>
        </div>
        <div class="price-field produtc-price">
            <p class="price">
                @php
                    echo number_format($cart->products->regular_price, 0, ',', '.').'đ';
                @endphp
            </p>
        </div>
        <div class="quantity">
            <div class="quantity-input">
                <input type="text"  class="product_quantity" value="{{$cart->quantity}}" data-max="{{$cart->products->quantity}}" pattern="[0-9]*" >									
                <span class="btn btn-increase changequantity"></span>
                <span class="btn btn-reduce changequantity"></span>
            </div>
        </div>
        
        <div class="price-field sub-total">
            <p class="price">
                @php
                    echo number_format($cart->products->regular_price * $cart->quantity, 0, ',', '.').'đ';
                @endphp
            </p>
        </div>
        <div class="delete">
            <a href="#" class="btn btn-delete remove-cart" title="">
                <span>Delete from your cart</span>
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </a>
        </div>
    </li>	
    @php
        $total = $total + $cart->products->regular_price * $cart->quantity;
    @endphp
    @endforeach	

@else 
    <div style="padding: 40px">
        <p style="text-align: center; font-size: 15px">Giỏ hàng của bạn đang trống.....</p>
    </div>
@endif		
<div class="summary">
    <div class="order-summary" style="margin-top: 20px">
        <p class="summary-info"><span class="title">Tổng tiền</span><b class="index">@php echo number_format($total, 0, ',', '.').'đ'; @endphp</b></p>
        <p class="summary-info"><span class="title">Phí vận chuyển</span><b class="index">Miễn phí</b></p>
        <p class="summary-info total-info "><span class="title">Tổng</span><b class="index">@php echo number_format($total, 0, ',', '.').'đ';@endphp</b></p>
    </div>
    <div class="checkout-info">
        <label class="checkbox-field">
            <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
        </label>
        <a class="btn btn-checkout" href="{{route('checkout')}}">Thanh toán</a>
        <a class="link-to-shop" href="{{route('shop')}}">Tiếp tục mua sắm<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
    </div>
    <div class="update-clear">
        {{-- <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
        <a class="btn btn-update" href="#">Update Shopping Cart</a> --}}
    </div>
</div>