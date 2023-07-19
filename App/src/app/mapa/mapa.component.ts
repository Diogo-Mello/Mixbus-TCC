import { Component, AfterViewInit, Input } from '@angular/core';
import * as L from 'leaflet';
import { LocalizacaoOnibusService } from '../services/localizacao-onibus.service';

@Component({
  selector: 'app-mapa',
  templateUrl: './mapa.component.html',
  styleUrls: ['./mapa.component.scss']
})
export class MapaComponent implements AfterViewInit {
  private map;
  private marker: L.Marker;

  private localizacoes: any[] = [];
  private busMarkersLayer = L.layerGroup();
  private busStopLayer = L.layerGroup();


  private locateOptions = {
    watch: true,
    setView: true,
    maxZoom: 15
  };

  private localizacaoRodoviaria = [
    {
      latitude: -23.347562,
      longitude: -47.843680,
      legenda: 'Rodoviária de Tatuí'
    },
    {
      latitude: -23.34779,
      longitude: -47.68989,
      legenda: 'Rodoviária de Iperó'
    },
    {
      latitude: -23.284611,
      longitude: -47.675722,
      legenda: 'Rodoviária de Boituva'
    },
    {
      latitude: -23.50657,
      longitude: -47.45645,
      legenda: 'Rodoviária de Sorocaba'
    }
  ]

  private myIcon = L.icon({
    iconUrl: 'assets/images/locate.svg',
    iconSize: [30, 30]
  });

  private iconBus = L.icon({
    iconUrl: 'assets/icon/bus-stop.svg',
    iconSize: [30, 30]
  });

  private busStop = L.icon({
    iconUrl: 'assets/images/stop-icon.svg',
    iconSize: [30, 30]
  });



  private initMap(): void {
    this.map = L.map('map', {
      zoom: 18
    });

    this.map.locate(this.locateOptions);
    this.map.on('locationfound', this.onLocationFound.bind(this));

    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      minZoom: 1,
    });


    tiles.addTo(this.map);
    this.map.zoomControl.remove();

  }

  onLocationFound(e: L.LocationEvent) {
    const radius = e.accuracy / 2;
    if (this.marker) {
      this.map.removeLayer(this.marker);
    }
    this.marker = L.marker(e.latlng, { icon: this.myIcon }).addTo(this.map);
    if (this.locateOptions.setView) {
      this.map.setView(e.latlng);
    }
  }




  constructor(
    private LocalizacaoOnibusService: LocalizacaoOnibusService
  ) { }

  localizacaoRodoviarias() {
    this.localizacaoRodoviaria.forEach(rodoviaria => {
      const marker = L.marker([rodoviaria.latitude, rodoviaria.longitude], { icon: this.busStop }).bindPopup(rodoviaria.legenda);
      this.busStopLayer.addLayer(marker);
    })
    this.busStopLayer.addTo(this.map);
  }

  localizacoesonibus() {
    this.LocalizacaoOnibusService.localizacaoOnibus().subscribe(
      (response) => {
        this.localizacoes = [];
        response.forEach(localizacao => {
          this.localizacoes.push({ lat: parseFloat(localizacao.latitude), lng: parseFloat(localizacao.longitude) })
        });
        this.busMarkersLayer.clearLayers();
        this.addBusMarkers();

        setTimeout(() => {
          this.localizacoesonibus();
        }, 2000)
      },
      (error) => {
        console.log("ERRO: " + error.error);
        setTimeout(() => {
          this.localizacoesonibus();
        }, 2000)
      }
    );
  }


  private addBusMarkers() {
    this.localizacoes.forEach(localizacao => {
      const marker = L.marker([localizacao.lat, localizacao.lng], { icon: this.iconBus });
      this.busMarkersLayer.addLayer(marker);
    })
    this.busMarkersLayer.addTo(this.map);
  }

  ngAfterViewInit(): void {

    this.initMap();

    // Adiciona listener para o evento move do mapa
    setTimeout(() => {
      this.map.invalidateSize();
    }, 1000)

    setTimeout(() => {
      this.map.stopLocate();
      this.localizacoesonibus();
      this.localizacaoRodoviarias();
    }, 2000)



  }
}