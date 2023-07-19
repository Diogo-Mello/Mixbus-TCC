import { Component, OnInit } from '@angular/core';
import { LocalizacaoService } from '../services/localizacao.service';
import { HomeService } from '../services/home.service';
import { LinhaService } from '../services/linha.service';
import { AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';


@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
  public intervalLocalizacao: any;
  public linhaAtual = undefined;
  public card: boolean = false;
  public verificarErro: boolean = false;
  public mensagemErro: string = "Você deve selecionar uma linha";
  public LocalizacaoCompartilhada: boolean = false;
  public nomeMotorista: string;
  public empresaMotorista: string;
  public idMotorista: number;
  public linhas = [];


  localizacao = {
    latitude: 0,
    longitude: 0
  }

  constructor(
    private LocalizacaoService: LocalizacaoService,
    private HomeService: HomeService,
    private LinhaService: LinhaService,
    private alertController: AlertController,
    private router: Router
  ) { }

  async alert1() {
    if (this.linhaAtual) {
      this.verificarErro = false;
      const alert = await this.alertController.create({
        header: "Tem certeza?",
        message: "Isso irá compartilhar sua localização com o aplicativo",
        buttons: [
          {
            text: 'Não',
            role: 'cancel',
            handler: () => {

            },
          },
          {
            text: 'Sim',
            role: 'confirm',
            handler: () => {
              this.compartilharLocalizacao();
              this.LocalizacaoCompartilhada = true;
            },
          },
        ],
      });

      await alert.present();
    } else {
      this.verificarErro = true;
    }
  }

  async alert2() {
    const alert = await this.alertController.create({
      header: "Tem certeza?",
      message: "Isso irá encerrar sua localização",
      buttons: [
        {
          text: 'Não',
          role: 'cancel',
          handler: () => {

          },
        },
        {
          text: 'Sim',
          role: 'confirm',
          handler: () => {
            this.pararLocalizacao();
            this.linhaAtual = undefined;
            this.LocalizacaoCompartilhada = false;
          },
        },
      ],
    });
    await alert.present();



  }

  compartilharLocalizacao() {
    this.intervalLocalizacao = setInterval(() => {
      navigator.geolocation.getCurrentPosition((position) => {
        if (this.linhaAtual) {
          this.localizacao["latitude"] = position.coords.latitude;
          this.localizacao["longitude"] = position.coords.longitude;

          this.LocalizacaoService.inserir({
            id: this.linhaAtual['id'],
            latitude: String(position.coords.latitude),
            longitude: String(position.coords.longitude),
          }).subscribe();
        }
      })
    }, 2000);
  }

  pararLocalizacao() {
    clearInterval(this.intervalLocalizacao);
    this.LocalizacaoCompartilhada = false;
  }

  logout() {
    this.router.navigate(['/login']);
  }

  checkName = async () => {

    const { value } = await Preferences.get({ key: 'idMotorista' });
    if (value == null || Number(value) == 0) {
      this.router.navigate(['/login']);
      return;
    }

    this.HomeService.motorista({
      id: Number(value)
    }).subscribe(
      (response) => {
        this.nomeMotorista = response.nome;
        this.empresaMotorista = response.empresa;
      },
      (error) => {
        console.log(error.error);
      }
    );
  };

  linhaService() {
    this.LinhaService.linhas().subscribe(
      (response) => {
        this.linhas = response;
      },
      (error) => {
        console.log(error.error);
      }
    );
  }

  ionViewDidEnter() {
    // Sua função que será executada quando a página for carregada
    this.checkName();
    this.linhaService();
  }

  ngOnInit(): void {
  }
}
