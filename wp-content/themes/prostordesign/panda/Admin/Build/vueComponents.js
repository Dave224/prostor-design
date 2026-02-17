"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = {
  props: {
    Slide: {
      type: Object,
      required: true
    }
  }
};
if (module.exports.__esModule) module.exports = module.exports.default;
(typeof module.exports === "function" ? module.exports.options : module.exports).template = "\n<li v-bind:key=\"Slide.Id\" :data-id=\"Slide.Id\">\n  <span>{{ Slide.Title }}</span>\n  <a v-if=\"Item.UrlEdit\" :href=\"Slide.UrlEdit\" target=\"_blank\">{{ Text.ItemEdit }}</a>\n  <button class=\"btn-item-delete\" @click=\"$emit('remove', Slide.Id)\">{{ Text.ItemDelete }}</button>\n</li>\n";

if (module.hot) {
  (function () {
    module.hot.accept();

    var hotAPI = require("vue-hot-reload-api");

    hotAPI.install(require("vue"), true);
    if (!hotAPI.compatible) return;

    if (!module.hot.data) {
      hotAPI.createRecord("_v-5a9ef9de", module.exports);
    } else {
      hotAPI.update("_v-5a9ef9de", module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template);
    }
  })();
}
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = {
  data: {
    SelectedItem: "",
    Text: undefined.getTextData(),
    Slides: undefined.getSlidesAll(),
    SelectedSlides: [],
    SelectedSlidesIds: undefined.getSelectedIds()
  },
  computed: {
    dragOptions: function dragOptions() {
      return {
        animation: 300,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },
  methods: {
    removeSlide: function removeSlide(Index) {
      this.$delete(this.SelectedSlides, index);
    },
    addSlide: function addSlide(Slide) {
      if (Slide === "") {
        return;
      }

      this.SelectedSlides.push(Slide);
    }
  }
};
if (module.exports.__esModule) module.exports = module.exports.default;
(typeof module.exports === "function" ? module.exports.options : module.exports).template = "\n<div id=\"slidesField\">\n  <div class=\"select-row\">\n    <select v-model=\"SelectedItem\">\n      <option v-for=\"Slide in Slides\" v-bind:key=\"Slide.Id\" v-bind:value=\"Slide\">{{ Slide.Title }}</option>\n    </select>\n\n    <button class=\"btn-add-block\" @click=\"addSlide(SelectedItem)\">{{ Text.AddSlide }}</button>\n  </div>\n\n  <input type=\"text\" v-model=\"SelectedSlidesIds\" name=\"\">\n\n  <draggable class=\"sortable-field-list\" tag=\"ul\" v-bind=\"dragOptions\" v-model=\"SelectedSlides\">\n    <li v-for=\"(Slide, Index) in SelectedSlides\" v-bind:key=\"Slide.Id\" :data-id=\"Slide.Id\">\n      <span>{{ Slide.Title }}</span>\n      <a v-if=\"Item.UrlEdit\" :href=\"Slide.UrlEdit\" target=\"_blank\">{{ Text.ItemEdit }}</a>\n      <button class=\"btn-item-delete\" @click=\"removeSlide(Index)\">{{ Text.ItemDelete }}</button>\n    </li>\n  </draggable>\n</div>\n";

if (module.hot) {
  (function () {
    module.hot.accept();

    var hotAPI = require("vue-hot-reload-api");

    hotAPI.install(require("vue"), true);
    if (!hotAPI.compatible) return;

    if (!module.hot.data) {
      hotAPI.createRecord("_v-f4df0ab0", module.exports);
    } else {
      hotAPI.update("_v-f4df0ab0", module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template);
    }
  })();
}