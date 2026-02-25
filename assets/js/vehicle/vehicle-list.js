document.addEventListener('DOMContentLoaded', async () => {

    const container = document.getElementById('vehicles');
    const template = document.getElementById('vehicle-card-template');

    try {

        const response = await fetch('/api/vehicles?order[createdAt]=desc', {
            headers: {
                'Accept': 'application/ld+json'
            }
        });

        const data = await response.json();
    console.log(data);
        if (!data.member || data.member.length === 0) {
            container.innerHTML =
                "<p>No vehicles available</p>";
            return;
        }

        data.member.forEach(vehicle => {

            const clone = template.content.cloneNode(true);

            const link = clone.querySelector("a");

            link.href = `/vehicle/${vehicle.id}`;

            clone.querySelector(".vehicle-name")
                .textContent = vehicle.name;

            clone.querySelector(".vehicle-price")
                .textContent =
                vehicle.price.toLocaleString() + " €";

            clone.querySelector(".vehicle-mileage")
                .textContent =
                vehicle.mileage + " km";

            clone.querySelector(".vehicle-year")
                .textContent =
                vehicle.year;

            clone.querySelector(".vehicle-brand")
                .textContent =
                vehicle.brand?.name ?? "";

            const img = clone.querySelector(".vehicle-image");

            if (vehicle.images?.length > 0) {
                img.src = vehicle.images[0].path;
            } else {
                img.src = "/uploads/noImageAvailable.png";
            }

            clone.querySelector(".vehicle-category").textContent = vehicle.category.name;

            clone.querySelector(".vehicle-fuel").textContent = vehicle.fuel.name

            container.appendChild(clone);
        });

    } catch (error) {
        console.error(error);
        container.innerHTML =
            "<p>Error loading vehicles</p>";
    }
});
