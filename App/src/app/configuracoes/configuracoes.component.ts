import { Component, OnInit } from '@angular/core';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { ConfiguracoesService } from '../services/configuracoes.service';
import { Preferences } from '@capacitor/preferences';
import { AlertController } from '@ionic/angular';

@Injectable({ providedIn: 'root', })

@Component({
  selector: 'app-configuracoes',
  templateUrl: './configuracoes.component.html',
  styleUrls: ['./configuracoes.component.scss'],
})
export class ConfiguracoesComponent implements OnInit {

  public isDarkTheme: boolean;
  public senhaAntiga: string = "";
  public senhaNova1: string = "";
  public senhaNova2: string = "";

  public senha: string;

  public mensagemErro: string;
  public verificarErro: boolean = false;

  public idUsuario: number;


  constructor(
    private router: Router,
    private ConfiguracoesService: ConfiguracoesService,
    private alertController: AlertController
  ) { }

  alterarSenha() {
    this.verificarErro = false;
    if (this.senhaAntiga == "" || this.senhaNova1 == "" || this.senhaNova2 == "") {
      this.mensagemErro = "Digite todos o campos";
      this.verificarErro = true;
    } else if (this.senhaNova1 != this.senhaNova2) {
      this.mensagemErro = "As senhas não coincidem";
      this.verificarErro = true;
    } else {
      this.ConfiguracoesService.alterarSenha({
        id: this.idUsuario,
        senhaAntiga: this.senhaAntiga,
        senhaNova: this.senhaNova1,
      }).subscribe(
        (response) => {
          if (!response) {
            this.mensagemErro = "Senha antiga não confere";
            this.verificarErro = true;
          } else {
            this.senhaAntiga = "";
            this.senhaNova1 = "";
            this.senhaNova2 = "";
            this.mensagemErro = "Senha alterada com sucesso";
            this.verificarErro = true;
          }
        },
        (error) => {
          console.log(error.error);
        }
      );
    }
  }

  excluirConta() {
    this.verificarErro = false;
    if (this.senha == "") {
      this.mensagemErro = "Digite a senha antes de continuar"
      this.verificarErro = true;
    }
    else {
      this.ConfiguracoesService.excluirConta({
        id: this.idUsuario,
        senha: this.senha
      }).subscribe(
        (response) => {
          if (response) {
            this.removerDados();
            this.checkName();
            this.setOpenConta(false);
          }
          else {
            this.mensagemErro = "Dados inválidos, falha ao excluir conta";
            this.verificarErro = true;
          }
        },
        (error) => {
          console.log(error.error);
        }
      );
    }
  }

  removerDados = async () => {
    await Preferences.remove({ key: 'idUsuario' });
    await Preferences.remove({ key: 'nomeUsuario' });
  };

  async goToHomePage() {
    await this.router.navigate(['/tabs']);
  }

  isModalOpenSenha = false;
  isModalOpenConta = false;

  setOpenSenha(isOpen: boolean) {
    this.verificarErro = false;
    this.isModalOpenSenha = isOpen;
  }

  async setOpenConta(isOpen: boolean) {
    this.verificarErro = false;
    this.isModalOpenConta = isOpen;
  }

  checkName = async () => {
    const { value } = await Preferences.get({ key: 'idUsuario' });
    this.idUsuario = Number(value);
  };

  async alertExcluirConta() {
    const alert = await this.alertController.create({
      header: "Tem certeza?",
      message: "Isso excluirá todos seus dados",
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
            this.excluirConta()
          },
        },
      ],
    });

    await alert.present();
  }




  ngOnInit() {
    this.checkName();
  }
}

