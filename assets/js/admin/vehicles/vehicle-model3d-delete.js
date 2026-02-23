document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('deleteModelBtn');
    if (!btn) return;

    btn.addEventListener('click', async (e) => {
        e.preventDefault(); // au cas où
        if (!confirm('Delete 3D model?')) return;

        const url = btn.dataset.deleteUrl;
        const csrf = btn.dataset.csrf;

        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        const data = await res.json().catch(() => null);

        if (!res.ok || !data?.ok) {
            alert(data?.error ?? 'Delete failed');
            return;
        }

        // UI: enlève le viewer + bloc
        btn.closest('.mt-4')?.remove();
        document.querySelector('model-viewer')?.closest('.mt-6')?.remove();
    });
});
