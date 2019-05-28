import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// il faut exporter la classe si on veut pouvoir l'importer
export default class Map
{
    static init() {
        // a-t-on la map?
        let map = document.querySelector('#map')
        if (map === null) { // si on ne trouve rien, on ne fait rien
            return 
        }
        // si on a bien un élément, on créé un map:
        map = L.map('map').setView([44.957540, 5.785967], 6.5)
        let token = 'pk.eyJ1IjoiZXBhbmNoZXIiLCJhIjoiY2p3Nmdsb3RuMGFzeTQxbzRpbHc2NmltdyJ9.gJyYHk-qiw6SPw4Gydj6eQ'

        L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`, {
            // Il est toujours bien de laisser le lien vers la source des données
            maxZoom: 18,
            minZoom: 4,
            attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map)
        
        L.marker([44.957540, 5.785967]).addTo(map)
            .bindPopup('Forcalquier')
            .openPopup()
    }
}