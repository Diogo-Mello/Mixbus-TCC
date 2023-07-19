import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Login{
  matricula: string,
  senha: string
}



@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/loginmotorista?pass=mixbus123api";

  login(login: Login): Observable<Login> {
    return this.http.post<Login>(this.URL, login);
  }
}
