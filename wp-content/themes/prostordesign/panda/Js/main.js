function scriptMain() {
  this.scrollToAnchor = function (anchor, speed) {
    if (!anchor.length) {
      return false;
    }

    var offset = 80;

    $('html,body').animate({
      scrollTop: anchor.offset().top - offset
    }, speed);
  };

  this.setVariationPrice = function () {
    var regularPriceWc = $('.js-variation-price del .amount');
    var salePriceWc = $('.js-variation-price ins .amount');
    var regularPrice = $('.js-product-regular-price .figure');
    var salePrice = $('.js-product-discount-price .figure');

    if (salePriceWc.length === 0) {
      salePriceWc = $('.js-variation-price .amount');
    }

    if (regularPriceWc.length !== 0) {
      regularPrice.html(regularPriceWc.html());
      $('.js-product-regular-price').attr('data-price', regularPriceWc.text());
      salePrice.html(salePriceWc.html());
      $('.js-product-discount-price').attr('data-price', salePriceWc.text());
    } else {
      regularPrice.html(salePriceWc.html());
      $('.js-product-regular-price').attr('data-price', salePriceWc.text());
    }
  };

  this.setProductAttributeUrl = function () {
    var url = window.location.origin + window.location.pathname;
    var params = '';

    $('.js-variant-list select').each(function () {
      params += $(this).attr('name') + '=' + $(this).val();
    });
    if (url.indexOf('?') > -1) {
      url += '&' + params;
    } else {
      url += '?' + params;
    }
    if (window.history.replaceState) {
      window.history.replaceState('', '', url);
    }
  };

  this.addProductToCart = function () {
    var productId = $('.js-product-id').val();
    var quantity = $('.js-product-quantity').val();
    var variationId = $('.js-variation-id').val();
    var variationParams = {};

    $('.js-variations-row').each(function () {
      var name = $(this).find('select').attr('name');
      var value = $(this).find('.js-variant-box-active .js-product-variant-name').text();

      variationParams[name] = value;
    });

    data = {
      action: "add_product_to_cart",
      productId: productId,
      quantity: quantity,
      variationId: variationId,
      variationParams: variationParams
    };

    $.post(myAjax.ajaxurl, data, function (response) {
      if (response !== null) {
        scriptMain.getHeaderBasketInfo();
        scriptMain.hideLoading();
        scriptMain.openShopPopup();
      }
    });
  };

  this.getHeaderBasketInfo = function () {
    var wrapper = $('.js-header-basket');

    data = {
      action: "get_header_cart_info",
    };

    $.post(myAjax.ajaxurl, data, function (response) {
      if (response !== null) {
        wrapper.empty();
        wrapper.prepend(response);
      }
    });
  };

  this.showLoading = function () {
    const main = document.querySelector("main");
    main.classList.add("loading")
  }

  this.hideLoading = function () {
    const main = document.querySelector("main");
    main.classList.remove("loading")
  }

  this.numberWithCommas = function (x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }

  this.openShopPopup = function () {

    const popup = document.querySelector(".shop-popup")
    popup.classList.add("--visible")

    const currency = popup.dataset.currency;
    console.log(currency);
    //amount
    const amountElm = document.querySelector(".product-detail-intro-section__input");
    const amountValue = amountElm.value;

    //price
    let price = document.querySelector(".product-detail-intro-section__price-full .product-detail-intro-section__price-number").textContent;
    price = price.replace('Kč', '');
    price = price.replace(currency, '');
    price = price.replace(',', '.');
    price = price.replace(' ', '');
    price = Number(price);
    let priceCount = price * Number(amountValue);
    priceCount = priceCount.toFixed(2)
    priceCount = scriptMain.numberWithCommas(priceCount)
    priceCount = priceCount.replace('.', ',');

    //price-no-vat
    let priceNoVat = document.querySelector(".product-detail-intro-section__price-without-vat .product-detail-intro-section__price-number").textContent;
    priceNoVat = priceNoVat.replace('Kč', '');
    priceNoVat = priceNoVat.replace('Kč bez DPH', '');
    priceNoVat = priceNoVat.replace(currency, '');
    priceNoVat = priceNoVat.replace(',', '.');
    priceNoVat = priceNoVat.replace(' ', '');
    priceNoVat = Number(priceNoVat);
    let priceNoVatCount = priceNoVat * Number(amountValue);
    priceNoVatCount = priceNoVatCount.toFixed(2)
    priceNoVatCount = scriptMain.numberWithCommas(priceNoVatCount)
    priceNoVatCount = priceNoVatCount.replace('.', ',');

    const popupAmout = document.querySelector(".shop-popup__parameter--value.--number");
    const popupValue = document.querySelectorAll(".shop-popup__parameter--value");
    const popopPrice = document.querySelector(".shop-popup__price .shop-popup__price-value");
    const popopPriceNoVat = document.querySelector(".shop-popup__price--no-dph .shop-popup__price-value");

    const productValues = document.querySelectorAll(".product-detail-intro-section__select");

    for (let index = 0, len = productValues.length; index < len; ++index) {
      if (productValues[index]) {
        const productValue = productValues[index].value;
        popupValue[index+1].innerHTML = productValue;
      } else {
        popupValue[index+1].parentNode.style.display = "none";
      }
    }

    if (currency === "CZK") {
      popopPrice.innerHTML = priceCount + " Kč";
      popopPriceNoVat.innerHTML = priceNoVatCount + " Kč bez DPH";
    } else {
      popopPrice.innerHTML = priceCount + " " + currency;
      popopPriceNoVat.innerHTML = "";
    }
    popupAmout.innerHTML = amountValue + " ks";
  }
}

window['scriptMain'] = new scriptMain();

$(document).ready(function () {
  if ($('#Hloubka').length) {
    $('.js-variation-id').val($('#Hloubka').find(':selected').data('var-id'));
  } else if ($('#Rozměry').length) {
    $('.js-variation-id').val($('#Rozměry').find(':selected').data('var-id'));
  } else if ($('#Barva').length) {
    $('.js-variation-id').val($('#Barva').find(':selected').data('var-id'));
  }  else if ($('#Závěsy').length) {
    $('.js-variation-id').val($('#Závěsy').find(':selected').data('var-id'));
  }
  $('.js-product-button').click(function (e) {
    e.preventDefault();

    if (!$(this).hasClass('disabled')) {
      scriptMain.showLoading();
      scriptMain.addProductToCart();
    }
  });

  // Product variants
  $('.js-variant-list .js-variant-box li').click(function (e) {
    e.preventDefault();

    var parent = $(this).parents('.js-variant-list');
    var select = parent.find('select');
    var value = $(this).data('value');
    var active = parent.find('.js-variant-box-active');

    active.empty().html($(this).html());
    select.find('option[value="' + value + '"]').prop('selected', true).change();
    scriptMain.setProductAttributeUrl();
  });

  $('.js-variant-box').click(function () {
    $(this).toggleClass('is-open');
  });

  $('.js-variant-list select').each(function () {
    var value = $(this).val();
    if (value !== '') {
      var parent = $(this).parents('.js-variant-list');
      var active = parent.find('.js-variant-box-active');

      active.empty().html(parent.find('li[data-value="' + value + '"]').html());
    }
  });

  // Checkout
  $('.js-change-checkout-section').click(function (e) {
    e.preventDefault();
    var index = $(this).data('index');
    $('.js-checkout-section').hide();
    $('.js-checkout-section:nth-child(' + index + ')').show();
    if (index === 1) {
      $('.cart-nav-data').removeClass("active");
      $('.cart-nav-transport').addClass("active");
      $('.cart-nav-summary').removeClass("active");
      $('.show-login-option').hide();
    }
    if (index === 2) {
      $('.cart-nav-data').addClass("active");
      $('.cart-nav-transport').removeClass("active");
      $('.cart-nav-summary').removeClass("active");
      $('.show-login-option').show();
    }
    if (index === 3) {
      $('.cart-nav-data').removeClass("active");
      $('.cart-nav-transport').removeClass("active");
      $('.cart-nav-summary').addClass("active");
      $('.show-login-option').hide();
    }
    $('html, body').animate({
      scrollTop: 0
    }, '500');
    //scriptMain.scrollToAnchor($('.eshop-cart-section'), 500);
  });

  // Checkout
  $('.js-change-checkout-section-nav').click(function (e) {
    e.preventDefault();
    var index = $(this).data('index');
    $('.js-checkout-section').hide();
    $('.js-checkout-section:nth-child(' + index + ')').show();
    $('.js-change-checkout-section-nav').removeClass("active");
    $(this).addClass("active");
    if (index === 2) {
      $('.show-login-option').show();
    } else {
      $('.show-login-option').hide();
    }
    $('html, body').animate({
      scrollTop: 0
    }, '500');
    //scriptMain.scrollToAnchor($('.eshop-cart-section'), 500);
  });
});

$(document).on('DOMNodeInserted', function (e) {
  if ($(e.target).hasClass('js-variation-price')) {
    scriptMain.setVariationPrice();
  }
});

$(document.body).on('click', 'a.showcoupon', function (e) {
  e.preventDefault();
  $('.checkout_coupon').slideToggle(400, function () {
    $('.checkout_coupon').find(':input:eq(0)').focus();
  });
});

$(document.body).on('change', '#Hloubka', function (e) {
  e.preventDefault();
  const popup = document.querySelector(".shop-popup")
  const currency = popup.dataset.currency;
  console.log(currency);
  if (currency === "CZK") {
    var crc = " Kč";
    var crcWithVat = " Kč bez DPH";
  } else {
    var crc = " " + currency;
    var crcWithVat = " " + currency;
  }
  $('.product-detail-intro-section__price-full').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Hloubka').find(':selected').data('price')) + crc);
  $('.product-detail-intro-section__price-without-vat').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Hloubka').find(':selected').data('price-no-vat')) + crcWithVat);
  $('.js-variation-id').val($('#Hloubka').find(':selected').data('var-id'));
});

$(document.body).on('change', '#Rozměry', function (e) {
  e.preventDefault();
  const popup = document.querySelector(".shop-popup")
  const currency = popup.dataset.currency;
  console.log(currency);
  if (currency === "CZK") {
    var crc = " Kč";
    var crcWithVat = " Kč bez DPH";
  } else {
    var crc = " " + currency;
    var crcWithVat = " " + currency;
  }
  $('.product-detail-intro-section__price-full').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Rozměry').find(':selected').data('price')) + crc);
  $('.product-detail-intro-section__price-without-vat').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Rozměry').find(':selected').data('price-no-vat')) + crcWithVat);
  $('.js-variation-id').val($('#Rozměry').find(':selected').data('var-id'));
});

$(document.body).on('change', '#Barva', function (e) {
  e.preventDefault();
  const popup = document.querySelector(".shop-popup")
  const currency = popup.dataset.currency;
  console.log(currency);
  if (currency === "CZK") {
    var crc = " Kč";
    var crcWithVat = " Kč bez DPH";
  } else {
    var crc = " " + currency;
    var crcWithVat = " " + currency;
  }
  $('.product-detail-intro-section__price-full').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Barva').find(':selected').data('price')) + crc);
  $('.product-detail-intro-section__price-without-vat').find('.product-detail-intro-section__price-number').html(scriptMain.numberWithCommas($('#Barva').find(':selected').data('price-no-vat')) + crcWithVat);
  $('.js-variation-id').val($('#Barva').find(':selected').data('var-id'));
});