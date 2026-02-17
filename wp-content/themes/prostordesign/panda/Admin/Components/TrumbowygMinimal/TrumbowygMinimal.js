(function() {
    let fancyArea = ".fancy-textarea-minimal";

    document.addEventListener("DOMContentLoaded", function(event) {
        init();
    });

    function init() {
        if (isFancyTextarea() && isTrumowygLibrary()) {
            jQuery(fancyArea).trumbowyg({
                lang: "cs",
                btns: [
                    ['viewHTML'],
                    ['undo', 'redo'],
                    ['strong'],
                    ['link'],
                ],
                removeformatPasted: true,
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