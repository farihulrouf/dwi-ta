"use strict";

$(function () {
    $('.grid').isotope({
        filter: '.transition'
    });
});

var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
});
$(document).ready(function () {
    $('a[href="' + $("#path_site").val() + '"]').addClass('active');
});
var filterFns = {
    numberGreaterThan50: function () {
        var number = $(this).find('.number').text();
        return parseInt(number, 10) > 50;
    },
    ium: function () {
        var name = $(this).find('.name').text();
        return name.match(/ium$/);
    }
};
$('.filters-select').on('change', function () {
    var filterValue = this.value;
    filterValue = filterFns[filterValue] || filterValue;
    $grid.isotope({
        filter: filterValue
    });
});
function disablebtn(){
    alert("This action is disabled in demo.");
}
$(function () {

    var filterList = {

        init: function () {

            $('#portfoliolist').mixItUp({
                selectors: {
                    target: '.portfolio',
                    filter: '.filter'
                },
                load: {
                    filter: '.1'
                }
            });

        }

    };


    filterList.init();

});


$(document).ready(function () {
    $("#content-slider").lightSlider({
        loop: true,
        keyPress: true
    });
    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 9,
        slideMargin: 0,
        speed: 500,
        auto: true,
        loop: true,
        onSliderLoad: function () {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });
});
$(document).ready(function () {

    $("#owl-demo").owlCarousel({
        navigation: true
    });

});

function changetab() {
    $(this).toggleClass("on");
    $("#menu").slideToggle();
}


$('.responsive').slick({
    dots: true,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    infinite: false,
    speed: 300,
    rtl: rtl_slick(),
    slidesToShow: 7,
    slidesToScroll: 4,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }

    ]
});

function checkboth(val) {
    var pwd = $("input[name='password_reg']").val();
    if (val != pwd) {
        alert($("#pwdmatch").val());
        $("input[name='password_reg']").val("");
        $("input[name='con_password_reg']").val("");
    }
}

function checkbothpwd(val) {
    var npwd = $("input[name='npwd']").val();
    if (npwd != val) {
        alert($("#pwdmatch").val());
        $("input[name='npwd']").val("");
        $("input[name='rpwd']").val("");
    }
}

function checkcurrentpwd(val) {
    $.ajax({
        url: $("#path_site").val() + "/checkuserpassword" + "/" + val,
        success: function (data) {
            if (data == 0) {
                alert($("#error_cut_pwd").val());
                $("input[name='opwd']").val("");
            }
        }
    });
}

function cancelpwd() {
    $("input[name='npwd']").val("");
    $("input[name='rpwd']").val("");
    $("input[name='opwd']").val("");
}

function changepassword() {
    var npwd = $("input[name='npwd']").val();
    var opwd = $("input[name='opwd']").val();
    $.ajax({
        url: $("#path_site").val() + "/changeuserpwd",
        method: "GET",
        data: {
            npwd: npwd,
            opwd: opwd,
        },
        success: function (data) {
            $("input[name='npwd']").val("");
            $("input[name='rpwd']").val("");
            $("input[name='opwd']").val("");
            $('#contact').addClass('active');
            var txt = '<div class="col-sm-12"><div class="alert  alert-success alert-dismissible fade show" role="alert">Password Change Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
            document.getElementById("msgres").innerHTML = txt;
        }
    });
}

function divup(val) {
    $("#portfoliolist").css("display","block");
    $("#main_content").css("display","none");
       for (var j = 0; j < $("#totalcategory").val(); j++) {
                if (j == val) {
                    $("#catebtn" + j).addClass("activeslider");
                } else {
                    $("#catebtn" + j).removeClass("activeslider");
                }
            }
    
   /* document.getElementById("category_div").style.display = "block";
    document.getElementById("main_content").style.display = "none";
    $.ajax({
        url: $("#path_site").val() + "/category" + "/" + val,
        method: "GET",
        success: function (result) {
            var res = JSON.parse(result);
            var data = res.item;
            var txt = "";
            console.log(data);
           
            var path = $("#path_site").val();
            for (var i = 0; i < data.length; i++) {
                txt=txt+'<div class="row">';
                if(data[i]!=null){
                    txt = txt + '<div class="portfolio 1  burger w3-container  w3-animate-zoom portfoliocat" data-cat="1"  data-bound=""><div class="items"><div class="b-img">  <input type="hidden" name="selsize'+i+'" id="selsize'+i+'" value="m" /><a href="javascript:gotodetail('+data[i]['id']+','+i+')"><img src="' + path + '/public/upload/images/menu_item_icon' + "/" + data[i]['menu_image'] + '"></a></div><div class="bor"><div class="b-text"><h1><a class="portfoliocattxt" href="javascript:gotodetail('+data[i]['id']+','+i+')">' + data[i]['menu_name'] + '</a></h1><p>' + data[i]['description'] + '</p><div class="size_main_sb"><a href="javascript:changepriceqty('+i+','+"'s'"+','+data[i]["id"]+','+parseFloat(data[i]["small_price"])+')" id="s'+i+'">S</a><a href="javascript:changepriceqty('+i+','+"'m'"+','+data[i]["id"]+','+parseFloat(data[i]["medium_price"])+')" class="active" id="m'+i+'">M</a><a href="javascript:changepriceqty('+i+','+"'l'"+','+data[i]["id"]+','+parseFloat(data[i]["large_price"])+')" id="l'+i+'">L</a></div></div><div class="price"><h1>' + $("#currency").val() + '<span id="priceitem'+i+'">'+data[i]['medium_price'] + '</span></h1><div class="cart"><a href="javascript:gotodetail('+data[i]['id']+','+i+')">' + $("#addcart").val() + '</a></div></div></div></div></div>';
                    i++;
                }
                if(data[i]!=null){
                    txt = txt + '<div class="portfolio 1 burger w3-container  w3-animate-zoom portfoliocat" data-cat="1"  data-bound=""><div class="items"><div class="b-img">  <input type="hidden" name="selsize'+i+'" id="selsize'+i+'" value="m" /><a href="javascript:gotodetail('+data[i]['id']+','+i+')"><img src="' + path + '/public/upload/images/menu_item_icon' + "/" + data[i]['menu_image'] + '"></a></div><div class="bor"><div class="b-text"><h1><a class="portfoliocattxt" href="javascript:gotodetail('+data[i]['id']+','+i+')">' + data[i]['menu_name'] + '</a></h1><p>' + data[i]['description'] + '</p><div class="size_main_sb"><a href="javascript:changepriceqty('+i+','+"'s'"+','+data[i]["id"]+','+parseFloat(data[i]["small_price"])+')" id="s'+i+'">S</a><a href="javascript:changepriceqty('+i+','+"'m'"+','+data[i]["id"]+','+parseFloat(data[i]["medium_price"])+')" class="active" id="m'+i+'">M</a><a href="javascript:changepriceqty('+i+','+"'l'"+','+data[i]["id"]+','+parseFloat(data[i]["large_price"])+')" id="l'+i+'">L</a></div></div><div class="price"><h1>' + $("#currency").val() + '<span id="priceitem'+i+'">'+data[i]['medium_price'] + '</span></h1><div class="cart"><a href="javascript:gotodetail('+data[i]['id']+','+i+')">' + $("#addcart").val() + '</a></div></div></div></div></div>';
                }
                
                
                txt=txt+'</div>';
            }
            
            var cat = res.category;
            for (var j = 0; j < cat.length; j++) {
                if (cat[j]['id'] == val) {
                    $("#catebtn" + cat[j]['id']).addClass("active");
                } else {
                    $("#catebtn" + cat[j]['id']).removeClass("active");
                }
            }
            document.getElementById("category_div").innerHTML = txt;
        }
    });*/
}
$(document).ready(function () {
    $('#link1').removeClass('active');
    $('#link2').removeClass('active');
    $('#link3').removeClass('active');
    $('#link4').removeClass('active');
    if(window.location.href==$("#path_site").val()+"/aboutus"){
         $('#link2').addClass('active');
    }else if(window.location.href==$("#path_site").val()+"/service"){
         $('#link3').addClass('active');
    }else if(window.location.href==$("#path_site").val()+"/contactus"){
         $('#link4').addClass('active');
    }else{
         $('#link1').addClass('active');
    }
   // $('a[href="' + window.location.href + '"]').addClass('active');
});

function logout() {
    window.location.href = $("#path_site").val() + "/user_logout";
}

function rtl_slick() {
    if ($('body').hasClass("rtl")) {
        return true;
    } else {
        return false;
    }
}
function addtocart() {
    var item_id = $("#menu_name").val();
    var item=$("#item_id").val();
    var qty = $("#number").val();
    var price = $('#origin_price').val();
    var selectedsize=$("#selectedsize").val();
    var favorite = [];
    $.each($("input[name='interdient']:checked"), function () {
        favorite.push($(this).val());
    });
    var totalint = favorite.toString();
    $.ajax({
        url: $("#path_site").val() + "/addcartitem",
        method: "GET",
        data: {
            id: item_id,
            qty: qty,
            totalint: totalint,
            price: price,
            size:selectedsize
        },
        success: function (data) {

            document.getElementById("totalcart").innerHTML = data;
            window.location.href = $("#path_site").val() + "/detailitem" + '/' + item+'/'+selectedsize;
        }
    });

}

function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 1 : value;
    value++;
    var getprice = $("#origin_price").val();
    document.getElementById('number').value = value;
    var finalvalues = parseInt(value) * parseFloat(getprice);
    document.getElementById('price').innerHTML = finalvalues.toFixed(2);
}

function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 1 : value;
    value < 1 ? value = 1 : '';
    if (value > 1) {
        value--;
    }
    var getprice = $("#origin_price").val();
    document.getElementById('number').value = value;
    var finalvalues = parseInt(value) * parseFloat(getprice);
    document.getElementById('price').innerHTML = finalvalues.toFixed(2);
}

function changemodel() {
    $('a[href="#tab1').removeClass('active');
    $('a[href="#tab2').addClass('active');
    $('#tab1').removeClass('active');
    $('#tab2').addClass('active');
    $("#myModal1").model("show");
}

function addtocartsingle(item_id) {
    var qty = 1;
    var totalint = 0;
    $.ajax({
        url: $("#path_site").val() + "/addcartitem",
        method: "GET",
        data: {
            id: item_id,
            qty: qty,
            totalint: totalint
        },
        success: function (data) {
            document.getElementById("totalcart").innerHTML = data;
            window.location.reload();
        }
    });
}

function shareonsoical(val, id) {
    $.ajax({
        url: $("#path_site").val() + "/sharesoicalmedia" + "/" + val + "/" + id,
        method: "GET",
        success: function (data) {
            if (val == 1) {
                window.open('https://www.facebook.com/sharer/sharer.php?u='+$("#path_site").val()+'/detailitem/' + id + '/'+$("#selectedsize").val(), '_blank');
                document.getElementById("facebook_share_id").innerHTML = data;
            }
            if (val == 2) {
                window.open('https://twitter.com/intent/tweet?text='+$("#menu_name").val()+'  '+$("#path_site").val()+'/detailitem/' + id + '/'+$("#selectedsize").val(), '_blank');
                document.getElementById("twitter_share_id").innerHTML = data;
            }

        }
    });
}

function checkcart() {
    var cartttotal = $("#carttotal").val();
    if (carttotal != 0) {
        window.location.href = $("#path_site").val() + "/cartdetails";
    }
}


function registeruser() {
      document.getElementById("reg_error_msg").style.display = "none";
        document.getElementById("reg_success_msg").style.display = "none";
     $(document).ajaxSend(function() {
           $("#overlaychk").fadeIn(300);　
     });
    var name = $("input[name='name']").val();
    var phone = $("input[name='phone_reg']").val();
    var password = $("input[name='password_reg']").val();
    var email = $("input[name='email']").val();
    var conn = $("input[name='con_password_reg']").val();
    if (name != "" && phone != "" && password != "" && conn != ""&&email!="") {
        $.ajax({
            url: $("#path_site").val() + "/userregister",
            method: "GET",
            data: {
                name: name,
                phone: phone,
                password: password,
                email:email
            },
            success: function (data) {
                if (data == 1) {
                      $.ajax({
                                    url: $("#path_site").val() + "/userlogin",
                                    method: "GET",
                                    data: {
                                        phone: phone,
                                        password: password,
                                        rem_me: 0
                                    },
                                    success: function (data) {
                                        if (data == 1) {
                                            var url1 = window.location.href;
                                            var url2 = $("#path_site").val() + "/home";
                                            var n = url1.localeCompare(url2);
                                            console.log(n);
                                            if (n == 0) {
                                                window.location.href = $("#path_site").val() + "/myaccount";
                                            } else {
                                                window.location.reload();
                                            }
                        
                                        } else {
                                            document.getElementById("login_error_msg").innerHTML = $("#login_error").val();
                                            document.getElementById("login_error_msg").style.display = "block";
                                        }
                                    }
                    });
                } else {
                    document.getElementById("reg_error_msg").innerHTML = data;
                    document.getElementById("reg_error_msg").style.display = "block";
                    document.getElementById("reg_success_msg").style.display = "none";
                }
            }
        });
    } else {
        document.getElementById("reg_error_msg").style.display = "block";
        document.getElementById("reg_success_msg").style.display = "none";
        console.log($("#reg_error").val());
        document.getElementById("reg_error_msg").innerHTML = $("#reg_error").val();

    }
    $("#overlaychk").fadeOut(1000);
}

function checkdata(val) {
    var pwd = $("input[name='password_reg']").val();
    if (val != pwd) {
        alert($("#pwdmatch").val());
        $("input[name='password_reg']").val("");
        $("input[name='con_password_reg']").val("");
    }
}

function loginaccount() {
     document.getElementById("login_error_msg").style.display = "none";
     $(document).ajaxSend(function() {
    $("#overlaychk").fadeIn(300);　
  });
    var phone = $("input[name='phone']").val();
    var password = $("input[name='password']").val();
    if ($("input[name='rem_me']").prop("checked") == true) {
        var rem_me = 1;
    } else {
        var rem_me = 0;
    }

    if (phone != "" && password != "") {
        $.ajax({
            url: $("#path_site").val() + "/userlogin",
            method: "GET",
            data: {
                phone: phone,
                password: password,
                rem_me: rem_me
            },
            success: function (data) {
                if (data == 1) {
                    var url1 = window.location.href;
                    var url2 = $("#path_site").val() + "/home";
                    var n = url1.localeCompare(url2);
                    if (n == 0) {
                        window.location.href = $("#path_site").val() + "/myaccount";
                    } else {
                        window.location.reload();
                    }

                } else {
                    document.getElementById("login_error_msg").innerHTML = $("#login_error").val();
                    document.getElementById("login_error_msg").style.display = "block";
                }
            }
        });
    } else {
        document.getElementById("login_error_msg").innerHTML = $("#required_field").val();
        document.getElementById("login_error_msg").style.display = "block";
    }
    $("#overlaychk").fadeOut(1000);
}

function checkloginaccount() {
    var phone = $("input[name='phone_check']").val();
    var password = $("input[name='password_check']").val();
    if ($("input[name='rem_me_check']").prop("checked") == true) {
        var rem_me = 1;
    } else {
        var rem_me = 0;
    }

    if (phone != "" && password != "") {
        $.ajax({
            url: $("#path_site").val() + "/userlogin",
            method: "GET",
            data: {
                phone: phone,
                password: password,
                rem_me: rem_me
            },
            success: function (data) {
                if (data == 1) {
                    var url1 = window.location.href;
                    var url2 = $("#path_site").val() + "/home";
                    var n = url1.localeCompare(url2);
                    console.log(n);
                    if (n == 0) {
                        window.location.href = $("#path_site").val() + "/myaccount";
                    } else {
                        window.location.reload();
                    }

                } else {
                    document.getElementById("check_login_error_msg").innerHTML = $("#login_error").val();
                    document.getElementById("check_login_error_msg").style.display = "block";
                }
            }
        });
    } else {
        document.getElementById("check_login_error_msg").innerHTML = $("#required_field").val();
        document.getElementById("check_login_error_msg").style.display = "block";
    }
}

function forgotmodel() {
    document.getElementById('forgotbody').style.display = "block";
    document.getElementById('loginmodel').style.display = "none";
}

function loginmodel() {
    document.getElementById('forgotbody').style.display = "none";
    document.getElementById('loginmodel').style.display = "block";
}

function forgotaccount() {
    var phone = $("input[name='phone_for']").val();
    if (phone != "") {
        $.ajax({
            url: $("#path_site").val() + "/forgotpassword",
            method: "GET",
            data: {
                phone: phone
            },
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    document.getElementById("for_success_msg").style.display = "block";
                    document.getElementById("for_error_msg").style.display = "none";
                } else {
                    document.getElementById("for_error_msg").innerHTML = $("#forgot_error").val();
                    document.getElementById("for_error_msg").style.display = "block";
                    document.getElementById("for_success_msg").style.display = "none";
                }
            }
        });
    } else {
        document.getElementById("for_error_msg").innerHTML = $("#forgot_error_2").val();
        document.getElementById("for_error_msg").style.display = "block";
        document.getElementById("for_success_msg").style.display = "none";

    }

}


function changeoption1(val) {
    if (val == 0) {
        document.getElementById("checkbox-0").checked = true;
        document.getElementById("checkbox-1").checked = false;
      
        var subtotal=document.getElementById("subtotal").innerHTML;
        document.getElementById("delivery_charges_order").innerHTML=document.getElementById("delivery_charges").value;
        var delivery_charges_order=document.getElementById("delivery_charges").value;
        var total=parseFloat(subtotal)+parseFloat(delivery_charges_order);
        document.getElementById("finaltotal").innerHTML=total.toFixed(2);
    }
    if (val == 1) {
        document.getElementById("checkbox-1").checked = true;
        document.getElementById("checkbox-0").checked = false;
      
        document.getElementById("delivery_charges_order").innerHTML="0.00";
         var total=parseFloat(document.getElementById("subtotal").innerHTML);
        document.getElementById("finaltotal").innerHTML=total.toFixed(2);
    }
}

function addqty(id, iqty) {
    var qty = $("input[name='qty" + iqty + "']").val();
    
    var nqty = parseInt(qty) + 1;
    var price = document.getElementById("price_pro" + id).innerHTML;
      var pricedata = parseFloat(nqty) * parseFloat(price);
            document.getElementById("producttotal" + id).innerHTML = pricedata.toFixed(2);
    $("input[name='qty" + iqty + "']").val(nqty);
    $.ajax({
        url: $("#path_site").val() + "/cartqtyupdate" + "/" + id + "/" + nqty + "/1",
        data: {},
        success: function (data) {
          
            var result= parseFloat(data.finaltotal)+parseFloat($("#delivery_charges_order").html());
                document.getElementById("finaltotal").innerHTML =result.toFixed(2);
            document.getElementById("subtotal").innerHTML = data.subtotal;
        }
    });

}

function minusqty(id, iqty) {
    var qty = $("input[name='qty" + iqty + "']").val();
    var nqty = parseInt(qty) - 1;
    var price = document.getElementById("price_pro" + id).innerHTML;
    $("input[name='qty" + iqty + "']").val(nqty);
    var pricedata = parseFloat(nqty) * parseFloat(price);
    document.getElementById("producttotal" + id).innerHTML = pricedata.toFixed(2);
    if (nqty != 0) {
        $.ajax({
            url: $("#path_site").val() + "/cartqtyupdate" + "/" + id + "/" + nqty + "/0",
            data: {},
            success: function (data) {
                var result= parseFloat(data.finaltotal)+parseFloat($("#delivery_charges_order").html());
                document.getElementById("finaltotal").innerHTML =result.toFixed(2);
                document.getElementById("subtotal").innerHTML = data.subtotal;
            }
        });
    } else {
        $.ajax({
            url: $("#path_site").val() + "/deletecartitem" + "/" + id,
            data: {},
            success: function (data) {
                window.location.reload();
            }
        });
    }

}


function changebutton(val) {
    if (val == "Cash" || val == "by Card") {
        document.getElementById("orderplace1").style.display = "block";
        document.getElementById("orderplacestrip").style.display = "none";
        document.getElementById("orderplacepaypal").style.display = "none";
        $("#pay1").addClass('activepayment');
        $("#pay2").removeClass('activepayment');
         $("#shipping_type_or").val($("input[name='shipping_type']").val());
        $("#pay3").removeClass('activepayment');
        $("#order_payment_type_1").prop("checked", true);
        $("#order_payment_type_3").prop("checked", false);
        $("#order_payment_type_4").prop("checked", false);
    }
    if (val == "Stripe") {
        var totalprice = document.getElementById("finaltotal_order").innerHTML;
        $("script").each(function () {
            $(this).attr('data-amount', totalprice);
        })
        $("#phone_or").val($("#order_phone").val());
        $("#note_or").val($("#order_notes").val());
        $("#city_or").val($("#order_city").val());
        $("#payment_type_or").val("Stripe");
        $("#shipping_type_or").val($("input[name='shipping_type']").val());
        $('#total_price_or').val(totalprice);
        $('#subtotal_or').val(document.getElementById("subtotal_order").innerHTML);

        if ($("#phone_or").val() != "" && $("#city_or").val() != "") {
            if ($("#checkbox-0").prop("checked") == true) {
                var shipping_type = 0;
                $("#shipping_type_or").val(0);
                $("#address_or").val($("#us2-address").val());
                $("#lat_long_or").val($("#us2-lat").val() + "," + $("#us2-lon").val());
                $('#charage_or').val(document.getElementById("delivery_charges_order").innerHTML);
            } else if ($("#checkbox-1").prop("checked") == true) {
                var shipping_type = 1;
                $("#shipping_type_or").val(1);
                $('#charage_or').val(0);
            }

            if (shipping_type == 0 && $("#address_or").val() == "") {
                $("#order_payment_type_4").prop("checked", false);
                alert("{{__('messages.required_field')}}");
            } else {
                document.getElementById("orderplace1").style.display = "none";
                document.getElementById("orderplacestrip").style.display = "block";
                document.getElementById("orderplacepaypal").style.display = "none";
                $("#pay1").removeClass('activepayment');
                $("#pay2").removeClass('activepayment');
                $("#pay3").addClass('activepayment');
                $("#order_payment_type_1").prop("checked", false);
                $("#order_payment_type_3").prop("checked", false);
                $("#order_payment_type_4").prop("checked", true);
            }
        } else {
            $("#order_payment_type_4").prop("checked", false);
            alert($("#required_field").val());

        }

    }
    if (val == "Paypal") {
        var totalprice = document.getElementById("finaltotal_order").innerHTML;
        $("#phone_pal").val($("#order_phone").val());
        $("#note_pal").val($("#order_notes").val());
        $("#city_pal").val($("#order_city").val());
        $("#payment_type_pal").val("Paypal");
        $('#total_price_pal').val(totalprice);
        $('#subtotal_pal').val(document.getElementById("subtotal_order").innerHTML);
        if ($("#phone_pal").val() != "" && $("#city_pal").val() != "") {
            document.getElementById("orderplace1").style.display = "none";
            document.getElementById("orderplacestrip").style.display = "none";
            document.getElementById("orderplacepaypal").style.display = "block";
            $("#pay1").removeClass('activepayment');
            $("#pay2").addClass('activepayment');
            $("#pay3").removeClass('activepayment');
            $("#order_payment_type_1").prop("checked", false);
            $("#order_payment_type_3").prop("checked", true);
            $("#order_payment_type_4").prop("checked", false);
            if ($("#checkbox-0").prop("checked") == true) {
                var shipping_type = 0;
                $("#shipping_type_pal").val(0);
                $("#address_pal").val($("#us2-address").val());
                $("#lat_long_pal").val($("#us2-lat").val() + "," + $("#us2-lon").val());
                $('#charage_pal').val(document.getElementById("delivery_charges_order").innerHTML);
            } else if ($("#checkbox-1").prop("checked") == true) {
                var shipping_type = 1;
                $("#shipping_type_pal").val(1);
                $('#charage_pal').val(0);
            }

        } else {
            $("#order_payment_type_3").prop("checked", false);
            alert($("#required_field").val());

        }

    }
}

function changeoption(val) {
    var paymenttype=[];
    $.each($("input[name='order_payment_type']:checked"), function () {
                                paymenttype.push($(this).val());
                });
   // alert(paymenttype);
    
    var subtotal = $("#subtotalorder").val();
    var discharges = $("#delivery_charges").val();
    if (val == 0) {
        document.getElementById("checkbox-0").checked = true;
        document.getElementById("checkbox-1").checked = false;
        document.getElementById("maporder").style.display = "block";
        document.getElementById("addressorder").style.display = "block";
        document.getElementById("dcorder").style.display = "block";
        var str=parseFloat(subtotal) + parseFloat(discharges);
        document.getElementById("finaltotal_order").innerHTML = str.toFixed(2);
    }
    if (val == 1) {
        document.getElementById("checkbox-1").checked = true;
        document.getElementById("checkbox-0").checked = false;
        document.getElementById("maporder").style.display = "none";
        document.getElementById("addressorder").style.display = "none";
        document.getElementById("dcorder").style.display = "none";
         var str=parseFloat(document.getElementById("finaltotal_order").innerHTML) - parseFloat(discharges);
        document.getElementById("finaltotal_order").innerHTML = str.toFixed(2);
    }
    changebutton(paymenttype);
}

function orderplace() {
    var phone = $("#order_phone").val();
    var note = $("#order_notes").val();
    var city = $("#order_city").val();
    var payment_type = 'Cash';
    var totalprice = document.getElementById("finaltotal_order").innerHTML;
    var subtotal = document.getElementById("subtotal_order").innerHTML;
    var charge = 0;
    var typedata = "";
 //   console.log($("#us2-address").val());

    if ($("#checkbox-0").prop("checked") == true) {
        var shipping_type = 0;
        var address = $("#us2-address").val();
        var latlong = $("#us2-lat").val() + "," + $("#us2-lon").val();
        var charge = document.getElementById("delivery_charges_order").innerHTML;
    }
    if ($("#checkbox-1").prop("checked") == true) {
        var shipping_type = 1;
        var address ="";
        var latlong ="";
        var charge=0;
    } 

    if (phone != "" && city != "" && payment_type != "") {
        $('#cashbutton').prop('disabled', true);
        $.ajax({
            url: $("#path_site").val() + "/placeorder",
            method: "GET",
            data: {
                phone: phone,
                note: note,
                city: city,
                address:address,
                payment_type: payment_type,
                shipping_type: shipping_type,
                totalprice: totalprice,
                subtotal: subtotal,
                charge: charge,
                latlong:latlong
            },
            success: function (data1) {
                console.log(data1);
                if (data1 != 0) {
                    setTimeout(function(){ window.location.href = $("#path_site").val() + "/viewdetails" + "/" + data1; }, 5000);

                    
                }
            }
        });
    } else {
        document.getElementById("orderplace1").style.display = "none";
        document.getElementById("orderplacestrip").style.display = "none";
        document.getElementById("orderplacepaypal").style.display = "none";
        $("#pay1").removeClass('activepayment');
        $("#pay2").removeClass('activepayment');
        $("#pay3").removeClass('activepayment');
        $("#order_payment_type_1").prop("checked", false);
        $("#order_payment_type_3").prop("checked", false);
        $("#order_payment_type_4").prop("checked", false);
        alert($("#required_field").val());
    }
}





function addprice(id, iqty) {
    $.ajax({
            url: $("#path_site").val() + "/getitemdetails/"+id+"/"+$("#selectedsize").val(),
            method: "GET",
            success: function (data) {
                 if ($("#checkbox-" + iqty).prop("checked") == true) {
                    var origin_price = $("#origin_price").val();
                    var menu_new_price = parseFloat(origin_price) + parseFloat(data);
                    $("#origin_price").val(menu_new_price.toFixed(2));
                    var pricedata = menu_new_price * parseFloat($('#number').val());
                    document.getElementById("price").innerHTML = pricedata.toFixed(2);
                } else if ($("#checkbox-" + iqty).prop("checked") == false) {
                    var origin_price = $("#origin_price").val();
                    var menu_new_price = parseFloat(origin_price) - parseFloat(data);
                    $("#origin_price").val(menu_new_price.toFixed(2));
                    var pricedata = menu_new_price * parseFloat($('#number').val());
                    document.getElementById("price").innerHTML = pricedata.toFixed(2);
                }

            }
        });
}

function changepriceqty(idata,fields,ids,price,tag){ 
             $(".sizename"+idata+tag).removeClass('active');
                
                $("#selsize"+idata).val(fields);
                $("#"+fields+idata+tag).addClass('active');
                document.getElementById("priceitem"+idata+tag).innerHTML=parseFloat(price).toFixed(2);
         
}
function changepriceqty1(idata,fields,ids,price){   
                
                  $(".detaills").removeClass('active');
                 
                $("#0"+fields).addClass('active');
                $("#selectedsize").val(fields);
                document.getElementById("origin_price").value=price;
                var favorite = [];
                $.each($("input[name='interdient']:checked"), function () {
                                favorite.push($(this).val());
                });
                var totalint = favorite.toString();
                $.ajax({
                        url: $("#path_site").val() + "/itemchanges",
                        data: { 
                                totalint:totalint,
                                id:$("#item_id").val(),
                                size:fields
                        },
                        success: function (data1) {
                            var str=JSON.parse(data1);
                            var total=parseFloat($("#origin_price").val())+parseFloat(str.total);
                            document.getElementById("price").innerHTML=total.toFixed(2);
                             document.getElementById("origin_price").value=total.toFixed(2);
                            for(var i=0;i<str.item.length;i++){  
                                    console.log(str.item[i].price);
                                    if(str.item[i].price==""){
                                        $("#in"+str.item[i].id).html(0.00);  
                                    }else{
                                        $("#in"+str.item[i].id).html(str.item[i].price);  
                                    }                            
                                                                 
                            }
                        }
                    });
           
}
if($('#us2').length){
    $('#us2').locationpicker({
    location: {
          latitude: $("#lat_env").val(),
        longitude: $("#long_env").val()
    },
    radius: 300,
    inputBinding: {
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon'),
        radiusInput: $('#us2-radius'),
        locationNameInput: $('#us2-address')
    },
    enableAutocomplete: true
});
}


function gotodetail(id,idata){
    var size=$("#selsize"+idata).val();
    window.location.href=$("#path_site").val()+"/detailitem"+'/'+id+'/'+size;
}

var $table = document.querySelector('.minha-table');
if($table){
      $table.addEventListener("click", function(ev){
      if (ev.target.tagName == "INPUT") {
        if (ev.target.checked) {
          ev.target.parentNode.parentNode.classList.add("selected");
        }else {
          ev.target.parentNode.parentNode.classList.remove("selected");
        }
      }
    });
}


var $table = document.querySelector('.minha-table-2');
if($table){
    $table.addEventListener("click", function(ev){
  if (ev.target.tagName == "INPUT") {
    if (ev.target.checked) {
      ev.target.parentNode.parentNode.classList.add("selected");
    }else {
      ev.target.parentNode.parentNode.classList.remove("selected");
    }
  }
});
}
