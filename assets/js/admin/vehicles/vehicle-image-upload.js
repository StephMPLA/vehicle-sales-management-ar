document.addEventListener('DOMContentLoaded', () => {

    const config = document.getElementById('imageUploadConfig');
    if (!config) return;

    const uploadUrl = config.dataset.uploadUrl;
    const uploadCsrf = config.dataset.uploadCsrf;

    const fileInput = document.getElementById('imgFile');
    const typeSelect = document.getElementById('imgType');
    const uploadBtn = document.getElementById('uploadBtn');
    const grid = document.getElementById('currentImagesGrid');

    function refreshUploadButton() {
        uploadBtn.disabled = fileInput.files.length === 0;
    }

    fileInput.addEventListener('change', refreshUploadButton);

    uploadBtn.addEventListener('click', async () => {

        const file = fileInput.files[0];
        if (!file) return;

        uploadBtn.disabled = true;

        const fd = new FormData();
        fd.append('file', file);
        fd.append('type', typeSelect.value);

        const response = await fetch(uploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': uploadCsrf
            },
            body: fd
        });

        const data = await response.json();

        if (!response.ok || !data.ok) {
            alert(data.error ?? 'Upload failed');
            refreshUploadButton();
            return;
        }

        grid.insertAdjacentHTML('afterbegin', data.html);

        fileInput.value = '';
        refreshUploadButton();
    });

});
