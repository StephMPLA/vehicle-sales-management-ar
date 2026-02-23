document.addEventListener('DOMContentLoaded', () => {

    const input = document.querySelector(
        'input[type="file"][name$="[model3dFile]"]'
    );

    if (!input) return;

    input.addEventListener('change', () => {

        const file = input.files[0];
     });
});
