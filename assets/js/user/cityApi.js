document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('user_profile_city');
    if (!input) {
        console.log("city-input not found");
        return;
    }

    const list = document.createElement('div');
    list.className = "border bg-white shadow rounded mt-1 absolute z-50 w-full";
    input.parentNode.appendChild(list);

    input.addEventListener('input', async () => {

        const q = input.value.trim();

        if (q.length < 2) {
            list.innerHTML = "";
            return;
        }

        try {
            const res = await fetch(
                `https://geo.api.gouv.fr/communes?nom=${q}&fields=nom,codesPostaux&limit=5`
            );

            const cities = await res.json();

            list.innerHTML = "";

            cities.forEach(city => {

                const item = document.createElement('div');
                item.className = "px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm";
                item.textContent = `${city.nom} (${city.codesPostaux[0]})`;

                item.onclick = () => {
                    input.value = city.nom;
                    list.innerHTML = "";
                };

                list.appendChild(item);
            });

        } catch (e) {
            console.error("API error", e);
        }

    });

});
