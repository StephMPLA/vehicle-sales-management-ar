document.addEventListener('click', async (e) => {

    const btn = e.target.closest('.delete-image');
    if (!btn) return;

    if (!confirm('Delete image ?')) return;

    const deleteUrl = btn.dataset.deleteUrl;
    const csrf = btn.dataset.csrf;

    if (!deleteUrl || !csrf) {
        console.error('Missing delete data');
        return;
    }

    try {

        const response = await fetch(deleteUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        });

        const data = await response.json();

        if (!response.ok || !data.ok) {
            throw new Error(data.error ?? 'Delete failed');
        }

        btn.closest('[data-image-id]')?.remove();

    } catch (err) {
        console.error(err);
        alert('Delete failed');
    }
});
