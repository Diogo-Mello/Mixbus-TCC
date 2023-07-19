import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface AlterarSenha {
  id: number,
  senhaAntiga: string,
  senhaNova: string
}

export interface ExcluirConta {
  id: number,
  senha: string
}

@Injectable({
  providedIn: 'root'
})

export class ConfiguracoesService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/alterarsenha?pass=mixbus123api";
  private URL2 = this.EnderecoService.endereco+"api/excluirconta?pass=mixbus123api";

  alterarSenha(alterarSenha: AlterarSenha): Observable<AlterarSenha> {
    return this.http.post<AlterarSenha>(this.URL, alterarSenha);
  }

  excluirConta(excluirConta: ExcluirConta): Observable<ExcluirConta> {
    return this.http.post<ExcluirConta>(this.URL2, excluirConta);
  }
}
