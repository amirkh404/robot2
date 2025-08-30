document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll(".otp-input");

    inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if(e.key === "Backspace" && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    const form = document.getElementById("otp-form");
    if (form) {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            const code = Array.from(inputs).map(i => i.value).join('');
            document.getElementById('code').value = code;
            this.submit();
        });
    }
});