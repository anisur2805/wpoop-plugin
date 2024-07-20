window.addEventListener("load", function (e) {
    const form = document.getElementById("testimonial-form");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // reset all error
        reset_message();

        // collect all data
        const data = {
            name: form.querySelector('[name="name"]').value,
            email: form.querySelector('[name="email"]').value,
            message: form.querySelector('[name="message"]').value,
            nonce: form.querySelector('[name="nonce"]').value,
        };

        // validate fields
        if (!data.name) {
            form.querySelector('[data-error="invalidName"]').classList.add(
                "show"
            );
            return;
        }

        if (!data.email) {
            form.querySelector('[data-error="invalidEmail"]').classList.add(
                "show"
            );
            return;
        }

        if (!data.message) {
            form.querySelector('[data-error="invalidMessage"]').classList.add(
                "show"
            );
            return;
        }

        // ajax handle
        const url = form.dataset.url;
        const params = new URLSearchParams(new FormData(form));

        fetch(url, {
            method: "POST",
            body: params,
        })
            .then((res) => res.json())
            .catch((err) => {
                reset_message();

                form.querySelector(".js-form-error").classList.add("show");
            })
            .then((res) => {
                reset_message();

                if ( res === 0 || res.status === 'error' ) {
                    form.querySelector(".js-form-error").classList.add("show");
                    return;
                }

                form.reset();
                form.querySelector(".js-form-success").classList.add("show");
            });
    });

    function reset_message() {
        document
            .querySelectorAll(".field-message")
            .forEach((f) => f.classList.remove("show"));
    }
});
