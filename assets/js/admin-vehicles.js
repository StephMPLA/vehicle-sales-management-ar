document.addEventListener('DOMContentLoaded', () => {
    initDeleteVehicle();
});

function initDeleteVehicle() {

    document.querySelectorAll('.btn-delete').forEach(button => {

        button.addEventListener('click', async (e) => {

            e.preventDefault();

            if (!confirm("Delete this vehicle?")) return;

            const id = button.dataset.id;
            const token = button.dataset.token;

            const response = await fetch(`/api/admin/vehicles/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ _token: token })
            });

            if (!response.ok) {
                alert("Delete failed");
                return;
            }

            // remove row from table
            button.closest('tr')?.remove();

            // refresh KPI count from API
            await refreshVehicleCount();
        });

    });
}


/*
Refresh vehicle KPI count
*/
async function refreshVehicleCount() {

    const res = await fetch('/api/admin/vehicles/count');

    if (!res.ok) return;

    const data = await res.json();

    const el = document.getElementById('vehicle-count');

    if (el) {
        el.textContent = data.count;
    }
}


document.addEventListener('click', async e => {

    const btn = e.target.closest('.delete-image');
    if (!btn) return;

    if (!confirm('Delete image ?')) return;

    const id = btn.dataset.id;

    const response = await fetch(
        `/admin/vehicle/image/${id}`,
        {
            method: 'DELETE'
        }
    );

    const data = await response.json();

    if (data.success) {
        btn.closest('[data-image-id]').remove();
    }
});
