import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Login{
  email: string,
  senha: string
}

export interface LoginResponse {
  id: string;
  nome: string;
}


@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/loginusuario?pass=mixbus123api";

  login(login: Login): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(this.URL, login);
  }
}
