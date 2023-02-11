document.getElementById("alert-button").addEventListener("click", function () {
    Swal.fire({
        title: "Submit your Github username",
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Look up",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(`//api.github.com/users/${login}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch((error) => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Success!",
                text: "Data has been submitted",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Go to Next Page",
            }).then((result) => {
                if (result.value) {
                    window.location.href = "/next-page";
                }
            });
        }
    });
});
