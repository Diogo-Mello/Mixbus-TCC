import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Localizacao{
  id: number,
  latitude: string,
  longitude: string
}

@Injectable({
  providedIn: 'root'
})


export class LocalizacaoService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/cadastrolocalizacao?pass=mixbus123api";

  inserir(localizacao: Localizacao): Observable<Localizacao> {
    return this.http.post<Localizacao>(this.URL, localizacao);
  }
}
