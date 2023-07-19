import { AfterViewInit, Component } from '@angular/core';
import { Preferences } from '@capacitor/preferences';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page implements AfterViewInit {

  public usuario = false;
  public idUsuario = "";
  public nomeUsuario = "";

  constructor() { }

  checkName = async () => {
    this.usuario = false;
    const {value} = await Preferences.get({ key: 'idUsuario' });
    this.idUsuario = value;

    if (this.idUsuario != null || Number(this.idUsuario) != 0) {
      this.usuario = true;

      const {value} = await Preferences.get({ key: 'nomeUsuario' });

      this.nomeUsuario = value;
    }
  };

  removeName = async () => {
    await Preferences.remove({ key: 'idUsuario' });
    await Preferences.remove({ key: 'nomeUsuario' });

    window.location.reload();
  };

  ionViewDidEnter() {
    // Sua função que será executada quando a página for carregada
    this.checkName();
  }

  ngAfterViewInit(): void {
  }

}
