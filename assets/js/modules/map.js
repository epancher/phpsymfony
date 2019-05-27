import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// il faut exporter la classe si on veut pouvoir l'importer
export default class Map
{
    static init()
    {
        // a-t-on la map?
        let map = document.querySelector('#map')
        if (map === null) // si on ne trouve rien, on ne fait rien
        {
            return 
        }
        // si on a bien un élément, on créé unmap:
        map = L.map('map').setView([48.852969, 2.349903], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
            minZoom: 1,
            maxZoom: 20
        }).addTo(map);
        
        L.marker([48.852969, 2.349903]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();
    }
}