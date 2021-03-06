import axios from 'axios'
import ShowCart from "../../components/show_cart";
import SidebarMenu from "../../components/sidebar_mobile";
import $ from "jquery";
import Toast from "../../toastr/toastr";
import AjaxSearch from "../../components/ajax_search_product";
import LoginAjax from "../../components/login_ajax";
import 'jquery-modal';
import 'jquery-validation';

const Cart = {
    init()
    {
        ShowCart.init();
        SidebarMenu.init();
        this.amountIncrease();
        this.amountReduction();
        this.amountChange();
        this.getProductRemoveToCart();
        AjaxSearch.init();
        LoginAjax.init();
        this.validateForm();
        this.postOrder();
    },

    amountIncrease()
    {
        let that = this;

        $('.amount-increase').click(function ()
        {

            let $getDisable     = $(this).attr('disabled');

            if ($getDisable) return false;

            $(this).attr('disabled', true);

            let $amount         = $(this).siblings().eq(1);
            let $id             = $(this).data('id');
            let $valueAmount    = $amount.val();

            if ($valueAmount > 9) return alert('Không được đặt quá 10 sản phẩm');

            $('.loading-cart').fadeIn();

            $amount.val(parseInt($valueAmount) + 1);

            let data = {
                'qty' : 1
            };

            that.updateCartIncrease($id, data);
        })
    },

    async updateCartIncrease($id,data)
    {
        await axios.get('/add-to-cart/' + $id, {params: data})
            .then(res =>
            {
                this.handelUpdateSuccess(res);
            })
            .catch(err => {
                if (err.response.status === 404)
                {
                    Toast.showToastr();
                    Toast.toastrAddError('Update giỏ hành thất bại');
                }
            })
    },

    amountReduction()
    {
        let that = this;

        $('.amount-reduction').click(function ()
        {
            let $getDisable     = $(this).attr('disabled');

            if ($getDisable) return false;

            $(this).attr('disabled', true);

            let $amount         = $(this).siblings().eq(0);
            let $id             = $(this).data('id');
            let $valueAmount    = $amount.val();

            if ($valueAmount <= 1) return alert('Số lượng sản phẩm không được nhỏ hơn 1');

            $('.loading-cart').fadeIn();

            let value_sp = parseInt($valueAmount) - 1;

            $amount.val(value_sp);

            that.updateCartReduction($id);

        })
    },

    async updateCartReduction($id)
    {
        await axios.get('/remove-one-to-cart/' + $id)
            .then(res =>
            {
                this.handelUpdateSuccess(res, false)

            })
            .catch(err => {
                if (err.response.status === 404)
                {
                    Toast.showToastr();
                    Toast.toastrAddError('Update giỏ hành thất bại');
                }
            })
    },

    handelUpdateSuccess(res, flag = true)
    {
        if(res.data.length <= 0)
        {
            $('#cart').html('<span class="d-block text-center mt-5 mb-5">Chưa có sản phẩm trong giỏ hàng. <a href="/" style="color: #ff9c00">Quay lại trang chủ!</a></span>');
        }
        if (flag) $('.amount-increase').attr('disabled', false);
        else $('.amount-reduction').attr('disabled', false);

        let totalPrice  = res.data.totalPrice;

        totalPrice      = totalPrice
            .toString()
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        $('.total-money').html(totalPrice + '<sup>đ</sup>');
        $('.loading-cart').fadeOut();

        Toast.showToastr();
        Toast.toastrAddSuccess('Update giỏ hàng thành công');
    },

    amountChange()
    {
        let that = this;

        $('.amount').change(function ()
        {
            let $value  = $(this).val();
            let $id     = $(this).data('id');

            if (isNaN($value) || $value.trim() === '')
            {
                $value = 1;
            }
            else{
                if ($value > 10)
                {
                    alert('Không được đặt quá 10 sản phẩm');
                    $value = 10;
                }
            }
            $('.loading-cart').fadeIn();
            $(this).val(parseInt($value));

            let data = {
                'qty' : $value,
                'flag': 1
            };

            that.updateCartIncrease($id, data);
        });
    },

    getProductRemoveToCart()
    {
        let that = this;
        $('.order-delete').click(function ()
        {
            let $id = $(this).data('id');
            $('.loading-cart').fadeIn();
            that.removeProductToCart($id, $(this));
        });
    },

    async removeProductToCart($id, $element)
    {
        await axios.get('/remove-to-cart/' + $id)
            .then(res =>
            {
                $('.loading-cart').fadeOut();
                let $count = $('.countTotalCart');
                $count.html(parseInt($count.html()) - 1);
                this.handelUpdateSuccess(res);
                $element.parent().parent().parent().parent().remove();
            })
            .catch(err => {
                console.log(err);
            })
    },

    postOrder()
    {
        $('#ubtn-order').click( () =>
        {
            let $form = $('#gh-form');

            if (!$form.valid()) return false;

        });
    },

    validateForm()
    {
        $.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                let re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Không hợp lệ"
        );

        $('#gh-form').validate({
            onsubmit: false,
            rules: {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    maxlength: 10,
                    regex: "^((09|03|07|08|05)+([0-9]{8})\\b)$"
                },
                address: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
            },
            messages: {
                name: {
                    required: 'Họ tên không được để trống',
                    minlength: 'Họ tên phải có ít nhất 5 kí tự',
                    maxlength: 'Họ tên không được nhiều hơn 255 kí tự'
                },
                phone: {
                    required: 'Số điện thoại không được để trống',
                    maxlength: 'Số điện thoại không được nhiều hơn 10 kí tự',
                    regex: 'Số điện thoại không đúng định dạng'
                },
                address: {
                    required: 'Địa chỉ không được để trống',
                    minlength: 'Địa chỉ phải có ít nhất 5 kí tự',
                    maxlength: 'Địa chỉ không được nhiều hơn 255 kí tự'
                }
            },
            errorPlacement: function (error, element)
            {
                let placement = $(element).data('error');
                if (placement)
                    $(placement).append(error);
                else
                    error.insertAfter(element);

            },
            submitHandler: function(form)
            {
                if ($(form).valid()) form.submit();
                return false;
            }
        });
    },
};

$(function () {
   Cart.init();
});
