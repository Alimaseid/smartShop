!(function (l) {
    "use strict";
    function e() {}
    (e.prototype.initSelect2 = function () {
        l('[data-toggle="select2"]').select3();
    }),
        (e.prototype.initMaxLength = function () {
            l("input#defaultconfig").maxlength({
                warningClass: "badge bg-success",
                limitReachedClass: "badge bg-danger",
            }),
                l("input#thresholdconfig").maxlength({
                    threshold: 20,
                    warningClass: "badge bg-success",
                    limitReachedClass: "badge bg-danger",
                }),
                l("input#alloptions").maxlength({
                    alwaysShow: !0,
                    separator: " out of ",
                    preText: "You typed ",
                    postText: " chars available.",
                    validate: !0,
                    warningClass: "badge bg-success",
                    limitReachedClass: "badge bg-danger",
                }),
                l("textarea#textarea").maxlength({
                    alwaysShow: !0,
                    warningClass: "badge bg-success",
                    limitReachedClass: "badge bg-danger",
                }),
                l("input#placement").maxlength({
                    alwaysShow: !0,
                    placement: "top-left",
                    warningClass: "badge bg-success",
                    limitReachedClass: "badge bg-danger",
                });
        }),
        (e.prototype.initSelectize = function () {
            l("#selectize-tags").selectize({
                persist: !1,
                createOnBlur: !0,
                create: !0,
            }),
                l("#selectize-select").selectize({
                    create: !0,
                    sortField: { field: "text", direction: "asc" },
                    dropdownParent: "body",
                }),
                l("#selectize-maximum").selectize({ maxItems: 3 }),
                l("#selectize-links").selectize({
                    theme: "links",
                    maxItems: null,
                    valueField: "id",
                    searchField: "title",
                    options: [
                        {
                            id: 1,
                            title: "Coderthemes",
                            url: "https://coderthemes.com/",
                        },
                        { id: 2, title: "Google", url: "http://google.com" },
                        { id: 3, title: "Yahoo", url: "http://yahoo.com" },
                    ],
                    render: {
                        option: function (e, t) {
                            return (
                                '<div class="option"><span class="title">' +
                                t(e.title) +
                                '</span><span class="url">' +
                                t(e.url) +
                                "</span></div>"
                            );
                        },
                        item: function (e, t) {
                            return (
                                '<div class="item"><a href="' +
                                t(e.url) +
                                '">' +
                                t(e.title) +
                                "</a></div>"
                            );
                        },
                    },
                    create: function (e) {
                        return { id: 0, title: e, url: "#" };
                    },
                }),
                l("#selectize-confirm").selectize({
                    delimiter: ",",
                    persist: !1,
                    onDelete: function (e) {
                        return confirm(
                            1 < e.length
                                ? "Are you sure you want to remove these " +
                                      e.length +
                                      " items?"
                                : 'Are you sure you want to remove "' +
                                      e[0] +
                                      '"?'
                        );
                    },
                }),
                l("#selectize-optgroup").selectize({ sortField: "text" }),
                l("#selectize-programmatic").selectize({
                    options: [
                        { class: "mammal", value: "dog", name: "Dog" },
                        { class: "mammal", value: "cat", name: "Cat" },
                        { class: "mammal", value: "horse", name: "Horse" },
                        {
                            class: "mammal",
                            value: "kangaroo",
                            name: "Kangaroo",
                        },
                        { class: "bird", value: "duck", name: "Duck" },
                        { class: "bird", value: "chicken", name: "Chicken" },
                        { class: "bird", value: "ostrich", name: "Ostrich" },
                        { class: "bird", value: "seagull", name: "Seagull" },
                        { class: "reptile", value: "snake", name: "Snake" },
                        { class: "reptile", value: "lizard", name: "Lizard" },
                        {
                            class: "reptile",
                            value: "alligator",
                            name: "Alligator",
                        },
                        { class: "reptile", value: "turtle", name: "Turtle" },
                    ],
                    optgroups: [
                        {
                            value: "mammal",
                            label: "Mammal",
                            label_scientific: "Mammalia",
                        },
                        {
                            value: "bird",
                            label: "Bird",
                            label_scientific: "Aves",
                        },
                        {
                            value: "reptile",
                            label: "Reptile",
                            label_scientific: "Reptilia",
                        },
                    ],
                    optgroupField: "class",
                    labelField: "name",
                    searchField: ["name"],
                    render: {
                        optgroup_header: function (e, t) {
                            return (
                                '<div class="optgroup-header">' +
                                t(e.label) +
                                ' <span class="scientific">(' +
                                t(e.label_scientific) +
                                ")</span></div>"
                            );
                        },
                    },
                }),
                l("#selectize-optgroup-column").selectize({
                    options: [
                        { id: "avenger", make: "dodge", model: "Avenger" },
                        { id: "caliber", make: "dodge", model: "Caliber" },
                        {
                            id: "caravan-grand-passenger",
                            make: "dodge",
                            model: "Caravan Grand Passenger",
                        },
                        {
                            id: "challenger",
                            make: "dodge",
                            model: "Challenger",
                        },
                        { id: "ram-1500", make: "dodge", model: "Ram 1500" },
                        { id: "viper", make: "dodge", model: "Viper" },
                        { id: "a3", make: "audi", model: "A3" },
                        { id: "a6", make: "audi", model: "A6" },
                        { id: "r8", make: "audi", model: "R8" },
                        { id: "rs-4", make: "audi", model: "RS 4" },
                        { id: "s4", make: "audi", model: "S4" },
                        { id: "s8", make: "audi", model: "S8" },
                        { id: "tt", make: "audi", model: "TT" },
                        {
                            id: "avalanche",
                            make: "chevrolet",
                            model: "Avalanche",
                        },
                        { id: "aveo", make: "chevrolet", model: "Aveo" },
                        { id: "cobalt", make: "chevrolet", model: "Cobalt" },
                        {
                            id: "silverado",
                            make: "chevrolet",
                            model: "Silverado",
                        },
                        {
                            id: "suburban",
                            make: "chevrolet",
                            model: "Suburban",
                        },
                        { id: "tahoe", make: "chevrolet", model: "Tahoe" },
                        {
                            id: "trail-blazer",
                            make: "chevrolet",
                            model: "TrailBlazer",
                        },
                    ],
                    optgroups: [
                        { $order: 3, id: "dodge", name: "Dodge" },
                        { $order: 2, id: "audi", name: "Audi" },
                        { $order: 1, id: "chevrolet", name: "Chevrolet" },
                    ],
                    labelField: "model",
                    valueField: "id",
                    optgroupField: "make",
                    optgroupLabelField: "name",
                    optgroupValueField: "id",
                    lockOptgroupOrder: !0,
                    searchField: ["model"],
                    plugins: ["optgroup_columns"],
                    openOnFocus: !1,
                }),
                l(".selectize-close-btn").selectize({
                    plugins: ["remove_button"],
                    persist: !1,
                    create: !0,
                    render: {
                        item: function (e, t) {
                            return '<div>"' + t(e.text) + '"</div>';
                        },
                    },
                    onDelete: function (e) {
                        return confirm(
                            1 < e.length
                                ? "Are you sure you want to remove these " +
                                      e.length +
                                      " items?"
                                : 'Are you sure you want to remove "' +
                                      e[0] +
                                      '"?'
                        );
                    },
                }),
                l(".selectize-drop-header").selectize({
                    sortField: "text",
                    hideSelected: !1,
                    plugins: { dropdown_header: { title: "Language" } },
                });
        }),
        (e.prototype.initSwitchery = function () {
            l('[data-plugin="switchery"]').each(function (e, t) {
                new Switchery(l(this)[0], l(this).data());
            });
        }),
        (e.prototype.initMultiSelect = function () {
            0 < l('[data-plugin="multiselect"]').length &&
                l('[data-plugin="multiselect"]').multiSelect(l(this).data()),
                l("#my_multi_select3").multiSelect({
                    selectableHeader:
                        "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader:
                        "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (e) {
                        var t = this,
                            a = t.$selectableUl.prev(),
                            i = t.$selectionUl.prev(),
                            l =
                                "#" +
                                t.$container.attr("id") +
                                " .ms-elem-selectable:not(.ms-selected)",
                            o =
                                "#" +
                                t.$container.attr("id") +
                                " .ms-elem-selection.ms-selected";
                        (t.qs1 = a.quicksearch(l).on("keydown", function (e) {
                            if (40 === e.which)
                                return t.$selectableUl.focus(), !1;
                        })),
                            (t.qs2 = i
                                .quicksearch(o)
                                .on("keydown", function (e) {
                                    if (40 == e.which)
                                        return t.$selectionUl.focus(), !1;
                                }));
                    },
                    afterSelect: function () {
                        this.qs1.cache(), this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache(), this.qs2.cache();
                    },
                });
        }),
        (e.prototype.initTouchspin = function () {
            var i = {};
            l('[data-toggle="touchspin"]').each(function (e, t) {
                var a = l.extend({}, i, l(t).data());
                l(t).TouchSpin(a);
            });
        }),
        (e.prototype.init = function () {
            this.initSelect2(),
                this.initMaxLength(),
                this.initSelectize(),
                this.initSwitchery(),
                this.initMultiSelect(),
                this.initTouchspin();
        }),
        (l.FormAdvanced = new e()),
        (l.FormAdvanced.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.FormAdvanced.init();
    })();
