import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { LoginService } from '../services/login.service';
import { CadastroService } from '../services/cadastro.service';
import { Preferences } from '@capacitor/preferences';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {

  constructor(
    private router: Router,
    private LoginService: LoginService,
    private CadastroService: CadastroService
  ) { }

  public loginComponent: boolean = true;
  public email: string = "";
  public senha: string = "";
  public verificarErro: boolean = false;
  public mensagemErro: string = "";
  public resposta: string;

  public cadastroNome: string = "";
  public cadastroEmail: string = "";
  public cadastroSenha1: string = "";
  public cadastroSenha2: string = "";

  async login() {
    this.verificarErro = false;
    if (this.email == "" || this.senha == "") {
      this.mensagemErro = "Todos os dados devem ser preenchidos";
      this.verificarErro = true;
    } else {
      this.LoginService.login({
        email: this.email.toLowerCase(),
        senha: this.senha
      }).subscribe(
        (response) => {
          if (!response) {
            this.mensagemErro = "Email ou senha invalido";
            this.verificarErro = true;
          } else {
            const setName = async () => {
              await Preferences.set({
                key: 'idUsuario',
                value: `${response.id}`,
              });
              await Preferences.set({
                key: 'nomeUsuario',
                value: `${response.nome}`,
              });
            };
            setName();

            window.location.reload();
          }
          // this.verificarErro = false;
          // const setName = async () => {
          //   await Preferences.set({
          //     key: 'idMotorista',
          //     value: String(response),
          //   });
          // //   await this.router.navigate(['/home']);
          // };
          // setName();
        },
        (error) => {
          // this.mensagemErro = "Todos os dados devem ser preenchidos";
          // this.verificarErro = true;
          console.log(error.error);
          this.mensagemErro = "Tente novamente mais tarde";
          this.verificarErro = true;
        }
      );
    }
  }

  async cadastro() {
    this.verificarErro = false;
    if (this.cadastroEmail == "" || this.cadastroSenha1 == "" || this.cadastroNome == "" || this.cadastroSenha2 == "") {
      this.mensagemErro = "Todos os dados devem ser preenchidos";
      this.verificarErro = true;
    } else if (this.cadastroSenha1 != this.cadastroSenha2) {
      this.mensagemErro = "As senhas não são iguais";
      this.verificarErro = true;
    } else {
      this.CadastroService.cadastro({
        nome: this.cadastroNome.replace(/(?:^|\s)\w/g, match => match.toUpperCase()),
        email: this.cadastroEmail.toLowerCase(),
        senha: this.cadastroSenha1
      }).subscribe(
        (response) => {
          if (!response) {
            this.mensagemErro = "Este Email já possui uma conta!";
            this.verificarErro = true;
          } else {
            this.cadastroEmail = "";
            this.cadastroNome = "";
            this.cadastroSenha1 = "";
            this.cadastroSenha2 = "";
            this.email = "";
            this.senha = "";
            this.mensagemErro = "Conta cadastrada com sucesso";
            this.verificarErro = true;
            this.loginComponent = true;
          }
          // this.verificarErro = false;
          // const setName = async () => {
          //   await Preferences.set({
          //     key: 'idMotorista',
          //     value: String(response),
          //   });
          // //   await this.router.navigate(['/home']);
          // };
          // setName();
        },
        (error) => {
          // this.mensagemErro = "Todos os dados devem ser preenchidos";
          // this.verificarErro = true;
          console.log(error.error);
          this.mensagemErro = "Tente novamente mais tarde";
          this.verificarErro = true;
        }
      );
    }
  }

  ngOnInit() {
  }
}
