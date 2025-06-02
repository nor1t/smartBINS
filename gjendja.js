function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: 42.65422, lng: 21.16291 }
    });

    const bins = [
        { name: "Salla 1 Tetori", latitude: 42.65391, longitude: 21.16743, fill_percentage: 19 },
        { name: "QKUK", latitude: 42.64413, longitude: 21.16532, fill_percentage: 20 },
        { name: "Parku i Qytetit", latitude: 42.66111, longitude: 21.16944, fill_percentage: 28 },
        { name: "Fakulteti Teknik", latitude: 42.64867, longitude: 21.16773, fill_percentage: 32 },
        { name: "Bregu i Diellit", latitude: 42.65299, longitude: 21.17447, fill_percentage: 36 },
        { name: "Stacioni i autobuseve", latitude: 42.65048, longitude: 21.14781, fill_percentage: 47 },
        { name: "Rruga Agim Ramadani", latitude: 42.6581, longitude: 21.16477, fill_percentage: 50 },
        { name: "Stadiumi Fadil Vokrri", latitude: 42.66265, longitude: 21.15585, fill_percentage: 58 },
        { name: "Pejton", latitude: 42.65699, longitude: 21.15451, fill_percentage: 64 },
        { name: "Ulpiane", latitude: 42.64769, longitude: 21.15832, fill_percentage: 68 },
        { name: "Aktash", latitude: 42.65886, longitude: 21.16769, fill_percentage: 71 },
        { name: "Katedralja", latitude: 42.65640, longitude: 21.15884, fill_percentage: 72 },
        { name: "Dardania pika 2", latitude: 42.65240, longitude: 21.14978, fill_percentage: 73 },
        { name: "Rruga Egnatia", latitude: 42.65349, longitude: 21.16149, fill_percentage: 76 },
        { name: "Qendra", latitude: 42.65920, longitude: 21.16030, fill_percentage: 83 },
        { name: "Sheshi Ibrahim Rugova", latitude: 42.66421, longitude: 21.16444, fill_percentage: 84 },
        { name: "Arberi", latitude: 42.65661, longitude: 21.14822, fill_percentage: 88 },
        { name: "Fontana", latitude: 42.65149, longitude: 21.16432, fill_percentage: 91 },
        { name: "Dardania pika 1", latitude: 42.65188, longitude: 21.15314, fill_percentage: 92 },
        { name: "Rruga B", latitude: 42.64773, longitude: 21.17184, fill_percentage: 97 }
    ];

    const list = document.getElementById("bin-list");

    bins.forEach(bin => {

    let low = 6, medium = 8, high = 5;
    let iconColor = "https://maps.google.com/mapfiles/kml/pushpin/grn-pushpin.png";
    let listClass = "low-fill";

    if (bin.fill_percentage > 80) {
    iconColor = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
    listClass = "high-fill";
    high++;
} else if (bin.fill_percentage >= 50) {
    iconColor = "http://maps.google.com/mapfiles/ms/icons/orange-dot.png";
    listClass = "medium-fill";
    medium++;
} else {
    listClass = "low-fill";
    low++;
}

    if (bin.fill_percentage > 80) {
        iconColor = "https://maps.google.com/mapfiles/kml/pushpin/red-pushpin.png";
        listClass = "high-fill";
    } else if (bin.fill_percentage >= 50) {
        iconColor = "https://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png";
        listClass = "medium-fill";
    }
    
document.getElementById("low-count").textContent = `🟢 Pak të mbushur: ${low}`;
document.getElementById("med-count").textContent = `🟠 Mesatarisht: ${medium}`;
document.getElementById("high-count").textContent = `🔴 Shumë të mbushur: ${high}`;

    const marker = new google.maps.Marker({
        position: { lat: bin.latitude, lng: bin.longitude },
        map: map,
        title: `${bin.name} - ${bin.fill_percentage}% full`,
        icon: iconColor
    });

    const li = document.createElement("li");
    li.textContent = `${bin.name}: ${bin.fill_percentage}% full`;
    li.classList.add(listClass);
    list.appendChild(li);
});
}
