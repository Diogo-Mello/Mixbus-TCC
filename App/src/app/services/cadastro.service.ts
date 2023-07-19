import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Cadastro {
  nome: string,
  email: string,
  senha: string
}



@Injectable({
  providedIn: 'root'
})
export class CadastroService {
  
  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/cadastrousuario?pass=mixbus123api";

  cadastro(cadastro: Cadastro): Observable<Cadastro> {
    return this.http.post<Cadastro>(this.URL, cadastro);
  }
}
