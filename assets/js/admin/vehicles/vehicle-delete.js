document.addEventListener('click', async (event) => {

    const button = event.target.closest('.btn-delete');
    if (!button) return;

    event.preventDefault();

    if (!confirm('Delete this vehicle?')) {
        return;
    }

    const id = button.dataset.id;
    const token = button.dataset.token;

    try {

        const response = await fetch(`/api/admin/vehicles/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _token: token
            })
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            alert(data.error ?? 'Delete failed');
            return;
        }

        button.closest('tr')?.remove();

        await refreshVehicleCount();

    } catch (error) {
        console.error(error);
        alert('Network error');
    }

});

/*
Refresh vehicle KPI count
*/
async function refreshVehicleCount() {

    try {

        const res = await fetch('/api/admin/vehicles/count');

        if (!res.ok) return;

        const data = await res.json();

        const el = document.getElementById('vehicle-count');

        if (el) {
            el.textContent = data.count;
        }

    } catch (e) {
        console.error('KPI refresh failed', e);
    }
}
