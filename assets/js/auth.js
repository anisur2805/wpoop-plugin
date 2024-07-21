document.addEventListener("DOMContentLoaded", () => {
    let loginBtn = document.querySelector(".auth-btn-container input"),
        authForm = document.querySelector("#wpoop-auth-form"),
        closeIcon = document.querySelector("#close"),
        status = document.querySelector('.status');

    console.log( 'status', status )

    loginBtn.addEventListener("click", () => {
        authForm.classList.add("show");
        loginBtn.parentElement.classList.add("hide");
    });

    closeIcon.addEventListener("click", () => {
        authForm.classList.remove("show");
        loginBtn.parentElement.classList.remove("hide");
    });

    authForm.addEventListener("submit", (e) => {
        e.preventDefault();

        // reset all error
        reset_message();

        // collect all data
        const data = {
            name: authForm.querySelector('[name="username"]').value,
            password: authForm.querySelector('[name="password"]').value,
            security: authForm.querySelector('[name="security"]').value,
        };

        // validate fields
        if (!data.name || !data.password) {
            status.innerHTML = "Missing data";
            status.classList.add("error");
            return;
        }

        let url = authForm.dataset.url,
            params = new URLSearchParams(new FormData(authForm));

        authForm.querySelector('[name="login"]').value = "Logging in...";
        authForm.querySelector('[name="login"]').disabled = true;

        fetch(url, {
            body: params,
            method: "POST",
        })
            .then((res) => res.json())
            .catch((err) => {
                reset_message();
            })
            .then((response) => {
                reset_message();

                if (response === 0 || !response.status) {
                    status.innerHTML = response.message;
                    status.classList.add("error");

                    authForm.querySelector('[name="login"]').value = "Log in";
                    authForm.querySelector('[name="login"]').disabled = false;

                    return;
                }

                console.log( response )

                status.innerHTML = response.message;
                status.classList.add("success");
                authForm.reset();

                window.location.reload();
            });
    });

    function reset_message() {
        authForm
            .querySelector(".status").classList.remove("show")
    }
});
