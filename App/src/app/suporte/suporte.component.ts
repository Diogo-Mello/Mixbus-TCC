import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { SuporteService } from '../services/suporte.service';
import { ModalController } from '@ionic/angular';

@Component({
  selector: 'app-suporte',
  templateUrl: './suporte.component.html',
  styleUrls: ['./suporte.component.scss'],
})

export class SuporteComponent implements OnInit {


  public usuario = false;
  public suportes: any;
  public suporteDescricao = "";
  public idUsuario;

  constructor(
    private router: Router,
    private SuporteService: SuporteService,
    private modalController: ModalController
  ) { }

  cancel() {
    this.modalController.dismiss(null, 'Cancelar');
  }

  async confirm() {
    if (this.suporteDescricao != "") {
      this.modalController.dismiss();
      this.SuporteService.pedidoSuporte({
        descricao: this.suporteDescricao,
        fkUsuario: Number(this.idUsuario)
      }).subscribe(
        (response) => {
          window.location.reload();
        },
        error => {
          console.error('Erro ao enviar dados', error.error);
        }
      )
    }
  }

  checkName = async () => {
    const { value } = await Preferences.get({ key: 'idUsuario' });
    this.idUsuario = value;

    if (value != null) {
      this.usuario = true;

      await this.SuporteService.suporte({
        id: Number(value),
      }).subscribe(
        (response) => {
          if (!response) {
            
          } else {
            this.suportes = response;
          }
        }
      )
    };
  }

  goToHomePage() {
    this.router.navigate(['/tabs']);
  }

  ngOnInit(): void {
    this.checkName();
  }
}
