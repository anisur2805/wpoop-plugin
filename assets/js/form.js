window.addEventListener("load", function (e) {
    const form = document.getElementById("testimonial-form");

    form.addEventListener("submit", (e) =>   {
        e.preventDefault();

        // reset all error
        reset_message();

        // collect all data
        const data = {
            name: form.querySelector('[name="name"]').value,
            email: form.querySelector('[name="email"]').value,
            message: form.querySelector('[name="message"]').value,
        };
        
        console.log( data.name )
        console.log( form.querySelector('[data-error="invalidName"]') )
        // validate fields
        if( ! data.name) {
            form.querySelector('[data-error="invalidName"]').classList.add('show');
            return;
        }
        
        if( ! data.email) {
            form.querySelector('[data-error="invalidEmail"]').classList.add('show');
            return;
        }

        if( ! data.message) {
            form.querySelector('[data-error="invalidMessage"]').classList.add('show');
            return;
        }

    });

    function reset_message() {
        document.querySelectorAll(".field-message").forEach((f) =>
            f.classList.remove("show")
        );
    }
});
