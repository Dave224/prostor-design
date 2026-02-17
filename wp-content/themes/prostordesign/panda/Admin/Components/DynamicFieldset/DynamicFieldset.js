jQuery(function () {
    (new DynamicFieldset);
});

class DynamicFieldset {

    DynamicFieldsetModal = jQuery(".admin-modal-dynamic-fieldset");
    DynamicFieldsetOpenButton = jQuery(".admin-modal-dynamic-fieldset-open");
    DynamicFieldsetClose = jQuery(".admin-modal-dynamic-fieldset-close");
    DynamicFieldsetCloseAfterEdit = jQuery(".admin-modal-dynamic-fieldset-close-close");
    DynamicFieldsetRemoveFieldButton = jQuery(".remove-fieldset");
    DynamicFieldsetAddFieldButton = jQuery(".btn-add-field");

    ActiveFieldset = jQuery(".fieldset-field-item");

    constructor() {

        this.init();
    }

    init() {
        if (this.isDynamicFieldset()) {
            this.handleOpen();
            this.handleClose();
            this.handleRemove();
            this.handleAdd();
            this.ajaxUpdate();
        }
    }

    handleOpen() {
        let self = this;
        jQuery(this.DynamicFieldsetOpenButton).click(function (e) {
            e.preventDefault();
            self.ActiveFieldset = jQuery(this).closest(".fieldset-field-item");
            self.DynamicFieldsetModal = jQuery(self.ActiveFieldset).children(".admin-modal-dynamic-fieldset");
            self.openModal(self.DynamicFieldsetModal);
        });
    }

    handleClose() {
        let self = this;

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

    openModal(Modal) {
        Modal.addClass("admin-modal-open");
        this.handleTrumbowyg();
    }

    closeModal(Modal) {
        this.handleEdit(Modal);
        Modal.removeClass("admin-modal-open");
    }

    // --- Issets

    isDynamicFieldset() {
        return this.DynamicFieldsetModal.length;
    }

    handleRemove() {
        jQuery(this.DynamicFieldsetRemoveFieldButton).click(function (e) {
            e.preventDefault();
            jQuery(this).closest("li").remove();
        });
    }

    handleAdd() {
        jQuery(this.DynamicFieldsetAddFieldButton).click(function(e) {
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

    handleEdit(Modal) {
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
                jQuery(this.ActiveFieldset).children("strong").replaceWith("<img src='"+imgSrc+"' />");
            }
        }

        if (value !== "" && inputType.attr('type') == 'text') {
            jQuery(this.ActiveFieldset).children("strong").text(value);
        }
    }


    handleTrumbowyg() {
        jQuery(".ui-sortable").sortable({
            cancel: '.admin-modal-dynamic-fieldset,[contenteditable]'
        });
        jQuery(".fancy-textarea").trumbowyg({
            lang: "cs",
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['strong'],
                ['link'],
                ['unorderedList', 'orderedList'],
            ],
            removeformatPasted: true,
        });
    }

    ajaxUpdate() {
        let self = this;
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
}
