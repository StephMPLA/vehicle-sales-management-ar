document.addEventListener('DOMContentLoaded', () => {

    const root = document.getElementById('model3dManager');
    if (!root) return;

    const stateUrl = root.dataset.stateUrl;
    const uploadUrl = root.dataset.uploadUrl;
    const deleteUrl = root.dataset.deleteUrl;
    const csrf = root.dataset.csrf;

    const fileInput = document.getElementById('model3dFile');
    const uploadBtn = document.getElementById('model3dUploadBtn');
    const deleteBtn = document.getElementById('model3dDeleteBtn');

    const info = document.getElementById('model3dInfo');
    const viewerWrapper = document.getElementById('model3dViewerWrapper');
    const viewer = document.getElementById('model3dViewer');

    const errorBox = document.getElementById('model3dError');
    const status = document.getElementById('model3dStatus');

    function setError(msg) {
        if (!errorBox) return;
        if (!msg) {
            errorBox.classList.add('hidden');
            errorBox.textContent = '';
            return;
        }
        errorBox.textContent = msg;
        errorBox.classList.remove('hidden');
    }

    function setStatus(msg) {
        if (!status) return;
        status.textContent = msg ?? '';
    }

    function setHasModel(hasModel, path) {
        if (hasModel) {
            info?.classList.remove('hidden');
            viewerWrapper?.classList.remove('hidden');
            if (viewer && path) viewer.setAttribute('src', path);
        } else {
            info?.classList.add('hidden');
            viewerWrapper?.classList.add('hidden');
            if (viewer) viewer.setAttribute('src', '');
        }
    }

    async function refreshState() {
        setError('');
        try {
            const res = await fetch(stateUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
            const data = await res.json();
            setHasModel(!!data.hasModel, data.path);
        } catch (e) {
            console.error(e);
            setError('Unable to load model state');
        }
    }

    // Enable upload button when a file is selected
    fileInput?.addEventListener('change', () => {
        setError('');
        const file = fileInput.files?.[0];
        uploadBtn.disabled = !file;
    });

    // Upload
    uploadBtn?.addEventListener('click', async () => {
        setError('');
        const file = fileInput.files?.[0];
        if (!file) return;

        if (!file.name.toLowerCase().endsWith('.glb')) {
            setError('Invalid format: only .glb');
            return;
        }

        try {
            uploadBtn.disabled = true;
            setStatus('Uploading...');

            const fd = new FormData();
            fd.append('file', file);

            const res = await fetch(uploadUrl, {
                method: 'POST',
                body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await res.json().catch(() => null);

            if (!res.ok || !data?.ok) {
                setError(data?.error ?? 'Upload failed');
                return;
            }

            fileInput.value = '';
            setStatus('Uploaded ✅');
            await refreshState();

        } catch (e) {
            console.error(e);
            setError('Network error');
        } finally {
            uploadBtn.disabled = true;
            setTimeout(() => setStatus(''), 1500);
        }
    });

    // Delete
    deleteBtn?.addEventListener('click', async () => {
        setError('');
        if (!confirm('Delete 3D model?')) return;

        try {
            setStatus('Deleting...');

            const res = await fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            const data = await res.json().catch(() => null);

            if (!res.ok || !data?.ok) {
                setError(data?.error ?? 'Delete failed');
                return;
            }

            setStatus('Deleted ✅');
            await refreshState();

        } catch (e) {
            console.error(e);
            setError('Network error');
        } finally {
            setTimeout(() => setStatus(''), 1500);
        }
    });

    // Initial load
    refreshState();
});
