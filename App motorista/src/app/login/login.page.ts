import { Component, OnInit } from '@angular/core';
import { LoginService } from '../services/login.service';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  constructor(
    private LoginService: LoginService,
    private router: Router
  ) { }

  public matricula: string = "";
  public senha: string = "";
  public verificarErro: boolean = false;
  public mensagemErro: string = "";
  public resposta: string;

  removeName = async () => {
    await Preferences.remove({ key: 'idMotorista' });
  };

  async login() {
    this.verificarErro = false;
    if (this.matricula == "" || this.senha == "") {
      this.mensagemErro = "Todos os dados devem ser preenchidos";
      this.verificarErro = true;
    } else {
      this.LoginService.login({
        matricula: this.matricula,
        senha: this.senha
      }).subscribe(
        (response) => {
          if (response) {
            this.verificarErro = false;
            const setName = async () => {
              await Preferences.set({
                key: 'idMotorista',
                value: String(response),
              });
              await this.router.navigate(['/home']);
            };
            setName();
          } else {
            this.mensagemErro = "Dados inválidos";
            this.verificarErro = true;
          }
        },
        (error) => {
          console.log(error.error)
        }
      );
    }
  }

  ngOnInit() {
    this.removeName();
  }

}
