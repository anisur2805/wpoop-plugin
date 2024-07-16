window.addEventListener("load", function () {
    var tabs = document.querySelectorAll(".nav-tabs > li");

    for (i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(e) {
        e.preventDefault();

        var clickedTab = e.currentTarget;
        var anchor = e.target;
        var activePaneID = anchor.getAttribute("href");

        document
            .querySelector(".nav-tabs > li.active")
            .classList.remove("active");
        document
            .querySelector(".tab-content .tab-pane.active")
            .classList.remove("active");

        clickedTab.classList.add("active");
        document.querySelector(activePaneID).classList.add("active");
    }
});

jQuery(document).ready(function ($) {
    $(document).on("click", ".js-image-upload", function (e) {
        e.preventDefault();
        var $button = $(this);

        var file_frame = (wp.media.frames.file_frame = wp.media({
            title: "Select Image",
            library: {
                type: "image",
            },
            button: {
                text: "Choose Image",
            },
            multiple: false,
        }));

        file_frame.on("select", function () {
            var attachment = file_frame
                .state()
                .get("selection")
                .first()
                .toJSON();
            $button.siblings(".image-upload").val(attachment.url);
        });

        file_frame.open();
    });
});
