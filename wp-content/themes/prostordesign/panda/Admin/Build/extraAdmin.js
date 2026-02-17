"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

jQuery(function () {
  new DynamicFieldset();
});

var DynamicFieldset = /*#__PURE__*/function () {
  function DynamicFieldset() {
    _classCallCheck(this, DynamicFieldset);

    _defineProperty(this, "DynamicFieldsetModal", jQuery(".admin-modal-dynamic-fieldset"));

    _defineProperty(this, "DynamicFieldsetOpenButton", jQuery(".admin-modal-dynamic-fieldset-open"));

    _defineProperty(this, "DynamicFieldsetClose", jQuery(".admin-modal-dynamic-fieldset-close"));

    _defineProperty(this, "DynamicFieldsetCloseAfterEdit", jQuery(".admin-modal-dynamic-fieldset-close-close"));

    _defineProperty(this, "DynamicFieldsetRemoveFieldButton", jQuery(".remove-fieldset"));

    _defineProperty(this, "DynamicFieldsetAddFieldButton", jQuery(".btn-add-field"));

    _defineProperty(this, "ActiveFieldset", jQuery(".fieldset-field-item"));

    this.init();
  }

  _createClass(DynamicFieldset, [{
    key: "init",
    value: function init() {
      if (this.isDynamicFieldset()) {
        this.handleOpen();
        this.handleClose();
        this.handleRemove();
        this.handleAdd();
        this.ajaxUpdate();
      }
    }
  }, {
    key: "handleOpen",
    value: function handleOpen() {
      var self = this;
      jQuery(this.DynamicFieldsetOpenButton).click(function (e) {
        e.preventDefault();
        self.ActiveFieldset = jQuery(this).closest(".fieldset-field-item");
        self.DynamicFieldsetModal = jQuery(self.ActiveFieldset).children(".admin-modal-dynamic-fieldset");
        self.openModal(self.DynamicFieldsetModal);
      });
    }
  }, {
    key: "handleClose",
    value: function handleClose() {
      var self = this;
      self.DynamicFieldsetModal.click(function (e) {
        if (e.target == this) {
          e.preventDefault();
          self.closeModal(self.DynamicFieldsetModal);
        }
      });
      self.DynamicFieldsetClose.click(function (e) {
        e.preventDefault();
        self.closeModal(self.DynamicFieldsetModal);
      });
      self.DynamicFieldsetCloseAfterEdit.click(function (e) {
        e.preventDefault();
        self.closeModal(self.DynamicFieldsetModal);
      });
    }
  }, {
    key: "openModal",
    value: function openModal(Modal) {
      Modal.addClass("admin-modal-open");
      this.handleTrumbowyg();
    }
  }, {
    key: "closeModal",
    value: function closeModal(Modal) {
      this.handleEdit(Modal);
      Modal.removeClass("admin-modal-open");
    } // --- Issets

  }, {
    key: "isDynamicFieldset",
    value: function isDynamicFieldset() {
      return this.DynamicFieldsetModal.length;
    }
  }, {
    key: "handleRemove",
    value: function handleRemove() {
      jQuery(this.DynamicFieldsetRemoveFieldButton).click(function (e) {
        e.preventDefault();
        jQuery(this).closest("li").remove();
      });
    }
  }, {
    key: "handleAdd",
    value: function handleAdd() {
      jQuery(this.DynamicFieldsetAddFieldButton).click(function (e) {
        e.preventDefault();
        var parentDom = jQuery(this).closest(".kt-form-table").children("tbody").children("tr").children("td").children(".fieldset-field").children(".fieldset-field-list");
        var counterDom = jQuery(this).closest(".kt-form-table ").children("tbody").children("tr").children("td").children(".ff_count");
        var data = {
          action: "kt_generate_fieldset",
          config: parentDom.attr("data-config"),
          fieldset: parentDom.attr("data-fieldset"),
          number: parseInt(counterDom.val()) + 1
        };
        jQuery.get(kt_urls.ajaxurl, data, function (data) {
          parentDom.append(data);
          counterDom.val(parseInt(counterDom.val()) + 1);
          kt_dynamic_fields_on_add();
        });
      });
    }
  }, {
    key: "handleEdit",
    value: function handleEdit(Modal) {
      if (jQuery(this.ActiveFieldset).children(Modal).children(".admin-modal-content").children(".admin-modal-body").children("ul").children(".dynamic-fieldset-input").children(".file-load-box").length) {
        var inputType = jQuery(this.ActiveFieldset).children(Modal).children(".admin-modal-content").children(".admin-modal-body").children("ul").children(".dynamic-fieldset-input").children(".file-load-box").children("input").first();
        var value = inputType.val();
        var imgSrc = jQuery(this.ActiveFieldset).children(Modal).children(".admin-modal-content").children(".admin-modal-body").children("ul").children(".dynamic-fieldset-input").children(".file-load-box").children("span").children("img").attr("src");
      } else if (!jQuery(this.ActiveFieldset).children(Modal).children(".admin-modal-content").children(".admin-modal-body").children("ul").children(".dynamic-fieldset-input").children(".file-load-box").length) {
        var inputType = jQuery(this.ActiveFieldset).children(Modal).children(".admin-modal-content").children(".admin-modal-body").children("ul").children(".dynamic-fieldset-input").children("input").first();
        var value = inputType.val();
      }

      if (value !== "" && inputType.attr('type') == 'hidden') {
        if (jQuery(this.ActiveFieldset).children("img").length) {
          console.log(imgSrc);
          jQuery(this.ActiveFieldset).children("img").attr('src', imgSrc);
        } else {
          console.log(imgSrc);
          jQuery(this.ActiveFieldset).children("strong").replaceWith("<img src='" + imgSrc + "' />");
        }
      }

      if (value !== "" && inputType.attr('type') == 'text') {
        jQuery(this.ActiveFieldset).children("strong").text(value);
      }
    }
  }, {
    key: "handleTrumbowyg",
    value: function handleTrumbowyg() {
      jQuery(".ui-sortable").sortable({
        cancel: '.admin-modal-dynamic-fieldset,[contenteditable]'
      });
      jQuery(".fancy-textarea").trumbowyg({
        lang: "cs",
        btns: [['viewHTML'], ['undo', 'redo'], ['strong'], ['link'], ['unorderedList', 'orderedList']],
        removeformatPasted: true
      });
    }
  }, {
    key: "ajaxUpdate",
    value: function ajaxUpdate() {
      var self = this;
      jQuery(document).ajaxComplete(function () {
        self.DynamicFieldsetOpenButton = jQuery(".admin-modal-dynamic-fieldset-open");
        self.DynamicFieldsetModal = jQuery(".admin-modal-dynamic-fieldset");
        self.DynamicFieldsetClose = jQuery(".admin-modal-dynamic-fieldset-close");
        self.DynamicFieldsetCloseAfterEdit = jQuery(".admin-modal-dynamic-fieldset-close-close");
        self.DynamicFieldsetRemoveFieldButton = jQuery(".remove-fieldset");
        self.DynamicFieldsetAddFieldButton = jQuery(".btn-add-field");
        self.handleOpen();
        self.handleClose();
        self.handleRemove();
      });
    }
  }]);

  return DynamicFieldset;
}();

jQuery(function () {
  new IconPickerDynamic();
});

var IconPickerDynamic = /*#__PURE__*/function () {
  function IconPickerDynamic() {
    _classCallCheck(this, IconPickerDynamic);

    _defineProperty(this, "IconPickerDynamic", jQuery(".admin-modal"));

    _defineProperty(this, "IconPickerDynamicOpenButton", jQuery(".admin-modal-button-open"));

    _defineProperty(this, "IconPickerDynamicClose", jQuery(".admin-modal-close"));

    _defineProperty(this, "IconPreviewBox", jQuery(".icon-preview-box"));

    _defineProperty(this, "ActiveField", void 0);

    _defineProperty(this, "ActiveInput", jQuery(".icon-picker-field"));

    this.init();
  }

  _createClass(IconPickerDynamic, [{
    key: "init",
    value: function init() {
      //this.initRender();
      if (this.isIconPickerDynamic()) {
        //this.initRender();
        this.renderImagePreviewBox();
        this.handleOpen();
        this.handleClose();
        this.handleIconClick();
        this.ajaxUpdate();
      }
    } // --- Handles

  }, {
    key: "handleOpen",
    value: function handleOpen() {
      var self = this;
      jQuery(this.IconPickerDynamicOpenButton).click(function (e) {
        e.preventDefault(); //self.ActiveField = jQuery(this).closest(".icon-picker-field");

        self.ActiveInput = jQuery(this).closest(".icon-picker-field");
        jQuery(".icon-preview").removeClass("icon-preview-selected");
        jQuery(".icon-preview[data-icon-name*='" + self.getActiveInputValue() + "']").addClass("icon-preview-selected");
        self.openModal(self.IconPickerDynamic);
      });
      jQuery(this.IconPreviewBox).click(function (e) {
        e.preventDefault(); //self.ActiveField = jQuery(this).closest(".icon-picker-field");

        self.ActiveInput = jQuery(this).parent().children(".icon-picker-field");
        jQuery(".icon-preview").removeClass("icon-preview-selected");
        jQuery(".icon-preview[data-icon-name*='" + self.getActiveInputValue() + "']").addClass("icon-preview-selected");
        self.openModal(self.IconPickerDynamic);
      });
    }
  }, {
    key: "handleClose",
    value: function handleClose() {
      var self = this;
      self.IconPickerDynamic.click(function (e) {
        if (e.target == this) {
          e.preventDefault();
          self.closeModal(self.IconPickerDynamic);
        }
      });
      self.IconPickerDynamicClose.add(".admin-modal-button-close").click(function (e) {
        e.preventDefault();
        self.closeModal(self.IconPickerDynamic);
      });
    }
  }, {
    key: "handleIconClick",
    value: function handleIconClick() {
      self = this;
      jQuery(".icon-preview").click(function (e) {
        e.preventDefault();

        if (!jQuery(this).hasClass("icon-preview-selected")) {
          jQuery(".icon-preview").removeClass("icon-preview-selected");
          jQuery(this).addClass("icon-preview-selected");
          self.setInputValue(self.getSelectedIconValue());
          self.renderImagePreviewBox();
          self.handleOpen();
        }
      });
    }
  }, {
    key: "getInputValue",
    value: function getInputValue() {
      return jQuery(self.ActiveInput).val();
    }
  }, {
    key: "openModal",
    value: function openModal(Modal) {
      Modal.addClass("admin-modal-open");
    }
  }, {
    key: "closeModal",
    value: function closeModal(Modal) {
      Modal.removeClass("admin-modal-open");
    } // --- Getters

  }, {
    key: "getActiveInputValue",
    value: function getActiveInputValue() {
      return this.ActiveInput.val();
    }
  }, {
    key: "getSelectedIconValue",
    value: function getSelectedIconValue() {
      return jQuery(".icon-preview-selected").attr("data-icon-name");
    } // --- Setters

  }, {
    key: "setInputValue",
    value: function setInputValue(value) {
      return jQuery(self.ActiveInput).val(value);
    } // --- Issets

  }, {
    key: "isIconPickerDynamic",
    value: function isIconPickerDynamic() {
      return this.IconPickerDynamic.length;
    } // --- Renders

  }, {
    key: "renderImgTag",
    value: function renderImgTag() {
      var SelectedImage = this.getActiveInputValue();
      var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");

      if (typeof SelectedImageSrc !== 'undefined') {
        var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >'; //(".icon-preview-box").html(SelectedImageImgTag);
      }
    }
  }, {
    key: "renderIconPreviewBox",
    value: function renderIconPreviewBox() {
      var SelectedImage = this.getInputValue();
      var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");
      var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';

      if (SelectedImageSrc !== undefined) {
        var imagePreviewBox = '<div class="icon-preview-box">' + '<img src="' + SelectedImageSrc + ' " ></div>';
        jQuery(this.ActiveInput).parent().append(imagePreviewBox);
        this.hideTextInput();
      } else {
        jQuery(".icon-picker-field").each(function () {
          var SelectedImageFromInput = jQuery(this).val();

          if (SelectedImageFromInput !== "") {
            var imagePreviewBoxFromInput = '<div class="icon-preview-box">' + '<img src="' + location.protocol + '//' + location.host + '/wp-content/themes/atmos/images/advantages-ico/' + SelectedImageFromInput + ' " ></div>';
            jQuery(this).parent().append(imagePreviewBoxFromInput);
            jQuery(this).hide();
          }
        });
      } //jQuery(this.ActiveInput).closest("li").children(".icon-preview-box").append(SelectedImageImgTag);

    }
  }, {
    key: "renderImagePreviewBox",
    value: function renderImagePreviewBox() {
      //var SelectedImage = this.getInputValue();
      //var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");
      jQuery(this.ActiveInput).parent().children(".icon-preview-box").remove();
      this.renderIconPreviewBox();
      this.IconPreviewBox = jQuery(".icon-preview-box"); //var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';
      //console.log(SelectedImageImgTag);
      //jQuery(this.ActiveInput).closest("li").children(".icon-preview-box").append(SelectedImageImgTag);
      //this.hideTextInput();
    }
  }, {
    key: "hideTextInput",
    value: function hideTextInput() {
      jQuery(this.ActiveInput).hide();
    }
  }, {
    key: "initRender",
    value: function initRender() {
      this.hideTextInput();
      this.renderImagePreviewBox();
    }
  }, {
    key: "renderImgTagInit",
    value: function renderImgTagInit() {
      jQuery(this.ActiveInput).each(function () {
        if (jQuery(this).val()) {
          var SelectedImage = jQuery(this).val();
          var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");

          if (typeof SelectedImageSrc !== 'undefined') {
            var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >'; //(".icon-preview-box").html(SelectedImageImgTag);
          }
        }
      });
    } // -- AjaxUpdate

  }, {
    key: "ajaxUpdate",
    value: function ajaxUpdate() {
      var self = this;
      jQuery(document).ajaxComplete(function () {
        self.IconPickerDynamicOpenButton = jQuery(".admin-modal-button-open");
        self.IconPreviewBox = jQuery(".icon-preview-box");
        self.handleOpen();
        self.handleClose();
        self.handleIconClick();
      });
    }
  }]);

  return IconPickerDynamic;
}();

(function () {
  var fancyArea = ".fancy-textarea";
  document.addEventListener("DOMContentLoaded", function (event) {
    init();
  });

  function init() {
    if (isFancyTextarea() && isTrumowygLibrary()) {
      jQuery(fancyArea).trumbowyg({
        lang: "cs",
        btns: [['viewHTML'], ['undo', 'redo'], ['strong'], ['link'], ['unorderedList', 'orderedList']],
        removeformatPasted: true
      });
    }
  }

  function isTrumowygLibrary() {
    return typeof jQuery(fancyArea).trumbowyg !== "undefined";
  }

  function isFancyTextarea() {
    return jQuery(fancyArea).length;
  }
})();

(function () {
  var fancyArea = ".fancy-textarea-minimal";
  document.addEventListener("DOMContentLoaded", function (event) {
    init();
  });

  function init() {
    if (isFancyTextarea() && isTrumowygLibrary()) {
      jQuery(fancyArea).trumbowyg({
        lang: "cs",
        btns: [['viewHTML'], ['undo', 'redo'], ['strong'], ['link']],
        removeformatPasted: true
      });
    }
  }

  function isTrumowygLibrary() {
    return typeof jQuery(fancyArea).trumbowyg !== "undefined";
  }

  function isFancyTextarea() {
    return jQuery(fancyArea).length;
  }
})();
//# sourceMappingURL=extraAdmin.js.map
