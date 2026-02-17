jQuery(function () {
	(new IconPickerDynamic);
});


class IconPickerDynamic {

	IconPickerDynamic = jQuery(".admin-modal");
	IconPickerDynamicOpenButton = jQuery(".admin-modal-button-open");
	IconPickerDynamicClose = jQuery(".admin-modal-close");
	IconPreviewBox = jQuery(".icon-preview-box");

	ActiveField;
	ActiveInput = jQuery(".icon-picker-field");

	constructor() {

		this.init();
	}

	init() {
			//this.initRender();

		if (this.isIconPickerDynamic()) {
      //this.initRender();
      this.renderImagePreviewBox();
      this.handleOpen();
			this.handleClose();
			this.handleIconClick();
			this.ajaxUpdate();
		}
	}

	// --- Handles

	handleOpen() {
		let self = this;
		jQuery(this.IconPickerDynamicOpenButton).click(function (e) {
			e.preventDefault();
			//self.ActiveField = jQuery(this).closest(".icon-picker-field");
			self.ActiveInput = jQuery(this).closest(".icon-picker-field");
			jQuery(".icon-preview").removeClass("icon-preview-selected");
			jQuery(".icon-preview[data-icon-name*='" + self.getActiveInputValue() + "']").addClass("icon-preview-selected");

			self.openModal(self.IconPickerDynamic);

		});

    jQuery(this.IconPreviewBox).click(function (e) {
      e.preventDefault();
      //self.ActiveField = jQuery(this).closest(".icon-picker-field");
      self.ActiveInput = jQuery(this).parent().children(".icon-picker-field");
      jQuery(".icon-preview").removeClass("icon-preview-selected");
      jQuery(".icon-preview[data-icon-name*='" + self.getActiveInputValue() + "']").addClass("icon-preview-selected");

      self.openModal(self.IconPickerDynamic);

    });

	}

	handleClose() {
		let self = this;

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

	handleIconClick() {
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

	getInputValue() {
		return jQuery(self.ActiveInput).val();
	}

	openModal(Modal) {
		Modal.addClass("admin-modal-open");
	}

	closeModal(Modal) {
		Modal.removeClass("admin-modal-open");
	}



	// --- Getters

	getActiveInputValue() {
		return this.ActiveInput.val();
	}

	getSelectedIconValue() {
		return jQuery(".icon-preview-selected").attr("data-icon-name");
	}


	// --- Setters

	setInputValue(value) {
		return jQuery(self.ActiveInput).val(value);
	}

	// --- Issets

	isIconPickerDynamic() {
		return this.IconPickerDynamic.length;
	}


	// --- Renders

	renderImgTag() {
		let SelectedImage = this.getActiveInputValue();
		let SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");

		if (typeof SelectedImageSrc !== 'undefined') {
			var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';
			//(".icon-preview-box").html(SelectedImageImgTag);
		}

	}

	renderIconPreviewBox() {
		var SelectedImage = this.getInputValue();
		var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");
    var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';
		if (SelectedImageSrc !== undefined) {
		var imagePreviewBox =
			'<div class="icon-preview-box">' +
			'<img src="' + SelectedImageSrc + ' " ></div>';
		jQuery(this.ActiveInput).parent().append(imagePreviewBox);
		this.hideTextInput();
    } else {
      jQuery( ".icon-picker-field" ).each(function() {
        var SelectedImageFromInput = jQuery( this ).val();
        if (SelectedImageFromInput !== "") {
          var imagePreviewBoxFromInput =
            '<div class="icon-preview-box">' +
            '<img src="'+ location.protocol + '//' + location.host +'/wp-content/themes/atmos/images/advantages-ico/' + SelectedImageFromInput + ' " ></div>';
          jQuery(this).parent().append(imagePreviewBoxFromInput);
          jQuery(this).hide();
        }
      });
    }
    //jQuery(this.ActiveInput).closest("li").children(".icon-preview-box").append(SelectedImageImgTag);
	}

	renderImagePreviewBox() {
		//var SelectedImage = this.getInputValue();
		//var SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");

			jQuery(this.ActiveInput).parent().children(".icon-preview-box").remove();
			this.renderIconPreviewBox();
			this.IconPreviewBox = jQuery(".icon-preview-box");
			//var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';
			//console.log(SelectedImageImgTag);
			//jQuery(this.ActiveInput).closest("li").children(".icon-preview-box").append(SelectedImageImgTag);
			//this.hideTextInput();


	}

	hideTextInput() {
		jQuery(this.ActiveInput).hide();
	}


	initRender() {
		this.hideTextInput();
		this.renderImagePreviewBox();
	}

	renderImgTagInit() {
		jQuery(this.ActiveInput).each(function () {
			if (jQuery(this).val()) {
				let SelectedImage = jQuery(this).val();
				let SelectedImageSrc = jQuery(".icon-preview[data-icon-name*='" + SelectedImage + "']").children("img").attr("src");

				if (typeof SelectedImageSrc !== 'undefined') {
					var SelectedImageImgTag = '<img src="' + SelectedImageSrc + ' " >';
					//(".icon-preview-box").html(SelectedImageImgTag);
				}
			}

		});

	}


	// -- AjaxUpdate

	ajaxUpdate() {
		let self = this;
		jQuery(document).ajaxComplete(function () {
			self.IconPickerDynamicOpenButton = jQuery(".admin-modal-button-open");
			self.IconPreviewBox = jQuery(".icon-preview-box");

			self.handleOpen();
			self.handleClose();
			self.handleIconClick();
		});
	}

}
